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
		foreach($solved_game->getNumbersList() as $child)
		{
		   echo $child.",";
		}
		echo "}\n";
		echo "Target:".$solved_game->get3dNumber()."\n";
		if($solved_game->get3dNumber() == $solved_game->getSolution())
			echo "Solution [Exact]:\n";
		else
			echo "[Remaining: ".($solved_game->get3dNumber() - $solved_game->getSolution())."]:\n";
		echo $this->infix($solved_game->getSolutionPostfix())."=".$solved_game->getSolution()."\n";
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
