<?php namespace App\AppCore\Admin\CompanyProfiles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyProfileRequest extends FormRequest {

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
			'user_id' => 'required',

			'name' => 'required',
			'web_url' => 'url',
			'email' => 'email',
			'state_id' => 'required',
			'city' => 'required',
			'addr_1' => 'required',
			'zip' => 'required',
		];

		return $rules;
	}
}