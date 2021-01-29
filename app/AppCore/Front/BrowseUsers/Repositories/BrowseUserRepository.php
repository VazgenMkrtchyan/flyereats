<?php namespace App\AppCore\Front\BrowseUsers\Repositories;
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
use User;

class BrowseUserRepository extends EloquentRepository {

	protected $model;

	function __construct(User $model)
	{
		$this->model = $model;
	}

	//gets users based on search
	public function getUsers($data)
	{
		$users = $this->model->usersFilter(['userType' => 'simple', 'userStatus' => 'active']);

		//SORT BY
		$sortBy = getOrWebc('ui_user_sort', 'sortby');
		if ($sortBy == 'name_ASC') $users->orderBy('last_name', 'ASC');
		elseif ($sortBy == 'name_DESC') $users->orderBy('last_name', 'DESC');

		//user group
		if (! empty($data['userGroup']))
		{
			$users->where('user_group_id', $data['userGroup']);
		}

		//per page
		$perPage = getOrWebc('ui_user_no', 'per_page');

		return $users->paginate($perPage, ['users.*']);
	}

} 