<?php
class Database
{
	private $db_name;
	
	public function Database($db_name)
	{
		$this->db_name = $db_name; 
		$this->createDatabaseDir();
	}
	public function getDatabaseName()
	{
		return $this->db_name;
	}
	private function createDatabaseDir() 
	{
		$path = "./databases/".$this->db_name;
		if (!mkdir($path, 0700, true)) {
		    die('Failed to create database...');
		}
		//create empty tables file
		$this->saveTablesListToFile([]);
	}
	public function deleteDatabaseDir()
	{
		$path = "./databases/".$this->db_name."/";
		//loop through file of the db to remove
	    foreach((glob($path.'*')) as $file){
		unlink ( $file);
		}
		rmdir($path);
	}
	public function createTable($table_name,$columns_list)
	{	
		if(!$this->checkTableExistence($table_name)){

			$new_table = new Table($this->db_name,$table_name,$columns_list);
			$tables_list = $this->getTablesList();
			array_push($tables_list, serialize($new_table));
			$this->saveTablesListToFile($tables_list);
		}
		else
		{
			echo "table exist \n";
		}
	}
	private function saveTablesListToFile($tables_list)
	{
		//encode array of databases and save it in file
		file_put_contents("./databases/".$this->db_name."/tables_list.json", json_encode($tables_list));
	}
	public function getTablesList()
	{
		//JSON serializing. It is human readable and you'll get better performance (file is smaller and faster to load/save)
		$tables_list = json_decode(file_get_contents("./databases/".$this->db_name."/tables_list.json"), true);

		if($tables_list == null){
			$tables_list = array();
		}
		return $tables_list ;
	}
	private function checkTableExistence($new_table_name)
	{
		$tables_list = $this->getTablesList();
		foreach ($tables_list as $key => $value) {
			if(unserialize($value)->getTableName() == $new_table_name){
				return true;
			}
		}
		return false;
	}
}
?>