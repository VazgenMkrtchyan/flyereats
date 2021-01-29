<?php namespace App\AppCore\Admin\Listings\Repositories;
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
use App\AppCore\Miscellaneous\Traits\CarFeaturesTrait;
use Carbon;
use Listing, User;

class ListingRepository extends EloquentRepository {

	use CarFeaturesTrait;

	protected $model, $webc;
	function __construct(Listing $model)
	{
		$this->model = $model;
		error_reporting(0);
	}

	//gets listings based on search data
	public function getListings($data)
	{
		//builds query
		$listings = $this->model
			->listingsFilter($data)
			->listingsSort(['sort' => getOrWebc('ai_list_sort', 'sortby')]);

		//listings per page
		$perPage = sessionOrWebc('ai_list_no', \Route::currentRouteName());

		return $listings->paginate($perPage, ['listings.*']);
	}

	///////////////////////////////////////////////
	//adds listing
	public function addListing($data)
	{
		//calculates Latitude and Longitude coordinates
		$data = setLatLng($data);
		//sets correct enhancement data
		$data = $this->setEnhancement($data);
		//creates listing
		$listing = $this->create($data);
		//assigns car features
		$this->assignCarFeatures($listing, $data);

		return $listing;
	}

	//updates listing
	public function updateListing($listingId, $data)
	{
		//sets correct enhancement data (MUST GO AFTER $this->unsetDates...)
		$data = $this->setEnhancement($data);
		//recalculates Lat and Lng coordinates
		if (locationHasChanged($data))
		{
			$data = setLatLng($data);
		}

		//updates listing
		$listing = $this->update($listingId, $data, ['st_archived']);
		//assigns car features
		$this->assignCarFeatures($listing, $data);

		return $listing;
	}

	//gets users
	public function getUsers()
	{
		$users = User::selectRaw("`id`, CONCAT(`first_name`, ' ', `last_name`) AS `name`")
			->usersFilter(['userType' => 'simple'])
			->pluck('name', 'id')->all();

		return $users;
	}

	//approves listing
	public function approveListing($listingId)
	{
		$listing = $this->getById($listingId);

		//sets correct expiration date
		$listingPlan = $listing->listingPlan;
		if ($listingPlan)
		{
			if ($listingPlan->duration)
			{
				$data['expires_on'] = Carbon::now()->addDays($listingPlan->duration);
			}
			else
			{
				$data['expires_on'] = null;
			}
		}
		//sets correct status
		$data['st_moderation'] = 'approved';

		//updates
		$listing = $this->update($listingId, $data);

		return $listing;
	}

	//rejects listing
	public function rejectListing($listingId)
	{
		$this->update($listingId, ['st_moderation' => 'rejected']);
	}

	//undoes listing reject
	public function undoRejectListing($listingId)
	{
		$this->update($listingId, ['st_moderation' => 'approved']);
	}

	//transfers listings from one user to other
	public function transferListings($ownerId, $recipientId)
	{
		$this->model
			->where('user_id', $ownerId)
			->update([
				'user_id' => $recipientId,
			]);
	}

	##HELPERS##
	//sets correct enhancement data
	protected function setEnhancement($data)
	{
		switch($data['listing_enhancement'])
		{
			case 'highlighted':
				$stHighlighted = true;
				$stFeatured = false;
				break;

			case 'featured':
				$stHighlighted = false;
				$stFeatured = true;
				break;

			default:
				$stHighlighted = false;
				$stFeatured = false;
				$data['high_or_feat_till'] = null;
		}

		$data['st_highlighted'] = $stHighlighted;
		$data['st_featured'] = $stFeatured;

		return $data;
	}

	##COUNTER##
	public function counter()
	{
		//listingStatus
		$count['listingStatus.active'] = $this->model->listingsFilter(['listingStatus' => 'active'])->count();
		$count['listingStatus.inactive'] = $this->model->listingsFilter(['listingStatus' => 'inactive'])->count();

		//listingType
		$count['listingType.simple'] = $this->model->listingsFilter(['listingType' => 'simple'])->count();
		$count['listingType.highlighted'] = $this->model->listingsFilter(['listingType' => 'highlighted'])->count();
		$count['listingType.featured'] = $this->model->listingsFilter(['listingType' => 'featured'])->count();

		//moderationStatus
		$count['moderationStatus.approved'] = $this->model->listingsFilter(['moderationStatus' => 'approved'])->count();
		$count['moderationStatus.pending'] = $this->model->listingsFilter(['moderationStatus' => 'pending'])->count();
		$count['moderationStatus.rejected'] = $this->model->listingsFilter(['moderationStatus' => 'rejected'])->count();

		//listing plan (counts listings without a listing plan - all the rest are dynamically counted)
		$count['listing_plans.without'] = $this->model->listingsFilter(['listingPlan' => 'without'])->count();

		return $count;
	}
}