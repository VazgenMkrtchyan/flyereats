<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
		'App\Http\Middleware\App',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		//Admin End Middleware
		'admin.auth' => 'App\Http\Middleware\Admin\Authenticated',
		'admin.guest' => 'App\Http\Middleware\Admin\RedirectIfAuthenticated',
		'admin.allowed' => 'App\Http\Middleware\Admin\HasPermission',
		'notDemo' => 'App\Http\Middleware\Admin\NotDemo',

		//Front End Middleware
		'auth' => 'App\Http\Middleware\Front\Authenticated',
		'guest' => 'App\Http\Middleware\Front\RedirectIfAuthenticated',
		'simple' => 'App\Http\Middleware\Front\IsSimple',
		'owner' => 'App\Http\Middleware\Front\IsListingOwner',
		'allowedLP' => 'App\Http\Middleware\Front\AllowedListingPlan',
		'allowedMP' => 'App\Http\Middleware\Front\AllowedMembershipPlan',
		'allowedListingsNo' => 'App\Http\Middleware\Front\AllowedListingsNo',
		'hasActiveMP' => 'App\Http\Middleware\Front\HasActiveMembershipPlan',
		'notArchived' => 'App\Http\Middleware\Front\NotArchived',
		'notInstalled' => 'App\Http\Middleware\Front\NotInstalled',
	];

}
