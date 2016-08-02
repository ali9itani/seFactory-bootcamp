<?php
class MyStack
{
	private $arr=array();
	function push($value)
	{
		 $this->arr[]=$value;
	}
	function pop()
	{
		try 
		{
   			 return array_pop($this->arr);
		} catch (Exception $e) {
		    echo "Caught exception: empty stack\n";
		}
	}
}
?>
