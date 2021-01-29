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

class Compprofile extends Eloquent {

	use PresentableTrait;
	protected $presenter = 'App\AppCore\Miscellaneous\Presenters\CompProfilePresenter';

	// Don't forget to fill this array
	protected $fillable = ['user_id', 'name', 'description', 'email', 'phone', 'fax', 'web_url', 'logo', 'state_id', 'city', 'addr_1', 'zip', 'lat', 'lng'];
	//PROTECT 'user_id' from mass assignment in Front

	//RELATIONSHIPS
	//#user
	public function user()
	{
		return $this->belongsTo('User');
	}
	//#state
	public function state()
	{
		return $this->belongsTo('State');
	}

	public function logoUrl()
	{
		return asset('uploads/logos/compprofiles/' . substr($this->logo, 0, 2) . '/' . substr($this->logo, 2, 2) . '/' . $this->logo);
	}
}