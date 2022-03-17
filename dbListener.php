<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'on');

// setting error logging to be active
ini_set('log_errors', 'On');
ini_set('error_log', dirname(__FILE__).'/home/parallels/git/IT490F1/IT490F1/errorlog.txt');

// PHP code for logging error into a given file
// error message to be logged
$error_message = "This is an error message!";

// path of the log file where errors need to be logged
$log_file = "'/home/parallels/git/IT490F1/IT490F1/errorlog.txt'";



// setting the logging file in php.ini
ini_set('error_log', $log_file);

// logging the error
error_log($error_message);

errorReporting();

//Requried files
require_once('/home/parallels/git/IT490F1/IT490F1/path.inc');
require_once('/home/parallels/git/IT490F1/IT490F1/get_host_info.inc');
require_once('/home/parallels/git/IT490F1/IT490F1/rabbitMQLib.inc');
require_once('dbFunctions.php');

function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);
        
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
	}

	$response_msg = file_get_contents('errorlog.txt', $request['error_string'], FILE_APPEND);
	$dist_msg = file_get_contents('errorlog.txt');
	echo "outcome:" .$response_msg;
	break;

}

$server = new RabbitMQServer('log1.ini');
echo "Error in Database Server START\N";
$server->process_requests('requestProcessor');

?>
