#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$system = (string)readline('Which System do you want to deploy [DMZ][WEB][DB] ');

if($system == 'DMZ')
{


$ini = parse_ini_file('DMZ.ini');
$sship = $ini['IP'];
$filepath = $ini['PATH'];
$file1 = $ini['FILE1'];
$file2 = $ini['FILE2'];
$service = $ini['SERVICE'];

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


echo shell_exec("ssh mit490@172.27.122.48 zip -j '$response'.zip /home/mit490/git/IT490F1/$file1 ");
shell_exec("ssh mit490@172.27.122.48 scp -r '$response'.zip /home/mit490/deployment");
shell_exec("ssh mit490@172.27.122.48 scp -r /home/mit490/deployment/'$response'.zip '$sship':'$filepath'");  
shell_exec("ssh '$sship' unzip -o /home/mit/git/IT490F1/'$response'.zip -d '$filepath'");
shell_exec("echo Vmpass1 | ssh -tt '$sship' sudo systemctl restart '$service'.service");
}
elseif($system == 'DB'){


$ini = parse_ini_file('DB.ini');
$sship = $ini['IP'];
$filepath = $ini['PATH'];
$file1 = $ini['FILE1'];
$service = $ini['SERVICE'];

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



echo shell_exec("ssh zrt423@172.27.173.73 zip -j '$response'.zip /home/zrt423/git/IT490F1/$file1 ");
shell_exec("ssh zrt423@172.27.173.73 scp -r '$response'.zip /home/zrt423/deployment");
shell_exec("ssh zrt423@172.27.173.73 scp -r /home/zrt423/deployment/'$response'.zip '$sship':'$filepath'");
shell_exec("ssh '$sship' unzip -o /home/zrt423/git/IT490F1/'$response'.zip -d '$filepath'");
shell_exec("echo p@ssw0rd | ssh -tt '$sship' sudo systemctl restart '$service'.service");


}
elseif($system == 'WEB'){

$ini = parse_ini_file('WEB.ini');
$sship = $ini['IP'];
$filepath = $ini['PATH'];
$file1 = $ini['FILE1'];
$service = $ini['SERVICE'];

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
echo 'test';

//echo shell_exec("ssh mit490@172.27.122.48 cd /home/mit490/git/IT490F1/");
echo shell_exec("ssh theja@172.27.50.42 cd /home/desktop/git/IT490F1/; zip -r '$response'.zip $file1");
shell_exec("ssh theja@172.27.50.42 scp -r '$response'.zip /home/desktop/deployment");
shell_exec("ssh theja@172.27.50.42 scp -r /home/desktop/git/IT490F1/'$response'.zip '$sship':'$filepath'");
shell_exec("ssh '$sship' cd git/IT490F1");
shell_exec("ssh  '$sship' unzip -o /home/desktop/git/IT490F1/'$response'.zip -d '$filepath'");
shell_exec("echo Srirama12!! | ssh -tt '$sship' sudo systemctl restart '$service'.service");


}
?>

