  
  <?php 
  
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require 'index.php';
    require_once('testRabbitMQ.ini');

    $username = "Mit";
    $password = "it490";

$request = array();
$request['type'] = 'Login';
$request['username'] = $username;
$request['password'] = $password;

$client = new rabbitMQCLient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);
echo $response;

if($response == 1)
{
	echo "logi worked theja add code to go to homepage here";
}
else
{
	echo "login failed";
}


    ?>
