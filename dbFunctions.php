<?php

error_reporting(E_ALL);
ini_set('display_errors', 'off');
ini_set('log_errors', 'On');
ini_set('error_log', dirname(__FILE__).'/../logging/errorlog.txt');

    logAndSendErrors();
    //Requried files
    require_once('/home/parallels/git/IT490F1/IT490F1/path.inc');
    require_once('/home/parallels/git/IT490F1/IT490F1/get_host_info.inc');
    require_once('/home/parallels/git/IT490F1/IT490F1/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('dbConnection.php');

    //Error loggon
    function logAndSendErrors(){

        $file = fopen("/home/parallels/git/IT490F1/IT490F1/errorlog.txt","r");
        $errorArray = [];
        while(! feof($file)){
            array_push($errorArray, fgets($file));
        }
        for($i = 0; $i < count($errorArray); $i++){
            echo $errorArray[$i];
            echo "<br>";
        }

        fclose($file);


        $request = array();
        $request['type'] = "frontend";  
        $request['error_string'] = $errorArray;
        $returnedValue = createClientForRmq($request);

        $fp = fopen("../logging/logHistory.txt", "a");
        for($i = 0; $i < count($errorArray); $i++){
            fwrite($fp, $errorArray[$i]);
        }

        file_put_contents("/home/parallels/git/IT490F1/IT490F1/errorlog.txt", "");


    }
?>
