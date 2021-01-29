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

use App\AppCore\Miscellaneous\Repositories\DetailRepository;

trait GetDetailsTrait {

	public function getDetailsArray(array $details)
	{
		//initiates detail repository
		$detailRepo = new DetailRepository();

		//CREATING DETAILS ARRAY
		$detailsArray = array();
		//Conditions
		if (in_array('Conditions', $details))
			$detailsArray = array_add($detailsArray, 'Conditions', $detailRepo->getConditions());
		//BodyStyles
		if (in_array('BodyStyles', $details))
			$detailsArray = array_add($detailsArray, 'BodyStyles', $detailRepo->getBodyStyles());
		//ExtColors
		if (in_array('ExtColors', $details))
			$detailsArray = array_add($detailsArray, 'ExtColors', $detailRepo->getExtColors());
		//IntColors
		if (in_array('IntColors', $details))
			$detailsArray = array_add($detailsArray, 'IntColors', $detailRepo->getIntColors());
		//Transmissions
		if (in_array('Transmissions', $details))
			$detailsArray = array_add($detailsArray, 'Transmissions', $detailRepo->getTransmissions());
		//DriveTypes
		if (in_array('DriveTypes', $details))
			$detailsArray = array_add($detailsArray, 'DriveTypes', $detailRepo->getDriveTypes());
		//FuelTypes
		if (in_array('FuelTypes', $details))
			$detailsArray = array_add($detailsArray, 'FuelTypes', $detailRepo->getFuelTypes());
		//Features
		if (in_array('Features', $details))
			$detailsArray = array_add($detailsArray, 'Features', $detailRepo->getFeatures());
		//Features
		if (in_array('States', $details))
			$detailsArray = array_add($detailsArray, 'States', $detailRepo->getStates());
		###################################

		//makes (differs. has ability to provide additional data)
		if (array_key_exists('Makes', $details))
			$detailsArray = array_add($detailsArray, 'Makes', $detailRepo->getMakes($details['Makes']));
		//listing plans (has ability to return with count)
		if (array_key_exists('ListingPlans', $details))
			$detailsArray = array_add($detailsArray, 'ListingPlans', $detailRepo->getListingPlans($details['ListingPlans']));
		//UserGroups (has ability to return with count)
		if (array_key_exists('UserGroups', $details))
			$detailsArray = array_add($detailsArray, 'UserGroups', $detailRepo->getUserGroups($details['UserGroups']));
		//MembershipPlans (has ability to return with count)
		if (array_key_exists('MembershipPlans', $details))
			$detailsArray = array_add($detailsArray, 'MembershipPlans', $detailRepo->getMembershipPlans($details['MembershipPlans']));

		return $detailsArray;
	}

} 