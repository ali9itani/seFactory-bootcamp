<?php
require_once ("Config.php");

class MySQLWrap
{
	private $connection;
	private $status = '';
	public function __construct()
	{
		// Create connection
		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		// Check connection
		if ($this->connection->connect_error) {
		    $this->status =  "Connection to database failed \n";
		}else{
			$this->status = "Connected successfully\n";	
		}	

	}

	public function closeConnection()
	{
		if(mysqli_close($this->connection))
		{
			return "Connection Closed \n";
		}else{
			return "Error in Closing Connection \n";
		}
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getMoviesList()
	{
		$query = "SELECT 
					    film.film_id,film.title
					FROM
					    sakila.film;";

		$result = $this->executeQuery($query);
		return $result;
	}
	public function checkMovieId($id)
	{
		$query = "SELECT 
					    film.film_id
					FROM
					    sakila.film
					WHERE 
						film.film_id = '{$id}';";

		$result = $this->executeQuery($query);
		
		if($result)
		{
			return true;
		}else{
			return false;
		}
	}
//????????????????need to fix fetching!! -- 
	private function executeQuery($query)
	{
		$result = $this->connection->query($query);

		//return results for select/describe even if no results... - true for update/insert
		if(!$result){
			echo 'Wrong Query <br/>';
			return [];
		}elseif($result->num_rows==0){
			echo 'No Data <br/>';
			return [];
		}else{
			while(($row = $result->fetch_array())) {
		     $rows[] = $row;
			}
			//return associative array of results
			return $rows;
		}	
	}

}




?>
