<?php namespace App\AppCore\Admin\WebsiteOptions\Requests;
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

class UpdateImageSetRequest extends FormRequest {

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
		return [
			'size_photo_x' => 'required|numeric',
			'size_photo_y' => 'required|numeric',
			'size_thumb_x' => 'required|numeric',
			'size_thumb_y' => 'required|numeric',
			//'size_logo_x' => 'required|numeric',
			//'size_logo_y' => 'required|numeric',
		];
	}

}