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

class ListingPlan extends Eloquent {

	// Don't forget to fill this array
	//protected $fillable = [];
	protected $guarded = [];

	//ATTRIBUTES
	//price (if returns 0 instead of 0.00)
	public function getPriceAttribute($value)
	{
		if ($value == 0) return 0;
		return $value;
	}

	//RELATIONSHIPS
	//#listings
	public function listings()
	{
		return $this->hasMany('Listing');
	}

	#SCOPES
	public function scopeOrdered($query)
	{
		$query->orderBy('order')->orderBy('name');
	}

	//checks if listing plan is in use
	public function inUse()
	{
		return $this->listings()->listingsFilter(['listingStatus' => 'active'])->exists();
	}

	//checks whether plan is last in user group
	public function isLast()
	{
		if (ListingPlan::where('user_group_id', $this->user_group_id)->count() > 1) return false;
		return true;
	}

	//checks if listing plan is perpetual
	public function isPerpetual()
	{
		if ($this->duration)
		{
			return false;
		}
		return true;
	}
	
	//checks if it current listing plan
	public function isCurrent($listing)
	{
		return ($listing->listing_plan_id == $this->id);
	}
	
	//checks if plan can be selected
	public function allowSelect($listing)
	{
		//current perpetual plan cannot be extended unless listing has expiration (after changing plan setting in admin panel)
		if ($this->isCurrent($listing) AND
			$this->isPerpetual() AND
			! $listing->expires_on) return false;
		//checks plan listing limitations
		return (! $this->max_listings OR
			$this->listings()->listingsFilter(['listingStatus' => 'active'])->where('user_id', Auth::id())->count() < $this->max_listings);
	}
}