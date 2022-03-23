<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


$bname = $_GET['name'];
//echo $bname;
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


echo "\n\n";
$client2 = new rabbitMQClient("testRabbitMQ.ini","testServer");

$request2 = array();
$request2['type'] = "GetBracket";
$request2['bracketName'] = $bname;
$response2 =  $client2->send_request($request2);

//print_r( $response2);
$counter =0;
$bracketname = $response2[0][1];
for ( $x = 0; $x < 4; $x++)
{
$driver1 = $response2[0][3+$counter];
$driver2 = $response2[0][4+$counter];
$userpoints = $response2[0][6+$counter];
$username = $response2[0][2+$counter]; 



 foreach($array['MRData']['RaceTable']['Races'] [0]['Results'] as &$value) {
            //echo "</br>";
            $drivername = $value['Driver']['givenName'];
            //echo "Driver Name: " .$drivername;
            //echo "</br>";
	    $points = $value['points'];
            //echo "Points: " .$points;
	    //echo "</br>";
	                        $points = intval($points);

	    if($drivername == $driver1)
	    {
		   	  
		    
		    $userpoints = $userpoints + intval($points);
		    
	    }
	     if($drivername == $driver2)
            {
                    $userpoints = $userpoints +intval( $points);
            }


 }
$counter += 5;
echo "</br>";
echo "Username: $username";
echo "</br>";
echo "Userpoints:  $userpoints";
echo "</br>";





}



//echo gettype($response);
//echo $argv[0]." END".PHP_EOL;








?>

