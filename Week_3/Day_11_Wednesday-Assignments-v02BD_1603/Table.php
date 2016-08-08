<?php
class Table
{
	private $table_name;
	private $table = [[]];

	public function Table($db_name,$table_name,$columns_list)
	{
		$this->table_name = $table_name; 
		$this->createTable($db_name,$columns_list);
	}
	private function createTable($db_name,$columns_list) 
    {

    	foreach ($columns_list as $key => $value) {
    		array_push($this->table[0], $value);
    	}

    	$path = "./databases/".$db_name."/".$this->table_name;
    	$this->saveTableToFile($path, $this->table);
	}
	private function saveTableToFile($path, $table)
	{
		//encode array of databases and save it in file
		file_put_contents($path, json_encode($this->table));
	}
	public function getTableName()
	{
		return $this->table_name;
	}

}


?>