<?php
require_once __DIR__ .'/logtrans/src/vendor/autoload.php';
require_once 'config.php';

if(isset($_POST['text']) && $_POST['text'] != '')
{
	$text = $_POST['text'];
	$summary_result = '';

	//initilaizing aylien api
	$textapi = new AYLIEN\TextAPI(AYLIEN_ID, AYLIEN_KEY);

	//get summary from alien website and put it in result
	$summary = $textapi->Summarize(array('text' => $text, 'title' => 'my title', 'sentences_number' => 3));
	foreach ($summary->sentences as $sentece) {
		$summary_result .= $sentece."\n";
	}
	
	echo $summary_result;
}






?>