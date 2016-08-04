<?php
require_once("Database.php");


function queryExecuter($query)
{


	/*-- Create a Database
		CREATE,DATABASE,"Database Name"
		-- Delete a Database
		DELETE,DATABASE,"Database Name"
		-- Create a table (Number of columns is indefinite)
		CREATE,TABLE,"TABLENAME",COLUMNS,"Column1","Column2","Column3"
		-- Add a record (The table has a non-null constraint on all columns)
		ADD,"10","Bassem","Dghaidi","SEF Instructor"
		-- Retrieve a record
		GET,"10"
		-- Delete a record
		DELETE,ROW,"10"*/




	// to escape "db name"
	$query_array = explode(",",addslashes($query));
	$operations = array("CREATE", "ADD", "DELETE", "GET");

	if (!in_array($query_array[0], $operations)){
		echo "not a query\n";
	}
	//do database operations
	elseif ($query_array[1]=="DATABASE"){

		if(checkNameValidity($query_array[2])){
			//remove ""
			$db_name = extractName($query_array[2]);
			if($query_array[0]=="CREATE"){
				addNewDb($db_name);
			}
			elseif($query_array[0]=="DELETE"){
				deleteDatabase($db_name);
			}
		}
		  
	}
	 


}
	
 //check name field validity
function checkNameValidity($word)
{
	return preg_match("/\".*\"/",$word);
}
function extractName($word)
{
	return substr($word, 2, strlen($word[2])-3);
}
//create a new db and add to list of databases
function addNewDb($db_name)
{	
	if(checkDatabaseExistence($db_name)){
		echo "database name already exist\n";
	}
	else{
		$new_db = new Database($db_name);
		//get list of dbs to add to it 
		$databases_list = getDbList();
		//serialize object and then push to db list
		array_push($databases_list,serialize($new_db));
		saveDbListToFile($databases_list);
	}
}
function deleteDatabase($db_name)
{
	if(!checkDatabaseExistence($db_name)){
		echo "database  doesnt exist exist\n";
	}
	else{
		$databases_list = getDbList();
		foreach ($databases_list as $key => $value) {
			$db = unserialize($value);
			if($db->getDatabaseName() == $db_name){
				$db->deleteDir();
				unset($databases_list[$key]);
				saveDbListToFile($databases_list);
				break;
			}
		}
	}
}
function saveDbListToFile($databases_list)
{
	//encode array of databases and save it in file
	file_put_contents("./databases/db_list.json", json_encode($databases_list));
}

//check if db exists
function checkDatabaseExistence($db_name)
{
	$databases_list = getDbList();
	foreach ($databases_list as $key => $value) {
		if(unserialize($value)->getDatabaseName() == $db_name){
			return true;
		}
	}
	return false;
}


function getDbList()
{
	//JSON serializing. It is human readable and you'll get better performance (file is smaller and faster to load/save)
	$databases_list = json_decode(file_get_contents('./databases/db_list.json'), true);

	if($databases_list == null){
		$databases_list = array();
	}
	return $databases_list ;
}


//$databases_list = getDbList();

$user_query = readline("> ");
queryExecuter($user_query);


//addNewDb("ali-db1",$databases_list );

 
/*foreach ($databases_list as $entry) {
    echo unserialize($entry)->getDatabaseName();
}*/

 
    

?>
