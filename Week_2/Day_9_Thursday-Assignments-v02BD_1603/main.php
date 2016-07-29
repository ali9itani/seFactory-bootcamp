<?php
require_once('GameGenerator.php');
$number_of_games = readline("How many games would you like me to play today?\n");
//Finds whether the given variable is numeric, check if number >0
if(!is_numeric($number_of_games) || $number_of_games<1)
	exit("Bad input!\n");

$games = array();
while($number_of_games>0)
{
	array_push($games,new GameGenerator());
}
//$gameGenerator_Object  = new GameGenerator();
//$gameGenerator_Object->_print();
?>
