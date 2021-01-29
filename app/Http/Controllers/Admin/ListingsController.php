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

use App\AppCore\Admin\Listings\Jobs\AfterListingApproval;
use App\AppCore\Admin\Listings\Jobs\DeleteListing;
use App\AppCore\Admin\Listings\Requests\CreateListingRequest;
use App\AppCore\Admin\Listings\Requests\UpdateListingRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use App\AppCore\Admin\Listings\Repositories\ListingRepository;
use Input, Session;

class ListingsController extends Controller {

	use GetDetailsTrait;

	protected $listingRepo;
	function __construct(ListingRepository $listingRepository)
	{
		$this->listingRepo = $listingRepository;
	}


	//shows listings
	public function index()
	{
		$searchData = Input::all();

		$listings = $this->listingRepo->getListings($searchData);
		$counter = $this->listingRepo->counter();
		$details = $this->getDetailsArray(['Makes' => 'all', 'ListingPlans' => 'listings', 'UserGroups' => 'listings']);

		//search url is written to session
		Session::put('listing_search_url', $searchData);

		return view('admin.listings.index', [
			'listings' => $listings,
			'counter' => $counter,
			'details' => $details,
			'user' => Input::has('userId') ? \User::where('id', Input::get('userId'))->first() : null
		]);
	}


	//add listing page
	public function create()
	{
		$users = $this->listingRepo->getUsers();
		$details = $this->getDetailsArray(['Makes' => '', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes', 'Features', 'States']);

		//destroys listing_search_url session data
		Session::forget('listing_search_url');

		return view('admin.listings.create', [
			'users' => $users,
			'details' => $details
		]);
	}


	//adds listing
	public function store(CreateListingRequest $request)
	{
		$data = $request->all();

		//adds listing
		$listing = $this->listingRepo->addListing($data);

		session()->flash('listing_added', 'true');
		flash()->success(trans('back.flash_listing_added'));
		return redirect()->route('admin.listings.edit', $listing->id);
	}


	//edit listing page
	public function edit($listingId)
	{
		$listing = $this->listingRepo->getById($listingId);
		$photos = $listing->photos;
		$users = $this->listingRepo->getUsers();

		$details = $this->getDetailsArray(['Makes' => '', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes', 'Features', 'States']);

		return view('admin.listings.edit', [
			'listing' => $listing,
			'photos' => $photos,
			'users' => $users,
			'details' => $details
		]);
	}


	//updates listing
	public function update($listingId, UpdateListingRequest $request)
	{
		$data = $request->all();

		//updates listing
		$this->listingRepo->updateListing($listingId, $data);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.listings.index', Session::get('listing_search_url'));
	}


	//deletes listing
	public function destroy($listingId)
	{
		$this->dispatchNow(new DeleteListing($listingId));

		flash()->success(trans('back.flash_successfully_deleted'));
		return back();
	}


	//approves listing
	public function approveListing($listingId)
	{
		$listing = $this->listingRepo->approveListing($listingId);

		//fires event
		$this->dispatchNow(new AfterListingApproval($listing));

		flash()->success(trans('back.flash_listing_approved'));
		return back();
	}


	//rejects listing
	public function rejectListing($listingId)
	{
		$this->listingRepo->rejectListing($listingId);

		flash()->success(trans('back.flash_listing_rejected'));
		return back();
	}

	//undoes listing reject
	public function undoRejectListing($listingId)
	{
		$this->listingRepo->undoRejectListing($listingId);

		flash()->success(trans('back.flash_listing_undo_reject'));
		return back();
	}
}
