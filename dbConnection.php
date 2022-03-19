<?php

//include('errorlog.php');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/parallels/git/IT490F1/IT490F1/errorlog.txt');

function dbConnection()
{
	// Server and User Info
	$hostname  = "172.27.122.48";
	$username  = "test";
	$password  = "test";
	$dbname    = "testHost";

	$conn = mysqli_connect($hostname, $username, $password, $dbname);

	if (!$conn)
	{
		echo "ERROR! Could not connect to database ".$conn->connect_errno.PHP_EOL;
		exit(1);
	}
	return $conn;
}
?>
