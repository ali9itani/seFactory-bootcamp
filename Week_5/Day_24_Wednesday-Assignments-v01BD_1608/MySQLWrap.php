<?php
require_once ("Config.php");

class MySQLWrap
{
	private $connection;

	public function __construct()
	{
		$this->dbConnect();
	}

	private function dbConnect()
	{
		// Create connection
		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		// Check connection
		if ($this->connection->connect_error) {
		    $this->status =  "Service failure \n";
		}

	}
	public function closeConnection()
	{
		 mysqli_close($this->connection);
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

		$result = $this->executeQuery($query, true);

		//return rental_id of new inserted row
		return $result;
	}

	public function insertPaymentRecord($rental_id, $customer_id, $staff_id, $amount)
	{
		$query = "INSERT INTO sakila.payment(payment.customer_id, payment.staff_id, payment.rental_id,
 					payment.amount, payment.payment_date, payment.last_update) 
 				  values ('{$customer_id}', '{$staff_id}', '{$rental_id}', '{$amount}', now(), now());";

		$result = $this->executeQuery($query, true);

		return $result;
	}

	public function  getFilmRentalRate($ordered_film_id)
	{
		$query = "SELECT 
				    film.rental_rate
				FROM
				    sakila.film
				WHERE
				    film.film_id = '{$ordered_film_id}';";

		$result = $this->executeQuery($query);

		return $result[0]['rental_rate'];
	}

	private function executeQuery($query, $notRead = false)
	{
		$result = $this->connection->query($query);

		//result returned from this function as 2 dimension array for a select 

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
			//return id for inserted row
			if($notRead = true){
				return $this->connection->insert_id;
			}
			//no results for select  
			return [];
		}	
	}

}

?>
