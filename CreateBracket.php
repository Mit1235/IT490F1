<?php

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');

session_start();   


$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

$request = array();
$request['type'] = 'MakeBracket';
$request['bracketName'] = $_GET['bracketName'];
$request['username'] = $_GET['username'];

$response = $client->send_request($request);
echo $response;
?>