<?php

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');

session_start();   


$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

$request = array();
$request['type'] = 'AddCrew';
$request['playerName'] = $_GET['playerName'];
$request['bracketName'] = $_GET['bracketName'];
$request['driver1'] = $_GET['driver1'];
$request['driver2'] = $_GET['driver2'];
$request['pitCrew'] = $_GET['pitCrew'];


$response = $client->send_request($request);
echo $response;
?>