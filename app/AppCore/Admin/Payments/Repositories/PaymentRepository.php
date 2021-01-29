<?php namespace App\AppCore\Admin\Payments\Repositories;
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
use Payment;

class PaymentRepository extends EloquentRepository {

	protected $model;
	function __construct(Payment $model)
	{
		$this->model = $model;
	}


	public function getPayments($data)
	{
		$payments = $this->buildWhere($data);

		//payments per page
		$perPage = sessionOrWebc('ai_payments_no', \Route::currentRouteName());

		return $payments->paginate($perPage);
	}


	//counts payments
	public function counter()
	{
		$count['all'] = $this->buildWhere()->count();
		$count['status.completed'] = $this->buildWhere(['status' => 'completed'])->count();
		$count['status.notCompleted'] = $this->buildWhere(['status' => 'notCompleted'])->count();

		$count['for.membershipPlan'] = $this->buildWhere(['paymentFor' => 'membershipPlan'])->count();
		$count['for.listingPlan'] = $this->buildWhere(['paymentFor' => 'listingPlan'])->count();
		$count['for.listingHigh'] = $this->buildWhere(['paymentFor' => 'listingHigh'])->count();
		$count['for.listingFeat'] = $this->buildWhere(['paymentFor' => 'listingFeat'])->count();

		return $count;
	}


	## HELPERS ##
	protected function buildWhere($data = null)
	{
		$payments = $this->model->from('payments');

		if (! empty($data['status'])) {
			$status = $data['status'];
			if ($status == 'completed') $payments->completed();
			if ($status == 'notCompleted') $payments->notCompleted();
		}

		if (! empty($data['paymentFor'])) {
			$for = $data['paymentFor'];
			if ($for == 'membershipPlan') $payments->forMembership();
			if ($for == 'listingPlan') $payments->forListing();
			if ($for == 'listingHigh') $payments->forHighlighting();
			if ($for == 'listingFeat') $payments->forFeaturing();
		}

		return $payments;
	}
}