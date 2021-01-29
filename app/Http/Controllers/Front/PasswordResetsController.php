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

use App\AppCore\Front\PasswordResets\Requests\ResetRequest;
use App\AppCore\Front\PasswordResets\Requests\SendResetRequest;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordResetsController extends Controller {

	protected $auth; //The Guard implementation.
	protected $passwords; //The password broker implementation.

	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}

	//Display the form to request a password reset link.
	public function getEmail()
	{
		return view('front.password.remind');
	}


	//Send a reset link to the given user.
	public function postEmail(SendResetRequest $request)
	{
		$response = $this->passwords->sendResetLink($request->only('email'), function($m)
		{
			//email subject
			$m->subject('Your Password Reset Link');
		});

		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
			{
				flash()->success(trans($response));
				return redirect()->back();
			}

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => trans($response)]);
		}
	}


	//Display the password reset view for the given token.
	public function getReset($token = null)
	{
		if (is_null($token))
		{
			throw new NotFoundHttpException;
		}

		return view('front.password.reset')->with('token', $token);
	}


	//Reset the given user's password.
	public function postReset(ResetRequest $request)
	{
		$credentials = $request->only(['email', 'password', 'password_confirmation', 'token']);

		$response = $this->passwords->reset($credentials, function($user, $password)
		{
			$user->password = bcrypt($password);

			$user->save();

			$this->auth->login($user);
		});

		switch ($response)
		{
			case PasswordBroker::PASSWORD_RESET:
			{
				flash()->success(trans('front.flash_password_reset_success'));
				return redirect()->route('account_summary');
			}

			default:
				return redirect()->back()
					->withInput($request->only('email'))
					->withErrors(['email' => trans($response)]);
		}
	}

}
