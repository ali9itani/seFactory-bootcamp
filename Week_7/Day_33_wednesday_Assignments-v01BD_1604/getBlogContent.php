<?php

if(isset($_POST['blog-link']) && $_POST['blog-link'] != '')
{
	$blog_url = $_POST['blog-link'];
	$ch = curl_init();
	// set URL and other appropriate options
	$options = array(CURLOPT_URL => $blog_url,
	                 CURLOPT_RETURNTRANSFER => true,
	                 CURLOPT_FOLLOWLOCATION => true
	                );

	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);

	// Check HTTP status code
		switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:
				echo $result;
				break;
			case 404:
				echo "-1";
				break;
			 default:
				echo "-1";
		}

}


?>