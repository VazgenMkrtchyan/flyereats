<?php namespace App\AppCore\Admin\DataFields\Identic\Repositories;
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

class IdenticRepository {

	use UpdateOrderTrait;

	public $table; //database table

	public function __construct($table)
	{
		$this->table = $table;
		$this->model = DB::table($table);
	}


	public function values()
	{
		//results per page
		$perPage = sessionOrWebc('ai_datafields_no', 'admin.data_solo.index');
		$foreignKey = substr($this->table, 0, -1).'_id';

		//exception for states
		if ($foreignKey == 'det_state_id') $foreignKey = 'state_id';

		$results = $this->model
			->orderBy('order')
			->orderBy('name')
			->select([
				$this->table.'.*',
				DB::raw("(SELECT COUNT(*) FROM listings WHERE listings.$foreignKey = $this->table.id) AS listingsNo")
			])
			->paginate($perPage);

		return $results;
	}


	public function addField($data)
	{
		$data['active'] = true;
		$this->model->insert([$data]);
	}


	public function updateOrder($data)
	{
		$this->updateOrderFunction($this->table, $data);
	}


	public function inUse($id)
	{
		$foreignKey = substr($this->table, 0, -1).'_id';

		//fixes problem with states
		if ($foreignKey == 'det_state_id') $foreignKey = 'state_id';

		return DB::table('listings')->where($foreignKey, $id)->exists();
	}


}