
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('index.php');
require_once('testRabbitMQ.ini');

    $email = 'test@test.com'; //$_POST['email'];
    $password = 'password'; //$_POST['password'];  
    $username = 'tester';  // $_POST['username'];
//    $hash = password_hash($password, password_default, $options);
    $isNotif = 0; //$_POST[''];
    

   $client = new rabbitMQClient('testRabbitMQ.ini','testServer');

        $request = array();
        $request['type'] = "Register";
        $request['email'] = $email;
        $request['username'] = $username;
        $request['password'] = $password;
        $request['isNotif'] = $isNotif;

        $response = $client->send_request($request);



?>    
