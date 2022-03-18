<?php
include_once 'Header.php';
?>
<section class="signup-form">
	<h2>Login!</h2>
	<form action="includes/login.inc.php" method="post">
		<input type="text" name="username" placeholder="Please enter your Username">
		<input type="email" name="email" placeholder="Please enter your Email">
		<input type="password" name="password" placeholder="Please enter your Password">
		<button type="submit" name="submit">Sign Up!</button>
	</form>


</section>



<?php
include_once 'Footer.php';
?>