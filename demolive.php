<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://ergast.com/api/f1/current/last/results.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {

    $array = json_decode( $response,true);

    foreach($array['MRData']['RaceTable']['Races'] as &$value) {
            echo PHP_EOL;
	    $Season = $value['season'];
	    echo "Season: " .$Season;
	    echo PHP_EOL;  
	    $RaceName = $value['raceName'];
            echo "Race Name: ".$RaceName;
            echo PHP_EOL;
            $Country = $value['Circuit']['circuitName'];
            echo "Circuit Name: ".$Country;
	    echo PHP_EOL;
	    $lat = $value['Circuit']['Location']['lat'];
	    echo "lat: " .$lat;
	    echo PHP_EOL;
	    $long = $value['Circuit']['Location']['long'];
	    echo "long: " .$long;
	    echo PHP_EOL;
	    $locality = $value['Circuit']['Location']['locality'];
            echo "locality: " .$locality;
	    echo PHP_EOL;

            $date = $value['date'];
            echo "Date: ".$date;
	    echo PHP_EOL;
            $time = $value['time'];
	    echo "Time: " .$time;
	    echo PHP_EOL;
	    foreach($array['MRData']['RaceTable']['Races'][0]['Results'] as &$value) {
	    $number = $value['number'];
	    echo "Number: " .$number;
	    echo PHP_EOL;
	    $position = $value['position'];
            echo "position: " .$position;
	    echo PHP_EOL; 
	    $drivername = $value['Driver']['givenName'];
            echo "Driver Name: " .$drivername;
	    echo PHP_EOL;
            $constructor = $value['Constructor']['constructorId'];
            echo "constructor: " .$constructor;
	    echo PHP_EOL;
	    $grid = $value['grid'];
            echo "grid: " .$grid;
	    echo PHP_EOL;

	    $speed = $value['FastestLap']['AverageSpeed']['speed'];
            echo "Drivers Average Speed in KPH: " .$speed;
            echo PHP_EOL;
	    echo PHP_EOL;
	    
	    
	    }

    }


}



?>





