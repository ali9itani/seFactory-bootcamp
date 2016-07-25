<?php
//$argv array of argument from the terminal
$main_directory_path= $argv[2];
//checking if the submitted path exists
if(file_exists($main_directory_path))
{	
	check($main_directory_path );}
else
{
	echo "Directory doesn't exist.\n";
  	exit();
}
//recurssive function to check all directories(sub)
function check($dir_or_file )
{ 
	//check if directory or file
	if(is_dir ( $dir_or_file ))
	{	//make sure the directory isnt empty
		if(!isEmptyDir($dir_or_file))
		{	//retrieving directory contents
			$directory_contents = scandir($dir_or_file);
			for($i=2;$i<count($directory_contents); $i++)
			{	//check every single directory/file
				check($dir_or_file ."/".$directory_contents[$i]);
			}
		}

	}
	else
	{	//if its a file - print its name
		echo basename($dir_or_file)."\n";
	}
}

echo "Status: Finished\n";

function isEmptyDir($directory_to_check)
{ 	//check if empty by scaning directory and check if there is any file rather than . ..
	return (($files = scandir($directory_to_check)) && count($files) <= 2);
}

?>
