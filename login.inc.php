  
  <?php 
  
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');

session_start();   



$client = new rabbitMQCLient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);
echo $response;


$request = array();
$request['type'] = 'Login';
$request['username'] = $_GET['username'];
$request['password'] = $_GET['password'];


if($response == 1)
{
  header("Location: Create.php");
}
else
{
	echo "login failed";
}


    ?>
