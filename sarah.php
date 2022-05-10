<?php

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"/home/Desktop/git/IT490F1/errorlog.txt");


    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');


session_start();

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");


  $request = array();
       $request['type'] = "AddComment";
        $request['Bracket_Name'] = $_GET['Bracket_Name'];
        $request['comment_author'] = $_GET['comment_author'];
        $request['comment'] = $_GET['comment'];

$response = $client->send_request($request);
        echo $response;

echo "hi";

?>
