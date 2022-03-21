  
  <?php 
  
    require_once('../path.inc');
    require_once('../get_host_info.inc');
    require_once('../rabbitMQLib.inc');
    require '../index.php';
    require_once('../testRabbitMQ.ini');


$username = $_POST['username'];
$password = $_POST['password'];

$request = array();
$request['type'] = 'login';
$request['username'] = $username;
$request['password'] = $password;

$client = new rabbitMQCLient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);
    ?>
