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

class AllowedListingPlan {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$for = $request->route('for');
		$forId = $request->route('forId');

		//checking if user is not trying to manipulate url data
		if ((empty($for) OR empty($forId))
		OR ($for == 'listingPlan' AND !$request->user()->allowedListingPlan($forId))
		OR ($for != 'listingPlan' AND !$request->user()->allowedHighFeatPlan($forId))
		) {
			flash()->error(trans('front.flash_not_allowed_plan_selected'));
			return redirect()->route('userlistings.index');
		}

		return $next($request);
	}

}
