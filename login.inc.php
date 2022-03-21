  
  <?php 
  
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require 'index.php';
    require_once('testRabbitMQ.ini');



$request = array();
$request['type'] = 'Login';
$request['username'] = $username;
$request['password'] = $password;

$client = new rabbitMQCLient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);
    ?>
