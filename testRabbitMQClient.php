#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');



$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
        $request = array();
        $request['type'] = "Register";
        $request['email'] = 'johndoe@gmail.com';
        $request['username'] ="johndoe";
	$request['password'] ="johndoe";
	$request['isNotif'] = '1';
       


	$response = $client->send_request($request);
	//$response = $client->publish($request);

		echo "client received response: ".PHP_EOL;
		print_r($response);
		echo "\n\n";
		echo $argv[0]." END".PHP_EO;

