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

use App\AppCore\Admin\UserGroups\Requests\CreateUserGroupRequest;
use App\AppCore\Admin\UserGroups\Requests\UpdateUserGroupRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\UserGroups\Repositories\UserGroupRepository;
use Input;

class UserGroupsController extends Controller {

	protected $userGroupRepo;
	function __construct(UserGroupRepository $userGroupRepository)
	{
		$this->userGroupRepo = $userGroupRepository;
	}

	public function index()
	{
		$userGroups = $this->userGroupRepo->getUserGroups();

		return view('admin.user-groups.index', [
			'userGroups' => $userGroups
		]);
	}


	public function create()
	{
		return view('admin.user-groups.create');
	}


	public function store(CreateUserGroupRequest $request)
	{
		$data = $request->all();

		//creates record
		$this->userGroupRepo->create($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.user-groups.index');
	}


	public function edit($userGroupId)
	{
		$userGroup = $this->userGroupRepo->getById($userGroupId);

		return view('admin.user-groups.edit', [
			'userGroup' => $userGroup
		]);
	}


	public function update($userGroupId, UpdateUserGroupRequest $request)
	{
		$data = $request->all();

		//updates record
		$this->userGroupRepo->update($userGroupId, $data, ['display_company', 'display']);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.user-groups.index');
	}


	public function destroy($userGroupId)
	{
		$userGroup = $this->userGroupRepo->getById($userGroupId);
		//protects from deleting user group with users assigned to it
		if (! $userGroup->inUse())
		{
			$userGroup->delete();

			flash()->success(trans('back.flash_successfully_deleted'));
			return back();
		}

		flash()->error(trans('back.flash_user_group_cannot_be_deleted_has_users'));
		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();

		$this->userGroupRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}