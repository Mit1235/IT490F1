
<?php
require_once('../rabbitmqphp_example/path.inc');
require_once('../rabbitmqphp_example/get_host_info.inc');
require_once('../rabbitmqphp_example/rabbitMQLib.inc');
require_once('testRabbitMQClient.php');

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];  
    $username = $_POST['username'];
    $hash = password_hash($password, password_default, $options);
    

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
