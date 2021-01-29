<?php namespace App\AppCore\Front\Users\Repositories;
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
use User, Carbon;

class UserFrontRepository extends EloquentRepository {

	protected $model;

	function __construct(User $model)
	{
		$this->model = $model;
	}


	public function updateProfile($userId, array $data)
	{
		//protecting user_type, st_moderation, username, email
		unset($data['user_type'], $data['st_moderation'], $data['username'], $data['email']);

		$this->update($userId, $data, ['show_phone']);
	}


	public function updateEmail($userId, $newEmail)
	{
		$this->update($userId, ['email' => $newEmail]);
	}

	
	public function findByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

} 