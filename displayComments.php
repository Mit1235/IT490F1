<?php
require('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>

</div>
<div class="container">
	<div class="col-md-8">

		<div class="panel panel-default">
		<div class="panel-heading">Comments</div>
		  <div class="panel-body">
		  <?php 
		  	$comsql = "SELECT * FROM comments WHERE cid=$id";
		  	$comres = mysqli_query($connection, $comsql);
		  	while($comr = mysqli_fetch_assoc($comres)){
		  		$hash = md5( strtolower( trim( $comr['email'] ) ) );
				$size = 150;
		  		$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
		  ?>
		  	<div class="row">
		  		<div class="col-md-3">
		  			<img src="<?php echo $grav_url; ?>">
		  		</div>
		  		<div class="col-md-9">
		  			<p><strong><?php echo $comr['name']; ?></strong> </p>
		  			<p><?php echo $comr['submittime'] ?></p>
		  			<p><?php echo $comr['subject']; ?></p>
		  		</div>
		  	</div>
		  	<br>
		  	<?php } ?>
		  </div>
		</div>
	</div>
	<div class="col-md-4">

	</div>
</div>
</body>
</html>
