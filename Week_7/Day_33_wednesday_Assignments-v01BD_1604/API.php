<?php
require_once 'config_file.php';

function createCurlSession($options) 
{
	//Initialize a cURL session
	$curl_session = curl_init();
	curl_setopt_array($curl_session, $options);	 	
	$result = curl_exec($curl_session);	

	// Check HTTP status code
	switch ($http_code = curl_getinfo($curl_session, CURLINFO_HTTP_CODE)) {
		case 200:
			echo $result;
			break;
		case 404:
			echo "-1";
			break;
		 default:
			echo "-1";
	}

	//close curl session
	curl_close($curl_session);
}

if(isset($_POST['blog-link']) && $_POST['blog-link'] != ''){
	//set curl options: link, return value instead of outputting it out directly.
	$options = [CURLOPT_URL => $_POST['blog-link'],  CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true ];
	createCurlSession($options); 

} elseif(isset($_POST['text']) && $_POST['text'] != '') {

	$summarization_link = 'https://api.aylien.com/api/v1/summarize';
	$postfields = array('title'=>'title value', 'text'=>$_POST['text'], 'sentences_number'=>'3');
	$authenticationFields = array(AYLIEN_ID, AYLIEN_KEY);

	//set curl session options: link ,return , post, header authentication, post fields
	$options = [CURLOPT_URL =>$summarization_link,  CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true, CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => $authenticationFields, CURLOPT_POSTFIELDS => $postfields];
	createCurlSession($options);
} else {
	//if there is no data in post fields
	echo "-2";
}

?>