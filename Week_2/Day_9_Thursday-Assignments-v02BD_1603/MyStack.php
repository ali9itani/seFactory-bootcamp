<?php
class MyStack
{
	private $arr=array();
	function push($value)
	{
		array_push($this->arr,$value);
	}
	function pop()
	{
		if(!empty ($this->arr))
		{
			return array_pop($this->arr);
		}
	}
}
?>
