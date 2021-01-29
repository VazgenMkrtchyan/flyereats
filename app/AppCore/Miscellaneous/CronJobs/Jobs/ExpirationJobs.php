<?php namespace App\AppCore\Miscellaneous\CronJobs\Jobs;
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

use App\AppCore\Miscellaneous\Abstractions\Job;

use App\AppCore\Front\Mailers\ExpirationMailer;
use App\AppCore\Miscellaneous\CronJobs\Repositories\CronJobRepository;

class ExpirationJobs extends Job
{
	public function __construct()
	{
	}


	public function handle(CronJobRepository $cronJobRepository, ExpirationMailer $expirationMailer)
	{
		$lastCronJob = $cronJobRepository->lastCronJob();
		//creates new cronJob record (must go after retrieving last record)
		$cronJobRepository->createCronJobRecord();

		//if previous cronJob exists
		if (! empty($lastCronJob))
		{
			$lastCronTime = $lastCronJob->created_at;

			## LISTINGS ##
			//EXPIRED
			$expiredListings = $cronJobRepository->getExpiredListings($lastCronTime);
			foreach ($expiredListings as $listing)
			{
				if (appCon()->email_listing_expired)
				{
					$expirationMailer->listingExpired($listing);
				}
			}

			//EXPIRING IN 2 DAYS
			if (appCon()->email_listing_expires_2)
			{
				$expiringIn2Days = $cronJobRepository->getListingsExpiringIn(2, $lastCronTime);
				foreach ($expiringIn2Days as $listing)
				{
					$expirationMailer->listingExpiresIn2Days($listing);
				}
			}

			//EXPIRING IN 7 DAYS
			if (appCon()->email_listing_expires_7)
			{
				$expiringIn7Days = $cronJobRepository->getListingsExpiringIn(7, $lastCronTime);
				foreach ($expiringIn7Days as $listing)
				{
					$expirationMailer->listingExpiresIn7Days($listing);
				}
			}

			//LISTINGS WITH EXPIRED ENHANCEMENT
			$expiredEnhancements = $cronJobRepository->getExpiredEnhancements($lastCronTime);
			foreach ($expiredEnhancements as $listing)
			{
				if (appCon()->email_listing_enhancement_expired)
				{
					$expirationMailer->listingEnhancementExpired($listing);
				}
			}
			//removed enhancements
			$expiredEnhancements->update([
			'st_featured' => false,
			'st_highlighted' => false]);

			## ./LISTINGS ##

			################

			##### USERS #####
			//EXPIRED
			$expiredUsers = $cronJobRepository->getExpiredUsers($lastCronTime);
			foreach ($expiredUsers as $user)
			{
				if (appCon()->email_membership_expired)
				{
					$expirationMailer->membershipExpired($user);
				}
			}

			//EXPIRING IN 2 DAYS
			if (appCon()->email_membership_expires_2)
			{
				$expiringIn2Days = $cronJobRepository->getUsersExpiringIn(2, $lastCronTime);
				foreach ($expiringIn2Days as $user)
				{
					$expirationMailer->membershipExpiresIn2Days($user);
				}
			}

			//EXPIRING IN 7 DAYS
			if (appCon()->email_membership_expires_2)
			{
				$expiringIn7Days = $cronJobRepository->getUsersExpiringIn(7, $lastCronTime);
				foreach ($expiringIn7Days as $user)
				{
					$expirationMailer->membershipExpiresIn7Days($user);
				}
			}

			## ./USERS ##

		}
	}

}