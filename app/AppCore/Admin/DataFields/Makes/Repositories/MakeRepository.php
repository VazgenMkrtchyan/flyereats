<?php namespace App\AppCore\Admin\DataFields\Makes\Repositories;
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

use App\AppCore\Miscellaneous\Traits\UpdateOrderTrait;
use DB;

class MakeRepository {

	use UpdateOrderTrait;

	public $model;
	public function __construct()
	{
		$this->model = DB::table('makes');
	}


	public function makes()
	{
		$perPage = sessionOrWebc('ai_datafields_no', \Route::currentRouteName());

		$results = $this->model
			->orderBy('order')
			->orderBy('name')
			->select([
				'makes.*',
				DB::raw("(SELECT COUNT(*) FROM models WHERE makes.id = models.make_id) AS modelsNo"),
				DB::raw("(SELECT COUNT(*) FROM listings WHERE makes.id = listings.make_id) AS listingsNo"),
			])
			->paginate($perPage);

		return $results;
	}


	public function addMake($data)
	{
		$data['active'] = true;
		$this->model->insert($data);
	}

	//checks if there is listings using features in selected feature group
	public function inUse($id)
	{
		$inUse = DB::table('listings')
			->where('make_id', $id)
			->exists();

		return $inUse;
	}


	public function updateOrder($data)
	{
		$this->updateOrderFunction('makes', $data);
	}

}