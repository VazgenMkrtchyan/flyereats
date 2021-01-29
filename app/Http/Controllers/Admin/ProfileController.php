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

use App\Http\Controllers\Controller;
use App\AppCore\Admin\MyProfile\Requests\UpdateProfileRequest;

use App\AppCore\Admin\MyProfile\Repositories\MyProfileRepository;
use Auth, Input;

class ProfileController extends Controller {

	public function edit()
	{
		$user = Auth::user();

		return view('admin.profile.edit', [
			'user' => $user
		]);
	}


	public function update(UpdateProfileRequest $request, MyProfileRepository $myProfileRepo)
	{
		$data = $request->only(['first_name', 'last_name', 'email', 'username']);
		if ($request->has('password')) $data = array_add($data, 'password', $request->get('password'));

		//updates data
		$myProfileRepo->update(Auth::id(), $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.dashboard');
	}

}