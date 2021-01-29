<?php namespace App\AppCore\Admin\Permissions\Repositories;
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
use Permission;
use PermissionGroup;
use DB;

class PermissionRepository extends EloquentRepository {

	protected $model;

	public function __construct(Permission $permission)
	{
		$this->model = $permission;
	}


	public function getPermissions($permissiongGroupId)
	{
		$permissions = $this->model
			->orderBy('order')
			->where('permission_group_id', $permissiongGroupId);

		$perPage = getOrWebc('ai_datafields_no', 'per_page');

		return $permissions->paginate($perPage);
	}


	public function updatePermission($permissionId, $data)
	{
		$this->update($permissionId, $data, ['system_protected']);
	}


	public function addPermission($data, $permissionGroupId)
	{
		$data['permission_group_id'] = $permissionGroupId;
		$this->create($data);
	}


	public function parent($permissionGroupId)
	{
		return PermissionGroup::find($permissionGroupId);
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

	//returns array of select options
	public function listPermissionGroups()
	{
		return PermissionGroup::orderBy('order')->orderBy('name')->pluck('name', 'id')->all();
	}

	//returns data array for user permissions
	public function userPermissionsTreeView($userId)
	{
		$permissionGroups = PermissionGroup::leftJoin('permissions', 'permission_groups.id', '=', 'permissions.permission_group_id')
			->leftJoin('permission_user', function($join) use ($userId) {
				$join->on('permissions.id', '=', 'permission_user.permission_id')
					->where('permission_user.user_id', '=', $userId);
			})
			->groupBy('permission_groups.id')
			->orderBy('permission_groups.order')
			->orderBy('permission_groups.name')
			->get(['permission_groups.*', DB::raw("COUNT(permission_user.id) AS selectedPermissions")]);


		$data = [];
		$PGI = 1; //permission group loop index
		foreach ($permissionGroups as $permissionGroup)
		{
			$permissions = $permissionGroup->permissions()
				->leftJoin('permission_user', function($join) use ($userId) {
					$join->on('permissions.id', '=', 'permission_user.permission_id')
						->where('permission_user.user_id', '=', $userId);
				})
				->groupBy('permissions.id')
				->orderBy('permissions.order')
				->get(['permissions.*', 'permission_user.user_id AS userHasPermission']);

			$permissionData = [];
			$pI = 1; //permission loop index
			foreach ($permissions as $permission)
			{
				$permissionData[$pI] = ['text' => $permission->description, 'type' => 'item'];

				$permissionData[$pI]['additionalParameters'] = ['item-selected' => ($permission->userHasPermission) ? true : false, 'id' => $permission->id];

				$pI++;
			}

			$data[$PGI] = ['text' => $permissionGroup->name .' ('.$permissionGroup->selectedPermissions.' selected)', 'type' => 'folder'];
			$data[$PGI]['additionalParameters'] = ['children' => $permissionData];

			$PGI++;
		}

		return $data;
	}

}