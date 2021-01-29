<?php namespace App\AppCore\Admin\PermissionGroups\Repositories;
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
use PermissionGroup, DB;

class PermissionGroupRepository extends EloquentRepository {

	protected $model;

	public function __construct(PermissionGroup $permissionGroup)
	{
		$this->model = $permissionGroup;
	}


	public function permissionGroups()
	{
		$perPage = getOrWebc('ai_datafields_no', 'per_page');

		$results = $this->model
			->orderBy('order')
			->orderBy('name')
			->select([
				'permission_groups.*',
				DB::raw("(SELECT COUNT(*) FROM permissions WHERE permission_groups.id = permissions.permission_group_id) AS permissionsNo")
			])
			->paginate($perPage);

		return $results;
	}


	public function updatePermissionGroup($permissionGroupId, $data)
	{
		$this->update($permissionGroupId, $data, ['system_protected']);
	}

	//updates order
	public function updateOrder(array $data)
	{
		foreach ($data as $key => $value) {

			if (substr($key, 0, 6) == 'order_')
			{
				//gets id
				$id = substr($key, 6);
				//updates record
				$this->model->where('id', $id)->update(['order' => $value]);
			}
		}
	}

}