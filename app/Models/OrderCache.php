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

class OrderCache extends Eloquent {

	protected $table = 'orders_cache';

	protected $guarded = [];

	##RELATIONSHIPS##
	public function user()
	{
		return $this->belongsTo('User');
	}
	public function orderFor()
	{
		switch ($this->for)
		{
			case 'membershipPlan':
				$model = 'MembershipPlan';
				break;

			case 'listingPlan':
				$model = 'ListingPlan';
				break;

			case 'listingHigh':
			case 'listingFeat':
				$model = 'HighfeatPlan';
				break;
		}

		return $this->belongsTo($model, 'for_id');
	}

}
