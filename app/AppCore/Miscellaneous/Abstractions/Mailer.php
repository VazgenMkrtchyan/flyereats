<?php namespace App\AppCore\Miscellaneous\Abstractions;
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

use Mail;

abstract class Mailer {

	public function sendTo($to, $subject, $view, $data = [], $replyTo = null)
	{
		Mail::send($view, $data, function($message) use ($to, $subject, $replyTo)
		{
			if (isset($replyTo))
			{
				$message
					->to($to)
					->replyTo($replyTo['data']['email'], $replyTo['data']['name'])
					->subject($subject);
			}
			else
			{
				$message
					->to($to)
					->subject($subject);
			}
		});
	}

}

 