<?php namespace App\AppCore\Admin\ListingPhotos\Jobs;
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

use App\AppCore\Miscellaneous\Abstractions\Job;

use App\AppCore\Admin\ListingPhotos\Jobs\DeletePhotoFile;
use App\AppCore\Admin\ListingPhotos\Repositories\PhotoRepository;

class RotatePhoto extends Job
{
	public $photoId;


	public function __construct($photoId)
	{
		$this->photoId = $photoId;
	}

	public function handle(PhotoRepository $photoRepository)
	{
        //Artisan::call('cache:clear');
        $dir = storage_path().'/framework/';
        $this->rmrf($dir.'views');
        $this->rmrf($dir.'cache');

        //rotate photos
        $photoRepository->rotate($this->photoId);
	}

    public function rmrf($dir) {
        foreach (glob($dir) as $file) {
            if (is_dir($file)) {
                $this->rmrf("$file/*");
                //rmdir($file);
            } else {
                unlink($file);
            }
        }
    }

}