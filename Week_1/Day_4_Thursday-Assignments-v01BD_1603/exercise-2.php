<?php

$path = "/var/log/apache2/access.log";
$contents = file($path);
$contents[0];

foreach($contents as $line) {
    // extracting ip only from log
    $ip = substr($line , 0 , strpos ($line , "-"));
    echo $ip."-- ";
    $line = substr($line , strpos ($line , "-")+3 );
    $date_time = substr($line , 2 , strpos ($line , "]")-2);
    $date_time = substr( $date_time , 0, strrpos ( $date_time , " "));
    $date = substr( $date_time, 0 , count($date_time)-10);
    $time = substr( $date_time, 12 );
    // from 15:23:50 21/Jul/2016 to  15-23-50 
    $time = str_replace(':', '-', $time );
    // from 21/Jul/2016 to Friday, July 22 2016 
    echo date("l, F j Y" , strtotime(str_replace('/', '-', $date)));
    echo " : ".$time." -- ";
    $line = substr($line , strpos ($line , "\""));
    //since response code is alway 3 chars + 8 (htt..) + 2  spaces
    $response = substr($line , 0, strpos ($line , "HTTP/1.1" )+13);
    echo $response."\n";
}

?>