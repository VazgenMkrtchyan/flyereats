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

use App\AppCore\Front\BrowseListings\Jobs\GenerateSearchUrl;
use App\AppCore\Front\BrowseListings\Requests\ListingEnquiryRequest;
use App\AppCore\Front\Mailers\Jobs\ListingEnquiry;
use App\Http\Controllers\Controller;

use App\AppCore\Front\BrowseListings\Repositories\BrowseListingRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Input, Session;

class BrowseListingsController extends Controller {

	use GetDetailsTrait;

	protected $browseListingRepo, $webc;

	function __construct(BrowseListingRepository $browseListingRepository)
	{
		$this->browseListingRepo = $browseListingRepository;
		$this->webc = appCon();
	}

	//all listings
	public function index()
	{
		$searchData = Input::all();

		$listings = $this->browseListingRepo->getListings($searchData);
		$userGroups = $this->browseListingRepo->userGroups($searchData);
		$counter = $this->browseListingRepo->counter($searchData);
		$details = $this->getDetailsArray(['Makes' => 'activeL', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes']);

		//user data
		if (isset($searchData['userId']))
		{
			$seller = $this->browseListingRepo->getUserInfo($searchData['userId']);
		}
		else
		{
			$seller = null;
		}

		//search url is written to session
		Session::put('search_url', $searchData);

		return view('front.browse-listings.index', [
			'listings' => $listings,
			'userGroups' => $userGroups,
			'counter' => $counter,
			'details' => $details,
			'seller' => $seller,
		]);
	}

	//view listing
	public function view($any, $listingId)
	{
		if (Session::has('seen_listings')) {
			$seen = Session::get('seen_listings');
			$seen[$listingId] = $listingId;
			Session::put('seen_listings', $seen);
		} else Session::put('seen_listings', [$listingId => $listingId]);

		$listing = $this->browseListingRepo->getById($listingId);
		
		if (empty($listing)) {
			flash()->error(trans('front.404_listing_not_found'), 'danger');
			return \Redirect::route('browselistings.index');
		}
		
		$seller = $listing->user;

		return view('front.browse-listings.view', [
			'listing' => $listing,
			'seller' => $seller
		]);
	}

	//send listing enquiry
	public function listingEnquirySend($listingId, ListingEnquiryRequest $request)
	{
		$data = $request->all();

		//sends email
		$this->dispatchNow(new ListingEnquiry($listingId, $data));

		return response(200);
	}


	//printable page
	public function listingPrint($listingId)
	{
		$listing = $this->browseListingRepo->getById($listingId);

		return view('front.browse-listings.view-print', [
			'listing' => $listing,
			'seller' => $listing->user,
			'photos' => $listing->photos()->take(3)->get()
		]);
	}


	public function doListingsSearch()
	{
		//generate search url command
		$searchUrl = $this->dispatchNow(new GenerateSearchUrl(Input::all()));

		return redirect()->route('browselistings.index', $searchUrl);
	}


	//stars listing
	public function loveListing($id)
	{
		$status = 'loved';
		if (Session::has('loved_listings'))
		{
			$loved_listings = Session::get('loved_listings');

			if (array_key_exists($id, $loved_listings)) {
				unset($loved_listings[$id]);
				$status = 'undone';
			}
			else $loved_listings[$id] = $id;

			Session::put('loved_listings', $loved_listings);
		}
		else Session::put('loved_listings', [$id => $id]);
		
		return \Response::json($status);
	}

}