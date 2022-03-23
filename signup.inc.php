
<?php

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"/home/Desktop/git/IT490F1/errorlog.txt");


require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('testRabbitMQClient.php');

  function register($username, $password)
{

        $request = array();

        $request['type'] = "Register";
        $request['username'] = $_POST['$username'];
        $request['password'] = $_POST['$password'];

        $returnValue = Client($request);

        return $returnValue;
}

?>    
