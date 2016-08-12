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
		file_put_contents($this->path, json_encode($data)."\n", FILE_APPEND | LOCK_EX);
		//create primary keys file
		touch($this->path."_primary_keys");
	}

	private function savePrimaryKey($data)
	{
		file_put_contents($this->path."_primary_keys", $data, FILE_APPEND | LOCK_EX);
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
		$primary_keys = $this->getPrimaryKeys();
		//check if primary_key already used
		if (!in_array($row_data[0]."\n", $primary_keys)) {
			$this->saveRecordToFile($row_data);
			$this->savePrimaryKey($row_data[0]."\n");
			echo "Record ADDED\n";
		} else {
			echo "primary key exists\n";
		}
		
	}

	private function getPrimaryKeys()
	{
		return file($this->path."_primary_keys");
	}

	public function getTableData()
	{
		$table_data = array();
		//JSON serializing. It is human readable and you'll get better performance (file is smaller and faster to load/save)
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
		$primary_keys = $this->getPrimaryKeys();
		//renaming files
		rename($this->path,$this->path."_tmp");
		rename($this->path."_primary_keys", $this->path."_primary_keys_tmp");
		//recreating files
		touch($this->path);
		touch($this->path."_primary_keys");

		try {
			foreach ($records as $i => $row) {
				if ($row[0] == $key_to_delete) {
					foreach ($primary_keys as $index => $primary_key) {	
						if($primary_key != $key_to_delete."\n") {
							$this->savePrimaryKey($primary_key);
						}
					}
				} else {
					$this->saveRecordToFile($row);
				}
			}
			//remove temproray files
			unlink($this->path."_primary_keys_tmp");
			unlink($this->path."_tmp");
			echo "Record DELETED\n";	
		} catch (Exception $e) {
			//since if the newname exist it overwrite
			rename($this->path,$this->path."_tmp");
			rename($this->path."_primary_keys", $this->path."_primary_keys_tmp");
			echo $e."\nNo deletion occured\n";
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