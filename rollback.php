#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$status = (string)readline('Is this working yes[y] to deploy to prod  or no[n] to roll back: ');
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$request = array();
$request['type'] = "LatestVersion";
$response = $client->send_request($request);
print_r($response);
 

$client2 = new rabbitMQClient("testRabbitMQ2.ini","testServer");

if ($status == 'y'){
echo "working";
$request2 = array();
$request2['type'] = "UpdateVersion";
$request2['workingStatus'] = 2;
$response = $client2->send_request($request2);
print_r($response);
echo "work";
shell_exec("zip -r '$response'.zip historicaldata.php");
shell_exec("scp -r /home/mit/git/IT490F1/'$response'.zip /home/mit/deployment");
shell_exec("scp -r /home/mit/git/IT490F1/'$response'.zip mit@127.27.22.155:/home/mit/git/IT490F1/");
shell_exec("ssh mit@127.27.22.155 cd git/IT490F1");
shell_exec("ssh mit@127.27.22.155 unzip -o /home/mit/git/IT490F1/'$response'.zip");
shell_exec("echo Vmpass1 | ssh -tt mit@127.27.22.155 sudo systemctl restart dmz.service");


}

else if ($status == 'n'){
echo "not";	
$request2 = array();
$request2['type'] = "UpdateVersion";
$request2['versionName'] = 0;
$response = $client2->send_request($request2);
echo "not2";

$client2 = new rabbitMQClient("testRabbitMQ3.ini","testServer");

$request3 = array();
$request3['type'] = "LatestWorkingVersion";
$response3 = $client2->send_request($request3);

shell_exec("ssh mit490@172.27.122.48 scp -r /home/mit490/deployment/'$response3'.zip mit@172.27.223.55:/home/mit/git/IT490F1/");
shell_exec("unzip -o /home/mit/git/IT490F1/'$response3'.zip");
shell_exec("echo Vmpass1 | sudo systemctl restart dmz.service");
echo $response3;

}







/*
echo shell_exec("zip -r '$response'.zip historicaldata.php");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip /home/mit490/deployment");
shell_exec("scp -r /home/mit490/git/IT490F1/'$response'.zip mit@172.27.223.55:/home/mit/git/IT490F1/");
shell_exec("ssh mit@172.27.233.55 cd git/IT490F1");
shell_exec("ssh  mit@172.27.223.55 unzip -o /home/mit/git/IT490F1/'$response'.zip");
shell_exec("echo Vmpass1 | ssh -tt mit@172.27.223.55 sudo systemctl restart dmz.service");
 */
echo "test";
?>
