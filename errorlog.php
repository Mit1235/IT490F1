<?php

display_errors = on
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '~git/IT490F1/IT490F1/errorlog.txt');
php_value error_log log/errorlog.txt

error_reporting(E_ALL & ~E_WARNING & ~E_CORE_WARNING & ~E_COMPILE_WARNING & ~E_USER_WARNING);

php_flag display_errors on 




?>



<?php

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
