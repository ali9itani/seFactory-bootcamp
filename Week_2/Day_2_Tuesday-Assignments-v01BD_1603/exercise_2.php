<?php
$sol = "not found";
$wrd_size = 0;
$querty = array("qwertyuiop","asdfghjkl","zxcvbnm");
$wrds_ls = file("data.txt");
for($i=0;$i<sizeof($wrds_ls);$i++){
  if(similar_text($querty[0],$wrds_ls[$i]) ? (similar_text($querty[1],$wrds_ls[$i])||similar_text($querty[2],$wrds_ls[$i])) : (similar_text($querty[1],$wrds_ls[$i])&&similar_text($querty[2],$wrds_ls[$i])))
    continue;
  if(strlen($wrds_ls[$i])>$wrd_size){
    $sol = $wrds_ls[$i];
    $wrd_size = strlen($wrds_ls[$i]);
  }
}
echo $sol;
?>