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

Route::group(['middleware' => ['admin.auth', 'admin.allowed']], function() {

	##DATA ROUTES##
	$dataRoutes = [
		'identic' => [
			'get' => 'admin/dataFields/identic/{dataField}',
			'as' => 'admin.data_solo',
			'uses' => 'Admin\DataFields\IdenticFieldsController',
		],
		'features' => [
			'get' => 'admin/dataFields/features',
			'as' => 'admin.data_features',
			'uses' => 'Admin\DataFields\FeaturesController',
		],
		'makes' => [
			'get' => 'admin/dataFields/makes',
			'as' => 'admin.data_makes',
			'uses' => 'Admin\DataFields\MakesController',
		],
		'models' => [
			'get' => 'admin/dataFields/models/{makeId}',
			'as' => 'admin.data_models',
			'uses' => 'Admin\DataFields\ModelsController',
		],
	];

	foreach ($dataRoutes as $dataRoute) {
		##SOLO Routes##
		//index
		Route::get($dataRoute['get'].'/index', [
			'as' => $dataRoute['as'].'.index',
			'uses' => $dataRoute['uses'].'@index'
		]);
		//create
		Route::get($dataRoute['get'].'/create', [
			'as' => $dataRoute['as'].'.create',
			'uses' => $dataRoute['uses'].'@create'
		]);
		//store
		Route::post($dataRoute['get'].'/store', [
			'as' => $dataRoute['as'].'.store',
			'uses' => $dataRoute['uses'].'@store',
			'middleware' => 'notDemo'
		]);
		//edit
		Route::get($dataRoute['get'].'/edit/{id}', [
			'as' => $dataRoute['as'].'.edit',
			'uses' => $dataRoute['uses'].'@edit'
		]);
		//update
		Route::match(['POST', 'PATCH', 'PUT'], $dataRoute['get'].'/update/{id}', [
			'as' => $dataRoute['as'].'.update',
			'uses' => $dataRoute['uses'].'@update',
			'middleware' => 'notDemo'
		]);
		//delete
		Route::delete($dataRoute['get'].'/destroy/{id}', [
			'as' => $dataRoute['as'].'.destroy',
			'uses' => $dataRoute['uses'].'@destroy',
			'middleware' => 'notDemo'
		]);
		//activate
		Route::get($dataRoute['get'].'/activate/{id}', [
			'as' => $dataRoute['as'].'.activate',
			'uses' => $dataRoute['uses'].'@activate',
			'middleware' => 'notDemo'
		]);
		//deactivate
		Route::get($dataRoute['get'].'/deactivate/{id}', [
			'as' => $dataRoute['as'].'.deactivate',
			'uses' => $dataRoute['uses'].'@deactivate',
			'middleware' => 'notDemo'
		]);
		//update order
		Route::patch($dataRoute['get'].'/updateOrder', [
			'as' => $dataRoute['as'].'.update_order',
			'uses' => $dataRoute['uses'].'@updateOrder',
			'middleware' => 'notDemo'
		]);
	}

});