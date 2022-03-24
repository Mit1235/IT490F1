<?php


require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log',"errorlog.txt");

$file = file_get_contents("errorlog.txt");

$client = new rabbitMQClient("log1.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "";
}

$request = array();
$request ['type'] = "Sarah";
$request['error_string'] =$file;
$response = $client->send_request($request);








?>

