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

use App\AppCore\Front\ListingPhotos\Jobs\DeletePhoto;
use App\AppCore\Front\ListingPhotos\Jobs\UploadPhoto;
use App\AppCore\Front\ListingPhotos\Repositories\PhotoRepository;
use App\Http\Controllers\Controller;

use App\AppCore\Front\UserListings\Repositories\UserListingRepository;
use Auth, Input;

class ListingPhotosController extends Controller {

	protected $userListingRepo;
	function __construct(UserListingRepository $userListingRepository)
	{
		$this->userListingRepo = $userListingRepository;
	}


	public function upload($listingId)
	{
		$listing = $this->userListingRepo->getById($listingId);
		$fallback = Input::has('fallback');

		if ($listing->photosLeft())
		{
			$photo = Input::file('file');
			//uploads selected photo
			$this->dispatchNow(new UploadPhoto($listingId, $photo));

			if ($fallback)
			{
				session()->flash('photos_upload_fallback', 'true');
				flash()->success("Photo Successfully Uploaded!");
				return back();
			}
			return 'uploaded';
		}

		return 'limit_reached';
	}


	//deletes a photo and a record from database
	public function destroy()
	{
		$photoId = Input::get('photoId');

		//checks if user is photo's owner
		if ($photoId AND Auth::user()->isPhotoOwner($photoId)) {
			//deletes listing image
			$this->dispatchNow(new DeletePhoto(Input::get('photoId')));
			return 'deleted';
		}

		return 'unauthorized';
	}

	//reorders images
	public function move(PhotoRepository $photoRepository)
	{
		$photoId = Input::get('photoId');
		$targetId = Input::get('targetId');

		//checking if user is authorized to move selected photos
		$user = Auth::user();
		if ($photoId AND $targetId
			AND $user->isPhotoOwner($photoId)
			AND $user->isPhotoOwner($targetId)) {
			//reorders photos
			$photoRepository->changeOrder($photoId, $targetId);
			return 'moved';
		}

		return 'unauthorized';
	}


	public function listingPhotosAJAX($listingId)
	{
		$listing = $this->userListingRepo->getById($listingId);
		$photos = $listing->photos;

		return view('front.user-listings.partials.listing-photos-ajax', [
			'photos' => $photos,
			'listing' => $listing,
		]);
	}

}