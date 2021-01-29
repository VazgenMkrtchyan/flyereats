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

use App\AppCore\Admin\CompanyProfiles\Jobs\DeleteCompany;
use App\AppCore\Admin\CompanyProfiles\Jobs\DeleteCompanyLogo;
use App\AppCore\Admin\CompanyProfiles\Jobs\UploadCompanyLogo;
use App\AppCore\Admin\CompanyProfiles\Requests\CreateCompanyProfileRequest;
use App\AppCore\Admin\CompanyProfiles\Requests\UpdateCompanyProfileRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\CompanyProfiles\Repositories\CompanyProfileRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Input;

class CompanyProfilesController extends Controller {

	use GetDetailsTrait;

	protected $companyProfileRepo;
	function __construct(CompanyProfileRepository $companyProfileRepository)
	{
		$this->companyProfileRepo = $companyProfileRepository;
	}

	public function index()
	{
		$compprofiles = $this->companyProfileRepo->getProfiles();

		return view('admin.company-profiles.index', [
			'compprofiles' => $compprofiles
		]);
	}


	public function create()
	{
		$users = $this->companyProfileRepo->getUsers();
		$details = $this->getDetailsArray(['States']);

		return view('admin.company-profiles.create', [
			'users' => $users,
			'details' => $details
		]);
	}


	public function store(CreateCompanyProfileRequest $request)
	{
		$data = $request->all();

		//adds company profile
		$companyProfile = $this->companyProfileRepo->addCompanyProfile($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.company-profiles.edit', $companyProfile->id);
	}


	public function edit($companyProfileId)
	{
		$compprofile = $this->companyProfileRepo->getById($companyProfileId);
		$users = $this->companyProfileRepo->getUsers($compprofile->user_id);
		$details = $this->getDetailsArray(['States']);

		return view('admin.company-profiles.edit', [
			'compprofile' => $compprofile,
			'users' => $users,
			'details' => $details
		]);
	}


	public function update($companyProfileId, UpdateCompanyProfileRequest $request)
	{
		$data = $request->all();

		//updates company profile
		$this->companyProfileRepo->updateCompanyProfile($companyProfileId, $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.company-profiles.index');
	}


	public function destroy($companyProfileId)
	{
		//deletes company profile
		$this->dispatchNow(new DeleteCompany($companyProfileId));

		flash()->success(trans('back.flash_successfully_deleted'));
		return redirect()->route('admin.company-profiles.index');
	}


	public function uploadLogo($companyProfileId)
	{
		$newLogo = Input::file('logo');
		//uploads logo
		$this->dispatchNow(new UploadCompanyLogo($newLogo, $companyProfileId));

		flash()->success(trans('back.flash_logo_uploaded'));
		return back();
	}


	public function deleteLogo($companyProfileId)
	{
		//deletes logo
		$this->dispatchNow(new DeleteCompanyLogo($companyProfileId));

		flash()->success(trans('back.flash_logo_deleted'));
		return back();
	}

}
