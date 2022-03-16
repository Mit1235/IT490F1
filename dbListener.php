<?php 

ini_set('display_errors', 'on');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__).'/home/parallels/git/IT490F1/IT490F1/errorlog.txt');

    logAndSendErrors();
    //Requried files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');

?>
