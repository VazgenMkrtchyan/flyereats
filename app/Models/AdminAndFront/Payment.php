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

class Payment extends Eloquent {

	protected $guarded = [];


	//RELATIONSHIPS
	public function user()
	{
		return $this->belongsTo('User');
	}
	public function listing()
	{
		return $this->belongsTo('Listing');
	}
	//returns entity (listing plan id, membership plan id...) for which payment is
	public function paymentFor()
	{
		switch ($this->for)
		{
			case 'membershipPlan':
				$model = 'MembershipPlan';
				break;

			case 'listingPlan':
				$model = 'ListingPlan';
				break;

			case 'listingHigh':
			case 'listingFeat':
				$model = 'HighfeatPlan';
				break;
		}

		return $this->belongsTo($model, 'for_id');
	}

	//scopes
	public function scopeCompleted($query)
	{
		$query->where('payment_status', 'Completed');
	}
	public function scopeNotCompleted($query)
	{
		$query->where('payment_status', '!=', 'Completed');
	}

	public function scopeForMembership($query)
	{
		$query->where('for', 'membershipPlan');
	}
	public function scopeForListing($query)
	{
		$query->where('for', 'listingPlan');
	}
	public function scopeForHighlighting($query)
	{
		$query->where('for', 'listingHigh');
	}
	public function scopeForFeaturing($query)
	{
		$query->where('for', 'listingFeat');
	}


	//CHECKS
	public function forMembershipPlan()
	{
		if ($this->for == 'membershipPlan')
		{
			return true;
		}
		return false;
	}

	public function forListingPlan()
	{
		if ($this->for == 'listingPlan')
		{
			return true;
		}
		return false;
	}

	public function forListingHighOrFeat()
	{
		if ($this->for == 'listingHigh'
			OR $this->for == 'listingFeat')
		{
			return true;
		}
		return false;
	}

}