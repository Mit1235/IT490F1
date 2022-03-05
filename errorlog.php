<?php
// Send error message to the server log if error connecting to the database
if (!mysqli_connect("localhost","bad_user","bad_password","my_db")) {
    error_log("Failed to connect to database!", 0);
}


ini_set('log_errors', 1);

try{
	if(true){
		throw new Exception("Something failed", 900);
	}
}

catch (Exception $e) {
	$datetime = new DateTime();
	$datetime->setTimezone(new DateTimeZone('EST'));
	$logEntry = $datetime->format('Y/m/d H:i:s') . ‘ ‘ . $e;
	
	// log to default error_log destination
	error_log($logEntry);
	
	//Email or notice someone
	}

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_ERROR);

// Report simple running errors
// Report all PHP errors
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);



}?>
