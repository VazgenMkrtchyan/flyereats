<?php namespace App\AppCore\Miscellaneous\Traits;
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

use DB;

trait ClosureTrait {

	//creates required relationship values in closure table
	public function buildClosure($closureTable, $itemId, $itemParentId)
	{
		DB::table($closureTable)->insert([
			'ancestor_id' => $itemId,
			'descendant_id' => $itemId,
			'depth' => 0
		]);

		if ($itemParentId)
		{
			DB::statement(DB::raw("
				INSERT INTO {$closureTable}(`ancestor_id`, `descendant_id`, `depth`)
				SELECT `a`.`ancestor_id`, `d`.`descendant_id`, `a`.`depth` + `d`.`depth` + 1
				FROM `locations_closure` AS `a`, `locations_closure` AS `d`
				WHERE `a`.`descendant_id` = {$itemParentId} AND `d`.`ancestor_id` = {$itemId}
		"));
		}
	}

	//gets lineage. can be used to generate browsing links (breadcrumbs) and for many other things
	public function lineage($table, $closureTable, $itemId)
	{
		$lineage = [];
		if ($itemId) {
			$lineage = DB::table($table)
				->join("$closureTable AS cl", "$table.id", '=', 'cl.ancestor_id')
				->where('cl.descendant_id', $itemId)
				->orderBy('cl.depth', 'DESC')
				->get(["$table.*"]);
		}
		return $lineage;
	}

	//deletes selected item and all the branches (descendants)
	public function deleteItem($table, $closureTable, $itemId)
	{
		DB::table($table)
			->join("$closureTable AS cl", "$table.id", '=', 'cl.descendant_id')
			->where('cl.ancestor_id', $itemId)
			->delete();
	}
}