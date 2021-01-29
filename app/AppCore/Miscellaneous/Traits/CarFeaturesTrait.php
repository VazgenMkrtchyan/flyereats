<?php namespace App\AppCore\Miscellaneous\Traits;
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

trait CarFeaturesTrait {

	//assigns selected car features to the listing
	protected function assignCarFeatures($listingEntity, $inputData) {

		$sync = [];
		//attaches car features
		foreach ($inputData as $key => $value)
		{
			if (substr($key, 0, 8) == 'feature_')
			{
				array_push($sync, $value);
			}
		}

		$listingEntity->features()->sync($sync);
	}

} 