<?php namespace App\Http\Controllers\Front;
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

use App\AppCore\Front\Sessions\Requests\LogInRequest;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller {

	public function create()
	{
		return view('front.sessions.create');
	}


	public function store(LogInRequest $request)
	{
		$data = $request->only(['username', 'password']);

		if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']], true))
		{
			$user = Auth::user();

			//simple user must be approved and with confirmed email to log in
			if (($user->isApproved() AND $user->emailConfirmed())
				OR ! $user->isSimple())
			{
				flash()->success(trans('front.flash_logged_in'));
				return redirect()->route('account_summary');
			}
			else
			{
				Auth::logout();
				session()->flash('inactiveUser', $user);
				return redirect()->route('sessions.create');
			}
		}
		else
		{
			flash()->error(trans('front.flash_wrong_credentials'));
			return redirect()->route('sessions.create')
				->withInput();
		}
	}


	public function destroy()
	{
		Auth::logout();

		flash()->success(trans('front.flash_logged_out'));
		return redirect()->route('sessions.create');
	}


}