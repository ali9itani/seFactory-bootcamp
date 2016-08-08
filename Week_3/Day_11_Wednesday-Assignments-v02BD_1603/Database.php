<?php
class Database
{
	private $db_name;
	private $db_tables = array();

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
		$new_table = new Table($this->db_name,$table_name,$columns_list);
		array_push($this->db_tables, $new_table);
	}

 
}
?>