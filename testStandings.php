#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');




$client = new rabbitMQClient("history.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
        $request = array();
        $request['type'] = "history";



        $response = $client->send_request($request);
        //$response = $client->publish($request);

                echo "client received response: ".PHP_EOL;
                print_r($response);
                echo "\n\n";

