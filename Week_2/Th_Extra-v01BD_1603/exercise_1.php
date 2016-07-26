<?php

$persons = array(); 
echo "enter black or white, any key to stop insertion\n";
$person_count=1;
while(true){
	//Returns a single string from the user
	//The line returned has the ending newline removed.
	$hat_color = readline($person_count.": ");
	if($hat_color!="white" && $hat_color!="black" )
		{
			$person_count--;
			break;
		}
	$person_count++;
	array_push($persons, $hat_color);
}
//array of fixed size for guesses
$suggests = new SplFixedArray($person_count);
//check if black ones before last person are even or odd 
//if odd, last one says black
$black_count=0;
for($x=0;$x<sizeof($persons)-1;$x++)
{
	if($persons[$x]=="black")
		$black_count++;
}
if($black_count%2 != 0)
{
	$suggests[$person_count-1] = "black";
}
else
{
	$suggests[$person_count-1] = "white";
}


while ($person_count>1)
{

	//next guy turn
	$person_count--;
 
 	$black_count=0;
	//to hear the ones before, starting from next person until the element before last one
	//since last one is just a hint
	for($x=$person_count ; $x < sizeof($suggests)-1;  $x++)
	{	if($suggests[$x] == "black")
		{
			$black_count++;
		}

	}
	//to look at all black hats in front of him
	for($x=$person_count-2; $x >=0  ;  $x--)
	{
	 	
		if($persons[$x] == "black")
		{
			$black_count++;
		}
	}

	//if blacks are odd && our count is even  
	//if blacks are even && our count is odd
	//then I am black
	if(($suggests[sizeof($suggests)-1]=="black" &&  ($black_count%2==0))  
		|| ($suggests[sizeof($suggests)-1]=="white" &&  ($black_count%2!=0)))
		{
			$suggests[$person_count-1] = "black";
		}
	else
		{	 
			$suggests[$person_count-1] = "white";		 
		}
}

for($x=0 ; $x < sizeof($suggests) ; $x++)
{
	echo $suggests[$x]." ";
}

echo "\n";
?>