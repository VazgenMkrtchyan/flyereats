<?php namespace App\AppCore\Miscellaneous\AJAX\Repositories;
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

class AJAXValidationsRepository {

	//checks if unique email
	public function uniqueEmail($email, $exceptId = null)
	{
		$exists = DB::table('users')->where('email', $email);

		if ($exceptId)
		{
			$exists->where('id', '!=', $exceptId);
		}

		return ! $exists->exists();
	}

	//checks if unique username
	public function uniqueUsername($username, $exceptId = null)
	{
		$exists = DB::table('users')->where('username', $username);

		if ($exceptId)
		{
			$exists->where('id', '!=', $exceptId);
		}

		return ! $exists->exists();
	}

	//checks whether entered ZIP code exists
	public function validZIP($ZIP)
	{
		return DB::table('zip_codes')->where('zip_code', $ZIP)->exists();
	}

	//checks if detail name is unique
	//ability to provide foreign key and it's value (applicable for models, locations, features, )
	public function uniqueDetailName($table, $name, $exceptId = null, $foreignKey = null, $parentId = null)
	{
		$exists = DB::table($table)
			->where('name', $name);

		if ($exceptId != "")
		{
			$exists->where('id', '!=', $exceptId);
		}

		if ($foreignKey != null AND $parentId != null)
		{
			$exists->where($foreignKey, $parentId);
		}

		return ! $exists->exists();
	}
}