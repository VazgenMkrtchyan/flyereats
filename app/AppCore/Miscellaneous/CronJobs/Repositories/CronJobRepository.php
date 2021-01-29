<?php namespace App\AppCore\Miscellaneous\CronJobs\Repositories;
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

use Carbon\Carbon;
use Listing, OrderCache, EmailToken, User, Cronjob;

class CronJobRepository {

	//creates record of CronJob
	public function createCronJobRecord()
	{
		Cronjob::create([]);
	}

	//gets how many seconds ago last CronJob was
	public function lastCronJob()
	{
		return Cronjob::orderBy('id', 'desc')->first();
	}

	//gets expired listings
	public function getExpiredListings($lastCronTime)
	{
		$lessThan = Carbon::now();
		$moreThan = $lastCronTime;

		$listings = Listing::listingsFilter(['listingStatus' => 'inactive'])
			->where('expires_on', '<', $lessThan)
			->where('expires_on', '>', $moreThan)
			->whereNotNull('expires_on')
			->get();

		return $listings;
	}

	//gets listings expiring in 'x' days
	public function getListingsExpiringIn($days, $lastCronTime)
	{
		$lessThan = Carbon::now()->addDays($days);
		$moreThan = $lastCronTime->addDays($days);

		$listings = Listing::listingsFilter(['listingStatus' => 'active'])
			->where('expires_on', '<', $lessThan)
			->where('expires_on', '>', $moreThan)
			->whereNotNull('expires_on')
			->get();

		return $listings;// = Listing::all();
	}

	//gets listings which enhancement recently expired
	public function getExpiredEnhancements($lastCronTime)
	{
		$lessThan = Carbon::now();
		$moreThan = $lastCronTime;

		$listings = Listing::listingsFilter(['listingStatus' => 'active', 'listingType' => 'enhanced'])
			->where('high_or_feat_till', '<', $lessThan)
			->where('high_or_feat_till', '>', $moreThan)
			->whereNotNull('high_or_feat_till')
			->get();

		return $listings;// = Listing::all();
	}

	//gets expired users
	public function getExpiredUsers($lastCronTime)
	{
		$lessThan = Carbon::now();
		$moreThan = $lastCronTime;

		$users = User::usersFilter(['userType' => 'simple', 'userStatus' => 'active'])
			->where('expires_on', '<', $lessThan)
			->where('expires_on', '>', $moreThan)
			->whereNotNull('expires_on')
			->get();

		return $users;// = User::all();
	}

	//gets users expiring in 'x' days
	public function getUsersExpiringIn($days, $lastCronTime)
	{
		$lessThan = Carbon::now()->addDays($days);
		$moreThan = $lastCronTime->addDays($days);

		$users = User::usersFilter(['userType' => 'simple', 'userStatus' => 'active'])
			->where('expires_on', '<', $lessThan)
			->where('expires_on', '>', $moreThan)
			->whereNotNull('expires_on')
			->get();

		return $users;// = User::all();
	}

	//clears 'orders_cache' table
	public function clearOrdersCache($daysOld)
	{
		$olderThan = Carbon::now()->addDays(-$daysOld);

		OrderCache::where('created_at', '<', $olderThan)->delete();
	}

	//clears 'email_confirm_change' table
	public function clearEmailTokens($daysOld)
	{
		$olderThan = Carbon::now()->addDays(-$daysOld);

		EmailToken::where('created_at', '<', $olderThan)->delete();
	}

	//clears user accounts with unconfirmed email address
	public function clearUnconfirmedUserAccounts($daysOld)
	{
		$olderThan = Carbon::now()->addDays(-$daysOld);

		User::usersFilter(['userType' => 'simple', 'emailStatus' => 'unconfirmed'])
			->where('created_at', '<', $olderThan)
			->delete();
	}

	//clears 'cronjobs' table
	public function clearCronJobs($daysOld)
	{
		$olderThan = Carbon::now()->addDays(-$daysOld);

		Cronjob::where('created_at', '<', $olderThan)->delete();
	}

} 