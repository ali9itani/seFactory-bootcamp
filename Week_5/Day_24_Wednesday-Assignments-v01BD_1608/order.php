<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head></head>
<body> 
<?php
require_once('MySQLWrap.php');

$wrapper = new MySQLWrap();
echo $wrapper->getStatus()."<br/>";

$movies = $wrapper->getMoviesList();

//check if there is results or not
if(!empty($movies)){
	echo '<select name="select_movie" form="submitorder">';	
	foreach ($movies as $key => $value) {
		//$value[0] => film_id to reuse upon select
		echo '<option value="'.$value[0].'">'.$value[1].'</option>';
	}
	echo "</select><br/>";	
}
?>

<form action="/OrderProcess.php" id="submitorder"  method="post">
  <input type="submit"  value="order"/>
</form>
<?php
echo $wrapper->closeConnection();

?>
</body>
</html>