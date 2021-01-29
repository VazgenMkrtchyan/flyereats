<?php namespace App\AppCore\Front\CompanyProfiles\Jobs;
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

use App\AppCore\Front\CompanyProfiles\Repositories\CompanyProfileRepository;
use App\AppCore\Miscellaneous\Traits\LogosTrait;

class DeleteCompany extends Job
{
	use LogosTrait;

	public $companyProfileId;

	
	public function __construct($companyProfileId)
	{
		$this->companyProfileId = $companyProfileId;
	}


	public function handle(CompanyProfileRepository $companyProfileRepository)
	{
		$companyProfile = $companyProfileRepository->getById($this->companyProfileId);
		//deletes profile from database
		$companyProfile->delete();

		//deleting logo file if company profile has one
		$companyLogo = $companyProfile->logo;
		if ($companyLogo)
		{
			$this->deleteLogo($companyLogo, 'images/logos/compprofiles');
		}
	}

}