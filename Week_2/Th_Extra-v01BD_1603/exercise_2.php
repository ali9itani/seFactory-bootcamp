<?php
$winning_word = "error msg: nothing found";
$winning_word_size = 0;
$keyboard_rows = array("qwertyuiop" , "asdfghjkl" , "zxcvbnm" );
$words_list = array();
$data_file = fopen("data.txt", "r") or die("Unable to open file!");
while(!feof($data_file))
{
	array_push($words_list , fgets($data_file));
}
for($i=0 ; $i < sizeof($words_list)-1; $i++)
{
	if(similar_text($keyboard_rows[0],$words_list[$i] ) ? (similar_text($keyboard_rows[1],$words_list[$i] ) || similar_text($keyboard_rows[2],$words_list[$i] )) : (similar_text($keyboard_rows[1],$words_list[$i] ) && similar_text($keyboard_rows[2],$words_list[$i] )))
		continue;
	if(strlen ($words_list[$i])>$winning_word_size)
	{
		$winning_word = $words_list[$i];
		$winning_word_size = strlen ($words_list[$i]);
	}
}
echo $winning_word;
fclose($data_file);
?>