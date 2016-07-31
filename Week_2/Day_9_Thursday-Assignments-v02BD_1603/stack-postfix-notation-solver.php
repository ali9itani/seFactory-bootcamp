<?php
function compute($exp) {
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

  echo $stack->pop()."\n";
 
}

// test
compute([ 10 , 2 , 8,  "*",  "+" ,  3 , "-" ]);  //23


?>
