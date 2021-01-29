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

use Carbon\Carbon;

//getting web configuration
function appCon()
{
	if (env('APP_ENV') == 'local') return Webconfig::first();
	if (! Cache::has('appCon')) {
		return Cache::remember('appCon', 60, function () {
			return Webconfig::first();
		});
	}
	return Cache::get('appCon');
}

//formats price
function format_price($price)
{
	$webc = appCon();
	$price_format = $webc->price_format;
	$currency_symbol = $webc->curr_symb;
	$formatted_price = number_format($price);

	if ($price_format == 'before')
	{
		return $currency_symbol . $formatted_price;
	}
	else
	{
		return $formatted_price . $currency_symbol;
	}
}

//formats date
function format_date($timestamp)
{
	$webc = appCon();
	$date_format = $webc->date_format;

	return Carbon::createFromTimestamp(strtotime($timestamp))->format($date_format);
}

//format time
function format_time($timestamp)
{
	$webc = appCon();
	$time_format = $webc->time_format;

	return Carbon::createFromTimestamp(strtotime($timestamp))->format($time_format);
}

//address formatting
function format_address($object)
{
	$formatted_address = $object->addr_1 . ', ' . $object->city . ', ' . $object->state->name . ', ' . $object->zip;

	return $formatted_address;
}

//formats response
function responseData($status, $message)
{
	return ['status' => $status, 'message' => $message];
}

//decides to use $_GET data from URL or $webc data (if there is no $_GET)
function getOrWebc($webcKey, $getKey)
{
	$get = Input::get($getKey);
	if (empty($get)) return appCon()->$webcKey;
	else return $get;
}

//decides to use session data or default settings
function sessionOrWebc($webcKey, $sessionKey = null)
{
	$session = Session::get('pref.'.str_replace('.', '+', $sessionKey));
	if (empty($session)) return appCon()->$webcKey;
	else return $session;
}

//decides to use session or default value provided
function sessionOrDefault($sessionKey, $default = null)
{
	$session = Session::get('pref.' . $sessionKey);
	if (empty($session)) return $default;
	else return $session;
}

//gets Latitude and Longitude coordinates of the address
function getLatLngAPI($fullAddress)
{
	//gets contents from google geocoding api
	$data_location = "http://maps.google.com/maps/api/geocode/json?address=".urlencode(utf8_encode($fullAddress));
	$data = file_get_contents($data_location);

	//decodes JSON string
	$data = json_decode($data);

	//checks response status
	if ($data->status=="OK")
	{
		$lat = $data->results[0]->geometry->location->lat;
		$lng = $data->results[0]->geometry->location->lng;

		return ['lat' => $lat, 'lng' => $lng];
	}
	else //if ($data->status == "OVER_QUERY_LIMIT")
	{
		return ['lat' => 0, 'lng' => 0];
	}
}

//gets  Latitude and Longitude
function setLatLng($data)
{
	$state = DB::table('det_states')->where('id', $data['state_id'])->first()->name;

	$fullAddress = $data['addr_1'] . ", " . $data['city'] . ", " . $state . ", " . $data['zip'];

	if ($fullAddress) $latLng = getLatLngAPI($fullAddress);
	else $latLng = ['lat' => 0, 'lng' => 0];

	$data['lat'] = $latLng['lat'];
	$data['lng'] = $latLng['lng'];

	return $data;
}

//checks whether location has changed
function locationHasChanged($data)
{
	if ($data['old_state_id'] != $data['state_id']
		OR $data['old_city'] != $data['city']
		OR $data['old_addr_1'] != $data['addr_1']
		OR $data['old_zip'] != $data['zip'])
	{
		return true;
	}
	else
	{
		return false;
	}
}

//function for formatting site title
function siteTitle($title) {
	return $title . ' | '. appCon()->web_name;
}


//checks whether current page is in array
function isPage(array $pages) {
	return in_array(Route::currentRouteName(), $pages);
}
//inverted function
function isNotPage(array $pages) {
	return ! in_array(Route::getCurrentRoute(), $pages);
}


//ROUTE HELPER
function generateResourceURLS(array $URLS = ['in', 'cr', 'st', 'sh', 'ed', 'up', 'de'], $controller, $address,  $as) {

	//index
	if (in_array('in', $URLS)) {
		Route::get("$address", [
			'as' => "$as.index",
			'uses' => "$controller@index",
		]);
	}

	//create
	if (in_array('cr', $URLS)) {
		Route::get("$address/create", [
			'as' => "$as.create",
			'uses' => "$controller@create",
		]);
	}

	//store
	if (in_array('st', $URLS)) {
		Route::post("$address", [
			'as' => "$as.store",
			'uses' => "$controller@store",
			'middleware' => 'notDemo'
		]);
	}

	//show
	if (in_array('sh', $URLS)) {
		Route::get("$address/{id}", [
			'as' => "$as.show",
			'uses' => "$controller@show",
		]);
	}

	//edit
	if (in_array('ed', $URLS)) {
		Route::get("$address/{id}/edit", [
			'as' => "$as.edit",
			'uses' => "$controller@edit",
		]);
	}

	//update
	if (in_array('up', $URLS)) {
		Route::match(['POST', 'PUT', 'PATCH'], "$address/{id}", [
			'as' => "$as.update",
			'uses' => "$controller@update",
			'middleware' => 'notDemo'
		]);
	}

	//delete
	if (in_array('de', $URLS)) {
		Route::delete("$address/{id}", [
			'as' => "$as.destroy",
			'uses' => "$controller@destroy",
			'middleware' => 'notDemo'
		]);
	}
}

//mileage units
function mileageUnits() {
	if (appCon()->mileage_units == 'mi')
	{
		return trans('front.miles');
	}
	return trans('front.kilometers');
}

//mileage range
function rangeMileage() {
	foreach(range(10000, 100000, 10000) as $miles) {
		$range[$miles] = number_format($miles, 0, '', ',');
	}
	return $range;
}

//price range
function rangePrice() {
	$prices = array_merge(range(1000, 25000, 1000), range(30000, 100000, 5000));
	foreach($prices as $price) {
		$range[$price] = format_price($price);
	}
	return $range;
}

//miles range
function rangeDistance() {
	$distances = array_merge(range(10, 50, 10), [75], range(100, 250, 50), [500]);
	$units = mileageUnits();
	foreach($distances as $distance) {
		$range[$distance] = number_format($distance, 0, null, ',') . " $units";
	}
	return $range;
}

//results per page
function rangePerPage() {
	foreach(range(5, 60, 5) as $results) {
		$range[$results] = $results . ' ' . trans('back.results');
	}
	return $range;
}

//checks whether website is in demo mode
function demo_mode_on() {
	if (File::exists(base_path('DEMO_MODE_ON')) OR env('DEMO_MODE', 'off') == 'on') return true;
	return false;
}

//get full sql query without question marks
function getSql($model){
	$replace = function ($sql, $bindings)
	{
		$needle = '?';
		foreach ($bindings as $replace){
			$pos = strpos($sql, $needle);
			if ($pos !== false) {
				$sql = substr_replace($sql, $replace, $pos, strlen($needle));
			}
		}
		return $sql;
	};
	$sql = $replace($model->toSql(), $model->getBindings());
	return $sql;
}