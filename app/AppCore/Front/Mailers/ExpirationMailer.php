<?php namespace App\AppCore\Front\Mailers;
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

use App\AppCore\Miscellaneous\Abstractions\Mailer;

class ExpirationMailer extends Mailer {

	//LISTING PLAN
	public function listingExpired($listingEntity)
	{
		$subject = 'Your listing has expired';

		$this->sendListingExpireNotify($listingEntity, 'listingexpired', $subject);
	}

	public function listingExpiresIn2Days($listingEntity)
	{
		$subject = 'Your Listing Expires in 2 days';

		$this->sendListingExpireNotify($listingEntity, 'listingexpires2', $subject);
	}

	public function listingExpiresIn7Days($listingEntity)
	{
		$subject = 'Your Listing Expires in 7 days';

		$this->sendListingExpireNotify($listingEntity, 'listingexpires7', $subject);
	}

	//LISTING ENHANCEMENT
	public function listingEnhancementExpired($listingEntity)
	{
		$subject = 'Your listing enhancement has expired';

		$this->sendListingExpireNotify($listingEntity, 'listing-enhancement-expired', $subject);
	}

	#################
	//MEMBERSHIP PLAN
	public function membershipExpired($userEntity)
	{
		$subject = 'Your Membership Plan has expired';

		$this->sendMembershipExpireNotify($userEntity, 'membership-expired', $subject);
	}

	public function membershipExpiresIn2Days($userEntity)
	{
		$subject = 'Your Membership Plan Expires in 2 days';

		$this->sendMembershipExpireNotify($userEntity, 'membership-expires2', $subject);
	}

	public function membershipExpiresIn7Days($userEntity)
	{
		$subject = 'Your Membership Plan Expires in 7 days';

		$this->sendMembershipExpireNotify($userEntity, 'membership-expires7', $subject);
	}

	##########
	protected function sendListingExpireNotify($listingEntity, $emailTemplate, $emailSubject)
	{
		$user_object = $listingEntity->user;

		$to = $user_object->email;
		$view = 'email-templates.expiration.' . $emailTemplate;
		$data = [
			'listing' => $listingEntity,
			'user' => $user_object,
			'subject' => $emailSubject
		];
		$subject = $emailSubject;

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}

	protected function sendMembershipExpireNotify($userEntity, $emailTemplate, $emailSubject)
	{
		$to = $userEntity->email;
		$view = 'email-templates.expiration.' . $emailTemplate;
		$data = [
			'user' => $userEntity,
			'subject' => $emailSubject
		];
		$subject = $emailSubject;

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}


}

 