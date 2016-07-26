<?php
$winning_word = "error msg: nothing found";
$winning_word_size = 0;
$keyboard_rows = array("qwertyuiop" , "asdfghjkl" , "zxcvbnm" );
$words_list = array();
//open a file just for read only(r)
$data_file = fopen("data.txt", "r") or die("Unable to open file!");
// push to array one line until end-of-file
while(!feof($data_file))
{
	array_push($words_list , fgets($data_file));
}
//first check word by word
//for each word check if it is made of one row only
//if its the first word, put it in winning_word
//else compare it to winning_word and choose the winner
for($i=0 ; $i < sizeof($words_list)-1; $i++)
{
	//check if the word is not just in one row  so it is not valid
	if(check_if_not_valid_word($keyboard_rows,$words_list[$i]))
	{
		continue;
	}
	if(strlen ($words_list[$i])>$winning_word_size)
	{
		$winning_word = $words_list[$i];
		$winning_word_size = strlen ($words_list[$i]);
	}
}
echo $winning_word;

function check_if_not_valid_word( $keyboard_rows,$value)
{ 				
	if(((levenshtein($keyboard_rows[0],$value )+(10-strlen ($value)))<10 &&
		((levenshtein($keyboard_rows[1],$value )+(9-strlen ($value)))<9 || ((levenshtein($keyboard_rows[2],$value )+(7-strlen ($value)))<7 )))
		||
		((levenshtein($keyboard_rows[2],$value )+(7-strlen ($value)))<7 &&
		((levenshtein($keyboard_rows[1],$value )+(9-strlen ($value)))<9 || ((levenshtein($keyboard_rows[0],$value )+(10-strlen ($value)))<10 )))
		||
		((levenshtein($keyboard_rows[1],$value )+(9-strlen ($value)))<9 &&
		((levenshtein($keyboard_rows[0],$value )+(10-strlen ($value)))<10 || ((levenshtein($keyboard_rows[2],$value )+(7-strlen ($value)))<7 ))))
		{
			return true;
		}
		return false;
}
fclose($data_file);
?>
