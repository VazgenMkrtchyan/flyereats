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

use App\AppCore\Admin\PermissionGroups\Repositories\PermissionGroupRepository;
use App\AppCore\Admin\PermissionGroups\Requests\CreatePermissionGroupRequest;
use App\AppCore\Admin\PermissionGroups\Requests\UpdatePermissionGroupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionGroupsController extends Controller {

	protected $permissionGroupRepo;

	public function __construct(PermissionGroupRepository $permissionGroupRepository)
	{
		$this->permissionGroupRepo = $permissionGroupRepository;
	}


	public function index()
	{
		$permissionGroups = $this->permissionGroupRepo->permissionGroups();

		return view('admin.permission-groups.index', [
			'permissionGroups' => $permissionGroups
		]);
	}


	public function create()
	{
		return view('admin.permission-groups.create');
	}


	public function store(CreatePermissionGroupRequest $request)
	{
		$data = $request->all();

		//creates record in database
		$this->permissionGroupRepo->create($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.permission-groups.index');
	}


	public function edit($permissionGroupId)
	{
		$permissionGroup = $this->permissionGroupRepo->getById($permissionGroupId);

		return view('admin.permission-groups.edit', [
			'permissionGroup' => $permissionGroup
		]);
	}


	public function update($permissionGroupId, UpdatePermissionGroupRequest $request)
	{
		$data = $request->all();

		$this->permissionGroupRepo->updatePermissionGroup($permissionGroupId, $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.permission-groups.index');
	}


	public function destroy($permissionGroupId)
	{
		$permissionGroup = $this->permissionGroupRepo->getById($permissionGroupId);

		if (! $permissionGroup->isProtected())
		{
			$permissionGroup->delete();

			flash()->success(trans('back.flash_successfully_deleted'));
		}
		else
		{
			flash()->error(trans('back.flash_permission_group_protected'));
		}

		return back();
	}


	public function updateOrder(Request $request)
	{
		$data = $request->all();

		//updates order
		$this->permissionGroupRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return redirect()->route('admin.permission-groups.index');
	}

}
