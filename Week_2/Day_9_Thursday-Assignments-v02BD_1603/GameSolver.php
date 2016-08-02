<?php
class GameSolver
{
	private $numbers_list;
	private $_3digit_number;
	private $solution=0;
	private $solution_postfix;
	private $GameGenerator_Object;
		
	function GameSolver(GameGenerator $game)
	{
		$this->numbers_list = $game->getNumbersList();
		$this->_3digit_number = $game->get3digitNumber();
		//sending one digit and remaining digits
		for($i=0;$i<sizeof($this->numbers_list);$i++)
		{	
			$exp=array();
			array_push($exp, $this->numbers_list[$i]);
			$left_nbs = array();
			for($j=0;$j<sizeof($this->numbers_list);$j++)
			{
				if($i==$j)
					continue;
				array_push($left_nbs,$this->numbers_list[$j]);
			}
			$this->finder($exp, $left_nbs);
		}
		//using game output to print results
		new GameOutput($this);
	}
	function getNumbersList()
	{
		return $this->numbers_list;
	}
	function get3dNumber()
	{
		return $this->_3digit_number;
	}
	function getSolution()
	{
		return $this->solution;
	}
	function getSolutionPostfix()
	{
		return $this->solution_postfix;
	}
	private function acceptsOperator($exp)
	{
		$n = 0;
		//count of digits must more than operators by 2 to allow new operator
		for($i=0; $i<sizeof($exp); $i++)
		{
			if(is_numeric($exp[$i]))
				$n++;
			else
			{
				$n--;
			}
		}
		    return $n > 1;
	}
		//search for all possible solutions in postfix notation
	private function finder($exp, $list)
	{
		//to stop all running recurison functions if a solution found 
		if($this->solution == $this->_3digit_number)
		{
			return;
		}
		$list2=array('+','*','-','/');
		//if accepts add from array2(+,-,*,/)
		if($this->acceptsOperator($exp))
		{
			for($i=0;$i<sizeof($list2);$i++)
			{
				array_push($exp, $list2[$i]);
				$value = $this->compute($exp); 
				if($value>0 && !is_float($value))
				{
					$new_distance = abs($value - $this->_3digit_number);
					$old_distance =  abs($this->solution - $this->_3digit_number);
					//is new one closer to 3_digit_number
					if($new_distance < $old_distance)
					{
						//replace old solution with new better ones
						$this->solution=$value;
						$this->solution_postfix=$exp;
					}
				}
				$this->finder($exp, $list);
				//to add another digit ex: 143(50) -- remove 50 to add another 143(9)
				array_pop($exp);
			}
		}
		else
		{	//no remaining digits to add
			if(empty($list))
				return;
			else
			{	
				//add a new digitfrom the list
				for($i=0;$i<sizeof($list);$i++)
				{	
					array_push($exp, $list[$i]);
					$left_nbs = array();
					for($j=0;$j<sizeof($list);$j++)
					{
						if($i==$j)
							continue;
						array_push($left_nbs, $list[$j]);
					}
					$this->finder($exp, $left_nbs  );
					array_pop($exp);
				}
			}
		}
	}
	//get the output of the postfix expression
	private function compute($exp)
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
			    switch($exp[$i])
			    {
			        case "+": $stack->push($first_operand + $second_operand); break;
			        case "-": $stack->push($first_operand - $second_operand); break;
			        case "*": $stack->push($first_operand * $second_operand); break;
			        case "/": $stack->push($first_operand / $second_operand); break;
			      }
			}
		}
		return $stack->pop();
	}

}
?>
