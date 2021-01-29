<?php namespace App\AppCore\Front\UserListings\Repositories;
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
use Listing, Carbon\Carbon;

class UserListingRepository extends EloquentRepository {

	use CarFeaturesTrait;

	protected $model;
	function __construct(Listing $model)
	{
		$this->model = $model;
	}

	//adds listing
	public function addListing($data, $userId)
	{
		//PROTECTS FIELDS FROM MANIPULATION
		unset($data['listing_plan_id'], $data['expires_on'], $data['st_moderation'], $data['st_featured'], $data['st_highlighted'], $data['high_or_feat_till']);

		//sets correct data
		$data['user_id'] = $userId; //sets correct owner
		//Latitude and Longitude
		// $data = setLatLng($data);
		//status moderation
		if (appCon()->membershipPlansBased())
			$data['st_moderation'] = \Auth::user()->membershipPlan->auto_conf ? 'approved' : 'pending';


		//creates listing
		$listing = $this->create($data);
		//assigns car features
		$this->assignCarFeatures($listing, $data);

		return $listing;
	}

	//updates listing
	public function updateListing($listingId, $data)
	{
		//PROTECTS FIELDS FROM MANIPULATION
		unset($data['user_id'], $data['listing_plan_id'], $data['expires_on'], $data['st_moderation'], $data['st_featured'], $data['st_highlighted'], $data['high_or_feat_till']);

		//if location has been changed, Latitude and Longitude coordinates are being updated
		// if (locationHasChanged($data))
		// {
		// 	$data = setLatLng($data);
		// }

		//updates listing
		$listing = $this->update($listingId, $data);
		//assigns car features
		$this->assignCarFeatures($listing, $data);
	}


	//gets logged user listings
	public function getUserListings($userId, $show) {
		if (isset($show)) {
			if ($show == 'active') $data['listingStatus'] = 'active';
			if ($show == 'inactive') $data['listingStatus'] = 'inactive';
			if ($show == 'archived') $data['archived'] = 'show';
		}
		
		$data['userId'] = $userId; //forces to show only user's listings

		return $this->model->listingsFilter($data)->get();
	}


	//counts logged user's listings
	public function countUserListings($userId)
	{
		$count['all'] = $this->model->where('user_id', $userId)->count();
		$count['active'] = $this->model->where('user_id', $userId)->listingsFilter(['listingStatus' => 'active'])->count();
		$count['inactive'] = $this->model->where('user_id', $userId)->listingsFilter(['listingStatus' => 'inactive'])->count();
		$count['archived'] = $this->model->where('user_id', $userId)->listingsFilter(['archived' => 'show'])->count();

		return $count;
	}


	//archives listing
	public function archiveListing($listingId)
	{
		$this->update($listingId, [
			'st_archived' => true
		]);
	}


	//restores listing
	public function restoreListing($listingId)
	{
		$this->update($listingId, [
			'st_archived' => false
		]);
	}

} 