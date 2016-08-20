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
			echo "<br>film doesnt exist<br/>";
			return false;
		}
	}
  
	public function checkInventory($film_id, $store_id)
	{
		$query = "SELECT 
				    inventory.inventory_id
				FROM
				    sakila.inventory
				where
				    inventory.store_id = '{$store_id}' AND inventory.film_id = '{$film_id}';";

		$result = $this->executeQuery($query);

		if($result)
		{
			return $result[0][0];
		}else{
			echo "<br>film doesnt exist in the inventory<br/>";
			return 0;
		}
	}

	public function insertRentalRecord($inventory_id, $customer_id, $staff_id)
	{
		$query = "INSERT INTO sakila.rental (rental_date, inventory_id, customer_id, staff_id, last_update)
				  values (now(), '{$inventory_id}', '{$customer_id}', '{$staff_id}', now());";

		$result = $this->executeQuery($query);


		print_r($result);
		// if($result)
		// {
		// 	return $result[0][0];
		// }else{
		// 	echo "<br>film doesnt exist in the inventory<br/>";
		// 	return 0;
		// }
	}

//????????????????need to fix fetching!! -- 
	private function executeQuery($query)
	{
		$result = $this->connection->query($query);

		//return results for select/describe even if no results... - true for update/insert
		//result returned usually as 2 dimension array
		if(!$result){
			echo 'Wrong Query <br/>';
			return [];
		}elseif($result->num_rows!=0){
			while(($row = $result->fetch_array())) {
		     $rows[] = $row;
			}
			//return associative array of results
			return $rows;
		}else{
			//no results
			return [];
		}	
	}

}




?>
