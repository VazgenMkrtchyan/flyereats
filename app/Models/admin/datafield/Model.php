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

class Model extends Eloquent {

	public $timestamps = false;
	public $table = 'models';

	protected $fillable = ['name', 'order', 'make_id'];

	//relationships
	public function make() {
		return $this->belongsTo('Make');
	}
	public function listings() {
		return $this->hasMany('Listing');
	}

	# SCOPES #
	public function scopeOrdered($query)
	{
		$query
			->orderBy('models.order')
			->orderBy('models.name');
	}

	//checks whether model has listings
	public function hasListings() {
		return $this->listings()->count();
	}

}