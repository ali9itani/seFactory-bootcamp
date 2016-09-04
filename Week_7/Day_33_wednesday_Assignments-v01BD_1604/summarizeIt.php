<?php
require_once 'config_file.php';

if(isset($_POST['text']) && $_POST['text'] != '')
{
	$text = $_POST['text'];

	$postfields = array('title'=>'title value', 'text'=>$text, 'sentences_number'=>'3');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.aylien.com/api/v1/summarize');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	//set authentication header
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(AYLIEN_ID, AYLIEN_KEY));
	// Edit: prior variable $postFields should be $postfields;
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
	$result = curl_exec($ch);
	echo $result;
}

?>