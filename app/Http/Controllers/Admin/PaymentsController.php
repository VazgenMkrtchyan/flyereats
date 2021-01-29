<?php namespace App\Http\Controllers\Admin;
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

use App\Http\Controllers\Controller;

use App\AppCore\Admin\Payments\Repositories\PaymentRepository;
use Input;

class PaymentsController extends Controller {

	protected $paymentRepo;
	function __construct(PaymentRepository $paymentRepository)
	{
		$this->paymentRepo = $paymentRepository;
	}

	public function index()
	{
		$searchData = Input::all();

		$payments = $this->paymentRepo->getPayments($searchData);
		$counter = $this->paymentRepo->counter();

		return view('admin.payments.index', [
			'payments' => $payments,
			'counter' => $counter
		]);
	}

	//deletes payment record
	public function destroy($paymentId)
	{
		$this->paymentRepo->destroy($paymentId);

		flash()->success(trans('back.flash_successfully_deleted'));
		return redirect()->route('admin.payments.index');
	}
}