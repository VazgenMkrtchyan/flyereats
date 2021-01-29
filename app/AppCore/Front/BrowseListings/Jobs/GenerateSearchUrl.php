<?php namespace App\AppCore\Front\BrowseListings\Jobs;
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
use Session;

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


	//generates correct search url based on the search preferences
	protected function generateSearchUrl($data)
	{
		$searchUrl = [];

		if(! empty($data['usertype'])) $searchUrl['usertype'] = $data['usertype'];
		if(! empty($data['description'])) $searchUrl['description'] = $data['description'];
		if(! empty($data['make'])) $searchUrl['make'] = $data['make'];
		if(! empty($data['model'])) $searchUrl['model'] = $data['model'];
		if(! empty($data['bodystyle'])) $searchUrl['bodystyle'] = $data['bodystyle'];
		if(! empty($data['fueltype'])) $searchUrl['fueltype'] = $data['fueltype'];
		if(! empty($data['condition'])) $searchUrl['condition'] = $data['condition'];
		if(! empty($data['transmission'])) $searchUrl['transmission'] = $data['transmission'];
		if(! empty($data['drivetype'])) $searchUrl['drivetype'] = $data['drivetype'];
		if(! empty($data['extcolor'])) $searchUrl['extcolor'] = $data['extcolor'];
		if(! empty($data['intcolor'])) $searchUrl['intcolor'] = $data['intcolor'];
      if(! empty($data['description'])) $searchUrl['description'] = $data['description'];
		if(! empty($data['min_price'])) $searchUrl['min_price'] = $data['min_price'];
		if(! empty($data['max_price'])) $searchUrl['max_price'] = $data['max_price'];
		if(! empty($data['min_mileage'])) $searchUrl['min_mileage'] = $data['min_mileage'];
		if(! empty($data['max_mileage'])) $searchUrl['max_mileage'] = $data['max_mileage'];
		if(! empty($data['min_year'])) $searchUrl['min_year'] = $data['min_year'];
		if(! empty($data['max_year'])) $searchUrl['max_year'] = $data['max_year'];

		//userId
		if (! empty($data['userId'])) $searchUrl['userId'] = $data['userId'];
		//userGroup
		if (! empty($data['userGroup'])) $searchUrl['userGroup'] = $data['userGroup'];
		//show loved
		if(! empty($data['show_loved'])) $searchUrl['show_loved'] = $data['show_loved'];
		//show history
		if(! empty($data['show_history'])) $searchUrl['show_history'] = $data['show_history'];
		
	
		if (empty($data['zip'])) $data['distance'] = null;
		Session::put('pref.distance', $data['distance']);

		//page number
		if(! empty($data['page'])) $searchUrl['page'] = $data['page'];

		return $searchUrl;
	}
}