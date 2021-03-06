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

class Permission extends Eloquent {

	public $timestamps = false;

	protected $guarded = [];


	##RELATIONSHIPS
	//#permission group
	public function permissionGroup()
	{
		return $this->belongsTo('PermissionGroup');
	}
	//#users
	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function isProtected()
	{
		if ($this->system_protected)
		{
			return true;
		}
		return false;
	}

}
