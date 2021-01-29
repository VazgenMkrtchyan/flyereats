<?php namespace App\AppCore\Miscellaneous\Abstractions;
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

use ForEloquentRepository; ##just a helper Model. Does nothing, has no reference to database at all. Shows all Eloquent methods...

abstract class EloquentRepository {

	protected $model;
	function __construct(ForEloquentRepository $forEloquentRepository)
	{
		$this->model = $forEloquentRepository;
	}

	public function make(array $with = [])
	{
		return $this->model->with($with);
	}

	//get record by id
	public function getById($id, array $with = [])
	{
		$query = $this->make($with);

		return $query->where('id', $id)->first();
	}

	//get all records
	public function getAll(array $with = [])
	{
		$query = $this->make($with);

		return $query->get();
	}

	//retrieve first record
	public function getFirst(array $with = [])
	{
		$query = $this->make($with);

		return $query->first();
	}

	public function create(array $data)
	{
		//null instead of empty values
		if (isset($this->model->nullable))
		{
			$data = $this->setNulls($data, $this->model->nullable);
		}

		return $this->model->create($data);
	}

	public function update($id, array $data, array $checkboxes = [])
	{
		//sets empty checkboxes (not set) to 0
		if (count($checkboxes))
		{
			$data = $this->unsetCheckboxes($data, $checkboxes);
		}

		//null instead of empty values
		if (isset($this->model->nullable))
		{
			$data = $this->setNulls($data, $this->model->nullable);
		}

		//updates and retrieves record
		$record = $this->model->find($id);
		$record->update($data); //updating record

		return $record;
	}

	public function destroy($id)
	{
		return $this->model->destroy($id);
	}

	#HELPERS
	//updates not checked (not set) checkboxes to 0
	protected function unsetCheckboxes(array $data, array $checkboxes)
	{
		$dataKeys = array_keys($data);
		foreach ($checkboxes as $checkboxKey) {
			if (! in_array($checkboxKey, $dataKeys))
			{
				$data[$checkboxKey] = 0;
			}
		}

		return $data;
	}

	//sets null value instead of empty in selected elements of array
	protected function setNulls(array $data, array $nullable)
	{
		$dataKeys = array_keys($data);
		foreach($nullable as $nullableKey)
		{
			if (in_array($nullableKey, $dataKeys))
			{
				if ($data[$nullableKey] == '')
				{
					$data[$nullableKey] = null;
				}
			}
		}

		return $data;
	}

} 