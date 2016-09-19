<?php
require_once __DIR__ . '/configuration/auth_config.php';

class MySqlAPI
{
	public $connection_status;

	//inialize a db connection
	function MySqlAPI(){
		$db_connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

		if (!$db_connection) {
		    $this->connection_status = false;
		} else
		{
			$this->connection_status = true;
		}



	}
}

//mysql_close($db_connection);

?>