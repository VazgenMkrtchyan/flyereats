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
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\Routing\Loader\ObjectRouteLoader;

class AllowedMembershipPlan {

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
		$membershipPlan = \MembershipPlan::find($request->route('membershipPlanId'));

		if (! $membershipPlan OR
			! $membershipPlan->allowSelect() OR
			! $request->user()->allowedMembershipPlan($membershipPlan->id))
		{
			flash()->error(trans('front.flash_not_allowed_membership_plan'));
			return redirect()->route('account_summary');
		}

		return $next($request);
	}

}
