<?php namespace App\Http\Controllers\Admin\DataFields;
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

use App\AppCore\Admin\DataFields\Makes\Repositories\MakeRepository;
use App\AppCore\Admin\DataFields\Makes\Requests\CreateMakeRequest;
use App\AppCore\Admin\DataFields\Makes\Requests\UpdateMakeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;

class MakesController extends Controller {

	public $repository;
	public
		$routeName = 'admin.data_makes',
		$viewsFolder = 'admin.data-fields.makes';


	public function __construct(MakeRepository $repository, Request $request)
	{
		$this->repository = $repository;
	}


	public function index()
	{
		$makes = $this->repository->makes();

		return view($this->viewsFolder.'.index', [
			'makes' => $makes
		]);
	}


	public function create()
	{
		return view($this->viewsFolder.'.create');
	}


	public function store(CreateMakeRequest $request)
	{
		$this->repository->addMake($request->only(['name', 'order']));

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route($this->routeName.'.index');
	}


	public function edit($id)
	{
		$make = $this->repository->model->find($id);

		return view($this->viewsFolder.'.edit', [
			'make' => $make,
		]);
	}


	public function update($id, UpdateMakeRequest $request)
	{
		$this->repository->model->where('id', $id)->update($request->only('name', 'order'));

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route($this->routeName.'.index');
	}


	public function destroy($id)
	{
		if ($this->repository->inUse($id))
		{
			flash()->error(trans('back.flash_cannot_be_deleted_used_in_listings'));
		}
		else
		{
			$this->repository->model->where('id', $id)->delete();
			flash()->success(trans('back.flash_successfully_deleted'));
		}

		return back();
	}


	public function activate($id)
	{
		$this->repository->model->where('id', $id)->update(['active' => true]);

		flash()->success(trans('back.flash_successfully_activated'));
		return back();
	}


	public function deactivate($id)
	{
		if ($this->repository->inUse($id))
		{
			flash()->error(trans('back.flash_cannot_be_deactivated_used_in_listings'));
		}
		else
		{
			$this->repository->model->where('id', $id)->update(['active' => false]);
			flash()->success(trans('back.flash_successfully_deactivated'));
		}

		return back();
	}


	public function updateOrder()
	{
		$data = Input::all();
		$this->repository->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}