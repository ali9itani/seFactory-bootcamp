<?php
require_once 'MySqlAPI.php';
require_once 'output.php';

class actor 
{
	function actor() {

	}

	function actorName(){
		$db_conx  = new MySqlAPI();

		//if an error in db connection exist
		if(!$db_conx->connection_status) {
			$ouput =  new output('server error, cannot serve you', '501');
		} else {
			
		}
		
	}
	
}


?>
