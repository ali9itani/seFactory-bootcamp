<?php
class GameGenerator
{
	private $numbers_1 = array(25, 50, 75, 100);
	private	$numbers_2 = array(1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10);
	//random number of tobe selected from first list
	private $tobe_selected_first ;
	private $tobe_selected_second ;
	private $all_selected = array();

	function __construct()
	{
		
		$this->tobe_selected_first = rand( 1, 4);
		$this->tobe_selected_second = (6-$this->tobe_selected_first);	

		while($this->tobe_selected_first>0)
		{
			//select random indexes from list 1
			//each index can be seleced once
			do
			{
				$index = rand(0,3);
			}
			while($this->numbers_1[$index] == 0);

			array_push($this->all_selected,$this->numbers_1[$index]);
			//make the value 0 at that index to not reselect it again
			$this->numbers_1[$index] = 0;


		$this->tobe_selected_first--;
		}

		while($this->tobe_selected_second>0)
		{
			//select random indexes from list 2
			//each index can be seleced once
			do
			{
				$index = rand(0,19);
			}
			while($this->numbers_2[$index] == 0);

			array_push($this->all_selected,$this->numbers_2[$index]);
			//make the value 0 at that index to not reselect it again
			$this->numbers_2[$index] = 0;
			$this->tobe_selected_second--;
		}

	}

	function _print()
	{
		print_r($this->all_selected);
	}
}
?>