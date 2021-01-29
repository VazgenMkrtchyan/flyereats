<?php namespace App\AppCore\Front\Payments\Repositories;
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

use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Payment, OrderCache;

class PaymentRepository extends EloquentRepository {

	protected $model;

	function __construct(Payment $model)
	{
		$this->model = $model;
	}

	//adds record to database
	public function addPayment($ipnMessage)
	{
		$invoice = $ipnMessage['invoice'];
		$tempOrderInfo = $this->orderCache($invoice);

		$payment = $this->model->create([
			'for' => $tempOrderInfo->for,
			'for_id' => $tempOrderInfo->for_id,
			'user_id' => $tempOrderInfo->user_id,
			'listing_id' => $tempOrderInfo->listing_id,
			'payment_status' => $ipnMessage['payment_status'], // 'pending' or 'completed'
			'txn_id' => $ipnMessage['txn_id'],
			'invoice_no' => $invoice,
			'amount' => $ipnMessage['mc_gross']
		]);

		//deletes temporary data
		$tempOrderInfo->delete();

		return $payment;
	}

	//updates payment status
	function updatePaymentStatus($invoice, $status)
	{
		$this->model->where('invoice_no', $invoice)->update(['payment_status' => $status]);

		return $this->model->where('invoice_no', $invoice)->first();
	}

	//gets user payments
	public function getUserPayments($userId)
	{
		return $this->model->where('user_id', $userId)->get();
	}

	//checks if payment exists
	public function paymentExists($invoice)
	{
		return $this->model->where('invoice_no', $invoice)->exists();
	}

	//returns cached order
	public function orderCache($invoice)
	{
		$orderCache = OrderCache::where('invoice_no', $invoice)->first();
		return $orderCache;
	}

	//deletes payment by invoice number
	public function deletePayment($invoice)
	{
		$this->model->where('invoice_no', $invoice)->delete();
	}


} 