<?php namespace App\Http\Controllers\Helpers;
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

use App\AppCore\Miscellaneous\CronJobs\Jobs\ClearMysqlData;
use App\AppCore\Miscellaneous\CronJobs\Jobs\ExpirationJobs;
use App\Http\Controllers\Controller;

class CronJobsController extends Controller {

	//checks if URL is correct
	public function run($cronKey)
	{
		if (appCon()->cron_key == $cronKey)
		{
			//sends expiration notifications, readjusts user and listing statuses
			$this->dispatchNow(new ExpirationJobs());

			//clears excessive and unneeded Mysql Data:
			$this->dispatchNow(new ClearMysqlData());

			return "CronJob Sucessful!";
		}

		return 'wrong_key';
	}
}