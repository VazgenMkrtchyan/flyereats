<?php namespace App\AppCore\Front\BrowseUsers\Jobs;
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

class GenerateSearchUrl extends Job
{
	public $inputData;

	
	public function __construct($inputData)
	{
		$this->inputData = $inputData;
	}


	public function handle()
	{
		return $this->generateSearchUrl($this->inputData);
	}

	##HELPERS
	protected function generateSearchUrl($data)
	{
		$searchUrl = [];

		if (! empty($data['userGroup'])) $searchUrl['userGroup'] = $data['userGroup'];

		if (! empty($data['sortby'])) $searchUrl['sortby'] = $data['sortby'];
		if (! empty($data['per_page'])) $searchUrl['per_page'] = $data['per_page'];

		return $searchUrl;
	}

}