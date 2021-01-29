<?php
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

use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;

class Listing extends Eloquent {

	//presenter
	use PresentableTrait;
	protected $presenter = 'App\AppCore\Miscellaneous\Presenters\ListingPresenter';

	//protected $guarded = [];
	protected $fillable = ['user_id', 'listing_plan_id', 'year', 'make_id', 'model_id', 'det_condition_id', 'det_bodystyle_id', 'mileage', 'price', 'doors', 'passengers', 'det_extcolor_id', 'det_intcolor_id', 'engine_cyl', 'engine_cap', 'det_transmission_id', 'det_drivetype_id', 'det_fueltype_id', 'description', 'state_id', 'city', 'addr_1', 'zip', 'lat', 'lng', 'expires_on', 'st_moderation', 'st_featured', 'st_highlighted', 'high_or_feat_till', 'st_archived'];
	//PROTECT FIELDS LIKE listing_plan_id, expires_on IN FORMS!!! (use unset)

	//If left empty, will be set to 'null'
	public $nullable = ['listing_plan_id', 'expires_on', 'high_or_feat_till'];

	//date mutators (converts to instances of Carbon)
	public function getDates()
	{
		return ['created_at', 'updated_at', 'high_or_feat_till', 'expires_on'];
	}

	//ATTRIBUTES
	//expires on
	public function setExpiresOnAttribute($value)
	{
		if (is_object($value))
		{
			$val = $value;
		}
		else
		{
			$val = empty($value) ? null : Carbon::createFromFormat('Y-m-d', $value);
		}

		$this->attributes['expires_on'] = $val;
	}

	public function setHighOrFeatTillAttribute($value)
	{
		if (is_object($value))
		{
			$val = $value;
		}
		else
		{
			$val = empty($value) ? null : Carbon::createFromFormat('Y-m-d', $value);
		}

		$this->attributes['high_or_feat_till'] = $val;
	}

	//RELATIONSHIPS (oh yea, listing has many :DDD)
	//#user
	public function user()
	{
		return $this->belongsTo('User');
	}
	//#listing plan
	public function listingPlan()
	{
		return $this->belongsTo('ListingPlan');
	}
	//#photos
	public function photos()
	{
		return $this->hasMany('Photo');
	}
	//#make
	public function make()
	{
		return $this->belongsTo('Make');
	}
	//#model
	public function model()
	{
		return $this->belongsTo('Model');
	}
	//#condition
	public function condition()
	{
		return $this->belongsTo('Condition', 'det_condition_id');
	}
	//#bodystyle
	public function bodystyle()
	{
		return $this->belongsTo('Bodystyle', 'det_bodystyle_id');
	}
	//#extcolor
	public function extcolor()
	{
		return $this->belongsTo('Extcolor', 'det_extcolor_id');
	}
	//#intcolor
	public function intcolor()
	{
		return $this->belongsTo('Intcolor', 'det_intcolor_id');
	}
	//#transmission
	public function transmission()
	{
		return $this->belongsTo('Transmission', 'det_transmission_id');
	}
	//#drivetype
	public function drivetype()
	{
		return $this->belongsTo('Drivetype', 'det_drivetype_id');
	}
	//#fueltype
	public function fueltype()
	{
		return $this->belongsTo('Fueltype', 'det_fueltype_id');
	}
	//#state
	public function state()
	{
		return $this->belongsTo('State');
	}
	//#features
	public function features()
	{
		return $this->belongsToMany('Feature');
	}
	// -------------- //

	##SCOPES##
	//SORT BY (adds sort filter)
	public function scopeListingsSort($query, $data)
	{
		//featured first
		if (isset($data['featured_first']) AND $data['featured_first']
		) 
			$query->orderBy('listings.st_featured', 'desc');
		
		//all the rest sort
		switch ($data['sort']) {
			case 'year_DESC':
				$query->orderBy('listings.year', 'DESC');
				break;
			case 'year_ASC':
				$query->orderBy('listings.year');
				break;
			case 'date_DESC':
				$query->orderBy('listings.created_at', 'DESC');
				break;
			case 'date_ASC':
				$query->orderBy('listings.created_at');
				break;
			case 'price_DESC':
				$query->orderBy('listings.price', 'DESC');
				break;
			case 'price_ASC':
				$query->orderBy('listings.price');
				break;
			case 'views_DESC':
				$query->orderBy('listings.views', 'DESC');
				break;
			case 'views_ASC':
				$query->orderBy('listings.views');
				break;
			case 'mileage_ASC':
				$query->orderBy('listings.mileage');
				break;
			case 'mileage_DESC':
				$query->orderBy('listings.mileage', 'DESC');
				break;

		}
	}
	
