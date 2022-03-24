<?php

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"/home/parallels/git/IT490F1/IT490F1/errorlog.txt");


function logger($log){
	if(!file_exists('/home/parallels/git/IT490F1/IT490F1/errorlog.txt')){
		file_put_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt', '');
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('EST');
	$time = date('m/d/y h:iA', time());
	$contents = file_get_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt');

	$contents .= "$ip\t$time\t$log\r";

	file_put_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt', $contents);

file_put_contents ("/home/parallels/git/IT490F1/IT490F1/errorlog.txt", $returnedValue, FILE_APPEND);


}
?>
