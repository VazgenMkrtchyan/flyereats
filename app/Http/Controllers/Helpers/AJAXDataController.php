<?php namespace App\Http\Controllers\Helpers;
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

use App\AppCore\Miscellaneous\AJAX\Repositories\AJAXDataRepository;
use App\Http\Controllers\Controller;
use Input, Form;

class AJAXDataController extends Controller {

	public $AJAXDataRepo;
	public function __construct(AJAXDataRepository $AJAXDataRepository)
	{
		$this->AJAXDataRepo = $AJAXDataRepository;
	}

	//gets models of selected make
	public function getModels()
	{
		$makeId = Input::get('parentId');
		$countOf = Input::get('countOf');

		return $this->AJAXDataRepo->getModelsOfMake($makeId, $countOf)->pluck('name', 'id')->all();
	}

	//gets listing plans
	public function getListingPlans()
	{
		$userId = Input::get('parentId');

		return $this->AJAXDataRepo->getListingPlans($userId);
	}

	//gets membership plans for user group
	public function getMembershipPlans()
	{
		$userGroupId = Input::get('parentId');

		return $this->AJAXDataRepo->getMembershipPlansForUserGroup($userGroupId);
	}

	//gets user address
	public function getUserAddress()
	{
		$userId = Input::get('userId');

		return $this->AJAXDataRepo->getUserAddressData($userId);
	}

	//gets listing plan data
	public function getListingPlanData()
	{
		$listingPlanId = Input::get('listingPlanId');

		return $this->AJAXDataRepo->getListingPlanData($listingPlanId);
	}


	public function getMembershipPlanData()
	{
		$membershipPlanId = Input::get('membershipPlanId');

		return $this->AJAXDataRepo->getMembershipPlanData($membershipPlanId);
	}
	
	
	public function getLoadMoreData()
	{
		$input = Input::all();
		$listings = $this->AJAXDataRepo->getLoadMoreData($input['loaded-no'], $input['load-step']);

		return view('front.index.partials.ajax-listings', [
			'listings' => $listings,
		]);
	}
}