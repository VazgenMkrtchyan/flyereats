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

use App\AppCore\Admin\ListingPlans\Requests\CreateListingPlanRequest;
use App\AppCore\Admin\ListingPlans\Requests\UpdateListingPlanRequest;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\ListingPlans\Repositories\ListingPlanRepository;
use Input;

class ListingPlansController extends Controller {

	use GetDetailsTrait;
	protected $listingPlanRepository;

	function __construct(ListingPlanRepository $listingPlanRepository)
	{
		$this->listingPlanRepository = $listingPlanRepository;
	}

	//LISTS ALL LISTING PLANS
	public function index()
	{
		$userGroups = $this->listingPlanRepository->getUserGroups();

		return view('admin.listing-plans.index', [
			'userGroups' => $userGroups
		]);
	}

	//RETURNS PAGE FOR ADDING A NEW LISTING PLAN
	public function create()
	{
		$details = $this->getDetailsArray(['UserGroups' => null]);

		return view('admin.listing-plans.create', [
			'details' => $details
		]);
	}

	//STORES NEW LISTING PLAN IN DATABASE
	public function store(CreateListingPlanRequest $request)
	{
		$data = $request->all();

		//creates listing plan
		$this->listingPlanRepository->create($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.listing-plans.index');
	}

	//SHOWS LISTING PLAN INFO
	public function show($listingPlanId)
	{
		$listingPlan = $this->listingPlanRepository->getById($listingPlanId, ['listings']);

		return view('admin.listing-plans.show', [
			'listingPlan' => $listingPlan
		]);
	}

	//EDIT LISTING PLAN PAGE
	public function edit($listingPlanId)
	{
		$details = $this->getDetailsArray(['UserGroups' => null]);
		$listingPlan = $this->listingPlanRepository->getById($listingPlanId);

		return view('admin.listing-plans.edit', [
			'details' => $details,
			'listingPlan' => $listingPlan
		]);
	}

	//UPDATES LISTING PLAN INFO
	public function update($listingPlanId, UpdateListingPlanRequest $request)
	{
		$data = $request->all();

		//updates listing plan
		$this->listingPlanRepository->update($listingPlanId, $data, ['auto_conf']);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.listing-plans.index');
	}

	//DELETES LISTING PLAN FROM DATABASE
	public function destroy($listingPlanId)
	{
		$listingPlan = $this->listingPlanRepository->getById($listingPlanId);

		if ($listingPlan->isLast())
		{
			flash()->error(trans('back.flash_last_listing_plan'));
			return back();
		}

		if (appCon()->ListingPlansBased()) {
			//checks if there are listings with this listing plan
			if (!$listingPlan->inUse()) {
				$listingPlan->delete();

				flash()->success(trans('back.flash_successfully_deleted'));
				return back();
			}
		}

		flash()->error(trans('back.flash_cannot_be_deleted_used_in_listings'));
		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();

		$this->listingPlanRepository->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}