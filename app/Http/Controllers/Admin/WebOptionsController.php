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

use App\AppCore\Admin\WebsiteOptions\Jobs\ChangeWebsiteType;
use App\AppCore\Admin\WebsiteOptions\Jobs\DeleteSiteLogo;
use App\AppCore\Admin\WebsiteOptions\Jobs\ImportZips;
use App\AppCore\Admin\WebsiteOptions\Jobs\UploadSiteLogo;
use App\AppCore\Admin\WebsiteOptions\Requests\UpdateImageSetRequest;
use App\AppCore\Admin\WebsiteOptions\Requests\UpdateLocalSetRequest;
use App\AppCore\Admin\WebsiteOptions\Requests\UpdateMailSetRequest;
use App\AppCore\Admin\WebsiteOptions\Requests\UpdatePaymentSetRequest;
use App\AppCore\Admin\WebsiteOptions\Requests\UpdateSitePrefRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\WebsiteOptions\Repositories\WebConfigRepository;
use Input, Cache, File;

class WebOptionsController extends Controller {

	private $webConfigRepo;
	function __construct(WebConfigRepository $webConfigRepository) {
		$this->webConfigRepo = $webConfigRepository;
	}
	
	public function changeWebsiteType()
	{
		$this->dispatchNow(new ChangeWebsiteType(Input::all()));

		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		flash()->success(trans('back.flash_website_type_changed'));
		return \Redirect::route('admin.settings.site-pref');
	}

	//display site preferences
	public function sitePrefIndex()
	{
		return view('admin.web-options.site-preferences', [
			'userGroups' => \UserGroup::ordered()->get()
		]);
	}

	//update site preferences
	public function sitePrefUpdate(UpdateSitePrefRequest $request)
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		//updates
		$this->webConfigRepo->update('1', $request->except('show_errors', 'public_key', 'private_key'), ['featured_first', 'captcha_admin_login', 'captcha_user_login', 'captcha_register', 'captcha_contact_forms', 'captcha_reset_pass']);

		//updates show errors config (app.php)
		$showErrors = $request->has('show_errors') ? 'true' : 'false';
		$contents = preg_replace(
			[
				"/'APP_DEBUG', false/",
				"/'APP_DEBUG', true/"
			],
			[
				"'APP_DEBUG', " . $showErrors,
				"'APP_DEBUG', " . $showErrors
			],
			File::get(config_path('app.php')));
		File::put(config_path('app.php'), $contents);

		//updates recaptcha config file
		$contents = preg_replace(
			[
				"/'public_key'.+?\),/",
				"/'private_key'.+?\),/"
			],
			[
				"'public_key' => env('RECAPTCHA_PUBLIC_KEY', '" . $request->get('public_key') . "'),",
				"'private_key' => env('RECAPTCHA_PRIVATE_KEY', '" . $request->get('private_key') . "'),",
			],
			File::get(config_path('recaptcha.php')));
		File::put(config_path('recaptcha.php'), $contents);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.site-pref');
	}

//////////////////////////////////////////////

	//display front interface settings config
	public function frontIntIndex()
	{
		return view('admin.web-options.interface-front');
	}

	//update main config
	public function frontIntUpdate()
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = Input::all();

		//updates
		$this->webConfigRepo->update('1', $data);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.front-int');
	}

//////////////////////////////////////////////

	//display admin interface settings config
	public function adminIntIndex()
	{
		return view('admin.web-options.interface-admin');
	}

	//update admin interface settings
	public function adminIntUpdate()
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = Input::all();

		//updates
		$this->webConfigRepo->update('1', $data);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.admin-int');
	}

