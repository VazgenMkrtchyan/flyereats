<?php namespace App\AppCore\Front\Payments\Jobs;
/**
 *
 * This file is part of the software provided by AppsWWW <http://www.appswww.com>
 *
 * Reproduce, re-sell, distribute, sublicense, disclose, market,
 * rent, lease or transfer the Licensed Software is not permitted
 * by this Agreement
 *
 *
 * For full copyright and license information, please visit
 * http://www.appswww.com/license-agreement/
 *
 * @copyright (c) Laimonas Prei (l.preisas@gmail.com)
 */

use App\AppCore\Miscellaneous\Abstractions\Job;

use App\AppCore\Front\ListingPlans\Jobs\HighFeatListing;
use App\AppCore\Front\ListingPlans\Jobs\ApplyListingPlan;
use App\AppCore\Front\MembershipPlans\Jobs\ApplyMembershipPlan;
use App\AppCore\Front\Payments\Repositories\PaymentRepository;

class ProcessPayment extends Job
{
	public $ipnMessage;

	
	public function __construct($ipnMessage)
	{
		$this->ipnMessage = $ipnMessage;
	}


	public function handle(PaymentRepository $paymentRepository)
	{
		$ipnMessage = $this->ipnMessage;
		$paymentStatus = $ipnMessage['payment_status'];
		$invoice = $ipnMessage['invoice'];

		//PAYMENT PROCESSING - writing to database, changing status and so on
		//if payment is COMPLETED
		if ($paymentStatus == 'Completed') {
			//checks if payment exists
			if ($paymentRepository->paymentExists($invoice)) {
				$payment = $paymentRepository->updatePaymentStatus($invoice, 'Completed');
			}
			else {
				//adds payment record to database
				$payment = $paymentRepository->addPayment($ipnMessage);
			}

			//APPLIES CORRECT ACTION (if payment is VALID)
			if ($this->validPayment($payment, $ipnMessage)) {
				$userId = $payment->user_id;
				$forId = $payment->for_id;
				$listingId = $payment->listing_id;

				if ($payment->forMembershipPlan()) {
					$this->dispatchNow(new ApplyMembershipPlan($userId, $forId));
				}
				elseif ($payment->forListingPlan()) {
					$this->dispatchNow(new ApplyListingPlan($listingId, $forId));
				}
				elseif ($payment->forListingHighOrFeat()) {
					$this->dispatchNow(new HighFeatListing($listingId, $forId));
				}
			}
		} //IF OTHER STATUS THAN COMPLETED
		else {
			if ($paymentRepository->paymentExists($invoice)) {
				$paymentRepository->updatePaymentStatus($invoice, $paymentStatus);
			}
			else {
				//adds payment record to database
				$paymentRepository->addPayment($ipnMessage);
			}
		} //updates payment status in database
		// ./PAYMENTS

		//deletes payment data if it's amount is 0
		if (! $ipnMessage['mc_gross'])
		{
			$paymentRepository->deletePayment($invoice);
		}
	}

	##HELPERS##
	//checks if everything is ok with the payment (correct price, correct currency ,correct recipient)
	protected function validPayment($paymentEntity, $ipnMessage)
	{
		if (strtolower($ipnMessage['business']) == strtolower(appCon()->pp_email)
			AND $ipnMessage['mc_currency'] == strtoupper(appCon()->pp_curr_code)
			AND $ipnMessage['mc_gross'] == $paymentEntity->paymentFor->price
		)
		{
			return true;
		}

		return false;
	}

}