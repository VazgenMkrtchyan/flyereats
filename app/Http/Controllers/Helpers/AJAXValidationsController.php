<?php namespace app\Http\Controllers\Helpers;
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

use App\AppCore\Miscellaneous\AJAX\Repositories\AJAXValidationsRepository;
use App\Http\Controllers\Controller;
use Input;

class AJAXValidationsController extends Controller {

	public $repository;
	public function __construct(AJAXValidationsRepository $repository)
	{
		$this->repository = $repository;
	}


	public function uniqueEmail()
	{
		$email = Input::get('email');
		$exceptId = Input::get('exceptId');

		$unique = $this->repository->uniqueEmail($email, $exceptId);

		return response()->json($unique);
	}


	public function uniqueUsername()
	{
		$username = Input::get('username');
		$exceptId = Input::get('exceptId');

		$unique = $this->repository->uniqueUsername($username, $exceptId);

		return response()->json($unique);
	}


	public function uniqueDetailName()
	{
		$unique = $this->repository->uniqueDetailName(Input::get('table'), Input::get('name'), Input::get('exceptId'), Input::get('foreignKey'), Input::get('parentId'));

		return response()->json($unique);
	}


	public function validZIP()
	{
		$ZIP = str_replace(' ', '', Input::get('zip'));
		$valid = $this->repository->validZIP($ZIP);

		return response()->json($valid);
	}
}