  
  <?php 
  
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');

session_start();   



$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");


$request = array();
$request['type'] = 'Login';
$request['username'] = $_GET['username'];
$request['password'] = $_GET['password'];

$response = $client->send_request($request);
echo $response;

if($response == 1)
{
  header("Location: Create.html");
}
else
{
	echo "login failed";
}


    ?>
