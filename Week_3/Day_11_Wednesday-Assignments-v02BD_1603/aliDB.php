<?php
require_once("Database.php");
require_once("Table.php");

function queryExecuter($query)
{
	// to escape "db name"
	$query_array = explode(",",addslashes($query));
	$operations = array("CREATE", "ADD", "DELETE", "GET");

	if(!in_array($query_array[0], $operations)){
		//q to stop execution
		if($query_array[0] != 'q'){
			echo "not a query\n";
		}
	}
	elseif($query_array[1]=="DATABASE"){
	//do database operations
		if(checkFieldValidity($query_array[2])){
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
	elseif($query_array[1]=="TABLE"){
	//do table operations
		$check_for_valid =true;
		if(checkFieldValidity($query_array[2])){
			//remove ""
			$table_name = extractName($query_array[2]);
			$columns_list = array();

			if($query_array[0]=="CREATE" && $query_array[3]=="COLUMNS"){
				for($i=4;$i<count($query_array);$i++){
					if(!checkFieldValidity($query_array[$i])){
						$check_for_valid = false;
						break;
					}
					else{
						array_push($columns_list, extractName($query_array[$i]));
					}
				}
			}
			if($check_for_valid){
				addTable($table_name, $columns_list);	
			}
			else{
				echo "Invalid Query";
			}
		}
	}
	//do records operations
	elseif($query_array[0]=="GET" || $query_array[0]=="DELETE" || $query_array[0]=="ADD"){
		$db_list = getDbList();
		if(empty($db_list)){
			echo "first create a database \n";
		}
		else{
			$last_added_db = unserialize(end($db_list));
			$last_added_table = unserialize(end($last_added_db->getTablesList()));
			if(empty($last_added_table)){
				echo "first create a table \n";
			}
			else{
				if($query_array[0]=="ADD"){
					insertTableRecord($last_added_table,$query_array);
				}
				elseif($query_array[0] == "DELETE" && $query_array[1] == "ROW"){
					deleteOrSearchTableRecord("del",$last_added_table,$query_array[2]);
				}
				elseif($query_array[0] == "GET"){
					deleteOrSearchTableRecord("search",$last_added_table, $query_array[1]);		
				}	
			}
		}
	}
}	
 //check name field validity
function checkFieldValidity($word)
{
	  if(preg_match("/\".*\"/",$word)){
	  	return (!empty(extractName($word)) || is_numeric(extractName($word)));
	  }
	  else{
	  	return false;
	  }
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
				$db->deleteDatabaseDir();
				//remove from list
				unset($databases_list[$key]);
				saveDbListToFile($databases_list);
				break;
			}
		}
	}
}
function addTable($table_name,$columns_list)
{
	$db_list = getDbList();
	if(empty($db_list)){
		echo "first create a database \n";
	}
	else{
	//get last created database and add a tableto it
	$last_db = unserialize(end($db_list));
	$last_db->createTable($table_name,$columns_list);
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

function insertTableRecord($last_added_table,$query_array)
{
	//check if data are less/more than needed
	if(count($query_array)-1 == $last_added_table->getColumnsCount()){	
		$data_array = array();
		$valid_data = true;
		for($i=1;$i<count($query_array);$i++){
			//check if namevalid not empty not null
			if(!checkFieldValidity($query_array[$i])){
				$valid_data = false;
				break;
			}
			else{
				array_push($data_array, extractName($query_array[$i]));
			}
		}

		if($valid_data){
			$last_added_table->addRecord($data_array);
		}
		else
		{
			echo "invalid data\n";
		}
	}
	else
	{
		echo "check columns count\n";
	}
}
function deleteOrSearchTableRecord($operation,$last_added_table,$key)
{
	if(!checkFieldValidity($key)){
		echo "invalid data\n";
	}
	else{
		if($operation=="del"){
			$last_added_table->deleteRecord(extractName($key));
		}
		else{
			$result = $last_added_table->searchRecord((extractName($key)));
		}
	}	
}
do{
$user_query = readline("> ");
queryExecuter($user_query);
}
while($user_query != 'q');
?>
