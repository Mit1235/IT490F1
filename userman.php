<html>

<head>

<style media="screen">
  table{
    border-color:#004060;
    border-width: 2px;
    background-color: white;
  }
  th, td{
    padding: 2px;
    border-width: 2px;
  }
  .col{
          padding-left: 20px;
          width: 50%;
  }
  split{
        width: 300px;
    float: right;
    padding-top: 30px;
    margin-right: 20px;
    margin-left: 20px;
        border-radius: 10px;
    border-style: solid;
        padding-bottom: 10px;
    background-color: white;
    h1 {text-align: center;}

  }
  body{
      background-color: #ffffff;
  }
  .change{
          border-radius: 10px;
    padding: 15px;
    padding-top: 10px;
    width: 95%;
  }
  bh{
    font-size: 31px;
    font-family: 'Titallium', sans-serif;
    font-weight: normal;
  }
</style>
</head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


<split>
        <div class="col">
          <h1><b>User Management</b><br></h1>
          
                 <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
<p><label for="file" style="cursor: pointer;">Click here to add a profile picture!</label></p>
<p><img id="output" width="200" /></p>
          	  

<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
          
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12 2.5a5.5 5.5 0 00-3.096 10.047 9.005 9.005 0 00-5.9 8.18.75.75 0 001.5.045 7.5 7.5 0 0114.993 0 .75.75 0 101.499-.044 9.005 9.005 0 00-5.9-8.181A5.5 5.5 0 0012 2.5zM8 8a4 4 0 118 0 4 4 0 01-8 0z"></path></svg><br><br>



  <body>
    <div id= "container">
      <font size="5">
	<form method="post">
	<label for="username">Username: </label>
        <input type="username" id="pass" name="Username" placeholder="Enter curent username"/>
        <br></br>
        <label for="pass">Email: </label>
        <input type="email" id="pass" name="Email" placeholder="Enter curent email"/>
        <br></br>
	<label for="pass">Current Password: </label>
        <input type="password" id="pass" name="password" placeholder="Enter curent password"/>
        <br><br>
        <label for="pass">New Password: </label>
        <input type="password" id="newPass" name="newPassword" placeholder="Enter new password"/>
        <br><br>
        <lable for ="conf"> Confirm Password:</lable>
        <input type ="password" id= "conf" name="confirm" placeholder = Confirm password/>
        <br><br>
        <input type="submit" value="Change Password" class="button"/>
        </form>
        
        
<?php

function changePassword($username, $email, $newPass) {

	//databaseConn();
	$servername = "localhost";
	$dbusername = "it490";
	$dbpassword = "p@ssw0rd";
	$dbname = "IT490F1";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		echo "SQL Connection Successful\n";
	}

	$hashNewPass = password_hash($newPass, PASSWORD_BCRYPT);


	$sql = "UPDATE users SET password = '$hashNewPass' WHERE username = '$username' AND email = '$email'";
	if ($conn->query($sql) === TRUE) {
		echo "Password updated successfully";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
		return 1;
	$conn->close();

}


?>

   
    </div>
  </body>
</script>
</html>

