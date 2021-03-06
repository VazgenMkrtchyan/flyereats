<?php namespace App\Http\Middleware\Admin;
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
use Illuminate\Contracts\Auth\Guard;

class Authenticated {

	protected $auth;
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
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
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->route('admin.sessions.create');
			}
		}
		//if simple user is trying to reach admin panel
		elseif ($this->auth->user()->isSimple())
		{
			flash()->error(trans('back.flash_do_not_have_required_permissions_access_admin'));
			return redirect()->route('account_summary');
		}

		return $next($request);
	}

}
