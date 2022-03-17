<?php

//incldue('includes.php');

error_reporting(E_ALL & ~E_WARNING & ~E_CORE_WARNING & ~E_COMPILE_WARNING & ~E_USER_WARNING);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"/home/parallels/git/IT490F1/IT490F1/errorlog.txt");

$file = file_get_contents("/home/parallels/git/IT490F1/IT490F1/errorlog.txt");
$errorArray = [];
$request = array();
$request ['type'] = "parallels";
$request['error_string'] =$file;

$returnedValue = createClient($request);


file_put_contents ("/home/parallels/git/IT490F1/IT490F1/errorlog.txt", $returnedValue, FILE_APPEND);

//  Requireing required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


//require_once('../php/rabbitMQClient.php');

$file = fopen("/home/parallels/git/IT490F1/IT490F1/errorlog.txt","r");
$errorArray = [];
while(! feof($file)){
	array_push($errorArray, fgets($file));
}

fclose($file);
$request = array();
$request['type'] = "dmz";  
$request['error_string'] = $errorArray;
$returnedValue = createClient($request);

$fp = fopen("/home/parallels/git/IT490F1/IT490F1/errorlog.txt", "a");
for($i = 0; $i < count($errorArray); $i++){
	fwrite($fp, $errorArray[$i]);
    }

file_put_contents("/home/parallels/git/IT490F1/IT490F1/errorlog.txt", "");

function createClient($request){
	$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
	if(isset($argv[1])){
		$msg = $argv[1];
	}
	else{
		$msg = "client";
            }
	$response = $client->send_request($request);
	return $response;
}

?> 
