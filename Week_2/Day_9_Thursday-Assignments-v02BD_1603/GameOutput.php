<?php
class GameOutput
{
	function __construct(GameSolver $solved_game)
	{
		//game number
		static $number = 1;
		echo "Game ".$number.":\n";
		echo "{";
		//printing list numbers
		foreach($solved_game->_numbers_list() as $child)
		{
		   echo $child.",";
		}
		echo "}\n";
		echo "Target:".$solved_game->_get_3dnumber()."\n";
		if($solved_game->_get_3dnumber() == $solved_game->_get_solution())
			echo "Solution [Exact]:\n";
		else
			echo "[Remaining: +".($solved_game->_get_3dnumber() - $solved_game->_get_solution())."]:\n";
		echo $this->infix($solved_game->_get_solution_postfix())."\n";
		echo "------\n";
		$number++;
	}
	private function infix($exp)
	{
		$stack = new MyStack();
		for($i=0; $i<sizeof($exp); $i++)
		{
		    if(is_numeric($exp[$i]))
		    $stack->push($exp[$i]);
		    else
		    {
		        $second_operand =  $stack->pop();
		        $first_operand =  $stack->pop();
		        $stack->push(("(".$first_operand.$exp[$i].$second_operand.")"));
		    }
		}
		return ($stack->pop());
	}
}
?>
