<?php
require_once 'main.php';

class Customer extends Main
{
	/*
	*
	*customer actions - create update delete read
	*
	*lastname/firstname/ be lenght > 3|lenght < 46|chars&spaces are allowed 
	*email be lenght < 51| valid email format
	*addressId/storeId > relations (must exist in  addrees/store table)
	*
	*/
	function Customer()
	{
		$this->table_name = 'customer';
		$this->table_id = 'customer_id';
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