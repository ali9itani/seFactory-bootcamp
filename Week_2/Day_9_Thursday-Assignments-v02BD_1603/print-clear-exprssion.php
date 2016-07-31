<?php
function print($exp) {
	$stack = new SplStack();
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

	print_r($stack->pop());
}

//test 
  print([ 10 , 2 , 8,  "*",  "+" ,  3 , "-" ]);   
   
?>