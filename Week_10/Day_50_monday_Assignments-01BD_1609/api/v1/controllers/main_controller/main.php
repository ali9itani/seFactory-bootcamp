<?php
require_once '/var/www/html/api/v1/MySqlAPI.php';
require_once '/var/www/html/api/v1/output.php';
require_once '/var/www/html/api/v1/Validator.php';

class Main 
{
	/*
	*
	*actions - create update delete read
	*
	*lastname/firstname/ be lenght > 3|lenght < 46|chars&spaces are allowed 
	*email be lenght < 51| valid email format
	*addressId/storeId > relations (must exist in  addrees/store table)
	*
	*/
	protected $table_name;
	protected $table_id;
	protected $columns_name; 


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

	/* used to create a new row in db */
	public function create()
	{
		$db_conx = $this->initializeConnection();

		if($db_conx) {
			$data_array = $_POST;
			//call class validator to validate inputs
			$validator = new Validator();

			if($validator->validateData($_POST, $this->columns_name)){
				//extract needed data from post data
				$data_array = $this->extractDataFromInput();
				$result = $db_conx->insertData($this->table_name,$data_array, $this->table_id);
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(402, '(create '.$this->table_name.')');
			}
			//close fb conx
			$db_conx->closeConnection();
		}
		
	}

	//extract needed data from input (put data / post data)
	protected function extractDataFromInput()
	{
		$input_data;
		parse_str(file_get_contents("php://input"),$input_data);
		return $data_array = ['first_name' => $input_data['firstName'], 'last_name' => $input_data['lastName'],
								'email' => $input_data['email'], 'address_id' => $input_data['addressId'],
								'store_id' => $input_data['storeId'], 'active' => $input_data['active']					
					];
	}

	//select all rows of table from db
	public function getAll() {
		$db_conx = $this->initializeConnection();
		$result = $db_conx->getAll($this->table_name);
		$ouput = new output(200, $result);
		//close fb conx
		$db_conx->closeConnection();
	}

	//to check if id exist 
	protected function checkIdExistence($table_name, $id_key_name, $id_value)
	{
		if(is_numeric($id_value)){
			$db_conx = $this->initializeConnection();
			$result = $db_conx->getRowById($this->table_name, $id_key_name, $id_value);

			//close fb conx
			$db_conx->closeConnection();

			if($result){
				return true;
			} 
		} 
		return false;		
	}

	//select one row by row id
	public function getById($id_value)
	{
		//checks if valid and exist
		$id_check = $this->checkIdExistence($this->table_name, $this->table_id, $id_value);

		if($id_check){
			$db_conx = $this->initializeConnection();
			$result = $db_conx->getRowById($this->table_name, $this->table_id, $id_value);

			//close fb conx
			$db_conx->closeConnection();

			$ouput = new output(200, $result);
		} else {
			$ouput = new output(412,', '.$this->table_id);
		}		
	}

	//update all row's data
	public function updateOne($id_value) 
	{
		//checks if valid and exist
		$id_check = $this->checkIdExistence($this->table_name, $this->table_id, $id_value);

		if($id_check){
			//get data from put request
			$put_data;
			parse_str(file_get_contents("php://input"),$put_data);

			//call class validator to validate inputs
			$validator = new Validator();

			if($validator->validateData($put_data, $this->columns_name)){
				$db_conx = $this->initializeConnection();

				$data_array = $this->extractDataFromInput();
				$result = $db_conx->updateRow($this->table_name, $data_array, $this->table_id, $id_value);
				$ouput = new output(200, $result);
			} else {
				$ouput =  new output(422, ' - (update '.$this->table_name.')');
			}
				$db_conx->closeConnection();
		} else {
			$ouput = new output(422,', '.$this->table_id);
		}	
	}

	//delete one row
	public function deleteOne($id_value) 
	{
		//checks if valid and exist
		$id_check = $this->checkIdExistence($this->table_name, $this->table_id, $id_value);

		if($id_check){
			$db_conx = $this->initializeConnection();

			$result = $db_conx->deleteRowById($this->table_name, $this->table_id, $id_value);
			$ouput = new output(200, $result);

			$db_conx->closeConnection();
		} else {
			$ouput = new output(432,', id of '.$this->table_name);
		}	
	}

}

?>
