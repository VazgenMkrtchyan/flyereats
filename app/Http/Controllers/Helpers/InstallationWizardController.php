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
use Session, Illuminate\Http\Request, File, DB, User;

class InstallationWizardController extends Controller {

	public function step1()
	{
		if (Session::has('installation'))
		{
			return redirect()->route('install.step2');
		}

		return view('helpers.installation-wizard.step1');
	}

	//checks submitted data
	public function step1_submit(Request $request)
	{
		$this->validate($request, [
			'db_host' => 'required',
			'db_name' => 'required',
			'db_username' => 'required',
		]);
		$data = $request->all();

		//checks database details
		try {
			$dbCheck = mysqli_connect($data['db_host'], $data['db_username'], $data['db_password'], $data['db_name']);
		} catch(\Exception $e) {
			flash()->error(trans('back.flash_wrong_database_details'));
			return back()->withInput();
		}
		$dbCheck->close();

		//rewriting database connection config file contents
		$contents = str_replace(
			["mysql_host", "mysql_db_name", "mysql_db_username", "mysql_db_password"],
			[$data['db_host'], $data['db_name'], $data['db_username'], $data['db_password']],
			File::get(config_path('database.php')));

		File::put(config_path('database.php'), $contents);

		Session::put('installation', 'running');

		return redirect()->route('install.step2');
	}


	public function step2()
	{
		return view('helpers.installation-wizard.step2');
	}

	//checks submitted data
	public function step2_submit(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'username' => 'required|min:4',
			'password' => 'required|confirmed|min:6',
		]);
		$data = $request->all();

		//imports database structure
		DB::unprepared(File::get(base_path("DB_IMPORT.sql")));

		//creates super user
		User::create([
			'user_type' => 'super',
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => $data['password'],
		]);

		Session::remove('installation');

		return redirect()->route('install.installed');
	}


	//shows message after successful installation
	public function installed()
	{
		return view('helpers.installation-wizard.installed');
	}
}