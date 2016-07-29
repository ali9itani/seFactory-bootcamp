<?php
class GameSolver
{
	private $numbers_list;
	private $_3digit_number;
	private $solution;
	private $GameGenerator_Object;
	
	function GameSolver(GameGenerator $game)
	{
		$this->numbers_list = $game->_get_numbers_list();
		$this->_3digit_number = $game->_get_3digit_number();

		//test
		$this->solution = $this->_3digit_number;

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

}
?>