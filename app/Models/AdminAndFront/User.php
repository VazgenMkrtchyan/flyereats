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

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	use PresentableTrait;
	protected $presenter = 'App\AppCore\Miscellaneous\Presenters\UserPresenter';

	//Don't forget to fill this array
	protected $fillable = ['user_type', 'user_group_id', 'membership_plan_id', 'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'show_phone', 'state_id', 'city', 'addr_1', 'zip', 'expires_on', 'st_moderation', 'st_email_confirmed'];
	###PROTECT! user_type, user_group_id, and email_status (be careful not to pass these fields directly via mass assignment (use unset($array['user_type']) or anything you like))###

	//The attributes excluded from the model's JSON form.
	protected $hidden = array('password', 'remember_token');
	//If left empty, will be set to 'null'
	public $nullable = ['membership_plan_id', 'expires_on'];

	//date mutators (converts to instances of Carbon)
	public function getDates()
	{
		return ['created_at', 'updated_at', 'expires_on'];
	}

	//ATTRIBUTES
	//password
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}
	//expires_on
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

	//RELATIONSHIPS
	//#listings
	public function listings()
	{
		return $this->hasMany('Listing');
	}
	//#company profile
	public function compprofile()
	{
		return $this->hasOne('Compprofile');
	}
	//#payments
	public function payments()
	{
		return $this->hasMany('Payment');
	}
	//#user group
	public function userGroup()
	{
		return $this->belongsTo('UserGroup');
	}
	//#membership plan
	public function membershipPlan()
	{
		return $this->belongsTo('MembershipPlan');
	}
	//#permissions
	public function permissions()
	{
		return $this->belongsToMany('Permission');
	}
	//#state
	public function state()
	{
		return $this->belongsTo('State');
	}
	//#listing plans
	public function listingPlans()
	{
		return $this->hasMany('ListingPlan', 'user_group_id', 'user_group_id');
	}


	# SCOPES #
	//SORT BY (adds sort filter)
	public function scopeUsersSort($query, $data)
	{
		switch ($data) {
			case 'name_ASC':
				$query->orderBy('users.last_name');
				break;
			case 'name_DESC':
				$query->orderBy('users.last_name', 'DESC');
				break;
			case 'date_DESC':
				$query->orderBy('users.created_at', 'DESC');
				break;
		case 'date_ASC':
				$query->orderBy('users.created_at');
				break;
		}
	}

	//APPLIES VARIOUS FILTERS
	public function scopeUsersFilter($query, $data)
	{
		//user status
		if (! empty($data['userStatus']))
		{
			if ($data['userStatus'] == 'active') {

				$query->where(function ($query) { ///must be wrapped if multiple statements
					$query->where('users.st_moderation', 'approved')
						->where('users.st_email_confirmed', true)
						//changing web type to 'Listing Plans' based, 'expires_on' of users should be set to NULL
						->where(function ($query) {
							$query->where('users.expires_on', '>', Carbon::now())
								->orWhereNull('users.expires_on');
						});
					//if membership plans based
					if (appCon()->membershipPlansBased())
						$query->whereNotNull('users.membership_plan_id');
				});

			} else {

				$query->where(function ($query) { //must be wrapped if multiple statements
					$query->where('users.st_moderation', '!=', 'approved')
						->orWhere('users.st_email_confirmed', false)
						->orWhere(function ($query) {
							$query->where('users.expires_on', '<', Carbon::now())
								->whereNotNull('users.expires_on');
						});
					//if membership plans based
					if (appCon()->membershipPlansBased())
						$query->orWhereNull('users.membership_plan_id');
				});

			}
		}
		
		//userType
		if (! empty($data['userType']))
		{
			switch ($data['userType']) {
				case 'super':
					$query->where('users.user_type', 'super');
					break;
				case 'admin':
					$query->where('users.user_type', 'admin');
					break;
				case 'simple':
					$query->where('users.user_type', 'user');
					break;
			}
		}
		
		//(first name, last name, address)
		if (! empty($data['search']))
		{
			$search = $data['search'];
			$query->where(function ($query) use ($search)
			{
				$query->where('users.first_name', 'LIKE', '%' . $search . '%')
					->orWhere('users.last_name', 'LIKE', '%' . $search . '%')
					->orWhere('users.email', 'LIKE', '%' . $search . '%');
			});
		}

		//user group
		if (! empty($data['userGroup']))
		{
			$query->where('users.user_group_id', $data['userGroup']);
		}
		
		//moderation status
		if (! empty($data['moderationStatus']))
		{
			switch($data['moderationStatus'])
			{
				case 'approved':
					$query->where('users.st_moderation', 'approved');
					break;
				case 'pending':
					$query->where('users.st_moderation', 'pending');
					break;
				case 'rejected':
					$query->where('users.st_moderation', 'rejected');
					break;
			}
		}

		//membership plan
		if (! empty($data['membershipPlan']))
		{
			if ($data['membershipPlan'] == 'without')
			{
				$query->whereNull('users.membership_plan_id');
			}
			else
			{
				$query->where('users.membership_plan_id', $data['membershipPlan']);
			}
		}

		//email status
		if (! empty($data['emailStatus']))
		{
			switch ($data['emailStatus'])
			{
				case 'confirmed':
					$query->where('users.st_email_confirmed', true);
					break;
				case 'unconfirmed':
					$query->where('users.st_email_confirmed', false);
					break;
			}
		}
	}
	# /SCOPES #

	
	# VARIOUS CHECKS #
	public function isActiveUser()
	{
		return (
			$this->isApproved() AND
			$this->emailConfirmed() AND
			$this->hasActiveMembershipPlan()
		);
	}

	//checks whether user has active membership plan
	public function hasActiveMembershipPlan()
	{
		//irrelevant if website is based on listing plans. always true then
		if (appCon()->listingPlansBased()) return true;

		return ($this->membership_plan_id
			AND ! $this->isExpired()
		);
	}
	
	//checks whether user is approved
	public function isApproved()
	{
		return ($this->st_moderation == 'approved');
	}
	//checks if email is confirmed
	public function emailConfirmed()
	{
		return ($this->st_email_confirmed);
	}

	//checks whether user is expired
	public function isExpired()
	{
		if ($this->expires_on
			AND $this->expires_on < Carbon::now()) return true;
		return false;
	}

	//checks if user has company profile
	public function hasCompany()
	{
		return $this->compprofile()->exists();
	}

	//checks if membership plan is allowed based on user's user group
	public function allowedMembershipPlan($membershipPlanId)
	{
		return MembershipPlan::where('id', $membershipPlanId)
			->where('user_group_id', $this->user_group_id)
			->exists();
	}

	//checks if listing listing plan is allowed based on user's membership plan
	public function allowedListingPlan($listingPlanId)
	{
		return ListingPlan::where('id', $listingPlanId)
			->where('user_group_id', $this->user_group_id)
			->exists();
	}

	//checks if listing High/Feat plan is allowed
	public function allowedHighFeatPlan($planId)
	{
		return HighfeatPlan::where('id', $planId)
			->where('user_group_id', $this->user_group_id)
			->exists();
	}

	//checks if user is listing's owner
	public function isListingOwner($listingId)
	{
		return $this->listings()->where('id', $listingId)->exists();
	}

	//checks if user is photo's owner
	public function isPhotoOwner($photoId)
	{
		$is = DB::table('photos AS p')
			->join('listings AS l', 'p.listing_id', '=', 'l.id')
			->where('p.id', $photoId)
			->where('l.user_id', $this->id)
			->exists();

		return $is;
	}

	//maximum listings count (excluding archived) based on user's membership plan
	public function maxListingsNo()
	{
		if (appCon()->membershipPlansBased()) {
			if ($this->hasActiveMembershipPlan()) {
				return ($maxL = $this->membershipPlan->max_listings) ? $maxL : "UNLIMITED";
			}
			return '0';
		}
		return "UNLIMITED";
	}

	//checks if user is admin
	public function isAdmin()
	{
		return ($this->user_type == 'admin');
	}

	//checks if user is super user
	public function isSuper()
	{
		return ($this->user_type == 'super');
	}

	//checks if user is simple user
	public function isSimple()
	{
		return ($this->user_type == 'user');
	}

	//checks if user can increase listings number
	public function allowedListingsNo()
	{
		//if listing plans based there is no limit
		if (appCon()->listingPlansBased()) return true;

		return ($this->hasActiveMembershipPlan() AND
			!$this->membershipPlan->max_listings OR
			$this->membershipPlan->max_listings > $this->listings()->listingsFilter(['listingStatus' => 'active'])->count());
	}

	//if seller has company and whether it's displayed
	public function displayCompany()
	{
		if (
			$this->userGroup->displayCompany() and
			$this->hasCompany()
		)
			return true;
		return false;
	}

	//checks if user expires within x days
	public function expiresWithin($days)
	{
		//not used with listing plans based website
		if (appCon()->listingPlansBased()) return false;
		if (! $this->expires_on) return false;
		return $this->expires_on->diffInDays(Carbon::now()) <= $days;
	}

	##ADMIN PANEL PERMISSIONS
	//checks if user has permission to access certain route (script area)
	public function hasPermission($routeName)
	{
		if ($this->isSuper())
		{
			return true;
		}
		else
		{
			return $this->permissions()->where('permissions.route_names', 'like', '%' . $routeName . '%')->exists();
		}
	}

	//checks if user has permissions in given permission group
	public function hasPermissionsInGroup($identifier)
	{
		if ($this->isSuper())
		{
			return true;
		}
		else
		{
			$allowed = DB::table('permission_groups')
				->join('permissions', 'permission_groups.id', '=', 'permissions.permission_group_id')
				->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
				->where('permission_groups.identifier', $identifier)
				->where('permission_user.user_id', $this->id)
				->exists();

			return $allowed;
		}
	}
}