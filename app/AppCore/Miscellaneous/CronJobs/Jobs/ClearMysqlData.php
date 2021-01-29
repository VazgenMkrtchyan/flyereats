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

use App\AppCore\Miscellaneous\CronJobs\Repositories\CronJobRepository;

class ClearMysqlData extends Job
{
	public function __construct()
	{
	}


	public function handle(CronJobRepository $cronJobRepository)
	{
		//clears email change (older than * days)
		$cronJobRepository->clearEmailTokens(15);

		//clears temp orders (older than * days)
		$cronJobRepository->clearOrdersCache(15);

		//clears unconfirmed user accounts (older than * days)
		$cronJobRepository->clearUnconfirmedUserAccounts(15);

		//clears CronJobs (older than * days)
		$cronJobRepository->clearCronJobs(1);
	}

}