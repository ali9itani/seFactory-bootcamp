<?php
require_once __DIR__ . '/configuration/auth_config.php';

class MySqlAPI
{
	public $connection_status;
	private $mysqli;

	//inialize a db connection
	function MySqlAPI(){
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
			$this->connection_status = false;
		} else {
			$this->connection_status = true;
		}

	}

	//method used to insert to any db table
	public function insertData($table_name, $data_array, $id_key) {

		$columns = implode(', ',array_keys($data_array));
		$values = "'".implode("' , '",array_values($data_array))."'";

		$sql = "INSERT INTO {$table_name} ({$columns}) VALUES ({$values})";
		$result = $this->mysqli->query($sql);

		//return inserted row 
		return $this->getRowById($table_name, $id_key, $this->mysqli->insert_id);
	
		$this->closeConnection();
	}

	//method used to select a rowfrom db based on id
	public function getRowById($table_name, $id_key, $id_value) {

		$sql = "SELECT * FROM {$table_name} where $id_key = '{$id_value}' ";

		$result = $this->mysqli->query($sql);
		$this->closeConnection();

		//fetch row as associative array
		return $result->fetch_array(MYSQLI_ASSOC);
	}

	//closes db connection
	public function closeConnection() {
		$this->mysqli->close();
	}




}

?>