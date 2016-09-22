<?php
require_once 'main_controller/main.php';

class Actor  extends Main
{
	/*
	*
	*actor operation - create update delete read
	*data should be lenght > 3|lenght < 46|chars&spaces are allowed 
	*post parameters - firstName LastName ex: {firstName=ali&lastName=itani}
	*
	*/

	function Actor()
	{
		$this->table_name = 'actor';
		$this->table_id = 'actor_id';
		$this->columns_name = ['firstName','lastName'];
	}

	//extract needed data from input (put data / post data)
	protected function extractDataFromInput()
	{
		$input_data;
		parse_str(file_get_contents("php://input"),$input_data);
		return $data_array = ['first_name' => $input_data['firstName'], 'last_name' => $input_data['lastName']];
	}
}
?>
