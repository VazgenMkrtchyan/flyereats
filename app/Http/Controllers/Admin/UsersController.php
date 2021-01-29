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

use App\AppCore\Admin\Users\Jobs\AfterUserApproval;
use App\AppCore\Admin\Users\Jobs\DeleteUser;
use App\AppCore\Admin\Users\Requests\CreateUserRequest;
use App\AppCore\Admin\Users\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\Users\Repositories\UserRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Input, Session;

class UsersController extends Controller {

	use GetDetailsTrait;

	protected $userRepo, $webc;
	function __construct(UserRepository $userRepository)
	{
		$this->userRepo = $userRepository;

	}


	public function index()
	{
		$searchData = Input::all();
		$users = $this->userRepo->getUsers($searchData);
		$counter = $this->userRepo->counter();
		$details = $this->getDetailsArray(['UserGroups' => 'users', 'MembershipPlans' => 'users']);

		//search url is written to session
		Session::put('user_search_url', $searchData);

		return view('admin.users.index', [
			'users' => $users,
			'counter' => $counter,
			'details' => $details
		]);
	}


	public function create()
	{
		$details = $this->getDetailsArray(['States', 'UserGroups' => '']);

		return view('admin.users.create', [
			'details' => $details
		]);
	}


	public function store(CreateUserRequest $request)
	{
		$data = $request->all();

		//adds user
		$this->userRepo->addUser($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.users.index');
	}


	public function edit($userId)
	{
		$user = $this->userRepo->getById($userId);
		$details = $this->getDetailsArray(['States', 'UserGroups' => '']);

		//checks if data is not manipulated
		if (! $user->isSimple()) {
			return redirect()->route('admin.users.index');
		}

		return view('admin.users.edit', [
			'user' => $user,
			'details' => $details
		]);
	}


	public function update($userId, UpdateUserRequest $request)
	{
		//update password only if new is entered
		if ($request->has('password')) $data = $request->all();
		else $data = $request->except('password');

		//updates user
		$this->userRepo->updateUser($userId, $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.users.index');
	}

	//displays delete user page with options
	public function deleteUser($userId)
	{
		$user = $this->userRepo->getById($userId);
		$recipients = $this->userRepo->getTransferRecipients($userId);

		return view('admin.users.delete', [
			'user' => $user,
			'recipients' => $recipients
		]);
	}

	//deletes user
	public function destroy($userId)
	{
		$data = Input::only('delete_option', 'transfer_to');

		//deletes user
		$this->dispatchNow(new DeleteUser($userId, $data['delete_option'], $data['transfer_to']));

		flash()->success(trans('back.flash_successfully_deleted'));
		return redirect()->route('admin.users.index');
	}

	//approves user
	public function approveUser($userId)
	{
		$user = $this->userRepo->approveUser($userId);
		
		$this->dispatchNow(new AfterUserApproval($user));

		flash()->success(trans('back.flash_user_approved'));
		return back();
	}

	//rejects user
	public function rejectUser($userId)
	{
		$this->userRepo->rejectUser($userId);

		flash()->success(trans('back.flash_user_rejected'));
		return back();
	}

	//undoes user reject
	public function undoRejectUser($userId)
	{
		$this->userRepo->undoRejectUser($userId);

		flash()->success(trans('back.flash_user_undo_reject'));
		return back();
	}
}
