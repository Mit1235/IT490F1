
<?php
require_once('../rabbitmqphp_example/path.inc');
require_once('../rabbitmqphp_example/get_host_info.inc');
require_once('../rabbitmqphp_example/rabbitMQLib.inc');
require_once('testRabbitMQClient.php');


    function signup($firstname, $lastname, $username, $password,$email){        
        $request = array();
        $request['type'] = "Signup";
        $request['firstname'] = $firstname;
        $request['lastname'] = $lastname;
        $request['email'] = $email;
        $request['username'] = $username;
        $request['password'] = $password;
        $data = Client($request);
        if($data == 1){
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
        }else{
            session_destroy();
        }
        return $data;
    }



?>    
