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
	$stmt = $conn->prepare("INSERT INTO users (username, password, email, isNotif) VALUES ( ? , ? , ?, ?)");
	$stmt->bind_param('sssi', $username, $hashPass, $email, $isNotif);
	$stmt->execute();
	$conn->close();
	
}

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
	$conn->close();

}

function getID($username, $password) {

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
	$result = $conn->query("SELECT userID FROM users WHERE username = '$username'");
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

function makeBracket($bracketName, $playerID){
	
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
	$stmt = $conn->prepare("INSERT INTO brackets (bracketName, player1ID, player1Score) VALUES ( ?, ?, 0 )");
	$stmt->bind_param('si', $bracketName, $playerID);
	$stmt->execute();
	$conn->close();
}

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

function addPlayer($bracketName, $playerID){
	
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
	$result1 = $conn->query("SELECT player2ID FROM brackets WHERE bracketName = '$bracketName'");
	$player2ID = $result1->fetch_all();
	mysqli_free_result($result1);
	$result2 = $conn->query("SELECT player3ID FROM brackets WHERE bracketName = '$bracketName'");
	$player3ID = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player4ID FROM brackets WHERE bracketName = '$bracketName'");
	$player4ID = $result3->fetch_all();
	mysqli_free_result($result3);
	if (is_null($player2ID[0])) {
		$sql = "UPDATE brackets SET player2ID = $playerID WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			return false;
		}
		return true;
	}
	elseif (is_null($player3ID[0])) {
		$sql = "UPDATE brackets SET player3ID = $playerID WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		return true;
	}
	elseif (is_null($player4ID[0])) {
		$sql = "UPDATE brackets SET player4ID = $playerID WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Player added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			return false;
		}
		return true;
	}
	else {
		echo "Error: Max players reached";
		return false;
	}
	$conn->close();
	
}

function addCrew($bracketName, $playerID, $driver1, $driver2, $pitCrew) {

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
	$result1 = $conn->query("SELECT player1ID FROM brackets WHERE bracketName = '$bracketName'");
	$player1ID = $result1->fetch_all();
	mysqli_free_result($result1);
	$result2 = $conn->query("SELECT player2ID FROM brackets WHERE bracketName = '$bracketName'");
	$player2ID = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player3ID FROM brackets WHERE bracketName = '$bracketName'");
	$player3ID = $result3->fetch_all();
	mysqli_free_result($result3);
	$result4 = $conn->query("SELECT player4ID FROM brackets WHERE bracketName = '$bracketName'");
	$player4ID = $result4->fetch_all();
	mysqli_free_result($result4);
	if ($playerID == $player1ID[0]){
		$sql = "UPDATE brackets SET player1Driver1 = '$driver1', player1Driver2 = '$driver2', player1PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player2ID[0]) {
		$sql = $sql = "UPDATE brackets SET player2Driver1 = '$driver1', player2Driver2 = '$driver2', player2PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player3ID[0]){
		$sql = $sql = "UPDATE brackets SET player2Driver1 = '$driver1', player2Driver2 = '$driver2', player2PitCrew = '$pitCrew' WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Crew added successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player4ID[0]){
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
		return false;
	}
	return true;
	$conn->close();
}

function updateScore($bracketName, $playerID, $score){
	
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
	$result1 = $conn->query("SELECT player1ID FROM brackets WHERE bracketName = '$bracketName'");
	$player1ID = $result1->fetch_all();
	mysqli_free_result($result1);
	$result2 = $conn->query("SELECT player2ID FROM brackets WHERE bracketName = '$bracketName'");
	$player2ID = $result2->fetch_all();
	mysqli_free_result($result2);
	$result3 = $conn->query("SELECT player3ID FROM brackets WHERE bracketName = '$bracketName'");
	$player3ID = $result3->fetch_all();
	mysqli_free_result($result3);
	$result4 = $conn->query("SELECT player4ID FROM brackets WHERE bracketName = '$bracketName'");
	$player4ID = $result4->fetch_all();
	mysqli_free_result($result4);
	if ($playerID == $player1ID[0]){
		$sql = "UPDATE brackets SET player1Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player2ID[0]){
		$sql = "UPDATE brackets SET player2Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player3ID[0]){
		$sql = "UPDATE brackets SET player3Score = $score WHERE bracketName = '$bracketName'";
		if ($conn->query($sql) === TRUE) {
			echo "Score updated successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	elseif ($playerID == $player4ID[0]){
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
		return false;
	}
	return true;
	$conn->close();
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
    case "GetID":
      return getID($request['username'], $request['password']);
    case "EmailList":
      return emailList();
    case "MakeBracket":
      return makeBracket($request['bracketName']);
    case "GetBracket":
      return getBracket($request['bracketName']);
    case "AddPlayer":
      return addPlayer($request['bracketName'], $request['playerID']); 
    case "AddCrew":
      return addCrew($request['bracketName'], $request['playerID'], $request['driver1'], $request['driver2'], $request['pitCrew']);
    case "UpdateScore":
      return updateScore($request['bracketName'],$request['playerID'],$request['score']);
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