//////////////////////////////////////////////

	//display mail config
	public function mailIndex()
	{
		return view('admin.web-options.mail');
	}

	//update mail config
	public function mailUpdate(UpdateMailSetRequest $request)
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = $request->all();

		$contents = preg_replace(
			[
				"/'driver'.+?,/",
				"/'host'.+?,/",
				"/'port'.+?,/",
				"/'from'.+?],/",
				"/'username'.+?,/",
				"/'password'.+?,/"
			],
			[
				"'driver' => " . (isset($data['smtp_use']) ? "'smtp'," : "'mail',"),
				"'host' => '" . $data['smtp_host'] . "',",
				"'port' => " . $data['smtp_port'] . ",",
				"'from' => ['address' => '" . $data['from_email'] . "', 'name' => '". $data['from_name'] ."'],",
				"'username' => '" . $data['smtp_user'] . "',",
				"'password' => '" . $data['smtp_pass'] . "',"
			],
			File::get(config_path('mail.php')));

		//updates mail config file
		File::put(config_path('mail.php'), $contents);


		//updates config in database
		$this->webConfigRepo->update('1', ['cont_email' => $data['cont_email']]);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.mail');
	}

////////////////////////////////////////////////////////

	//display mail config
	public function paymentIndex()
	{
		return view('admin.web-options.payment');
	}

	//update mail config
	public function paymentUpdate(UpdatePaymentSetRequest $request)
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = $request->all();

		//updates
		$this->webConfigRepo->update('1', $data, ['pp_bypass', 'pp_sandbox']);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.payment');
	}

///////////////////////////////////////////////

	//display localization config
	public function localIndex()
	{
		return view('admin.web-options.localization');
	}

	//update mail config
	public function localUpdate(UpdateLocalSetRequest $request)
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = $request->all();

		//updates
		$this->webConfigRepo->update('1', $data);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.local');
	}


	//imports ZIP Codes
	public function importZips()
	{
		$this->dispatchNow(new ImportZips(Input::file('zips_file'), Input::has('truncate_zips')));

		flash()->success(trans('back.flash_zip_codes_imported'));
		return back();
	}

//////////////////////////////////

	//display images config
	public function imageIndex()
	{
		return view('admin.web-options.image');
	}

	//update images config
	public function imageUpdate(UpdateImageSetRequest $request)
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = $request->all();

		//makes empty photos for lazy loading.
		\Image::make(public_path('templates/misc/transparent.png'))
			->resize($data['size_photo_x'], $data['size_photo_y'])
			->save(public_path('templates/misc/photo_empty.png'))
			->resize($data['size_thumb_x'], $data['size_thumb_y'])
			->save(public_path('templates/misc/thumb_empty.png'));

		//updates
		$this->webConfigRepo->update('1', $data);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.image');
	}

	////////////////////////////

	//display email notifications config
	public function emailNotIndex()
	{
		return view('admin.web-options.email-notifications');
	}

	//email notifications configuration update
	public function emailNotUpdate()
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$data = Input::all();

		//updates
		$this->webConfigRepo->update('1', $data, ['email_welcome', 'email_payment_received', 'email_account_approved', 'email_listing_approved', 'email_listing_expired', 'email_listing_expires_2', 'email_listing_expires_7', 'email_membership_expired', 'email_membership_expires_2', 'email_membership_expires_7', 'email_listing_enhancement_expired']);

		flash()->success(trans('back.flash_settings_updated'));
		return redirect()->route('admin.settings.email-not');
	}

	/////////////////////// LOGO /////////////////////////
	public function uploadLogo()
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		$newLogo = Input::file('logo');

		//uploads logo
		$response = $this->dispatchNow(new UploadSiteLogo($newLogo));

		flash()->success(trans('back.flash_logo_uploaded'));
		return redirect()->route('admin.settings.site-pref');
	}


	public function deleteLogo()
	{
		//forgets App Configuration Cache
		$this->forgetCacheAppCon();

		//deletes logo
		$this->dispatchNow(new DeleteSiteLogo());

		flash()->success(trans('back.flash_logo_deleted'));
		return redirect()->route('admin.settings.site-pref');
	}


	##Helpers
	//forgets app config cache
	protected function forgetCacheAppCon()
	{
		Cache::forget('appCon');
	}
}