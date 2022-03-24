<?php

error_reporting(E_ALL);
ini_set('display_errors', 'off');
ini_set('log_errors', 'On');
ini_set('error_log', 'errorlog.txt');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function requestProcessor($request){


	echo $request['type']; 
        var_dump($request);	
	switch($request['type'])
	{
		case "Mit":
			echo "works";
			break;
	}
	



}
$server = new rabbitMQServer("testExchange.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();


?>
