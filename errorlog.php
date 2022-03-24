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
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"errorlog.txt");
$displayErrors = ini_get('display_errors');
$errorLog = ini_get('error_log',"errorlog.txt");
$errorMessage('This is an error');

//this is what reads the local files


$file = file_get_contents("errorlog.txt");
$fwrite($file, $errorLog, $displayErrors);
$errorArray = [];
$request = array();
$request ['type'] = "IT490F1";
$request['error_string'] =$file;

function our_errors($errorMessage){
	$errorLog = fopen("errorlog.txt", "a");
        fwrite($errorLog, $errorMessage);
	fclose($errorLog);
}
file_put_contents ("errorlog.txt", FILE_APPEND);               


?>
