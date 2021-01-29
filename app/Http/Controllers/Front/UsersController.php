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

use App\AppCore\Front\Users\Requests\ChangeEmailRequest;
use App\AppCore\Front\Users\Requests\UpdateProfileRequest;
use App\AppCore\Front\Users\Jobs\ConfirmNewEmail;
use App\AppCore\Front\Users\Jobs\RequestEmailChange;
use App\Http\Controllers\Controller;

use App\AppCore\Front\Users\Repositories\UserFrontRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Auth;
use Input;

class UsersController extends Controller {

	use GetDetailsTrait;


	public function accountSummary()
	{
		return view('front.user-summary.index', [
			'user' => Auth::user()
		]);
	}


	public function editProfile()
	{
		$details = $this->getDetailsArray(['States', 'UserGroups' => '']);

		return view('front.user-profile.edit', [
			'user' => Auth::user(),
			'details' => $details
		]);
	}
 

	public function updateProfile(UpdateProfileRequest $request, UserFrontRepository $userFrontRepository)
	{
		if ($request->has('password')) $data = $request->all();
		else $data = $request->except('password');

		//updates user data
		$userFrontRepository->updateProfile(Auth::id(), $data);

		flash()->success(trans('front.flash_profile_updated'));
		return redirect()->route('profile.edit');
	}


	public function updateEmail(ChangeEmailRequest $request)
	{
		$newEmail = $request->get('email');

		//email change command
		$status = $this->dispatchNow(new RequestEmailChange(Auth::id(), $newEmail));

		return response()->json(['status' => $status, 'newEmail' => $newEmail]);
	}


	public function confirmNewEmail($token)
	{
		$changed = $this->dispatchNow(new ConfirmNewEmail($token));

		if ($changed)
		{
			flash()->success(trans('front.flash_your_email_updated'));
			return redirect()->route('profile.edit');
		}
		else
		{
			flash()->error(trans('front.flash_wrong_token'));
			return redirect()->route('profile.edit');
		}
	}


	public function manageMembership()
	{
		return view('front.user-membership-plans.manage', [
			'user' => Auth::user(),
			'membershipPlans' => Auth::user()->userGroup->membershipPlans()->get()
		]);
	}


	public function userPayments()
	{
		return view('front.user-payments.index', [
			'payments' => Auth::user()->payments,
		]);
	}


	public function paymentStatus()
	{
		if (Input::has('success'))
		{
			flash()->success(trans('front.flash_payment_success'));
		}
		else
		{
			flash()->error(trans('front.flash_payment_failure'));
		}

		return redirect()->route('userpayments.index');
	}

}