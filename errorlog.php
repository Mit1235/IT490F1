<?php
// Send error message to the server log if error connecting to the database
if (!mysqli_connect("localhost","bad_user","bad_password","my_db")) {
    error_log("Failed to connect to database!", 0);
}

// Send email to administrator if we run out of FOO
if (!($foo = allocate_new_foo())) {
    error_log("Oh no! We are out of FOOs!", 1, "IT490F1Virgo@gmail.com");


ini_set('log_errors', 1);

try{
	if(true){
		throw new Exception("Something failed", 900);
	}
}

catch (Exception $e) {
	$datetime = new DateTime();
	$datetime->setTimezone(new DateTimeZone('UTC'));
	$logEntry = $datetime->format('Y/m/d H:i:s') . ‘ ‘ . $e;
	
	// log to default error_log destination
	error_log($logEntry);
	
	//Email or notice someone
	}
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_ERROR);


}?>
