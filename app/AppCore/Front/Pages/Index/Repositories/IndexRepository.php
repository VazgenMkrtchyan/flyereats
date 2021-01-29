<?php namespace App\AppCore\Front\Pages\Index\Repositories;
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

use Listing;

class IndexRepository {


	public function enhanced($maxListingsNo)
	{
		$listings = Listing::listingsFilter(['listingStatus' => 'active', 'listingType' => 'enhanced'])
			->inRandomOrder()
			->take($maxListingsNo)
			->get();

		return $listings;
	}


	public function recent($maxListingsNo)
	{
		$listings = Listing::listingsFilter(['listingStatus' => 'active'])
			->orderBy('created_at', 'desc')
			->take($maxListingsNo)
			->get();

		return $listings;
	}
	public function totalListings()
	{
		return Listing::listingsFilter(['listingStatus' => 'active'])->count();
	}
}