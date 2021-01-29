<?php namespace App\AppCore\Front\EmailTokens\Repositories;
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
use EmailToken, Carbon;

class EmailTokenRepository extends EloquentRepository {

	protected $model;
	function __construct(EmailToken $model)
	{
		$this->model = $model;
	}

	//creates token in database
	public function createToken($userId, $email, $token)
	{
		//prevents from duplicate records
		$this->model->where('user_id', $userId)->delete();

		//creates token
		$token = $this->create([
			'user_id' => $userId,
			'email' => $email,
			'token' => $token,
			'created_at' => Carbon::now()
		]);

		return $token;
	}

	//returns token object (null if incorrect token)
	public function findToken($token)
	{
		return $this->model->where('token', $token)->first();
	}

	//deletes token
	public function deleteToken($token)
	{
		$this->model->where('token', $token)->delete();
	}

} 