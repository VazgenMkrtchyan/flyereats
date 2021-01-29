<?php namespace App\Http\Controllers\Admin;
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

use App\Http\Controllers\Controller;

use App\AppCore\Admin\Permissions\Repositories\PermissionRepository;
use App\AppCore\Admin\Permissions\Requests\CreatePermissionRequest;
use App\AppCore\Admin\Permissions\Requests\UpdatePermissionRequest;
use Input;

class PermissionsController extends Controller {

	protected $permissionRepo;

	public function __construct(PermissionRepository $permissionRepository)
	{
		$this->permissionRepo = $permissionRepository;
	}

	public function index($permissionGroupId)
	{
		$permissions = $this->permissionRepo->getPermissions($permissionGroupId);
		$parent = $this->permissionRepo->parent($permissionGroupId);

		return view('admin.permissions.index', [
			'permissions' => $permissions,
			'parent' => $parent
		]);
	}


	public function create($permissionGroupId)
	{
		$parent = $this->permissionRepo->parent($permissionGroupId);

		return view('admin.permissions.create', [
			'parent' => $parent
		]);
	}


	public function store($permissionGroupId, CreatePermissionRequest $request)
	{
		//creates record in database
		$this->permissionRepo->addPermission($request->all(), $permissionGroupId);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.permissions.index', $permissionGroupId);
	}


	public function edit($permissionGroupId, $permissionId)
	{
		$permission = $this->permissionRepo->getById($permissionId);
		$parent = $this->permissionRepo->parent($permissionGroupId);

		return view('admin.permissions.edit', [
			'permission' => $permission,
			'parent' => $parent
		]);
	}


	public function update($permissionGroupId, $permissionId, UpdatePermissionRequest $request)
	{
		$this->permissionRepo->updatePermission($permissionId, $request->all());

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.permissions.index', $permissionGroupId);
	}


	public function destroy($permissionGroupId, $permissionId)
	{
		$permission = $this->permissionRepo->getById($permissionId);

		if (! $permission->isProtected())
		{
			$permission->delete();

			flash()->success(trans('back.flash_successfully_deleted'));
		}
		else
		{
			flash()->error(trans('back.flash_permission_protected'));
		}

		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();
		//updates order
		$this->permissionRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}
