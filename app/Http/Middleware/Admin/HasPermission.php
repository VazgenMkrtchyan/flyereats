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

class HasPermission {

	protected $auth;
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$routeName = $request->route()->getName();

		if (! $this->auth->user()->hasPermission($routeName))
		{
			flash()->error(trans('back.flash_do_not_have_required_permissions'));

			if ($this->auth->user()->isSimple())
			{
				return redirect()->route('account_summary');
			}
			return redirect()->route('admin.dashboard');
		}

		return $next($request);
	}

}
