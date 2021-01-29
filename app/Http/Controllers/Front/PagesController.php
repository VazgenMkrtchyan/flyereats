<?php namespace App\Http\Controllers\Front;
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

use App\AppCore\Front\Mailers\Jobs\SelCar;
use App\AppCore\Front\Pages\ContactUs\Requests\SelCarRequest;
use App\AppCore\Front\Pages\Index\Repositories\IndexRepository;
use App\AppCore\Front\Pages\Pricing\Repositories\PricingRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use App\Http\Controllers\Controller;
use App\AppCore\Front\Mailers\Jobs\ContactUs;
use App\AppCore\Front\Pages\ContactUs\Requests\ContactUsRequest;
use Input;

class PagesController extends Controller {

	use GetDetailsTrait;

	//index page
	public function index(IndexRepository $indexRepository)
	{
		$details = $this->getDetailsArray(['Makes' => 'activeL', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes']);

		return view('front.index.index', [
			'enhanced' => $indexRepository->enhanced(8),
			'recent' => $indexRepository->recent(4),
			'totalListings' => $indexRepository->totalListings(),
			'details' => $details
		]);
	}

	//advanced search page
	public function advancedSearch()
	{
		$details = $this->getDetailsArray(['Makes' => 'activeL', 'Conditions', 'BodyStyles', 'ExtColors', 'IntColors', 'Transmissions', 'DriveTypes', 'FuelTypes', 'UserGroups' => 'listings']);

		return view('front.advanced-search.index', [
			'details' => $details
		]);
	}

	//contact us page
	public function contactUsIndex()
	{
		return view('front.contact-us.index');
	}

	//contact us send action
	public function contactUsSend(ContactUsRequest $request)
	{
		$data = $request->all();

		//send email command
		$this->dispatchNow(new ContactUs($data));

		flash()->success('Your Message Was Successfully Sent!');

		return view('front.contact-us.index');
	}

	public function selYourCar(SelCarRequest $request)
	{
		$data = $request->all();

		//send email command
		$this->dispatchNow(new SelCar($data));

		flash()->success('Your Message Was Successfully Sent!');

        return redirect()->route('sell-your-car.info');
	}

	//pricing page
	public function pricingIndex(PricingRepository $pricingRepository)
	{

		$userGroups = $pricingRepository->userGroups();

		return view('front.pricing-info.index', [
			'userGroups' => $userGroups
		]);
	}

	//faq page
	public function faq()
	{
		return view('front.faq.index');
	}

	//about us page
	public function aboutUs()
	{
		return view('front.about-us.index');
	}
	//sell your car
	public function sellyourcar()
	{
		return view('front.sell-your-car.index');
	}

}