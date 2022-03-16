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

function registerUser($username, $password, $email, $isNotif){
	
	databaseConn();
	$hashPass = password_hash($password, PASSWORD_BCRYPT);
	$sql = 'INSERT INTO users (username, password, email, isNotif) VALUES ( ? , ? , ?, ?)';
	if ($stmt->prepare($sql)) {
		$stmt->bind_param('iss', $username, $hashPass, $email, $isNotif);
		
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

function emailList(){

	databaseConn();
	$listArray = mysqli->query("SELECT email FROM users WHERE isNotif = 1");
	return $listArray;
	
}

function makeBracket($bracketName, $player1ID){
	
	databaseConn();
	$sql = 'INSERT INTO brackets (bracketName, player1ID, player1Score) VALUES ( ?, ?, 0 )';
	if ($stmt->prepare($sql)) {
		$stmt->bind_param('iss', $bracketName, $player1ID);
		
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
	$bracketArray = mysqli->query("SELECT * FROM brackets WHERE bracketName = '$bracketName'");
	return $bracketArray;
}

/*function addRace($raceName, $raceLocation, $raceDT){

	databaseConn();
	$sql = 'INSERT INTO races (raceName, raceLocation, raceDT) VALUES ( ? , ? , ?)';
	if ($stmt->prepare($sql)) {
		$stmt->bind_param('iss', $raceName, $raceLocation, $raceDT);
		
		if($stmt->execute()) {
			echo "Race added successfully.";
			return 1;
		}
		else {
			echo "There was an error adding this race.";
			return 0;
		}
	}
}

function getRaceDT($raceName){

	databaseConn();
	//code to retrieve the datetime from a race with the requested name
	return 1;
}*/

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
      return registerUser($request['username'], $request['password'], $request['email'], $request['isNotif']);
    case "EmailList":
      return emailList();
    case "MakeBracket":
      return makeBracket($request['bracketName']);
    case "GetBracket":
      return getBracket($request['bracketName']);
    /*case "AddRace":
      return addRace($request['raceName'], $request['raceLocation'], $request['raceDT']);
    case "GetRaceTime":
      return getRaceDT($request['raceName']);*/
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

