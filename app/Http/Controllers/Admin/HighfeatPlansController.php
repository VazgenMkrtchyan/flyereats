<?php namespace App\Http\Controllers\Admin;
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

use App\AppCore\Admin\HighfeatPlans\Requests\CreateHighfeatPlanRequest;
use App\AppCore\Admin\HighfeatPlans\Requests\UpdateHighfeatPlanRequest;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\HighfeatPlans\Repositories\HighfeatPlanRepository;
use Input;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;

class HighfeatPlansController extends Controller {

	use GetDetailsTrait;

	protected $highfeatPlanRepo;

	function __construct(HighfeatPlanRepository $highfeatPlanRepository)
	{
		$this->highfeatPlanRepo = $highfeatPlanRepository;
	}


	public function index()
	{
		$userGroups = $this->highfeatPlanRepo->getUserGroups();

		return view('admin.highfeat-plans.index', [
			'userGroups' => $userGroups
		]);
	}


	//RETURNS PAGE FOR ADDING A NEW PLAN
	public function create()
	{
		$details = $this->getDetailsArray(['UserGroups' => '']);

		return view('admin.highfeat-plans.create', [
			'details' => $details
		]);
	}

	//STORES NEW PLAN IN DATABASE
	public function store(CreateHighfeatPlanRequest $request)
	{
		$data = $request->all();

		//creates plan
		$this->highfeatPlanRepo->create($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.highfeat-plans.index');
	}


	//EDIT PLAN PAGE
	public function edit($highfeatPlanId)
	{
		$details = $this->getDetailsArray(['UserGroups' => '']);
		$highfeatPlan = $this->highfeatPlanRepo->getById($highfeatPlanId);

		return view('admin.highfeat-plans.edit', [
			'highfeatPlan' => $highfeatPlan,
			'details' => $details
		]);
	}


	//UPDATES PLAN INFO
	public function update($highfeatPlanId, UpdateHighfeatPlanRequest $request)
	{
		$data = $request->all();

		//updates plan
		$this->highfeatPlanRepo->update($highfeatPlanId, $data, ['auto_conf']);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.highfeat-plans.index');
	}


	//DELETES PLAN FROM DATABASE
	public function destroy($highfeatPlanId)
	{
		$highfeatPlan = $this->highfeatPlanRepo->getById($highfeatPlanId);

		$highfeatPlan->delete();

		flash()->success(trans('back.flash_successfully_deleted'));
		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();

		$this->highfeatPlanRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}