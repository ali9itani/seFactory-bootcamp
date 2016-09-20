<?php
//all required classes + an instance of each one is defined in that file
include_once('routes_included_classes.php');

$main_dir = '/myapi/v1/';

$requested_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($requested_uri) {
	case $main_dir.'actor':
		if($method == 'POST' && isset($_POST))
			$actor->create();
		if($method == 'GET')
			$actor->create();
		break;
	
	default:
		echo 'not found';
		break;
}

?>