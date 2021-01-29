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

use App\AppCore\Admin\DataFields\Models\Repositories\ModelRepository;
use App\AppCore\Admin\DataFields\Models\Requests\CreateModelRequest;
use App\AppCore\Admin\DataFields\Models\Requests\UpdateModelRequest;
use App\Http\Controllers\Controller;
use Input;

class ModelsController extends Controller {


	public $repository;
	public
		$routeName = 'admin.data_models',
		$viewsFolder = 'admin.data-fields.models';


	public function __construct(ModelRepository $repository)
	{
		$this->repository = $repository;
	}


	public function index($makeId)
	{
		$models = $this->repository->models($makeId);
		$parent = $this->repository->parent($makeId);

		return view($this->viewsFolder.'.index', [
			'models' => $models,
			'parent' => $parent,
		]);
	}


	public function create($makeId)
	{
		$parent = $this->repository->parent($makeId);

		return view($this->viewsFolder.'.create', [
			'parent' => $parent
		]);
	}


	public function store($makeId, CreateModelRequest $request)
	{
		$this->repository->addModel($request->only(['name', 'order']), $makeId);

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route($this->routeName.'.index', $makeId);
	}


	public function edit($makeId, $id)
	{
		$model = $this->repository->model->find($id);
		$parent = $this->repository->parent($makeId);

		return view($this->viewsFolder.'.edit', [
			'model' => $model,
			'parent' => $parent,
		]);
	}


	public function update($makeId, $id, UpdateModelRequest $request)
	{
		$this->repository->model->where('id', $id)
			->update($request->only(['name', 'order']));

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route($this->routeName.'.index', $makeId);
	}


	public function destroy($makeId, $id)
	{
		$model = $this->repository->getById($id);
		if ($model->hasListings())
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


	public function activate($makeId, $id)
	{
		$this->repository->model->where('id', $id)->update(['active' => true]);

		flash()->success(trans('back.flash_successfully_activated'));
		return back();
	}


	public function deactivate($makeId, $id)
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