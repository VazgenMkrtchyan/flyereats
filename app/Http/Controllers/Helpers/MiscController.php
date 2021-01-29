<?php namespace App\Http\Controllers\Helpers;
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

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input, Session;

class MiscController extends Controller {

	//puts preferences to session
	public function preferencesToSession()
	{
		$prefName = str_replace('.', '+', Input::get('prefName'));
		$prefValue = Input::get('prefValue');

		Session::put('pref.' . $prefName, $prefValue);
	}


	//changes website's theme
	public function changeTheme(Request $request)
	{
		Session::put('pref.color_scheme', $request->get('color_scheme'));

		return back();
	}
}