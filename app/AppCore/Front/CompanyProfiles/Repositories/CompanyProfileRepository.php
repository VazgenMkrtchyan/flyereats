<?php namespace App\AppCore\Front\CompanyProfiles\Repositories;
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

use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Compprofile;

class CompanyProfileRepository extends EloquentRepository {

	protected $model;
	function __construct(Compprofile $model)
	{
		$this->model = $model;
	}


	public function addCompanyProfile($data, $userId)
	{
		$data['user_id'] = $userId;
		//Latitude and Longitude
		$data = setLatLng($data);

		//creates profile
		$profile = $this->model->create($data);

		return $profile;
	}

	public function updateCompanyProfile($companyProfileId, $data)
	{
		//protects from maliciously assigning profile to different user
		unset($data['user_id']);
		//if location has been changed, Latitude and Longitude coordinates are being updated
		if (locationHasChanged($data))
		{
			$data = setLatLng($data);
		}

		//updates record
		$this->update($companyProfileId, $data);
	}


	public function currentLogo($companyProfileId)
	{
		return $this->getById($companyProfileId)->logo;
	}


	public function uploadLogo($companyProfileId, $fileName)
	{
		$this->update($companyProfileId, ['logo' => $fileName]);
	}


	public function deleteLogo($companyProfileId)
	{
		$this->update($companyProfileId, ['logo' => null]);
	}


} 