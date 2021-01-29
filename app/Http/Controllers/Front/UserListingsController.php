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

use App\AppCore\Front\ListingPlans\Repositories\ListingPlanRepository;
use App\AppCore\Front\UserListings\Jobs\DeleteListing;
use App\AppCore\Front\UserListings\Requests\CreateListingRequest;
use App\AppCore\Front\UserListings\Requests\UpdateListingRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Front\UserListings\Repositories\UserListingRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Input, Auth;

class UserListingsController extends Controller {

	use GetDetailsTrait;

	protected $userListingRepo, $listingPlanRepository;
	function __construct(UserListingRepository $userListingRepository, ListingPlanRepository $listingPlanRepository)
	{
		$this->userListingRepo = $userListingRepository;
		$this->listingPlanRepository = $listingPlanRepository;
	}


	public function index()
	{
		$listings = $this->userListingRepo->getUserListings(Auth::id(), Input::get('show'));
		$listingsCount = $this->userListingRepo->countUserListings(Auth::id());

		return view('front.user-listings.index', [
			'listings' => $listings,
			'listingsCount' => $listingsCount
		]);
	}


	public function create()
	{
		$details = $this->getDetailsArray(['Makes' => '', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes', 'Features', 'States']);


		return view('front.user-listings.create', [
			'details' => $details
		]);
	}


	public function store(CreateListingRequest $request)
	{
		$data = $request->all();

		//adds listing
		$listing = $this->userListingRepo->addListing($data, Auth::id());

		flash()->success(trans('front.flash_listing_added'));
		session()->flash('listing_added', 'true');
		return redirect()->route('userlistings.edit', $listing->id);
	}


	public function edit($listingId)
	{
		$listing = $this->userListingRepo->getById($listingId);
		$photos = $listing->photos;
		$highFeatPlans = $this->listingPlanRepository->highFeatPlans();
		$listingPlans = appCon()->listingPlansBased() ? Auth::user()->listingPlans()->ordered()->get() : null;
		$details = $this->getDetailsArray(['Makes' => '', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes', 'Features', 'States']);

		return view('front.user-listings.edit', [
			'listing' => $listing,
			'photos' => $photos,
			'highFeatPlans' => $highFeatPlans,
			'listingPlans' => $listingPlans,
			'details' => $details
		]);
	}


	public function update($listingId, UpdateListingRequest $request)
	{
		$data = $request->all();

		//updates listing
		$this->userListingRepo->updateListing($listingId, $data);

		flash()->success(trans('front.flash_listing_updated'));
		return redirect()->route('userlistings.index');
	}


	public function destroy($listingId)
	{
		//delete listing command
		$this->dispatchNow(new DeleteListing($listingId));

		flash()->success(trans('front.flash_listing_deleted'));
		return redirect()->route('userlistings.index');
	}


	public function archiveListing($listingId)
	{
		$this->userListingRepo->archiveListing($listingId);

		flash()->success(trans('front.flash_listing_archived'));
		return back();
	}


	public function restoreListing($listingId)
	{
		$this->userListingRepo->restoreListing($listingId);

		flash()->success(trans('front.flash_listing_restored'));
		return back();
	}

}