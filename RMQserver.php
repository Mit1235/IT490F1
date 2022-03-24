<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'errorlog.txt');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


$errors = file_get_contents("errorlog.txt");

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Mit":
      return "Works";//history($request['msg']);
  }
  return array("worked");
}




$server = new rabbitMQServer("history.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();


?>
