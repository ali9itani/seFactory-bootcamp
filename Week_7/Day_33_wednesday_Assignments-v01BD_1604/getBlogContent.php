<?php

if(isset($_POST['blog-link']) && $_POST['blog-link'] != '')
{
	$blog_url = $_POST['blog-link'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $blog_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	$website_page_contents = curl_exec($ch);
	echo $website_page_contents;
}

?>