<?php namespace App\AppCore\Admin\Users\Jobs;
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

use App\AppCore\Admin\CompanyProfiles\Jobs\DeleteCompany;
use App\AppCore\Admin\Listings\Jobs\DeleteListing;
use App\AppCore\Admin\Listings\Repositories\ListingRepository;
use App\AppCore\Admin\Users\Repositories\UserRepository;

class DeleteUser extends Job
{
	public $userId, $deleteOption, $transferTo;


	public function __construct($userId, $deleteOption, $transferTo)
	{
		$this->userId = $userId;
		$this->deleteOption = $deleteOption;
		$this->transferTo = $transferTo;
	}


	public function handle(UserRepository $userRepository, ListingRepository $listingRepository)
	{
		$userId = $this->userId;
		$deleteOption = $this->deleteOption;
		$transferTo = $this->transferTo;

		//gets user entity
		$user = $userRepository->getById($userId);
		//deletes user record from database
		$user->delete();

		//deletes everything
		if ($deleteOption == 'delete_everything')
		{
			foreach ($user->listings as $listing)
			{
				//deletes listing photos command
				$this->dispatchNow(new DeleteListing($listing->id));
			}
		}
		//transfers
		elseif ($deleteOption == 'delete_transfer')
		{
			//transfers listings to new recipient
			$listingRepository->transferListings($userId, $transferTo);
		}

		//deletes company profile if user has it
		if ($user->hasCompany())
		{
			$this->dispatchNow(new DeleteCompany($user->compprofile->id));
		}
	}

}