<?php namespace App\AppCore\Admin\Administrators\Repositories;
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

class AdministratorRepository extends EloquentRepository {

	protected $model;
	function __construct(User $model)
	{
		$this->model = $model;
	}

	public function getAdministrators()
	{
		$administrators = $this->model->usersFilter(['userType' => 'admin']);

		//administrators per page
		$perPage = sessionOrWebc('ai_administrators_no', \Route::currentRouteName());

		return $administrators->paginate($perPage);
	}


	public function createAdmin($data)
	{
		$data['user_type'] = 'admin';
		//creates admin
		$admin = $this->create($data);

		return $admin;
	}


	public function updateAdminPermissions($adminId, $data)
	{

	}

}