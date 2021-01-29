<?php namespace App\Http\Controllers\Admin;
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

use App\AppCore\Admin\Sessions\Requests\LogInRequest;
use App\Http\Controllers\Controller;
use Auth;

class SessionsController extends Controller {


	public function create()
	{
		return view('admin.sessions.create');
	}


	public function store(LogInRequest $request)
	{
		$data = $request->only(['username', 'password', 'captcha',  'remember_me']);

		if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']], isset($data['remember_me'])))
		{
			flash()->success(trans('back.flash_welcome_back'));
			return redirect()->route('admin.dashboard');
		}
		else
		{
			flash()->error(trans('back.flash_wrong_credentials'));
			return redirect()->route('admin.sessions.create');
		}

	}

	public function destroy()
	{
		Auth::logout();

		flash()->success(trans('back.flash_logged_out'));
		return redirect()->route('admin.sessions.create');
	}

}