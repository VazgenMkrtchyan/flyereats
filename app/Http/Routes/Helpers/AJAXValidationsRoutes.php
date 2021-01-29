<?php
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

//unique email check
Route::post('AJAXValidation/email', [
	'as' => 'validation.uniqueEmail',
	'uses' => 'Helpers\AJAXValidationsController@uniqueEmail'
]);


//unique username check
Route::post('AJAXValidation/username', [
	'as' => 'validation.uniqueUsername',
	'uses' => 'Helpers\AJAXValidationsController@uniqueUsername'
]);


//unique detail name when creating
Route::post('AJAXValidation/detailName', [
	'as' => 'validation.uniqueDetailName',
	'uses' => 'Helpers\AJAXValidationsController@uniqueDetailName'
]);

//checks whether valid ZIP
Route::post('AJAXValidation/ZIP', [
	'as' => 'validation.validZIP',
	'uses' => 'Helpers\AJAXValidationsController@validZIP'
]);