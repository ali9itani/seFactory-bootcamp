<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head></head>
<body>
<?php

/**
 * Short description for task
 *
 * Used Tables
 *
 *rental table(each rental of each inventory item with information about who
 *rented what item, when it was rented, and when it was returned).
 *film table: is a list of all films potentially in stock in the stores. 
 *inventory table: The inventory table contains one row for each copy of
 *a given film in a given store.
 *The payment table records each payment made by a customer, with information
 *such as the amount and therental being paid for (when applicable).
 *customer: a list ofcustomers
 *staff: The staff table lists all staff members, including information on 
 *email address, login information, and picture.
 *
 * renting process
 *
 *To rent a movie,first confirm that the given inventory item is in stock
 *and then insert a row into the rental table. 
 *After the rental record is created, insert a row into the payment table. 
 *Depending on business rules, you may also need to check whether the customer
 *has an outstanding balance before processing the rental. 
 *
 */

require_once('MySQLWrap.php');

$ordered_film_id = $_POST['select_movie'];
$default_store_id = 1;
$default_customer_id = 1;
$default_staff_id = 1;

if(filter_var($ordered_film_id, FILTER_VALIDATE_INT))
{
	$wrapper = new MySQLWrap();

	//check if film_id exist
	if($wrapper->checkMovieId($ordered_film_id))
	{
		//check if inventory item exist and return inventory_id
		$inventory_id = $wrapper->checkInventory($ordered_film_id, $default_store_id);

		if($inventory_id){
			$rental_id = $wrapper->insertRentalRecord($inventory_id, $default_customer_id, $default_staff_id);
			$amount = $wrapper->getFilmRentalRate($ordered_film_id);
			$wrapper->insertPaymentRecord($rental_id, $default_customer_id, $default_staff_id, $amount);
			echo 'succeed</br>';
			echo "rental_rate: {$amount}$";
		}
	}

}else{
	echo 'something went wrong<br/>';
}

?>
</body>
</html>