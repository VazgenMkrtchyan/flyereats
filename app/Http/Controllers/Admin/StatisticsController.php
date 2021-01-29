<?php namespace App\Http\Controllers\Admin;
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

use App\Http\Controllers\Controller;

use App\AppCore\Admin\Statistics\Repositories\StatisticsRepository;

class StatisticsController extends Controller {

	protected $statisticsRepo;

	function __construct(StatisticsRepository $statisticsRepository)
	{
		$this->statisticsRepo = $statisticsRepository;
	}

	public function index()
	{
		$listingStats = $this->statisticsRepo->listingsStatistics();
		$userStats = $this->statisticsRepo->usersStatistics();
		$paymentStats = $this->statisticsRepo->paymentsStatistics();

		return view('admin.statistics.index', compact('userStats', 'listingStats', 'paymentStats'));
	}

}