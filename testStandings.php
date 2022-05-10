<?php 


$client = new rabbitMQClient("history.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
        $request = array();
        $request['type'] = "driverStanding";



        $response = $client->send_request($request);
        //$response = $client->publish($request);

                echo "client received response: ".PHP_EOL;
                print_r($response);
                echo "test";



		$array = json_decode($response, true);

			foreach($array['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as &$value) {

                        $Driver = $value['Driver']['givenName'];
                        echo "First Name: " .$Driver;
                        echo "</br>";

                        $lastName = $value['Driver']['familyName'];
                        echo "Last Name: " .$lastName;
                        echo "</br>";


			$Position = $value['position'];
                        echo "Position: " .$Position;
                        echo "</br>";

                        $wins = $value['wins'];
                        echo "Wins: " .$wins;
                        echo "</br>";
                        
                        $points = $value['points'];
                        echo "Points: " .$points;
                        echo "</br>";

			echo "</br>";
			
			
			}
	

?>		
