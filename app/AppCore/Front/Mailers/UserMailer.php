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

class UserMailer extends Mailer {


	public function welcome($userEntity)
	{
		$to = $userEntity->email;
		$view = 'email-templates.welcome';
		$subject = 'Welcome to ' . appCon()->web_name;
		$data = [
			'user' => $userEntity,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}


	public function confirmAccount($userEntity, $token)
	{
		$to = $userEntity->email;
		$view = 'email-templates.confirmaccount';
		$subject = 'Confirm Your Email Address';
		$data = [
			'user' => $userEntity,
			'token' => $token,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}


	public function changeEmail($userEntity, $newEmail, $token)
	{
		$to = $newEmail;
		$view = 'email-templates.changeemail';
		$subject = 'Change E-mail Request';
		$data = [
			'user' => $userEntity,
			'token' => $token,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}


	public function paymentReceivedNotification($paymentEntity)
	{
		$userEntity = $paymentEntity->user;

		$to = $userEntity->email;
		$view = 'email-templates.paymentreceived';
		$subject = 'Your Payment Received';
		$data = [
			'user' => $userEntity,
			'payment' => $paymentEntity,
			'subject' => $subject
		];

		//sending
		$this->sendTo($to, $subject, $view, $data);
	}


	public function listingEnquiry($listingEntity, $data)
	{
		$to = $listingEntity->user->email;
		$view = 'email-templates.listingenquiry';
		$subject = 'Listing Enquiry';
		$data = [
			'listing' => $listingEntity,
			'data' => $data,
			'subject' => $subject
		];

		//sending to seller
		$this->sendTo($to, $subject, $view, $data, $replyTo = $data);
	}


	public function contactUser($userEntity, $data)
	{

		$to = $userEntity->email;
		$view = 'email-templates.contactuser';
		$subject = 'Contact User...';
		$data = [
			'user' => $userEntity,
			'data' => $data,
			'subject' => $subject
		];

		//sending to seller
		$this->sendTo($to, $subject, $view, $data, $replyTo = $data);
	}


	public function contactUs($data)
	{
		$to = appCon()->cont_email;
		$view = 'email-templates.contactus';
		$subject = 'Contact Us';
		$data = [
			'data' => $data,
			'subject' => $subject
		];

		$this->sendTo($to, $subject, $view, $data, $replyTo = $data);
	}

	public function selCar($data)
	{
		$to = appCon()->cont_email;
		$view = 'email-templates.sel-car';
		$subject = 'Sell car';
		$data = [
			'data' => $data,
			'subject' => $subject
		];

		$this->sendTo($to, $subject, $view, $data, $replyTo = $data);
	}

} 