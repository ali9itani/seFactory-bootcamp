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
		array_push($this->table, $row_data);
    	$this->saveTableToFile();
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
}
?>