	//APPLIES VARIOUS FILTERS
	public function scopeListingsFilter($query, $data)
	{
		//listingStatus (overall - active or not)
		if (! empty($data['listingStatus']))
		{
			switch($data['listingStatus'])
			{
				case 'active':
					$query->where(function ($query) { ///must be wrapped if multiple statements
						$query->where('listings.st_moderation', 'approved')
							->where('listings.st_archived', false)
							//changing web type to 'Membership Plans' based, 'expires_on' of listings should be set to NULL
							->where(function ($query) {
								$query->where('listings.expires_on', '>', Carbon::now())
									->orWhereNull('listings.expires_on');
							})->whereHas('user', function ($query) {
								$query->usersFilter(['userStatus' => 'active']);
							});
						//if listing plans based
						if (appCon()->listingPlansBased())
							$query->whereNotNull('listings.listing_plan_id');
					});
					break;

				case 'inactive':
					$query->where(function ($query) { ///must be wrapped if multiple statements
						$query->where('listings.st_moderation', '!=', 'approved')
							->orWhere('listings.st_archived', true)
							->OrWhere(function ($query) {
								$query->where('listings.expires_on', '<', Carbon::now())
									->whereNotNull('listings.expires_on');
							})->orWhereHas('user', function ($query) {
								$query->usersFilter(['userStatus' => 'inactive']);
							});
						//if listing plans based
						if (appCon()->listingPlansBased())
							$query->orWhereNull('listings.listing_plan_id');
					});
					break;
			}
		}
		
		//description
		if (! empty($data['description']))
		{
			$desc = preg_replace('/\|/', '', $data['description']);
			$query->where('listings.description', 'REGEXP', trim(preg_replace('/\s+/', '|', $desc), '|'));
		}
		//make
		if (! empty($data['make']))
		{
			$query->where('listings.make_id', $data['make']);
		}
		//model
		if (! empty($data['model']))
		{
				$query->where('listings.model_id', $data['model']);
		}
		//body style
		if (! empty($data['bodystyle']))
		{
			$query->where('listings.det_bodystyle_id', $data['bodystyle']);
		}
		//fuel type
		if (! empty($data['fueltype']))
		{
			$query->where('listings.det_fueltype_id', $data['fueltype']);
		}
		//condition
		if (! empty($data['condition']))
		{
			$query->where('listings.det_condition_id', $data['condition']);
		}
		//transmission
		if (! empty($data['transmission']))
		{
			$query->where('listings.det_transmission_id', $data['transmission']);
		}
		//drive type
		if (! empty($data['drivetype']))
		{
			$query->where('listings.det_drivetype_id', $data['drivetype']);
		}
		//exterior color
		if (! empty($data['extcolor']))
		{
			$query->where('listings.det_extcolor_id', $data['extcolor']);
		}
		//interior color
		if (! empty($data['intcolor']))
		{
			$query->where('listings.det_intcolor_id', $data['intcolor']);
		}

		##MIN-MAX##
		//price
		if (! empty($data['min_price'])) {
			$query->where('listings.price', '>=', $data['min_price']);
		}
		if (! empty($data['max_price'])) {
			$query->where('listings.price', '<=', $data['max_price']);
		}
		//mileage
		if (! empty($data['min_mileage'])) {
			$query->where('listings.mileage', '>=', $data['min_mileage']);
		}
		if (! empty($data['max_mileage'])) {
			$query->where('listings.mileage', '<=', $data['max_mileage']);
		}
		//year
		if (! empty($data['min_year'])) {
			$query->where('listings.year', '>=', $data['min_year']);
		}
		if (! empty($data['max_year'])) {
			$query->where('listings.year', '<=', $data['max_year']);
		}

		//ZIP & DISTANCE
		if (! empty($data['zip'])
			AND ! empty($data['distance'])) {

			$zip = ZipCode::where('zip_code', $data['zip'])->first();

			if (! empty($zip)) {

				//multiplier is based on mileage units
				if (appCon()->mileage_units == 'km') {
					$multiplier = '6371';
				}
				//if miles, multiplier is 6371*1.6 = 10194
				else $multiplier = '10194';

				$query->whereRaw("(".$multiplier."* ACOS( COS( RADIANS( lat ) ) * COS( RADIANS( {$zip->lat} ) ) * COS( RADIANS( lng ) - RADIANS( {$zip->lng} ) ) + SIN( RADIANS( lat ) ) * SIN( RADIANS( {$zip->lat} ) ) ) )  < {$data['distance']}");
			}
		}

		//show loved
		if (isset($data['show_loved'])) {
			$query->whereIn('listings.id', \Session::get('loved_listings'));
		}
		//show history
		if (isset($data['show_history'])) {
			$query->whereIn('listings.id', \Session::get('seen_listings'));
		}

		//listingType
		if (! empty($data['listingType']))
		{
			switch($data['listingType'])
			{
				case 'simple':
					$query
						->where('listings.st_highlighted', false)
						->where('listings.st_featured', false);
					break;

				case 'enhanced':
					$query->where(function ($query) {
						$query
							->where('listings.st_highlighted', true)
							->orWhere('listings.st_featured', true);
					});
					break;

				case 'highlighted':
					$query->where('listings.st_highlighted', true);
					break;

				case 'featured':
					$query->where('listings.st_featured', true);
					break;
			}
		}

		//archived
		if (! empty($data['archived']))
		{
			$query->where('listings.st_archived', true);
		}
		
		//moderationStatus
		if (! empty($data['moderationStatus']))
		{
			switch($data['moderationStatus'])
			{
				case 'approved':
					$query->where('listings.st_moderation', 'approved');
					break;

				case 'pending':
					$query->where('listings.st_moderation', 'pending');
					break;

				case 'rejected':
					$query->where('listings.st_moderation', 'rejected');
					break;
			}
		}

		//listing plan
		if (! empty($data['listingPlan']))
		{
			if ($data['listingPlan'] == 'without')
			{
				$query->whereNull('listings.listing_plan_id');
			}
			else
			{
				$query->where('listings.listing_plan_id', $data['listingPlan']);
			}
		}

		//user filter
		if (! empty($data['userGroup']) OR
			! empty($data['userId'])
		) {
			$query->whereHas('user', function ($query) use ($data) {

				if (! empty($data['userGroup']))
					$query->where('users.user_group_id', $data['userGroup']);

				if (! empty($data['userId']))
					$query->where('users.id', $data['userId']);

			});
		}
		
	}


