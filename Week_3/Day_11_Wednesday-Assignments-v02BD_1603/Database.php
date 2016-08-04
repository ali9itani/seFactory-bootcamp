<?php
class Database
{
	private $db_name;

	public function Database($db_name)
	{
		$this->db_name = $db_name; 
		$this->createDir();
	}
	public function getDatabaseName()
	{
		return $this->db_name;
	}
    private function createDir() 
    {
    	$path = "./databases/".$this->db_name;
		if (!mkdir($path, 0777, true)) {
		    die('Failed to create database...');
		}
	}
	public function deleteDir()
	{
		$path = "./databases/".$this->db_name."/";
		//loop through file of the db to remove
	    foreach((glob($path.'*')) as $file){
    	 unlink ( $file);
 		}
	   rmdir($path);
	}
 
}
?>