<?php namespace App\AppCore\Admin\DataFields\Features\Repositories;
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

class FeaturesRepository {

	use UpdateOrderTrait;

	public $model;
	public function __construct()
	{
		$this->model = DB::table('features');
	}


	public function features()
	{
		$perPage = sessionOrWebc('ai_datafields_no', \Route::currentRouteName());

		$results = $this->model
			->orderBy('order')
			->orderBy('name')
			->select(
				['features.*',
				DB::raw("(SELECT COUNT(*) FROM feature_listing AS f_l WHERE features.id = f_l.feature_id) AS listingsNo")
				])
			->paginate($perPage);

		return $results;
	}


	public function addFeature($data)
	{
		$data['active'] = true;
		$this->model->insert($data);
	}

	//checks if there is listings using features in selected feature group
	public function inUse($id)
	{
		$inUse = DB::table('feature_listing')
			->where('feature_id', $id)
			->exists();

		return $inUse;
	}


	public function parent($featureGroupId)
	{
		return DB::table('feature_groups')->find($featureGroupId);
	}


	public function updateOrder($data)
	{
		$this->updateOrderFunction('features', $data);
	}

}