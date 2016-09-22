<?php
//a router to direct each request to destination function in a specific class
//requires all controllers
foreach(glob('controllers/*.php') as $file) {
     require_once $file;
}
require_once('output.php');


$requested_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// $requested_uri_parts[3] => entity name, $requested_uri_parts[4] => id
$requested_uri_parts  = explode("/", $requested_uri);
$entity_name = $requested_uri_parts[3];
$id = $requested_uri_parts[4];


//redirect acc. to request method type
switch($method) {
	case 'POST':
		postRoutes($entity_name);
		break;
	case 'GET':
		getRoutes($entity_name, $id);
		break;
	case 'PUT':
		putRoutes($entity_name, $id);
		break;
	case 'DELETE':
		deleteRoutes($entity_name);
		break;
	default:
		$ouput =  new output(404);
}

//validate that post data exist and then call class to create
function postRoutes($entity_name)
{
	if(isset($_POST)){
		//   /myapi/v1/examples/ => create example
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->create();
				break;
			case 'customers':
				$actor = new Customer();
				$actor->create();
				break;
			case 'films':
				$film = new Film();
				$film->create();
				break;
			default:
				$ouput =  new output(404);
		}
	} else {
			$ouput =  new output(403);
	}
}

//call class to display
function getRoutes($entity_name, $id)
{
	if($id){
		//   /myapi/v1/examples/1 => get all for example with id=1
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->getById($id);
				break;
			case 'customers':
				$customer = new Customer();
				$customer->getById($id);
				break;
			case 'films':
				$film = new Film();
				$film->getById($id);
				break;
			default:
				$ouput =  new output(404);
		}
	}else {
		// /myapi/v1/examples/ => get all examples
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->getAll();
				break;
			case 'customers':
				$customer = new Customer();
				$customer->getAll();
				break;
			case 'films':
				$film = new Film();
				$film->getAll();
				break;
			default:
				$ouput =  new output(404);
		}
	}
}

function putRoutes($entity_name, $id)
{
	if(file_get_contents("php://input")){
			//   /myapi/v1/examples/1 => update all data for example with id=1
		switch ($entity_name) {
			case 'actors':
				$actor = new Actor();
				$actor->updateOne($id);
				break;
			case 'customers':
				$customer = new Customer();
				$customer->updateOne($id);
				break;	
			case 'films':
				$film = new Film();
				$film->updateOne($id);
				break;			
			default:
				$ouput =  new output(404);
		}
	} else {
			$ouput =  new output(423);
	}
}

function deleteRoutes($entity_name)
{
	//   /myapi/v1/examples/1 => delete example with id=1
	switch ($entity_name) {
		case 'actors':
			$actor = new Actor();
			$actor->deleteOne($id);
			break;
		case 'customers':
			$customer = new Customer();
			$customer->deleteOne($id);
			break;
		case 'film':
			$film = new Film();
			$film->deleteOne($id);
			break;	
		default:
			$ouput =  new output(404);
	}
}

?>