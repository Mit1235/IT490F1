<?php
include_once 'Header.php';
?>
<section class="signup-form">
	<h2>Sign Up!</h2>
	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="Name" placeholder="Please enter your Name">
		<input type="text" name="username" placeholder="Please enter your Username">
		<input type="email" name="email" placeholder="Please enter your Email">
		<input type="password" name="password" placeholder="Please enter your Password">
		<input type="password" name="passwordrepeat" placeholder="Please reenter your Password">
		<button type="submit" name="submit">Sign Up!</button>
	</form>


</section>



<?php
include_once 'Footer.php';
?>