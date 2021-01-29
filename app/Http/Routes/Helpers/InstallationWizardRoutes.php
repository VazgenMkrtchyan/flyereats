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

//step 1
Route::get('install', [
	'as' => 'install.step1',
	'uses' => 'Helpers\InstallationWizardController@step1',
	'middleware' => 'notInstalled'
]);

Route::post('install', [
	'as' => 'install.step1_submit',
	'uses' => 'Helpers\InstallationWizardController@step1_submit',
	'middleware' => 'notInstalled'
]);

//step 2
Route::get('install/2', [
	'as' => 'install.step2',
	'uses' => 'Helpers\InstallationWizardController@step2',
	'middleware' => 'notInstalled'
]);

Route::post('install/2', [
	'as' => 'install.step2_submit',
	'uses' => 'Helpers\InstallationWizardController@step2_submit',
	'middleware' => 'notInstalled'
]);

//installed
Route::get('install/installed', [
	'as' => 'install.installed',
	'uses' => 'Helpers\InstallationWizardController@installed'
]);