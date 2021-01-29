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

class Webconfig extends Eloquent {

	protected  $guarded = ['id'];


	public function requireEmailConfirmation()
	{
		if ($this->require_email_conf)
		{
			return true;
		}
		return false;
	}

	public function autoAccConfirm()
	{
		if ($this->auto_acc_confirm)
		{
			return true;
		}
		return false;
	}

	public function bypassPayment()
	{
		if ($this->pp_bypass)
		{
			return true;
		}
		return false;
	}
	
	public function listingPlansBased()
	{
		if ($this->web_type == "listing_plans")
		{
			return true;
		}
		return false;
	}
	
	public function membershipPlansBased()
	{
		if ($this->web_type == "membership_plans")
		{
			return true;
		}
		return false;
	}

}