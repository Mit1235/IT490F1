#!/usr/bin/php
<?php

//requirements
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


//error logging lines
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"errorlog.txt");


//defunct database connection function 
//todo: make an easier way to connect to DB instead of function copy/paste
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


//function for registering a user to the DB
function registerUser($username, $password, $email, $isNotif){

	//databaseConn();
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
	
	//section to hash a password
	$hashPass = password_hash($password, PASSWORD_BCRYPT);
	$stmt = $conn->prepare("INSERT INTO users (username, password, email, isNotif) VALUES ( ? , ? , ?, ?)");
	$stmt->bind_param('sssi', $username, $hashPass, $email, $isNotif);
	$stmt->execute();
	$conn->close();
	
}


//function to log in a user
function doLogin($username, $password){

	//databaseConn();
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
	
	$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($hashPass);
	
	
	//verify password and return true or false
	while($stmt->fetch()) {
		if(password_verify($password, $hashPass)){
			echo "Login Successful.";
			return 1;
		}
		else{
			//log failed logins possibly
			echo "Username or Password incorrect.";
			return 0;
		}
	}
	$stmt->close();
	return 0;
	$conn->close();

}


//get a user ID from a username and email
function getID($username, $email) {

	//databaseConn();
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
	$hashPass = password_hash($password, PASSWORD_BCRYPT);
	$result = $conn->query("SELECT userID FROM users WHERE username = '$username' AND email = '$email'");
	$userID = $result->fetch_all();
	mysqli_free_result($result);
	print_r($userID);
	return $userID;
	$conn->close();
	
}

function emailList(){

	//databaseConn();
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
	$result = $conn->query("SELECT email FROM users WHERE isNotif = 1");
	$emailArray = $result->fetch_all();
	mysqli_free_result($result);
	print_r($emailArray);
	return $emailArray;
	$conn->close();
	
}


//function to make a new bracker with the first user 
function makeBracket($bracketName, $username){
	
	//databaseConn();
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
	$stmt = $conn->prepare("INSERT INTO brackets (bracketName, player1Name, player1Score) VALUES ( ?, ?, 0 )");
	$stmt->bind_param('ss', $bracketName, $username);
	$stmt->execute();
	return 1;
	$conn->close();
}


//get ALL data from a bracket based on name
function getBracket($bracketName){

	//databaseConn();
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
	$result = $conn->query("SELECT * FROM brackets WHERE bracketName = '$bracketName'");
	$bracketArray = $result->fetch_all();
	mysqli_free_result($result);
	return $bracketArray;
	$conn->close();
}


//add a player to a specific bracket off of their userID
function addPlayer($bracketName, $username){
	
	//databaseConn();
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
	
	//iterate through player slots until an empty one is found
	$result1 = $conn->query("SELECT player2Name FROM brackets WHERE bracketName = '$bracketName'");
	$player2Name = $result1->fetch_all();
	mysqli_free_result($result1);
	//print_r($player2Name);
	$result2 = $conn->query("SELECT player3Name FROM brackets WHERE bracketName = '$bracketName'");
	$player3Name = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player4Name FROM brackets WHERE bracketName = '$bracketName'");
	$player4Name = $result3->fetch_all();
	mysqli_free_result($result3);
	if ($player2Name[0][0] == '') {
		$sql = "UPDATE brackets SET player2Name = '$username' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			return 0;
		}
		return 1;
	}
	elseif ($player3Name[0][0] == '') {
		$sql = "UPDATE brackets SET player3Name = '$username' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		return 1;
	}
	elseif ($player4Name[0][0] == '') {
		$sql = "UPDATE brackets SET player4Name = '$username' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			return 0;
		}
		return 1;
	}
	else {
		echo "Error: Max players reached";
		return 0;
	}
	$conn->close();
	
}


//add drivers and pit crew to a certain player in a specific bracket
function addCrew($bracketName, $playerName, $driver1, $driver2, $pitCrew) {

	//databaseConn();
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
	
	//iterate through player slots until an empty one is found
	//todo: improve this
	$result1 = $conn->query("SELECT player1Name FROM brackets WHERE bracketName = '$bracketName'");
	$player1Name = $result1->fetch_all();
	mysqli_free_result($result1);
	$result2 = $conn->query("SELECT player2Name FROM brackets WHERE bracketName = '$bracketName'");
	$player2Name = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player3Name FROM brackets WHERE bracketName = '$bracketName'");
	$player3Name = $result3->fetch_all();
	mysqli_free_result($result3);
	$result4 = $conn->query("SELECT player4Name FROM brackets WHERE bracketName = '$bracketName'");
	$player4Name = $result4->fetch_all();
	mysqli_free_result($result4);
	if ($playerName == $player1Name[0][0]){
		$sql = "UPDATE brackets SET player1Driver1 = '$driver1', player1Driver2 = '$driver2', player1PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player2Name[0][0]) {
		$sql = $sql = "UPDATE brackets SET player2Driver1 = '$driver1', player2Driver2 = '$driver2', player2PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player3Name[0][0]){
		$sql = $sql = "UPDATE brackets SET player2Driver1 = '$driver1', player2Driver2 = '$driver2', player2PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player4Name[0][0]){
		$sql = $sql = "UPDATE brackets SET player2Driver1 = '$driver1', player2Driver2 = '$driver2', player2PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "Error: Player not in bracket";
		return 0;
	}
	return 1;
	$conn->close();
}


