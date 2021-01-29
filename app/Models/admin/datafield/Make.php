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

class Make extends Eloquent {

	public $timestamps = false;
	public $table = 'makes';

	protected $fillable = ['name', 'order'];

	# SCOPES #
	public function scopeOrdered($query)
	{
		$query
			->orderBy('makes.order')
			->orderBy('makes.name');
	}

	//relationship
	public function models() {
		return $this->hasMany('Model');
	}
	public function listings() {
		return $this->hasMany('Listing');
	}

}