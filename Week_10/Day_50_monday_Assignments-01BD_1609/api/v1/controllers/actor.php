<?php
require_once 'MySqlAPI.php';
require_once 'output.php';

class Actor 
{
	/*
	*
	*actor operation - create update delete read
	*data should be lenght > 3|lenght < 46|chars&spaces are allowed 
	*post parameters - firstName LastName ex: {firstName=ali&lastName=itani}
	*
	*/
	private $columns_name = ['firstName','lastName']; 

	//connection initializer - initialize a mysql db connection 
	public function initializeConnection()
	{
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
	function create()
	{
		$db_conx = $this->initializeConnection();

		if($db_conx) {
			$data_array = $_POST;
			if($this->validateData($_POST)){
				$data_array = ['first_name' => $_POST['firstName'], 'last_name' => $_POST['lastName']];
				$result = $db_conx->insertData('sakila.actor',$data_array, 'actor_id');
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(402, '(create actor)');
			}
			//close fb conx
			$db_conx->closeConnection();
		}
		
	}

	//check if data is valid and complete
	public function validateData($data_array)
	{
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
		//close fb conx
		$db_conx->closeConnection();

	}

	//select actor by actor id
	public function getActor($actor_id_value)
	{
		if(is_numeric($actor_id_value)){
			$db_conx = $this->initializeConnection();
			$result = $db_conx->getRowById('actor', 'actor_id', $actor_id_value);

			//close fb conx
			$db_conx->closeConnection();

			if($result){
				$ouput = new output(200, $result);
			} else {
				$ouput = new output(101);
			}
		} else {
			$ouput = new output(412,', actor id');
		}		
	}

	//update all actor's data
	public function updateActor($id_value) 
	{
		if(is_numeric($id_value)){
			//get data from put request
			$put_data;
			parse_str(file_get_contents("php://input"),$put_data);

			if($this->validateData($put_data)){
				$db_conx = $this->initializeConnection();

				//check if actor id exist
				$recent_actor_data = $db_conx->getRowById('actor', 'actor_id', $id_value);	

				if($recent_actor_data){
					$data_array = ['first_name' => $put_data['firstName'], 'last_name' => $put_data['lastName']];
					$result = $db_conx->updateRow('actor', $data_array, 'actor_id', $id_value);
					$ouput = new output(200, $result);
				} else {
					$ouput =  new output(422, '-actor id (update actor)');
				}
				$db_conx->closeConnection();
			} else {
				$ouput =  new output(422, '(update actor)');
			}
		} else {
			$ouput = new output(422,', actor id');
		}	
	}

	//delete an actor
	public function deleteActor($id_value) 
	{
		if(is_numeric($id_value)){
			$db_conx = $this->initializeConnection();

			//check if actor id exist
			$recent_actor_data = $db_conx->getRowById('actor', 'actor_id', $id_value);	

			if($recent_actor_data){
				$result = $db_conx->deleteRowById('actor', 'actor_id', $id_value);
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(432, '-actor id (delete actor)');
			}
			$db_conx->closeConnection();
		} else {
			$ouput = new output(422,', actor id');
		}	
	}

}


?>
