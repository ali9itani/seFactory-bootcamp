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

$requested_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//redirect acc. to request method type
switch($method) {
	case 'POST':
		postRoutes($requested_uri);
		break;
	case 'GET':
		getRoutes($requested_uri);
		break;
	case 'PUT':
		putRoutes($requested_uri);
		break;
	case 'DELETE':
		deleteRoutes($requested_uri);
		break;
	default:
		$ouput =  new output(404);

}

//validate that post data exist and then call class to create
function postRoutes($requested_uri)
{
	if(isset($_POST)){
		//   /myapi/v1/examples/ => create example
		switch ($requested_uri) {
			case $main_dir.'actors/':
				$actor = new Actor();
				$actor->create();
				break;
			case $main_dir.'customers/':
				$actor = new Customer();
				$actor->create();
				break;
			default:
				$ouput =  new output(404);
		}
	} else {
			$ouput =  new output(403);
	}
}

//call class to display
function getRoutes($requested_uri)
{
	// $requested_uri_parts[3] => entity name, $requested_uri_parts[4] => id
	$requested_uri_parts  = explode("/", $requested_uri);
	$entity_name = $requested_uri_parts[3];
	$id = $requested_uri_parts[4];

	if($id){
		//   /myapi/v1/examples/1 => get all for example with id=1
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->getActor($id);
				break;
			case 'customers':
				$customer = new Customer();
				$customer->getById($id);
				break;
			default:
				$ouput =  new output(404);
		}
	}else {
		// /myapi/v1/examples/ => get all examples
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->getAllActors();
				break;
			case 'customers':
				$customer = new Customer();
				$customer->getAll();
				break;
			default:
				$ouput =  new output(404);
		}
	}
}


function putRoutes($requested_uri)
{
	// $requested_uri_parts[3] => entity name, $requested_uri_parts[4] => id
	$requested_uri_parts  = explode("/", $requested_uri);
	$entity_name = $requested_uri_parts[3];
	$id = $requested_uri_parts[4];

	if(file_get_contents("php://input")){
			//   /myapi/v1/examples/1 => update all data for example with id=1
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->updateActor($id);
				break;
			case 'customers':
				$customer = new Customer();
				$customer->updateOne($id);
				break;			
			default:
				$ouput =  new output(404);
		}
	} else {
			$ouput =  new output(423);
	}
}

function deleteRoutes($requested_uri)
{
	// $requested_uri_parts[3] => entity name, $requested_uri_parts[4] => id
	$requested_uri_parts  = explode("/", $requested_uri);
	$entity_name = $requested_uri_parts[3];
	$id = $requested_uri_parts[4];

	//   /myapi/v1/examples/1 => delete example with id=1
	switch ($entity_name) {
		case 'actors':
			$actor = new Actor();
			$actor->deleteActor($id);
			break;
		case 'customers':
			$customer = new Customer();
			$customer->deleteOne($id);
			break;	
		default:
			$ouput =  new output(404);
	}
}

?>