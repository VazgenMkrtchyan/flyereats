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

class ListingPresenter extends Presenter {

	//formatted listing name
	public function listingName()
	{
		if(isset($this->make->name) && isset($this->model->name))
		{
			return $this->make->name . ' ' . $this->model->name . ' ' . $this->year;	
		}
		else
		{
			return '';
		}
		
	}

	//formatted listing address
	public function listingAddress()
	{
		return format_address($this);
	}

	//formatted listing price
	public function listingPrice()
	{
		return format_price($this->price);
	}

	//details
	//formatted listing mileage
	public function carMileage()
	{

		return number_format($this->mileage) . ' ' . appCon()->mileage_units;
	}
	public function carMake()
	{
		if (isset($this->make->name))
		{
			return $this->make->name;		
		}
		else
		{
			return "";
		}
	}
	public function carModel()
	{
		if (isset($this->model->name))
		{
			return $this->model->name;		
		}
		else
		{
			return "";
		}
		
	}
	public function carCondition()
	{
		if (isset($this->condition->name))
		{
			return $this->condition->name;
		}
		else
		{
			return '';
		}
		
		
	}
	public function carBodyStyle()
	{
		if (isset($this->bodystyle->name))
		{
			return $this->bodystyle->name;
		}
		else
		{
			return '';
		}
		
	}
	public function carTransmission()
	{
		if (isset($this->transmission->name))
		{
			return $this->transmission->name;
		}
		else
		{
			return '';
		}
		
	}
	public function carDriveType()
	{
		if (isset($this->drivetype->name))
		{
			return $this->drivetype->name;
		}
		else
		{
			return '';
		}
		
	}
	public function carFuelType()
	{
		if (isset($this->fueltype->name))
		{
			return $this->fueltype->name;
		}
		else
		{
			return '';
		}
		
	}
	public function carExtColor()
	{
		if (isset($this->extcolor->name))
		{
			return $this->extcolor->name;
		}
		else
		{
			return '';
		}
		
	}
	public function carIntColor()
	{
		if (isset($this->intcolor->name))
		{
			return $this->intcolor->name;
		}
		else
		{
			return '';
		}
		
	}

	//car photos - thumbnail and enlarged image
	public function mainThumbUrl()
	{
		if ($this->photos->count())
		{
			$thumb_url = $this->photos->first()->present()->thumbUrl();
		}
		else
		{
			$thumb_url = asset('/templates/misc/no_listing_photo_thumb.png');
		}
		return $thumb_url;
	}

	public function  mainPhotoUrl()
	{
		if ($this->photos->count())
		{
			$photo_url = $this->photos->first()->present()->photoUrl();
		}
		else
		{
			$photo_url = asset('/templates/misc/no_listing_photo_enlarge.png');
		}
		return $photo_url;
	}

	//seo friendly url
	public function seoUrl()
	{
		$any = $this->year . '-' . $this->carMake() . '-' . $this->carModel();
		$any = strtolower((str_replace(' ', '-', $any)));

		return route('browselistings.view', [$any, $this->id]);
	}

	public function metaDescription()
	{
		$meta = $this->ListingName() . ' for ' . $this->ListingPrice() . '. Listed on ' . appCon()->web_name;

		return $meta;
	}

	public function defaultEnquiryText()
	{
		$text = trans('front.default_enquiry_text', ['listingName' => $this->ListingName(), 'webName' => appCon()->web_name, 'listingPrice' => $this->ListingPrice()]);

		return $text;
	}

	public function expirationDate()
	{
		$expDate = appCon()->membershipPlansBased() ? $this->user->expires_on : $this->expires_on;
		
		return $expDate ? format_date($expDate) : trans('front.NEVER');
	}

	public function enhancementExpiration()
	{
		return $this->high_or_feat_till ? format_date($this->high_or_feat_till) : trans('front.NEVER');
	}

}
 