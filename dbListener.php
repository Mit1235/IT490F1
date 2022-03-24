<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'errorlog.txt');

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

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
	case "errors":
		echo "Errors";
		$response_msg = file_get_contents('errorlog.txt', $request['error_string'], FILE_APPEND);
		
	}

	echo $response_msg;
	return $response_msg;

}


$server = new RabbitMQServer('log1.ini', 'errorExchange');
echo "started";
$server->process_requests('requestProcessor');


?>
