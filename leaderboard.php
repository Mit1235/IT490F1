<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<form>
  <label for="League">League Name</label><br>
  <input type="text" id="Lename" name="Lename" value="Please enter the name of the league"><br>
  <input type="submit" value="Submit">
</form>

<button id="btn">Create a League<button>
<script src="index.js"></script>

    <h2>Leaderboard</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Driver 1</th>
                <th>Driver 2</th>
                <th>Pit Crew</th>
                <th>Score</th>
            </tr>
</table>
<table>
        <h2>Comments</h2>
            <tr>
                <th>Name</th>
                <th>Comment</th>
            </tr>



<?php



$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request = array();
        $request['type'] = "";
    $response = $client->send_request($request);


    foreach($response as &$innerArray){
        echo "<tr>";
        foreach($innerArray as &$value){
        echo "<td>{$value}<td>";
    }
    echo "</tr>";
}
?>

</table>


</body>
</html>