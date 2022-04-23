#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$name = (string)readline('Enter Name of File to be added to database and deployed: ');
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
echo $name;        
$request = array();
$request['type'] = "AddVersion";
$request['versionName'] = $name;


$response = $client->send_request($request);
//$response = $client->publish($request);

 echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;                                                                                                                                
echo shell_exec("zip -r '$response'.zip historicaldata.php");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip /home/mit490/deployment");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip mit@172.27.223.55:/home/mit/git/IT490F1/");  
shell_exec("ssh mit@172.27.233.55 cd git/IT490F1");
shell_exec("ssh  mit@172.27.223.55 unzip -o /home/mit/git/IT490F1/'$response'.zip");
shell_exec("echo Vmpass1 | ssh -tt mit@172.27.223.55 sudo systemctl restart dmz.service");

?>

