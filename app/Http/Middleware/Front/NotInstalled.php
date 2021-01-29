<?php namespace App\Http\Middleware\Front;
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

use Closure;
use File, Session;

class NotInstalled
{
	public function __construct()
	{
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//checks whether script is not installed and if it is, will not allow run installation script
		if (! preg_match('/mysql_host|mysql_db_name|mysql_db_username|mysql_db_password/', File::get(config_path('database.php')))
		AND ! Session::has('installation')
		)
		{
			flash()->error(trans('front.flash_script_installed'));
			return redirect()->route('index');
		}

		return $next($request);
	}

}