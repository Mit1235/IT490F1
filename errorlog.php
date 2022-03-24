<?php

//  Required files

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


//include('dbListener.php');
//include('dbFunctions.php');
//include('index.php');
//include('includes.php');
//include('errorlog.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log',"errorlog.txt");
$errorLog = ini_get('errorlog.txt');

//this is what reads the local files


$file = fopen("errorlog.txt","w");
fwrite($file, $errorLog);
$errorArray = [];

$client = new rabbitMQClient("log1.ini","errorExchange");

$request = array();
$request ['type'] = "error";
$request['error_string'] =$file;
$response = $client->send_request($request);


function our_errors($errorMessage){
	$errorLog = fopen("errorlog.txt", "a");
        fwrite($errorLog, $errorMessage);
	fclose($errorLog);
}
file_put_contents ("errorlog.txt", FILE_APPEND);               


?>
