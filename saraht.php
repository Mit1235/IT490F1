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
       $request['type'] = "GetComments";
        $request['bracketName'] = "TestBracket";

$response = $client->send_request($request);
        print_r($response);
echo "<table>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Comment</th>";
echo "</tr>";

foreach ($response as &$inner){
	echo "<tr>";
	echo "<th>$inner[0]</th>";
	echo "<th>$inner[1]</th>";
	echo "</tr>";

}
echo "</table>";

?>
