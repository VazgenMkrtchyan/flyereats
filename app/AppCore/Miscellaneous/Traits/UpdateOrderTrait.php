<?php namespace App\AppCore\Miscellaneous\Traits;
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

use DB;

trait UpdateOrderTrait {

	public function updateOrderFunction($table, array $data, $prefix = 'order_')
	{
		foreach ($data as $key => $value)
		{
			if (substr($key, 0, strlen($prefix)) == $prefix) {
				//gets record's id
				$id = substr($key, strlen($prefix));
				//updates record
				DB::table($table)->where('id', $id)->update(['order' => $value]);
			}
		}
	}
}