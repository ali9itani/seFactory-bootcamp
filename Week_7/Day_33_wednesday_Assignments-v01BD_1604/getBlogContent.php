<?php
$website_page_contents = '';

if(isset($_POST['blog-link']) && $_POST['blog-link'] != '')
{
	$blog_url = $_POST['blog-link'];
	$website_page_contents = file_get_contents($blog_url);
}



echo $website_page_contents;
?>