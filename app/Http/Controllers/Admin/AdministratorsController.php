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

use App\AppCore\Admin\Administrators\Requests\CreateAdministratorRequest;
use App\AppCore\Admin\Administrators\Requests\UpdateAdministratorRequest;
use App\AppCore\Admin\Permissions\Repositories\PermissionRepository;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\Administrators\Repositories\AdministratorRepository;
use Illuminate\Http\Request;
use Input, JavaScript;

class AdministratorsController extends Controller {

	protected $administratorRepo;
	function __construct(AdministratorRepository $administratorRepository)
	{
		$this->administratorRepo = $administratorRepository;
	}


	public function index()
	{
		$administrators = $this->administratorRepo->getAdministrators();

		return view('admin.administrators.index', [
			'administrators' => $administrators
		]);
	}


	public function create()
	{
		return view('admin.administrators.create');
	}


	public function store(CreateAdministratorRequest $request)
	{
		$data = $request->all();

		//ads administrator to database
		$admin = $this->administratorRepo->createAdmin($data);
		
		flash()->success(trans('back.flash_administrator_added'));
		return redirect()->route('admin.administrators.edit', $admin->id);
	}


	public function show($adminId)
	{
		$administrator = $this->administratorRepo->getById($adminId);

		return view('admin.administrators.show', [
			'administrator' => $administrator
		]);
	}


	public function edit($adminId, PermissionRepository $permissionRepository)
	{
		$administrator = $this->administratorRepo->getById($adminId);
		$adminPermissions = $permissionRepository->userPermissionsTreeView($adminId);

		JavaScript::put([
			'adminPermissions' => $adminPermissions,
		]);

		return view('admin.administrators.edit', [
			'administrator' => $administrator,
		]);
	}


	public function update($adminId, UpdateAdministratorRequest $request)
	{
		//updates password only if new is entered
		if ($request->has('password')) $data = $request->all();
		else $data = $request->except('password');

		//update
		$this->administratorRepo->update($adminId, $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.administrators.index');
	}


	public function destroy($adminId)
	{
		$this->administratorRepo->destroy($adminId);

		flash()->success(trans('back.flash_successfully_deleted'));
		return redirect()->route('admin.administrators.index');
	}

	//attaches permissions to administrator
	public function applyPermissions($adminId, Request $request)
	{
		$permissions = $request->get('permissions');
		$adminPermissions = $this->administratorRepo->getById($adminId)->permissions();
		if ($permissions)
		{
			$sync = explode('|', rtrim($permissions, '|'));
			$adminPermissions->sync($sync);
		}
		else
		{
			$adminPermissions->detach();
		}

		flash()->success(trans('back.flash_permissions_adjusted'));
		return redirect()->route('admin.administrators.edit', $adminId);
	}

}