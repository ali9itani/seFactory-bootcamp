<?php
require_once 'main.php';

class Film extends Main
{
	function Film()
	{
		$this->table_name = 'film';
		$this->table_id = 'film_id';
		$this->columns_name = ['firstName','lastName','storeId','addressId','email','active']; 
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
}
?>
