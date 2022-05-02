#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$ini = parse_ini_file('DMZ.ini');
$sship = $ini['IP'];
$filepath = $ini['PATH'];
$file1 = $ini['FILE1'];




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
echo shell_exec("zip -r '$response'.zip '$file1'");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip /home/mit490/deployment");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip '$sship':'$filepath'");  
shell_exec("ssh '$sship' cd git/IT490F1");
shell_exec("ssh  '$sship' unzip -o /home/mit/git/IT490F1/'$response'.zip -d '$filepath'");
shell_exec("echo Vmpass1 | ssh -tt '$sship' sudo systemctl restart dmz.service");

?>

