<?php namespace App\AppCore\Admin\Listings\Requests;
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

class UpdateListingRequest extends FormRequest {

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
			'st_moderation' => 'required',

			'make_id' => 'required',
			'model_id' => 'required',
			'det_condition_id' => 'required',
			/*'det_bodystyle_id' => 'required',*/
			/*'det_extcolor_id' => 'required',*/
			/*'det_intcolor_id' => 'required',*/
			'det_transmission_id' => 'required',
			'det_drivetype_id' => 'required',
			'det_fueltype_id' => 'required',
			/*'doors' => 'required',*/
			'passengers' => 'required',
			'mileage' => 'required|numeric',
			'price' => 'required|numeric',
			/*'state_id' => 'required',
			'city' => 'required',
			'addr_1' => 'required',
			'zip' => 'required',*/
			
		];

		return $rules;
	}

}