<?php namespace App\AppCore\Admin\Users\Repositories;
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
use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use User;
use Carbon;

class UserRepository extends EloquentRepository {
	
	use DispatchesJobs;
	
	protected $model, $webc;
	function __construct(User $model)
	{
		$this->model = $model;
	}

	//gets users based on search query
	public function getUsers($data)
	{
		$data['userType'] = 'simple'; //restricts to simple users
		//builds query
		$users = $this->model
			->with('compprofile')
			->usersFilter($data)
			->usersSort(getOrWebc('ai_user_sort', 'sortBy'));

		$perPage = sessionOrWebc('ai_user_no', \Route::currentRouteName());

		return $users->paginate($perPage, ['users.*']);
	}

	//creates user
	public function addUser(array $data)
	{
		$data['user_type'] = 'user';

		$user = $this->create($data);

		return $user;
	}

	//updates user
	public function updateUser($userId, array $data)
	{
		//if expiration date is not changed
		if ($data['expires_on'] == $data['old_expires_on'])
		{
			unset($data['expires_on']);
		}

		$user = $this->update($userId, $data);

		//raising an event if user was approved
		if ($data['st_moderation'] == 'approved'
			AND $data['old_st_moderation'] == 'pending')
		{
			$this->dispatchNow(new AfterUserApproval($user));
		}

		return $user;
	}

	//approves user
	public function approveUser($userId)
	{
		$user = $this->update($userId, ['st_moderation' => 'approved']);

		return $user;
	}

	//rejects user
	public function rejectUser($userId)
	{
		$this->update($userId, ['st_moderation' => 'rejected']);
	}

	//undoes user reject
	public function undoRejectUser($userId)
	{
		$this->update($userId, ['st_moderation' => 'approved']);
	}

	//returns available transfer recipients when deleting user
	public function getTransferRecipients($exceptId)
	{
		$recipients = $this->model
			->where('id', '!=', $exceptId)
			->usersFilter(['userType' => 'simple'])
			->get();

		return $recipients;
	}

	##COUNTER##
	public function counter()
	{
		//userStatus
		$count['userStatus.active'] = $this->model->usersFilter(['userType' => 'simple', 'userStatus' => 'active'])->count();
		$count['userStatus.inactive'] = $this->model->usersFilter(['userType' => 'simple', 'userStatus' => 'inactive'])->count();

		//moderationStatus
		$count['moderationStatus.approved'] = $this->model->usersFilter(['userType' => 'simple', 'moderationStatus' => 'approved'])->count();
		$count['moderationStatus.rejected'] = $this->model->usersFilter(['userType' => 'simple', 'moderationStatus' => 'rejected'])->count();
		$count['moderationStatus.pending'] = $this->model->usersFilter(['userType' => 'simple', 'moderationStatus' => 'pending'])->count();

		//membershipPlan (counts users without a plan - all the rest are dynamically counted)
		$count['membershipPlan.without'] = $this->model->usersFilter(['userType' => 'simple', 'membershipPlan' => 'without'])->count();

		//emailStatus
		$count['emailStatus.confirmed'] = $this->model->usersFilter(['userType' => 'simple', 'emailStatus' => 'confirmed'])->count();
		$count['emailStatus.unconfirmed'] = $this->model->usersFilter(['userType' => 'simple', 'emailStatus' => 'unconfirmed'])->count();

		return $count;
	}

} 