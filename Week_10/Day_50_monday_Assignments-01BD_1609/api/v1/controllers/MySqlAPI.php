<?php
require_once '/var/www/html/api/v1/configuration/auth_config.php';

class MySqlAPI
{
	public $connection_status;
	private $mysqli;

	//inialize a db connection
	function MySqlAPI(){
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if ($this->mysqli->connect_errno) {
			$this->connection_status = false;
		} else {
			$this->connection_status = true;
		}

	}

	//method used to insert to any db table
	public function insertData($table_name, $data_array, $id_key)
	{
		$columns = implode(', ',array_keys($data_array));
		$values = "'".implode("' , '",array_values($data_array))."'";

		$sql = "INSERT INTO {$table_name} ({$columns}) VALUES ({$values})";
		$result = $this->mysqli->query($sql);

		//return inserted row 
		return $this->getRowById($table_name, $id_key, $this->mysqli->insert_id);
	
		$this->closeConnection();
	}

	//method used to select a rowfrom db based on id
	public function getRowById($table_name, $id_key, $id_value)
	{
		$sql = "SELECT * FROM {$table_name} where $id_key = '{$id_value}';";

		$result = $this->mysqli->query($sql);
		$this->closeConnection();

		//ensure the there is result
		if($result->num_rows){
			//fetch row as associative array
			return $result->fetch_array(MYSQLI_ASSOC);
		} else {
			return [];
		}
		
	}

	//select * from a specific table
	public function getAll($table_name)
	{
		$sql = "SELECT * FROM {$table_name};";

		$result = $this->mysqli->query($sql);
		$this->closeConnection();

		//fetch all rows as associative arrays in 1 array
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	}

	//method used to do update in any db table
	public function updateRow($table_name, $data_array, $id_key, $id_value)
	{
		$set_columns_values="";
		foreach ($data_array as $field => $value)
		{
			$set_columns_values .= $field." = '".$value."',";
		}
		//remove last comma 
		$set_columns_values = trim($set_columns_values, ",");

		$sql = "UPDATE {$table_name} SET {$set_columns_values} WHERE {$id_key} = '{$id_value}'";
		$this->mysqli->query($sql);
		
		//return inserted row 
		return $this->getRowById($table_name, $id_key, $id_value);

		$this->closeConnection();
	}

	//closes db connection
	public function closeConnection()
	{
		$this->mysqli->close();
	}




}

?>