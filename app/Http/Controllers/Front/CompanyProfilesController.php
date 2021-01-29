<?php namespace App\Http\Controllers\Front;
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

use App\AppCore\Front\CompanyProfiles\Requests\CreateCompanyProfileRequest;
use App\AppCore\Front\CompanyProfiles\Requests\UpdateCompanyProfileRequest;
use App\AppCore\Front\CompanyProfiles\Jobs\DeleteCompany;
use App\AppCore\Front\CompanyProfiles\Jobs\DeleteCompanyLogo;
use App\AppCore\Front\CompanyProfiles\Jobs\UploadCompanyLogo;
use App\Http\Controllers\Controller;

use App\AppCore\Front\CompanyProfiles\Repositories\CompanyProfileRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Auth, Input;

class CompanyProfilesController extends Controller {

	use GetDetailsTrait;

	protected $companyProfileRepo;
	function __construct(CompanyProfileRepository $companyProfileRepository)
	{
		$this->companyProfileRepo = $companyProfileRepository;
	}


	public function create()
	{
		$user = Auth::user();

		if ($user->hasCompany())
		{
			return redirect()->route('compprofile.edit');
		}

		$details = $this->getDetailsArray(['States']);

		return view('front.user-company-profile.create', [
			'user' => $user,
			'details' => $details
		]);
	}


	public function store(CreateCompanyProfileRequest $request)
	{
		//checks whether user can add company profile
		if (! $request->user()->hasCompany())
		{
			$data = $request->all();

			//adds company profile
			$this->companyProfileRepo->addCompanyProfile($data, Auth::id());

			flash()->success(trans('front.flash_company_added'));
			return redirect()->route('compprofile.edit');
		}
	}


	public function edit()
	{
		$user = Auth::user();
		$compprofile = $user->compprofile;
		$details = $this->getDetailsArray(['States']);


		return view('front.user-company-profile.edit', [
			'compprofile' => $compprofile,
			'user' => $user,
			'details' => $details
		]);
	}


	public function update(UpdateCompanyProfileRequest $request)
	{
		$data = $request->all();

		//updates company profile
		$this->companyProfileRepo->updateCompanyProfile(Auth::user()->compprofile->id, $data);

		flash()->success(trans('front.flash_company_updated'));
		return redirect()->route('compprofile.edit');
	}


	public function destroy()
	{
		//deletes company profile
		$this->dispatchNow(new DeleteCompany(Auth::user()->compprofile->id));

		flash()->success(trans('front.flash_company_deleted'));
		return redirect()->route('account_summary');
	}


	public function uploadLogo()
	{
		$newLogo = Input::file('logo');
		//uploads logo
		$response = $this->dispatchNow(new UploadCompanyLogo($newLogo, Auth::user()->compprofile->id));

		session()->flash($response['status'], $response['message']);
		return back();
	}


	public function deleteLogo()
	{
		//deletes logo
		$this->dispatchNow(new DeleteCompanyLogo(Auth::user()->compprofile->id));

		flash()->success(trans('front.flash_logo_deleted'));
		return back();
	}

}