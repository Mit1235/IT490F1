<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
?>


<!DOCTYPE html>
<html>


<!--putting f1 logo/banner here :) -->

<head>
<table class="torspo_view__table" style="background:#212121;color:#ffffff">
<tbody><tr><td class="torspo_view__image-cell"><img height="100" src="//ssl.gstatic.com/onebox/media/sports/logos/lTM9VlVyyG5jgF4UHAx94g_64x64.png" width="100" role="img" data-atf="1" data-frt="0"></td><td class="torspo_view__entity-text-cell"><div class="gsmt torspo_view__title-container"><span class="tsp-ht">F1</span></div></td></tr></tbody></table>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<style media="screen">

table{
border-color:#004060;
border-width: 2px;
background-color: white;
}

th, td{
    padding: 20px;
    border-width: 2px;
  }

.coll2{
	  padding-left: 15px;
	  width: 50%;
  }

split{
width: 300px;
float: left;
padding-top: 50px;
padding-left: 50px;
margin-left: 10px;
margin-right: 50px;
border-radius: 10px;
border-style: solid;
padding-bottom: 10px;
background-color: white;
}
  body{
      background-color: #FFFFFF;
}

  h3{
    font-size: 31px;
    font-family: 'Titillum Light';
    font-weight: normal;
  }
    </style>
  
<body style="background-color: #FFFFFF">
<br>
<split>
	<div class="col">
	<h3 style="text-align:center">Standings</b><br><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12 2.5a5.5 5.5 0 00-3.096 10.047 9.005 9.005 0 00-5.9 8.18.75.75 0 001.5.045 7.5 7.5 0 0114.993 0 .75.75 0 101.499-.044 9.005 9.005 0 00-5.9-8.181A5.5 5.5 0 0012 2.5zM8 8a4 4 0 118 0 4 4 0 01-8 0z"></path></svg></h3><br>


</head>
  <body>
  </body>
</html>




<?php 


$client = new rabbitMQClient("history.ini","testServer");
if(isset($argv[1]))
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

                //echo "client received response: ".PHP_EOL;
                //print_r($response);
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
