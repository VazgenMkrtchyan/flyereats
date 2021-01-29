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

class UserPresenter extends Presenter {

	public function fullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function listingsNo()
	{
		return $this->listings->count();
	}

	public function expirationDate()
	{
		return $this->expires_on ? format_date($this->expires_on) : trans('front.NEVER');
	}

} 