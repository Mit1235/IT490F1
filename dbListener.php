<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/parallels/IT490F1/IT490F1/errorlog.txt');

//Requried files
require_once('/home/parallels/git/IT490F1/IT490F1/path.inc');
require_once('/home/parallels/git/IT490F1/IT490F1/get_host_info.inc');
require_once('/home/parallels/git/IT490F1/IT490F1/rabbitMQLib.inc');
require_once('/home/parallels/git/IT490F1/IT490F1/errorlog.php');

function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);
        
	if(!isset($request['type']))
	{
            return array('message'=>"ERROR: Message type is not supported");
	}

	switch($request['type'])
	{
	case "parallels":
		echo "Errors";
		$response_msg = file_get_contents('errorlog.txt', $request['error_string'], FILE_APPEND);
		
	}

	echo $response_msg;
	return $response_msg;

}

$server = new RabbitMQServer('log1.ini', 'testserver');
echo "Error in Database Server START\N";
$server->process_requests('requestProcessor');

?>
