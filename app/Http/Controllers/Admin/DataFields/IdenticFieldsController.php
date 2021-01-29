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

use App\AppCore\Admin\DataFields\Identic\Repositories\IdenticRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdenticFieldsController extends Controller {

	protected $request, $dataField, $initData, $identicRepo;
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->initData = $this->initialize($request->route()->getParameter('dataField'));
		$this->identicRepo = new IdenticRepository($this->initData['table']);
	}

	public function index($dataField)
	{
		$values = $this->identicRepo->values();

		return view('admin.data-fields.identic.index', [
			'values' => $values,
			'name' => $this->initData['name'],
			'dataField' => $dataField,
		]);
	}


	public function create($dataField)
	{
		return view('admin.data-fields.identic.create', [
			'name' => $this->initData['name'],
			'dataField' => $dataField,
			'table' => $this->initData['table']
		]);
	}


	public function store($dataField)
	{
		$this->validate($this->request, [
			'name' => 'required|unique:'.$this->initData['table'],
			'order' => 'numeric',
		]);

		$this->identicRepo->addField($this->request->only(['name', 'order']));

		flash()->success(trans('back.flash_successfully_added'));
		return redirect()->route('admin.data_solo.index', ['dataField' => $dataField]);
	}


	public function edit($dataField, $id)
	{
		$value = $this->identicRepo->model->find($id);

		return view('admin.data-fields.identic.edit', [
			'value' => $value,
			'name' => $this->initData['name'],
			'dataField' => $dataField,
			'table' => $this->initData['table']
		]);
	}


	public function update($dataField, $id)
	{
		$this->validate($this->request, [
			'name' => 'required|unique:'.$this->initData['table'].',name,'.$id,
			'order' => 'numeric',
		]);

		$this->identicRepo->model->where('id', $id)->update($this->request->only('name', 'order'));

		flash()->success(trans('back.flash_successfully_updated'));
		return redirect()->route('admin.data_solo.index', ['dataField' => $dataField]);
	}


	public function destroy($dataField, $id)
	{
		if ($this->identicRepo->inUse($id))
		{
			flash()->error(trans('back.flash_cannot_be_deleted_used_in_listings'));
		}
		else
		{
			$this->identicRepo->model->where('id', $id)->delete();
			flash()->success(trans('back.flash_successfully_deleted'));
		}

		return back();
	}


	public function activate($dataField, $id)
	{
		$this->identicRepo->model->where('id', $id)->update(['active' => true]);

		flash()->success(trans('back.flash_successfully_activated'));
		return back();
	}


	public function deactivate($dataField, $id)
	{
		if ($this->identicRepo->inUse($id))
		{
			flash()->error(trans('back.flash_cannot_be_deactivated_used_in_listings'));
		}
		else
		{
			$this->identicRepo->model->where('id', $id)->update(['active' => false]);
			flash()->success(trans('back.flash_successfully_deactivated'));
		}

		return back();
	}


	public function updateOrder()
	{
		$data = $this->request->all();
		$this->identicRepo->updateOrder($data);

		flash()->success(trans('back.flash_order_updated'));
		return back();
	}


	##HELPERS##
	//initializes correct data based on route {dataName} parameter
	protected function initialize($dataField)
	{
		switch ($dataField)
		{
			case 'bodyStyles':
				$init['table'] = 'det_bodystyles';
				$init['name'] = trans('back.body_styles');
        break;
			case 'conditions':
				$init['table'] = 'det_conditions';
				$init['name'] = trans('back.conditions');
        break;
			case 'driveTypes':
				$init['table'] = 'det_drivetypes';
				$init['name'] = trans('back.drive_types');
        break;
			case 'extColors':
				$init['table'] = 'det_extcolors';
				$init['name'] = trans('back.ext_colors');
        break;
			case 'intColors':
				$init['table'] = 'det_intcolors';
				$init['name'] = trans('back.int_colors');
        break;
			case 'fuelTypes':
				$init['table'] = 'det_fueltypes';
				$init['name'] = trans('back.fuel_types');
        break;
			case 'transmissions':
				$init['table'] = 'det_transmissions';
				$init['name'] = trans('back.transmissions');
        break;
			case 'states':
				$init['table'] = 'det_states';
				$init['name'] = trans('back.STATES');
				break;
			//if incorrect {dataName}, returns back
			default:
				return back();
		}

		return $init;
	}
}