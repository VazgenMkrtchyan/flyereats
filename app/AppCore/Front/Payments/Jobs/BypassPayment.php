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

use App\AppCore\Front\Payments\Jobs\ProcessPayment;

class BypassPayment extends Job
{
	public $orderCacheEntity;

	
	public function __construct($orderCacheEntity)
	{
		$this->orderCacheEntity = $orderCacheEntity;
	}


	public function handle()
	{
		$orderInfo = $this->orderCacheEntity;

		//simulating IPN message for payment bypassing
		$ipnMessage['payment_status'] = 'Completed';
		$ipnMessage['business'] = strtolower(appCon()->pp_email);
		$ipnMessage['mc_currency'] = strtoupper(appCon()->pp_curr_code);
		$ipnMessage['mc_gross'] = $orderInfo->orderFor->price;
		$ipnMessage['invoice'] = $orderInfo->invoice_no;
		$ipnMessage['txn_id'] = 'BYPASSED'; //for knowing that payment was bypassed

		$this->dispatchNow(new ProcessPayment($ipnMessage));
	}

}