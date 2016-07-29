<?php
class GameOutput  
{

	function __construct(GameSolver $solved_game)
	{
		static $number = 1;
		echo  "Game ".$number.":\n";
		echo "{";
		foreach($solved_game->_numbers_list() as $child) {
		   echo $child.",";
		}
		echo "}\n";
		echo "Target:".$solved_game->_get_3dnumber()."\n";
		$status="";
		//if()
		echo "Solution [Exact]:\n";
		echo $solved_game->_get_solution()."\n";
		echo "------\n";

		$number++;
	}

 
 

}

?>