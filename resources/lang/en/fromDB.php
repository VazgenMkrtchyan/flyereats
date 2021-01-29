<?php

//VALUES FROM DATABASE
return [

	"-select_state-" => "-SELECT " . strtoupper(appCon()->locality) ."-",
	"select_state" => "Please select " . strtolower(appCon()->locality) . ".",
	"zip" => appCon()->zip_format,
	"invalid_zip" => "Invalid " . appCon()->zip_format . ".",

];