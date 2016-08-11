<?php
class Table
{
	private $table_name;
	private $records = array();
	private $path;

	public function Table($db_name, $table_name, $columns_list)
	{
		$this->table_name = $table_name; 
		$this->columns = $columns_list;
		$this->createTable($db_name);
	}

	private function createTable($db_name) 
	{
		$this->path = "./databases/".$db_name."/".$this->table_name;
		$this->saveRecordToFile($this->columns);
	}

	private function saveRecordToFile($data)
	{
		//encode array of databases and save it in file
		file_put_contents($this->path, json_encode($data)."\n",FILE_APPEND | LOCK_EX);
		//create primary keys file
		touch($this->path."_primary_keys");
	}

	public function getTableName()
	{
		return $this->table_name;
	}

	public function getColumnsCount()
	{
		return count($this->columns);
	}

	public function addRecord($row_data)
	{
		
		$primary_keys = file($this->path."_primary_keys");
		//check if primary_key already used
		if (!in_array($row_data[0]."\n", $primary_keys)) {
			$this->saveRecordToFile($row_data);
			//add new primarykey 
			file_put_contents($this->path."_primary_keys", $row_data[0]."\n", FILE_APPEND | LOCK_EX);
			echo "Record ADDED\n";
		} else {
			echo "primary key exists\n";
		}
		
	}

	public function getTableData()
	{
		$table_data = array();
		$file_fields=file($this->path);
		foreach ($file_fields as $key => $value) {
			array_push($table_data,json_decode($value, true));
		}
		if ($table_data == null) {
			$table_data = array();
		}
		return $table_data ;
	}

	public function deleteRecord($key_to_delete)
	{
		$records = $this->getTableData();
		file_put_contents($this->path, json_encode($this->columns)."\n");

		foreach ($records as $i => $row) {
				if ($row[0] == $key_to_delete) {
					echo "Record DELETED\n";
				} else {
					$this->saveRecordToFile($row);
				}
			}
	}

	public function searchRecord($search_key)
	{
		$results = [];
		$table = $this->getTableData();
		foreach ($table as $i => $row) {
			foreach ($row as $key => $record) {
				if ($record == $search_key) {
					array_push($results, $row);
				}
			}
		}

		if(empty($results)) {
			echo "no results found \n";
		} else {
			//output results
			foreach ($results as $key => $value) {
				echo implode(" ", $value)."\n";
			}
		}
	}
}

?>