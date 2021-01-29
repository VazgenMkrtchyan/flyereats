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

use App\AppCore\Admin\ListingPhotos\Jobs\DeletePhoto;
use App\AppCore\Admin\ListingPhotos\Jobs\RotatePhoto;
use App\AppCore\Admin\ListingPhotos\Jobs\UploadPhoto;
use App\Http\Controllers\Controller;
use App\AppCore\Admin\ListingPhotos\Repositories\PhotoRepository;
use Input;
use Artisan;

class ListingPhotosController extends Controller {

	protected $photoRepo;
	function __construct(PhotoRepository $photoRepository)
	{
		$this->photoRepo = $photoRepository;
	}


	public function upload($listingId)
	{
		$photo = Input::file('file');

		//uploads selected photos
		$this->dispatchNow(new UploadPhoto($listingId, $photo));

		if (Input::has('fallback'))
		{
			session()->flash('photos_upload_fallback', 'true');
			flash()->success(trans('back.flash_photo_uploaded'));
			return back();
		}

		return response(200);
	}

    //deletes photo and photo record from database
	public function destroy()
	{
		//deletes listing photo
		$this->dispatchNow(new DeletePhoto(Input::get('photoId')));

		return response(200);
	}



    public function rotate()
    {
        $this->dispatchNow(new RotatePhoto(Input::get('photoId')));

        return response(200);
    }

	//Reorders images
	public function move()
	{
		$data = Input::only('photoId', 'targetId');

		//reorders photos
		$this->photoRepo->changeOrder($data['photoId'], $data['targetId']);

		return response(200);
	}


	public function listingPhotosAJAX($listingId)
	{
		$photos = $this->photoRepo->getAllListingPhotos($listingId);
		$listing = $this->photoRepo->getListing($listingId);

		return view('admin.listings.partials.listing-photos-ajax', [
			'photos' => $photos,
			'listing' => $listing,
		]);
	}

}



