<?php namespace App\AppCore\Admin\Users\Requests;
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

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'user_group_id' => 'required',

			'first_name' => 'required',
			'last_name' => 'required',
			'username' => 'required|unique:users|min:4',
			'password' => 'required|confirmed',
			'email' => 'required|email|unique:users',
			'state_id' => 'required',
			'city' => 'required',
			'addr_1' => 'required',
			'zip' => 'required',
		];

		return $rules;
	}
}