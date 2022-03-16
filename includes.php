<?php

function logger($log){
	if(!file_exists('/home/parallels/git/IT490F1/IT490F1/errorlog.txt')){
		file_put_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt', '');
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('America');
	$time = date('m/d/y h:iA', time());
	$contents = file_get_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt');

	$contents .= "$ip\t$time\t$log\r";

	file_put_contents('/home/parallels/git/IT490F1/IT490F1/errorlog.txt', $contents);
}
?>
