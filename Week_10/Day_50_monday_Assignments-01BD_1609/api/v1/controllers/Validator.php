<?php
require_once 'MySqlAPI.php';

//to validat input fields
class Validator
{
	//check if all necessary data exist and valid
	public function validateData($data_array, $columns_name)
	{	
		//predefined columns_name
		for ($i=0; $i < count($columns_name); $i++) { 
			$required_parameter_name = $columns_name[$i];
			//get value of each required record from the recieved data
			$record_value = $data_array[$required_parameter_name];
			//get the length of the value
			$record_value_length = strlen($record_value);

			//for validating firstname / lastname
			if($required_parameter_name == 'firstName' || $required_parameter_name == 'lastName'){
				if ($record_value_length < 3 ||  $record_value_length > 45
					|| !preg_match("/^[a-zA-Z ]*$/", $record_value) ){
					return false;
				}
			} elseif($required_parameter_name == 'storeId' || $required_parameter_name == 'addressId'){
				$field_name = $this->to_snake_case($required_parameter_name);
				if(!$this->checkIdExistence('customer', $field_name, $record_value)){
					return false;
				}		
			} elseif ($required_parameter_name == 'email') {
				//email is optional for customer
				if($record_value_length > 50 || 
					($record_value_length > 0  && !filter_var($record_value, FILTER_VALIDATE_EMAIL))
				){
					return false;
				}
			} elseif ($required_parameter_name == 'active') {
					if($record_value != 0  && $record_value != 1){
						return false;
					}
			}		
		}
		return true;
	}

	//convert from camel case to snake case
	function to_snake_case($input) {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}

	//to check if id exist 
	public function checkIdExistence($table_name, $id_key_name, $id_value)
	{
		if(is_numeric($id_value)){
			$db_conx = $this->initializeConnection();
			$result = $db_conx->getRowById($table_name, $id_key_name, $id_value);

			//close fb conx
			$db_conx->closeConnection();

			if($result){
				return true;
			} 
		} 
		return false;		
	}

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
}

?>