//update the score for a specific player in a specific bracket
function updateScore($bracketName, $playerName, $score){
	
	//databaseConn();
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
	
	//iterate through player slots until the correct one is found
	//todo: improve this
	$result1 = $conn->query("SELECT player1Name FROM brackets WHERE bracketName = '$bracketName'");
	$player1Name = $result1->fetch_all();
	mysqli_free_result($result1);
	$result2 = $conn->query("SELECT player2Name FROM brackets WHERE bracketName = '$bracketName'");
	$player2Name = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player3Name FROM brackets WHERE bracketName = '$bracketName'");
	$player3Name = $result3->fetch_all();
	mysqli_free_result($result3);
	$result4 = $conn->query("SELECT player4Name FROM brackets WHERE bracketName = '$bracketName'");
	$player4Name = $result4->fetch_all();
	mysqli_free_result($result4);
	if ($playerName == $player1Name[0][0]){
		$sql = "UPDATE brackets SET player1Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player2Name[0][0]){
		$sql = "UPDATE brackets SET player2Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player3Name[0][0]){
		$sql = "UPDATE brackets SET player3Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerName == $player4Name[0][0]){
		$sql = "UPDATE brackets SET player4Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "Error: Player not in bracket";
		return 0;
	}
	return 1;
	$conn->close();
}

//add a comment and a username to the database
function addComment($bracketName, $username, $commentText) {

	//databaseConn();
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
	$stmt = $conn->prepare("INSERT INTO comments (bracketName, username, commentText) VALUES (?,  ? , ?)");
	$stmt->bind_param('sss', $bracketName, $username, $commentText);
	$stmt->execute();
	return 1;
	$conn->close();

}

//get all the comments from the database
//todo: add more specific functions for getting comments if needed
function getComments($bracketName) {

	//databaseConn();
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
	$result = $conn->query("SELECT username, commentText FROM comments WHERE bracketName = '$bracketName'");
	$commentArray = $result->fetch_all();
	mysqli_free_result($result);
	//print_r($commentArray);
	return $commentArray;
	$conn->close();
}

function addVersion($versionName) {

	//databaseConn();
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
	$stmt = $conn->prepare("INSERT INTO versions (versionName) VALUES (?)");
	$stmt->bind_param('s', $versionName);
	$stmt->execute();
	
	$result = $conn->query("SELECT versionNo FROM versions WHERE versionName = '$versionName'");
	$versionNo = $result->fetch_all();
	mysqli_free_result($result);
	//print($versionNo[0][0]);
	return $versionNo[0][0];
	$conn->close();
	
}

function updateVersion($versionName, $workingStatus) {

	//databaseConn();
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
	$sql = "UPDATE versions SET workingStatus = $workingStatus WHERE versionName = '$versionName'";
	if ($conn->query($sql) === TRUE) {
		echo "Score updated successfully";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$result = $conn->query("SELECT versionName FROM versions WHERE workingStatus = 2");
	$versionNo = $result->fetch_all();
	mysqli_free_result($result);
	//print($versionNo[count($versionNo) - 1][0]);
	//echo count($versionNo);
	return $versionNo[count($versionNo) - 1][0];
	$conn->close();
	
	
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  //switch case for all the request types
  switch ($request['type'])
  {
    case "Login":
      return doLogin($request['username'],$request['password']);
    case "Register":
      return registerUser($request['username'], $request['password'], $request['email'], $request['isNotif']);
    case "GetID":
      return getID($request['username'], $request['email']);
    case "EmailList":
      return emailList();
    case "MakeBracket":
      return makeBracket($request['bracketName'], $request['username']);
    case "GetBracket":
      return getBracket($request['bracketName']);
    case "AddPlayer":
      return addPlayer($request['bracketName'], $request['username']); 
    case "AddCrew":
      return addCrew($request['bracketName'], $request['playerName'], $request['driver1'], $request['driver2'], $request['pitCrew']);
    case "UpdateScore":
      return updateScore($request['bracketName'], $request['playerName'], $request['score']);
    case "AddComment":
      return addComment($request['bracketName'], $request['username'], $request['commentText']);
    case "GetComments":
      return getComments($request['bracketName']);
    case "AddVersion":
      return addVersion($request['versionName']);
    case "UpdateVersion":
      return updateVersion($request['versionName'], $request['workingStatus']);
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

