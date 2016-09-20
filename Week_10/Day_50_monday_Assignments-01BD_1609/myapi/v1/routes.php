<?php
/*a router to direct each request to destination function in a specific class
*
*errors code meaning 
*404:page not found
*403:post request has no data
*413:get request has no data
*/

//all required classes + an instance of each one is defined in that file
include_once('routes_included_classes.php');

$main_dir = '/myapi/v1/';

$requested_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//redirect acc. to request method type
switch($method) {
	case 'POST':
		postRoutes($main_dir, $requested_uri);
		break;
	case 'GET':
		getRoutes($main_dir, $requested_uri);
		break;
	default:
		$ouput =  new output(404);

}

//validate that post data exist and then call class to create
function postRoutes($main_dir, $requested_uri){
	if(isset($_POST)){
		//   /myapi/v1/examples/ => create example
		switch ($requested_uri) {
			case $main_dir.'actors/':
				$actor = new Actor();
				$actor->create();
				break;		
			default:
				$ouput =  new output(404);
		}
	} else {
			$ouput =  new output(403);
	}
}

//validate that get data exist and then call class to display
function getRoutes($main_dir, $requested_uri){
	//   /myapi/v1/examples/ => get all examples
	switch ($requested_uri) {
		case $main_dir.'actors/':
			$actor = new Actor();
			$actor->getAllActors();
			break;
		case (preg_match('/actors\/([0-9])*/', $requested_uri) ? true : false):
			$actor = new Actor();
			$id = str_replace($main_dir."actors/","",$requested_uri);
			$actor->getActor($id);
			break;			
		default:
			$ouput =  new output(404);
	}
}

?>