	# VARIOUS CHECKS #
	//checks if listing is active
	public function isActiveListing()
	{
		return (
			!$this->isArchived() AND
			$this->isApproved() AND
			$this->hasActiveListingPlan() AND
			$this->user->isActiveUser()
		);
	}
	
	//checks whether listing is approved
	public function isApproved()
	{
		return ($this->st_moderation == 'approved');
	}
	//checks whether listing is pending
	public function isPending()
	{
		return ($this->st_moderation == 'pending');
	}
	//checks whether listing is rejected
	public function isRejected()
	{
		return ($this->st_moderation == 'rejected');
	}

	//checks whether listing is expired
	public function isExpired()
	{
		return ($this->expires_on != null
			AND $this->expires_on < Carbon::now());
	}
	
	//checks if listing has active plan
	public function hasActiveListingPlan()
	{
		//irrelevant if website is based on membership plans. always true then
		if (appCon()->membershipPlansBased()) return true;

		return (! $this->isExpired() AND $this->listing_plan_id);
	}

	//checks if listing is archived
	public function isArchived()
	{
		return $this->st_archived;
	}

	//checks if listing is featured
	public function isFeatured()
	{
		return $this->st_featured;
	}

	//checks if listing is highlighted
	public function isHighlighted()
	{
		return $this->st_highlighted;
	}

	//checks if listing enhancement (highlight or featuring expired)
	public function enhancementExpired()
	{
		if ($this->high_or_feat_till != null
			AND $this->high_or_feat_till < Carbon::now())
		{
			return true;
		}
		return false;
	}
	// ./STATUSES

	# PHOTOS #
	//max listing photos based on website type/listing plan
	public function maxPhotosNo()
	{
		if (appCon()->membershipPlansBased())
		{
			if ($maxP = $this->user->membershipPlan->max_photos) return $maxP;
			return "UNLIMITED";
		}

		//ELSE (if website is listing plans based)
		if (! $this->listing_plan_id)
		{
			if ($defaultL = appCon()->default_photos_limit) return $defaultL;
			return "UNLIMITED";
		}
		if ($maxP = $this->listingPlan->max_photos) return $maxP;
		return "UNLIMITED";
	}

	//number of photos left to upload
	public function photosLeft()
	{
		if ($this->maxPhotosNo() == 'UNLIMITED') return true;
		return ($this->maxPhotosNo() > $this->photos()->count());
	}

	//checks if listing expires within x days
	public function expiresWithin($days)
	{
		//not used with membership plans based website
		if (appCon()->membershipPlansBased()) return false;
		if (! $this->expires_on) return false;
		return ($this->expires_on->diffInDays(Carbon::now()) <= $days);
	}

	//checks if listing is starred
	public function isLoved()
	{
		return (Session::has('loved_listings') AND
			array_key_exists($this->id, Session::get('loved_listings')));
	}

	//checks if listing is seen
	public function isSeen()
	{
		return (Session::has('seen_listings') AND
			array_key_exists($this->id, Session::get('seen_listings')));
	}
}

