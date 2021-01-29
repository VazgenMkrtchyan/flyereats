<?php namespace App\Http\Controllers\Helpers;
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

use App\AppCore\Front\Payments\Jobs\ProcessPayment;
use App\Http\Controllers\Controller;
use Log;

use Mdb\PayPal\Ipn\Event\MessageVerifiedEvent;
use Mdb\PayPal\Ipn\Event\MessageInvalidEvent;
use Mdb\PayPal\Ipn\Event\MessageVerificationFailureEvent;
use Mdb\PayPal\Ipn\ListenerBuilder\Guzzle\InputStreamListenerBuilder as ListenerBuilder;

class IPNListener extends Controller {

	//receives PayPal Ipn messages and does verification
	public function listenToPayPal()
	{
		$listenerBuilder = new ListenerBuilder();
		//use sandbox mode if it's turned on
		if (appCon()->pp_sandbox) {
			$listenerBuilder->useSandbox(); // use PayPal sandbox
		}
		$listener = $listenerBuilder->build();


		// IPN message was verified, everything is ok! Do your processing logic here...
		$listener->onVerified(function (MessageVerifiedEvent $event) {
			$ipnMessage = $event->getMessage()->getAll();
			//Log::info($ipnMessage); //logs ipn message. for debugging purposes
			//TAKES PROCESSING OF EVERYTHING (writing payment info to database, updating listing and so on.)
			$this->dispatchNow(new ProcessPayment($ipnMessage));
		});

		// IPN message was was invalid, something is not right! Do your logging here...
		$listener->onInvalid(function (MessageInvalidEvent $event) {
			$ipnMessage = $event->getMessage();
		});

		// Something bad happend when trying to communicate with PayPal! Do your logging here...
		$listener->onVerificationFailure(function (MessageVerificationFailureEvent $event) {
			$error = $event->getError();
		});

		$listener->listen();

	}


}