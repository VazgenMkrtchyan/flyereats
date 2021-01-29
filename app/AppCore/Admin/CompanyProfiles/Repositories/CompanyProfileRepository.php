<?php namespace App\AppCore\Admin\CompanyProfiles\Repositories;

use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Compprofile, User;

class CompanyProfileRepository extends EloquentRepository {

	protected $model;
	function __construct(Compprofile $model)
	{
		$this->model = $model;
	}


	public function getProfiles()
	{
		//company profiles per page
		$perPage = sessionOrWebc('ai_compprofiles_no', \Route::currentRouteName());

		return $this->model->paginate($perPage);
	}


	public function addCompanyProfile($data)
	{
		//calculates Latitude and Longitude coordinates
		$data = setLatLng($data);

		$profile = $this->model->create($data);

		return $profile;
	}


	public function updateCompanyProfile($companyProfileId, $data)
	{
		//recalculates Lat and Lng coordinates
		if (locationHasChanged($data))
		{
			$data = setLatLng($data);
		}

		$profile = $this->update($companyProfileId, $data);

		return $profile;
	}


	public function getUsers($userId = null)
	{
		$users = User::selectRaw("`id`, CONCAT(`first_name`, ' ', `last_name`) AS `name`")
			->whereDoesntHave('compprofile')
			->usersFilter(['userType' => 'simple']);

		//used to retrieve company profile's owner (when EDITing)
		if ($userId)
		{
			$users->orWhere('id', $userId);
		}

		return $users->pluck('name', 'id')->all();
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