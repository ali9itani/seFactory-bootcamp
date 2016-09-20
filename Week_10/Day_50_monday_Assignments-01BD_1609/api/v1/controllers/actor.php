<?php
require_once 'MySqlAPI.php';
require_once 'output.php';

class Actor 
{
	/*
	*
	*post request to create an actor
	*data should be lenght > 3|lenght < 46|chars&spaces are allowed 
	*post parameters - firstName LastName ex: {firstName=ali&lastName=itani}
	*
	*errors status code meanings
	*501 -> error in db conx - 402 -> error in request post data 
	*200 -> everything is ok  -- message {"statusCode":200,"message":...
	*
	*/
	private $columns_name = ['firstName','lastName']; 

	//connection initializer - initialize a mysql db connection 
	public function initializeConnection(){
		$db_conx  = new MySqlAPI();

		//if an error in db connection exist
		if(!$db_conx->connection_status) {
			$ouput =  new output(501);
			return [];
		} else {
			return $db_conx;
		}
	}

	/* used to create a new actor in db */
	function create(){
		$db_conx = $this->initializeConnection();

		if($db_conx) {
			$data_array = $_POST;
			if($this->validData($_POST)){
				$data_array = ['first_name' => $_POST['firstName'], 'last_name' => $_POST['lastName']];
				$result = $db_conx->insertData('sakila.actor',$data_array, 'actor_id');
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(402, '(create actor)');
			}
		}
		
	}

	//check if data is valid and complete
	public function validData($data_array) {
		//check if all necessary data exist and valid
		for ($i=0; $i < count($this->columns_name); $i++) { 
			//get value of each required record
			$record_value = $data_array[$this->columns_name[$i]];
			//get the length of the value
			$record_value_length = strlen($record_value);
			if ($record_value_length < 3 ||  $record_value_length > 45
				|| !preg_match("/^[a-zA-Z ]*$/", $record_value) ){
				return false;
			}
		}
		return true;
	}

	//select all actors from db
	public function getAllActors() {
		$db_conx = $this->initializeConnection();
		$result = $db_conx->getAll('actor');
		$ouput = new output(200, $result);
	}

	//select actor by actor id
	public function getActor($actor_id_value) {
		if(is_numeric($actor_id_value)){
			$db_conx = $this->initializeConnection();
			$result = $db_conx->getRowById('actor', 'actor_id', $actor_id_value);

			if($result){
				$ouput = new output(200, $result);
			} else {
				$ouput = new output(101);
			}
			
		} else {
			$ouput = new output(412,', actor id');
		}
		
	}
}


?>
