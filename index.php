<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IT 490 Website</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<section class="signup-form">
	<h2>Sign Up!</h2>
	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="username" placeholder="Please enter your Username">
		<input type="email" name="email" placeholder="Please enter your Email">
		<input type="password" name="password" placeholder="Please enter your Password">
		<button type="submit" name="submit">Sign Up!</button>
		<input type="checkbox" id="isNotif" name="isNotif" value="isNotif">
		<label for="isNotif"> Push Notifications?</label><br>

	</form>
</section>

<section class="login-form">
	<h2>Login!</h2>
	<form action="includes/login.inc.php" method="post">
		<input type="text" name="username" placeholder="Please enter your Username">
		<input type="email" name="email" placeholder="Please enter your Email">
		<input type="password" name="password" placeholder="Please enter your Password">
		<button type="submit" name="submit">Login!</button>
	</form>
</section>


</body>
</html>
