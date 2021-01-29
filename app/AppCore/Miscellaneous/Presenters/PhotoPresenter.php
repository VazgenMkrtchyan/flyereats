<?php namespace App\AppCore\Miscellaneous\Presenters;
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

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class PhotoPresenter extends Presenter {

    //car photos - thumbnail and enlarged image
    public function thumbUrl()
    {
        $photoName = $this->name;
        return asset('uploads/listings/' . substr($photoName, 0, 2) . '/' . substr($photoName, 2, 2) . '/' . $photoName .'_thumb.jpg');
    }

    public function  photoUrl()
    {
        $photoName = $this->name;
        return asset('uploads/listings/' . substr($photoName, 0, 2) . '/' . substr($photoName, 2, 2) . '/' . $photoName . '_large.jpg');
    }

}
