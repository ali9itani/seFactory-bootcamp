<?php
class GameSolver
{
	private $numbers_list;
	private $_3digit_number;
	private $solution;
	private $solution_postfix;
	private $GameGenerator_Object;
	
	function GameSolver(GameGenerator $game)
	{
		$this->solution=0;
		$this->solution_postfix="";
		$this->numbers_list = $game->_get_numbers_list();
		$this->_3digit_number = $game->_get_3digit_number();

		//testing
		 //$this->numbers_list =  array(100, 1, 5, 8, 9, 10);
		// $this->_3digit_number = 553;

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
					array_push($left_nbs, $this->numbers_list[$j]);
			}
			$this->finder($exp, $left_nbs);
		}

		//using game output to print results
		new GameOutput($this);
	}

	function _numbers_list()
	{
		return $this->numbers_list;
	}
	function _get_3dnumber()
	{
		return $this->_3digit_number;
	}
	function _get_solution()
	{
		return $this->solution;
	}
	function _get_solution_postfix()
	{
		return $this->solution_postfix;
	}

	private function accepts_operator($exp)
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
		if($this->accepts_operator($exp))
		{
			for($i=0;$i<sizeof($list2);$i++)
			{
				array_push($exp, $list2[$i]);		
				$value = $this->compute($exp);
				if($value>0 && !is_float($value))
				{
					$new_distance = abs($value - $this->_3digit_number);
					$old_distance =  abs($this->solution - $this->_3digit_number);

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
		{
			if(empty($list))
				return;
			else
			{	 
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
		$stack = new SplStack();
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