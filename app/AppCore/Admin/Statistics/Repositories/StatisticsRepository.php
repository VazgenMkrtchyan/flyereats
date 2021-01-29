<?php namespace App\AppCore\Admin\Statistics\Repositories;
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

use Listing, User, Payment, DB, Carbon;

class StatisticsRepository {

	protected $listing, $user, $payment;
	function __construct(Listing $listing, User $user, Payment $payment)
	{
		$this->listing = $listing;
		$this->user = $user;
		$this->payment = $payment;
	}

	//LISTINGS STATS
	public function listingsStatistics()
	{
		$stats['total'] = $this->listing->count();
		//by type
		$stats['simple'] = $this->listing->listingsFilter(['listingType' => 'simple'])->count();
		$stats['highlighted'] = $this->listing->listingsFilter(['listingType' => 'highlighted'])->count();
		$stats['featured'] = $this->listing->listingsFilter(['listingType' => 'featured'])->count();

		//by status
		$stats['active'] = $this->listing->listingsFilter(['listingStatus' => 'active'])->count();
		$stats['inactive'] = $this->listing->listingsFilter(['listingStatus' => 'inactive'])->count();
		$stats['pending'] = $this->listing->listingsFilter(['moderationStatus' => 'pending'])->count();

		//new by time
		$stats['24hours'] = $this->listing->where('created_at', '>', Carbon::now()->addDays(-1))->count();
		$stats['7days'] = $this->listing->where('created_at', '>', Carbon::now()->addDays(-7))->count();
		$stats['30days'] = $this->listing->where('created_at', '>', Carbon::now()->addDays(-30))->count();

		return $stats;
	}


	//USERS STATS
	public function usersStatistics()
	{
		$stats['total'] = $this->user->count();
		//by type
		$stats['simple'] = $this->user->usersFilter(['userType' => 'simple'])->count();
		$stats['administrators'] = $this->user->usersFilter(['userType' => 'admin'])->count();
		$stats['super'] = $this->user->usersFilter(['userType' => 'super'])->count();

		//by status
		$stats['active'] = $this->user->usersFilter(['userType' => 'simple', 'userStatus' => 'active'])->count();
		$stats['inactive'] = $this->user->usersFilter(['userType' => 'simple', 'userStatus' => 'inactive'])->count();
		$stats['pending'] = $this->user->usersFilter(['userType' => 'simple', 'moderationStatus' => 'pending'])->count();
		$stats['emailUnconfirmed'] = $this->user->usersFilter(['userType' => 'simple', 'emailStatus' => 'unconfirmed'])->count();

		//new by time
		$stats['24hours'] = $this->user->usersFilter(['userType' => 'simple'])->where('created_at', '>', Carbon::now()->addDays(-1))->count();
		$stats['7days'] = $this->user->usersFilter(['userType' => 'simple'])->where('created_at', '>', Carbon::now()->addDays(-7))->count();
		$stats['30days'] = $this->user->usersFilter(['userType' => 'simple'])->where('created_at', '>', Carbon::now()->addDays(-30))->count();

		return $stats;
	}


	//PAYMENTS STATS
	public function paymentsStatistics()
	{
		//all
		$total = $this->payment
			->completed()
			->get([
				DB::raw("SUM(amount) AS total")
			]);
		$stats['total'] = $total[0]->total;

		//last 24 hours
		$total24 = $this->payment
			->completed()
			->where('created_at', '>', Carbon::now()->addDays(-1))
			->get([
			DB::raw("SUM(`amount`) AS `total`")
		]);
		$stats['24hours'] = $total24[0]->total;

		//last 7 days
		$total7 = $this->payment
			->completed()
			->where('created_at', '>', Carbon::now()->addDays(-7))
			->get([
				DB::raw("SUM(`amount`) AS `total`")
			]);
		$stats['7days'] = $total7[0]->total;

		//last 30 days
		$total30 = $this->payment
			->completed()
			->where('created_at', '>', Carbon::now()->addDays(-30))
			->get([
				DB::raw("SUM(`amount`) AS `total`")
			]);
		$stats['30days'] = $total30[0]->total;

		return $stats;
	}


}