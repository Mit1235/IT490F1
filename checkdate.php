<?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$obj =  new DateTime();
$DateAndTime = $obj->format("d-m-Y h:i:sp");
//echo $DateAndTime;
//echo PHP_EOL; 

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
        $RaceName = $value['raceName'];
       // echo "Race Name: ".$RaceName;
        //echo "<br>";
        $Country = $value['Circuit']['circuitName'];
       // echo "Circuit Name: ".$Country;
	
	//echo "<br>";
	    
	    $date = $value['date'];
	    
	    //echo "Date: ".$date;
	//echo "<br>";
	    $time = $value['time'];

	$dateA = "$date $time";
	    echo $dateA;
	    $dateB =   $DateAndTime;   
     	    //'2022-06-19 12:12:12';
		    
	    
	   $timediff = strtotime($dateA) - strtotime($dateB);

	   if($timediff > 86400 || $timediff < 1){
		   echo 'more than 24 hours';
	   }
	   else
	   {
		   echo 'less than 24 hours';


			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->SMTPDebug  = 1;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "smtp.gmail.com";
			$mail->Username   =" IT490F1virgo@gmail.com";
			$mail->Password   = "virgo2022";
			$mail->IsHTML(true);
			$mail->AddAddress("mp875@njit.edu", "Mit");
			$mail->SetFrom("IT490F1virgo@gmail.com", "IT490");
			$mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
			$mail->AddCC("", "cc-recipient-name");
			$mail->Subject = "F1 Push Notification";
			$content = "<b> The $RaceName is starting at $Country at $date and $time</b>";
			$mail->MsgHTML($content);
			if(!$mail->Send()) {
		 	 echo "Error while sending Email.";
		  	var_dump($mail);
			} else {
 		 	echo "Email sent successfully";
			}


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