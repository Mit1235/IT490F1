#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function databaseConn(){
	$servername = "localhost";
	$dbusername = "it490";
	$dbpassword = "p@ssw0rd";
	$dbname = "IT490F1";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		echo "SQL Connection Successful\n";
	}
}

function registerUser($username, $password, $email){
	
	databaseConn();
	$hashPass = password_hash($password, PASSWORD_BCRYPT);
	$sql = 'INSERT INTO users (username, password, email) VALUES ( ? , ? , ?)';
	if ($stmt->prepare($sql)) {
		$stmt->bind_param('iss', $username, $hashPass, $email);
		
		if($stmt->execute()) {
			echo "User added successfully.";
			return 1;
		}
		else {
			echo "There was an error adding this user.";
			return 0;
		}
	}
	
	
}

function doLogin($username, $password){

	databaseConn();
	$stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($hashPass);
	
	while($stmt->fetch()) {
		if(password_verify($password, $hashPass)){
			echo "Login Successful.";
			return true;
		}
		else{
			//log failed logins possibly
			echo "Username or Password incorrect.";
			return false;
		}
	}
	$stmt->close();
	return false;

}

function makeBracket($bracketName){
	
	databaseConn();
	$sql = 'INSERT INTO brackets (bracketName) VALUES ( ? )';
	if ($stmt->prepare($sql)) {
		$stmt->bind_param('iss', $bracketName);
		
		if($stmt->execute()) {
			echo "Bracket added successfully.";
			return 1;
		}
		else {
			echo "There was an error adding this bracket.";
			return 0;
		}
	}
}

function getBracket($bracketName){

	databaseConn();
	//code to retrieve all data from a bracket with the requested name
	return 1;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return doLogin($request['username'],$request['password']);
    case "Register":
      return registerUser($request['username'],$request['password'],$request['email']);
    case "MakeBracket":
      return makeBracket($request['bracketName']);
    case "GetBracket":
      return getBracket($request['bracketName']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

