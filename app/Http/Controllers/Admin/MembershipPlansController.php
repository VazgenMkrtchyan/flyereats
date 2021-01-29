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

use App\AppCore\Admin\MembershipPlans\Requests\CreateMembershipPlanRequest;
use App\AppCore\Admin\MembershipPlans\Requests\UpdateMembershipPlanRequest;
use App\AppCore\Miscellaneous\Traits\GetDetailsTrait;
use App\Http\Controllers\Controller;

use App\AppCore\Admin\MembershipPlans\Repositories\MembershipPlanRepository;
use Input;

class MembershipPlansController extends Controller {

	use GetDetailsTrait;

	protected $membershipPlanRepo;
	function __construct(MembershipPlanRepository $membershipPlanRepository)
	{
		$this->membershipPlanRepo = $membershipPlanRepository;
	}

	public function index()
	{
		$userGroups = $this->membershipPlanRepo->getUserGroups();

		return view('admin.membership-plans.index', [
			'userGroups' => $userGroups
		]);
	}


	public function create()
	{
		$details = $this->getDetailsArray(['UserGroups' => null]);

		return view('admin.membership-plans.create', [
			'details' => $details
		]);
	}


	public function store(CreateMembershipPlanRequest $request)
	{
		$data = $request->all();

		//creates record
		$this->membershipPlanRepo->create($data);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.membership-plans.index');
	}


	public function edit($membershipPlanId)
	{
		$details = $this->getDetailsArray(['UserGroups' => null]);
		$membershipPlan = $this->membershipPlanRepo->getById($membershipPlanId);

		return view('admin.membership-plans.edit', [
			'details' => $details,
			'membershipPlan' => $membershipPlan,
		]);
	}


	public function update($membershipPlanId, UpdateMembershipPlanRequest $request)
	{
		$data = $request->all();

		//updates record
		$this->membershipPlanRepo->update($membershipPlanId, $data, ['auto_conf', 'usable_once']);

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.membership-plans.index');
	}


	public function destroy($membershipPlanId)
	{
		$membershipPlan = $this->membershipPlanRepo->getById($membershipPlanId);

		if ($membershipPlan->isLast())
		{
			flash()->error(trans('back.flash_last_membership_plan'));
			return back();
		}
		
		if (appCon()->MembershipPlansBased()) {
			//protects from deleting membership plan with users assigned to it
			if (!$membershipPlan->inUse()) {
				$membershipPlan->delete();

				flash()->success(trans('back.flash_successfully_deleted'));
				return back();
			}
		}
		
		flash()->error(trans('back.flash_membership_plan_cannot_be_deleted_has_users'));
		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();

		$this->membershipPlanRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}