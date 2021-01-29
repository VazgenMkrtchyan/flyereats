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

use App\AppCore\Front\BrowseUsers\Jobs\GenerateSearchUrl;
use App\AppCore\Front\BrowseUsers\Requests\ContactUserRequest;
use App\AppCore\Front\Mailers\Jobs\ContactUser;
use App\Http\Controllers\Controller;

use App\AppCore\Front\BrowseUsers\Repositories\BrowseUserRepository;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use Input, Session;

class BrowseUsersController extends Controller {

	use GetDetailsTrait;

	protected $browseUserRepo;

	function __construct(BrowseUserRepository $browseUserRepository)
	{
		$this->browseUserRepo = $browseUserRepository;
	}

	public function index()
	{
		$searchData = Input::all();

		$users = $this->browseUserRepo->getUsers($searchData);

		//search url is written to session
		Session::put('users_search_url', $searchData);

		return view('front.browse-users.index', [
			'users'	=> $users
		]);
	}


	public function view($userId)
	{
		$seller = $this->browseUserRepo->getById($userId);

		return view('front.browse-users.view', [
			'seller' => $seller
		]);
	}

	//sends email
	public function contactUserSend($userId, ContactUserRequest $request)
	{
		$data = $request->all();

		//sends email command
		$this->dispatchNow(new ContactUser($userId, $data));

		return response(200);
	}


	public function doUsersSearch()
	{
		if (Session::has('users_search_url'))
		{
			$searchSession = Session::get('users_search_url');
		}
		else
		{
			$searchSession = [];
		}

		//gets correct input data + uses current search options
		$inputData = array_filter(array_merge($searchSession, Input::all()));

		//generates search url
		$searchUrl = $this->dispatchNow(new GenerateSearchUrl($inputData));

		return redirect()->route('browseusers.index', $searchUrl);
	}

}