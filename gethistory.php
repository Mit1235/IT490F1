<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("history.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "";
}

$request = array();
$request['type'] = "history";
$request['msg'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
//$response = json_encode($response, true);
$array = json_decode($response, true);

//print_r($response);
echo "\n\n";

 foreach($array['MRData']['RaceTable']['Races'] as &$value) {
            echo "</br>";
            $Season = $value['season'];
            echo "Season: " .$Season;
            echo "</br>";
            $RaceName = $value['raceName'];
            echo "Name: ".$RaceName;
            echo "</br>";
            $Country = $value['Circuit']['circuitName'];
            echo "Circuit Name: ".$Country;
            echo "</br>";
            $lat = $value['Circuit']['Location']['lat'];
            echo "lat: " .$lat;
            echo "</br>";
            $long = $value['Circuit']['Location']['long'];
            echo "long: " .$long;
            echo "</br>";
            $locality = $value['Circuit']['Location']['locality'];
            echo "locality: " .$locality;
            echo "</br>";

            $date = $value['date'];
            echo "Date: ".$date;
            echo "</br>";
            $time = $value['time'];
            echo "Time: " .$time;
            echo "</br>";
            foreach($array['MRData']['RaceTable']['Races'][0]['Results'] as &$value) {
            $number = $value['number'];
            echo "Number: " .$number;
            echo "</br>";
            $position = $value['position'];
            echo "position: " .$position;
            echo "</br>";
            $drivername = $value['Driver']['givenName'];
            echo "Driver Name: " .$drivername;
            echo "</br>";
            $constructor = $value['Constructor']['constructorId'];
            echo "constructor: " .$constructor;
            echo "</br>";
            $grid = $value['grid'];
            echo "grid: " .$grid;
            echo "</br>";

            $speed = $value['FastestLap']['AverageSpeed']['speed'];
            echo "Drivers Average Speed in KPH: " .$speed;
            echo "</br>";
            echo "</br>";
	    }
 }

echo gettype($response);
echo $argv[0]." END".PHP_EOL;








?>

