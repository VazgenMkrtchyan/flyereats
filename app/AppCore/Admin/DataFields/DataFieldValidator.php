<?php namespace App\AppCore\Admin\DataFields;
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

class DataFieldValidator {

	public function validate($attribute, $value, $parameters)
	{
		$table = $parameters[0];
		$parentColumn = $parameters[1];
		$parentId = $parameters[2];

		$exists = DB::table($table)
			->where($parentColumn, $parentId)
			->where($attribute, $value);

		//except ID
		if (isset($parameters[3]))
		{
			$exists->where('id', '!=', $parameters[3]);
		}

		return ! $exists->exists();
	}
}