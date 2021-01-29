<?php namespace App\AppCore\Front\Registrations\Repositories;
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

class RegistrationRepository extends EloquentRepository {

	protected $model;
	function __construct(User $model)
	{
		$this->model = $model;
	}

	public function registerUser($data)
	{
		//protects fields
		unset($data['membership_plan_id'], $data['expires_on']);

		$data['user_type'] = 'user';
		//moderation status
		if (appCon()->autoAccConfirm())
		{
			$data['st_moderation'] = 'approved';
		}
		else $data['st_moderation'] = 'pending';

		//email confirmation status
			$data['st_email_confirmed'] = appCon()->requireEmailConfirmation() ? false : true;

		//creates user
		$user = $this->create($data);

		return $user;
	}

} 