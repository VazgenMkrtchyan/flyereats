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

class UserGroup extends Eloquent {

	protected $fillable = ['name', 'description', 'display_company', 'display', 'active', 'order'];

	##RELATIONSHIPS##
	//#users
	public function users()
	{
		return $this->hasMany('User');
	}
	//#listings
	public function listings()
	{
		$this->hasManyThrough('Listing', 'User');
	}
	//#membership plans
	public function membershipPlans()
	{
		return $this->hasMany('MembershipPlan');
	}
	//#listing plans
	public function listingPlans()
	{
		return $this->hasMany('ListingPlan');
	}
	//#highlight/feature plans
	public function highfeatPlans()
	{
		return $this->hasMany('HighfeatPlan');
	}

	//SCOPES
	public function scopeOrdered($query)
	{
		$query->orderBy('order')->orderBy('name');
	}

	//checks whether membership plan can be detached from user group
	public function canDetachMembershipPlan($membershipPlanId)
	{
		$isUsed = $this->users()
			->where('membership_plan_id', $membershipPlanId)
			->count();

		if ($isUsed)
		{
			return false;
		}
		return true;
	}

	//checks if user group is in use
	public function inUse()
	{
		return $this->users()->exists();
	}

	public function isActive()
	{
		return $this->active;
	}


	public function displayCompany()
	{
		if ($this->display_company)
		{
			return true;
		}
		return false;
	}

}