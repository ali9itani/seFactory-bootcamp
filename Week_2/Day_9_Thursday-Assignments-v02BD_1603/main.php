<?php
require_once('GameGenerator.php');
require_once('GameSolver.php');
require_once('GameOutput.php');
require_once('MyStack.php');
$number_of_games = readline("How many games would you like me to play today?\n");
//Finds whether the given variable is numeric, check if number >0
if(!is_numeric($number_of_games) || $number_of_games<1)
	exit("Bad input!\n");

$games = array();

while($number_of_games>0)
{
	//get and remove last element in the array
	array_push($games,new GameGenerator());
	$number_of_games--;
}
//sending games to solver and form an array for solutions
while(!empty($games))
{
	$game = array_pop($games);
	new GameSolver($game);
}
?>
