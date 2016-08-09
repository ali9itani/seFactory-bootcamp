<?php
class Table
{
	private $table_name;
	private $table = array();
	private $path;

	public function Table($db_name,$table_name,$columns_list)
	{
		$this->table_name = $table_name; 
		$this->createTable($db_name,$columns_list);
	}
	private function createTable($db_name,$columns_list) 
	{
		array_push($this->table, $columns_list);
		$this->path = "./databases/".$db_name."/".$this->table_name;
		$this->saveTableToFile();
	}
	private function saveTableToFile()
	{
		//encode array of databases and save it in file
		file_put_contents($this->path, json_encode($this->table));
	}
	public function getTableName()
	{
		return $this->table_name;
	}
	public function getColumnsCount()
	{
		return count($this->table[0]);
	}
	public function addRecord($row_data)
	{
		$this->table = $this->getTableData();

		$primary_keys=array();
		foreach ($this->table as $key => $row) {
			array_push($primary_keys, $row[0]);
		}

		//check if primary_key already used
		if(!in_array($row_data[0], $primary_keys)){
			array_push($this->table, $row_data);
			$this->saveTableToFile();
			echo "Record ADDED\n";
		}
		else{
			echo "primary key exists\n";
		}
		
	}
	public function getTableData()
	{
		//JSON serializing. It is human readable and you'll get better performance (file is smaller and faster to load/save)
		$table_data = json_decode(file_get_contents($this->path), true);
		if($table_data == null){
			$table_data = array();
		}
		return $table_data ;
	}
	public function deleteRecord($key)
	{
		$this->table = $this->getTableData();
		for($i=0;$i<count($this->table);$i++){
			if($this->table[$i][0]==$key)
			{
				unset($this->table[$i]);
				echo "Record DELETED\n";
			}
		}
		$this->saveTableToFile();
	}
	public function searchRecord($search_key)
	{
		$results= [];
		$this->table = $this->getTableData();
		foreach ($this->table as $i => $row) {
			foreach ($row as $key => $record) {
				if($record==$search_key){
					array_push($results, $row);
				}
			}
		}
		if(empty($results))
		{
			echo "no results found \n";
		}
		else
		{	
			//output results
			foreach ($results as $key => $value) {
				echo implode(" ",$value)."\n";
			}
		}
	}
}
?>