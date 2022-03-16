<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://ergast.com/api/f1/2022.json',
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
        //echo "<br>";
        //$RaceName = $value['raceName'];
       // echo "Race Name: ".$RaceName;
        //echo "<br>";
       // $Country = $value['Circuit']['circuitName'];
       // echo "Circuit Name: ".$Country;
	
	//echo "<br>";
	    
	    $date = $value['date'];
	    
	    //echo "Date: ".$date;
	//echo "<br>";
	    $time = $value['time'];

	$dateA = "$date $time";
	    echo $dateA;
	$dateB = "2022-03-16 12:12:12";
	   $timediff = strtotime($dateA) - strtotime($dateB);

	   if($timediff > 86400){
		   echo 'more than 24 hours';
	   }
	   else
	   {
		   echo 'less than 24 hours';
	   }
	   echo PHP_EOL;



   //     echo "Time: ".$time;
 //       echo "<br>";
    }


}


//$response = new SimpleXMLElement($MRData);
//echo gettype($response);

//echo $response->$response[1];

?>
