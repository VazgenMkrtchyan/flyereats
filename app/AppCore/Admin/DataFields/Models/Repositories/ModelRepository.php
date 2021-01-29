<?php namespace App\AppCore\Admin\DataFields\Models\Repositories;
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
use App\AppCore\Miscellaneous\Traits\UpdateOrderTrait;
use DB, Model;

class ModelRepository extends EloquentRepository {

	use UpdateOrderTrait;

	public $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}


	public function models($makeId)
	{
		$perPage = sessionOrWebc('ai_datafields_no', \Route::currentRouteName());

		$results = $this->model
			->where('make_id', $makeId)
			->ordered()
			->select([
				'models.*',
				DB::raw("(SELECT COUNT(*) FROM listings WHERE `models`.`id` = `listings`.`model_id`) as listingsNo")
			])
			->paginate($perPage);

		return $results;
	}


	public function addModel($data, $makeId)
	{
		$data['make_id'] = $makeId;
		$data['active'] = true;
		$this->model->insert($data);
	}
	

	public function parent($makeId)
	{
		return DB::table('makes')->find($makeId);
	}


	public function updateOrder($data)
	{
		$this->updateOrderFunction('models', $data);
	}

}