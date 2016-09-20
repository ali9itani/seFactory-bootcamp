<?php
require_once 'MySqlAPI.php';
require_once 'output.php';

class actor 
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
	function actor() {

	}

	/* used to create a new actor in db */
	function create(){

		$db_conx  = new MySqlAPI();

		//if an error in db connection exist
		if(!$db_conx->connection_status) {
			$ouput =  new output(501);
		} else {
			$data_array = $_POST;
			$columns_name = ['firstName','lastName']; 

			if($this->validData($columns_name, $_POST)){
				$data_array = ['first_name' => $_POST['firstName'], 'last_name' => $_POST['lastName']];
				$result = $db_conx->insertData('sakila.actor',$data_array, 'actor_id');
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(402, '(create actor)');
			}
		}
		
	}

	//check if data is valid and complete
	public function validData($columns_name, $data_array) {
		//check if all necessary data exist and valid
		for ($i=0; $i < count($columns_name); $i++) { 
			//get value of each required record
			$record_value = $data_array[$columns_name[$i]];
			//get the length of the value
			$record_value_length = strlen($record_value);
			if ($record_value_length < 3 ||  $record_value_length > 45
				|| !preg_match("/^[a-zA-Z ]*$/", $record_value) ){
				return false;
			}
		}
		return true;
	}
}


?>
