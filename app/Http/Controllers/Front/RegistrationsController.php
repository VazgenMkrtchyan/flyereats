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

use App\AppCore\Front\EmailTokens\Jobs\ConfirmToken;
use App\AppCore\Front\Registrations\Jobs\ResendConfirmationToken;
use App\AppCore\Front\Registrations\Jobs\RegistrationNotification;
use App\AppCore\Front\Registrations\Repositories\RegistrationRepository;
use App\AppCore\Front\Registrations\Requests\RegistrationRequest;
use App\AppCore\Front\Registrations\Requests\ResendConfirmationRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;

class RegistrationsController extends Controller {

	use GetDetailsTrait;
	use DispatchesJobs;

	public function create()
	{
		$details = $this->getDetailsArray(['States', 'UserGroups' => '']);

		return view('front.register.create', [
			'details' => $details
		]);
	}


	public function store(RegistrationRequest $request, RegistrationRepository $registrationRepository)
	{
		$data = $request->all();

		//registers user
		$user = $registrationRepository->registerUser($data);

		//sends notification email
		$this->dispatchNow(new RegistrationNotification($user));

		session()->flash('registeredUser', $user);
		return redirect()->route('sessions.create');
	}


	public function confirmAccount($token)
	{
		$tokenObject = $this->dispatchNow(new ConfirmToken($token));

		if ($tokenObject)
		{
			//updates user's status
			$tokenObject->user()->update(['st_email_confirmed' => true]);

			flash()->success(trans('front.flash_email_confirmed'));
		}
		else
		{
			flash()->error('Invalid Token!');
		}

		return redirect()->route('sessions.create');
	}


	//REQUEST TO RESEND CONFIRMATION
	public function resendConfirmation()
	{
		return view('front.register.resend-confirmation');
	}

	//resends confirmation
	public function resendConfirmationPost(ResendConfirmationRequest $request)
	{
		$email = $request->get('email');

		$resend = $this->dispatchNow(new ResendConfirmationToken($email));
		$response = $resend['response'];

		if ($response == 'sent')
		{
			flash()->success(trans('front.flash_confirmation_sent'));
			return redirect()->route('sessions.create');
		}
		elseif ($response == 'email_is_confirmed')
		{
			flash()->warning(trans('front.flash_already_confirmed'));
			return redirect()->route('sessions.create');
		}
		elseif ($response == 'user_not_found')
		{
			flash()->error(trans('front.flash_no_user_found'));
		}

		return back();
	}

}