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

class HighfeatPlan extends Eloquent {

	protected $fillable = ['user_group_id', 'for', 'duration', 'price', 'order', 'active'];

	//ATTRIBUTES
	//price (if returns 0 instead of 0.00)
	public function getPriceAttribute($value)
	{
		if ($value == 0) return 0;
		return $value;
	}

	//SCOPES
	public function scopeHighlighting($query)
	{
		return $query->where('for', 'highlighting');
	}

	public function scopeFeaturing($query)
	{
		return $query->where('for', 'featuring');
	}

	public function scopeOrdered($query)
	{
		return $query->orderBy('order')->orderBy('duration');
	}

}