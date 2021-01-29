<?php namespace App\AppCore\Admin\Mailers;
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

class UserMailer extends Mailer {

	public function userApprovedNotification($userEntity)
	{
		$to = $userEntity->email;
		$view = 'email-templates.accountapproved';
		$subject = 'Your Account Has Been Approved';
		$data = [
			'user' => $userEntity,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}

	public function listingApprovedNotification($listingEntity)
	{
		$userEntity = $listingEntity->user;

		$to = $userEntity->email;
		$view = 'email-templates.listingapproved';
		$subject = 'Your Listing Has Been Approved';
		$data = [
			'user' => $userEntity,
			'listing' => $listingEntity,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}

	public function websiteTypeChangeNotification($userEntity)
	{
		$to = $userEntity->email;
		$view = 'email-templates.website-type-changed';
		$subject = 'Website Type has been changed! All you listings were archived!';
		$data = [
			'user' => $userEntity,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}

} 