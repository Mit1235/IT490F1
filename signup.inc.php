
<?php

require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');
require_once('../index.php');
require_once('../testRabbitMQ.ini');

    $email = $_POST['email'];
    $password = $_POST['password'];  
    $username = $_POST['username'];
    $hash = password_hash($password, password_default, $options);
    $isNotif = $_POST[''];
    

        $request = array();
        $request['type'] = "Register";
        $request['email'] = $email;
        $request['username'] = $username;
        $request['password'] = $password;
        $request['type'] = $isNotif

        $response = $client->send_request($request);



?>    
