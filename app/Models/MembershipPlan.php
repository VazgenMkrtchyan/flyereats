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

class MembershipPlan extends Eloquent {

	protected $guarded = [];

	//ATTRIBUTES
	//price (if returns 0 instead of 0.00)
	public function getPriceAttribute($value)
	{
		if ($value == 0) return 0;
		return $value;
	}

	##RELATIONSHIPS##
	//#users
	public function users()
	{
		return $this->hasMany('User');
	}

	#SCOPES
	public function scopeOrdered($query)
	{
		$query->orderBy('order')->orderBy('name');
	}

	//checks whether membership plan is in use
	public function inUse()
	{
		return $this->users()->usersFilter(['userStatus' => 'active'])->exists();
	}
	
	//checks whether plan is last in user group
	public function isLast()
	{
		if (MembershipPlan::where('user_group_id', $this->user_group_id)->count() > 1) return false;
		return true;
	}

	//checks if membership plan is perpetual
	public function isPerpetual()
	{
		if ($this->duration)
		{
			return false;
		}
		return true;
	}

	//checks if membership lan was already used
	public function wasUsed()
	{
		return Payment::where('for', 'membershipPlan')->where('user_id', Auth::id())->exists();
	}

	//checks if it's current membership plan
	public function isCurrent($user = null)
	{
		if ($user) return ($user->membership_plan_id == $this->id);
		return (Auth::user()->membership_plan_id == $this->id);
	}

	//checks if plan can be selected
	public function allowSelect()
	{
		$user = Auth::user();
		
		//if it is usable once and have been used
		if ($this->usable_once AND $this->wasUsed()) return false;
		//current perpetual plan cannot be extended unless user has expiration (after changing plan setting in admin panel)
		if ($this->isCurrent($user) AND
			$this->isPerpetual() AND
			! $user->expires_on) return false;
		
		return true;
	}
}