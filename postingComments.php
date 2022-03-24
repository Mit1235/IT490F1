<?php

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log',"/home/parallels/git/IT490F1/IT490F1/errorlog.txt");

require('connect.php');

if(isset($_POST) & !empty($_POST)){
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$subject = mysqli_real_escape_string($connection, $_POST['subject']);

	echo $isql = "INSERT INTO comments (cid, name, email, subject, status) VALUES ('$id', '$name', '$email', '$subject', 'draft')";
	$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
	if($ires){
		$smsg = "Successfully commented!";
	}else{
		$fmsg = "Comment not posted, please try again!";
	}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<!-- Latest compiled and minified CSS! -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >

	<!-- Latest compiled and minified JavaScript! -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>

<div class="container">

</div>
<div class="container">
	<div class="col-md-8">

		<div class="panel panel-default">
		<div class="panel-heading">Submit Your Comments</div>
		  <div class="panel-body">
		  	<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		  	<form method="post">
		  	  <div class="form-group">
			    <label for="exampleInputEmail1">Name</label>
			    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Subject</label>
			    <textarea name="subject" class="form-control" rows="3"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>

	</div>
	<div class="col-md-4">

	</div>
</div>
</body>
</html>


