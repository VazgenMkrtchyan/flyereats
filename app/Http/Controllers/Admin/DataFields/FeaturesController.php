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

use App\AppCore\Admin\DataFields\Features\Repositories\FeaturesRepository;
use App\AppCore\Admin\DataFields\Features\Requests\CreateFeatureRequest;
use App\AppCore\Admin\DataFields\Features\Requests\UpdateFeatureRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturesController extends Controller {

	public $repository, $request;
	public
		$routeName = 'admin.data_features',
		$viewsFolder = 'admin.data-fields.features';


	public function __construct(FeaturesRepository $repository, Request $request)
	{
		$this->repository = $repository;
		$this->request = $request;
	}


	public function index()
	{
		$features = $this->repository->features();

		return view($this->viewsFolder.'.index', [
			'features' => $features,
		]);
	}


	public function create()
	{
		return view($this->viewsFolder.'.create');
	}


	public function store(CreateFeatureRequest $request)
	{
		$this->repository->addFeature($request->only(['name', 'order']));

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route($this->routeName.'.index');
	}


	public function edit($id)
	{
		$feature = $this->repository->model->find($id);

		return view($this->viewsFolder.'.edit', [
			'feature' => $feature,
		]);
	}


	public function update($id, UpdateFeatureRequest $request)
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
		$data = $this->request->all();
		$this->repository->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}

}