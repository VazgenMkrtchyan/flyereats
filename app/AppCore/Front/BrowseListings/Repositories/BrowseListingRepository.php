<?php namespace App\AppCore\Front\BrowseListings\Repositories;
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
use Listing, UserGroup, User, ZipCode;

class BrowseListingRepository extends EloquentRepository {

	protected $model;

	function __construct(Listing $model)
	{
		$this->model = $model;
	}

	//gets listings
	public function getListings($data)
	{
		$data['listingStatus'] = 'active'; //forces to show only active listings
		$data['zip'] = sessionOrDefault('zip', '');
		$data['distance'] = sessionOrDefault('distance', '');
		//build listings query
		$listings = $this->model
			->with(['make', 'model', 'condition', 'transmission', 'fueltype', 'drivetype', 'bodystyle', 'extcolor', 'intcolor', 'photos'])
			->listingsFilter($data)
			->listingsSort([
				'featured_first' => appCon()->featured_first,
				'sort' => sessionOrWebc('ui_list_sort', 'sort_by')
			]);

		$perPage = sessionOrWebc('ui_list_no', 'per_page');

		return $listings->paginate($perPage, ['listings.*']);
	}

	##User Groups## (returns displayed user groups along with the listings count in them based on search options)
	public function userGroups($data)
	{
		unset($data['userGroup']);
		$data['listingStatus'] = 'active'; //forces to count only active listings

		//selects active and displayed user groups
		$userGroups = UserGroup::where('display', '1')->orderBy('order')->get(['name', 'id']);
		$array = [];
		//all the rest user groups (key represents user group's id)
		foreach ($userGroups as $userGroup)
		{
			$array[$userGroup->id] = $userGroup->name . ' (' . $this->model
					->listingsFilter($data)
					->whereHas('user', function($query) use($userGroup) {
					$query->where('user_group_id', $userGroup->id);
				})->count() . ')';
		}

		return $array;
	}

	//gets user info. Used for browsing selected user's listings
	public function getUserInfo($userId)
	{
		return User::findOrFail($userId);
	}

	##Counter##
	//counts all found listings based on search query
	public function counter($data)
	{
		unset($data['userGroup']);
		$data['listingStatus'] = 'active'; //forces to count only active listings
		return $this->model->listingsFilter($data)->count();
	}
}