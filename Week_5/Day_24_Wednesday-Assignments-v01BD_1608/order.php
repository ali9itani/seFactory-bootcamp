<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head></head>
<body> 
<?php
require_once('MySQLWrap.php');

$wrapper = new MySQLWrap();
echo $wrapper->getStatus()."<br/>";

$movies = $wrapper->getmoviesList();

//check if there is results or not
if(!empty($movies)){
	echo '<select>';	
	foreach ($movies as $key => $value) {
		//$value[0] => film_id to reuse upon select
		echo '<option value="'.$value[0].'">'.$value[1].'</option>';
	}
	echo "</select><br/>";	
}

echo $wrapper->closeConnection();
?>
</body>
</html>