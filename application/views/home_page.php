<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>discuss.io</title>
</head>
<body>
	<!-- login form -->
	<form>
		<label for="email">E-mail </label><input type="text" name="email" id="login_email"><br/>
		<div id="error-login_email"></div><br/>
		<label for="password">Password </label><input type="password" name="password" id="login_password"><br/>
		<button type="button" id="login_submit">Submit</button>
	</form>

	<pre id="result"></pre>

	<!-- register form -->	

	<br/>
	<br/>
	Register:
	<br/>

	<form>
		<label for="fname">First Name </label><input type="text" name="fname" id="first_name"><br/>
		<label for="lname">Last Name </label><input type="text" name="lname" id="last_name"><br/>
		<label for="pnum">Phone Num </label><input type="text" name="pnum" id="phone_num"><br/>
		<div id="error-pnum" class="error-div"></div><br/>
		<label for="email">Email </label><input type="text" name="email" id="register_email"><br/>
		<div id="error-email" class="error-div"></div><br/>
		<label for="password">Password </label><input type="password" name="password" id="register_password"><br/>
		<div id="error-password" class="error-div"></div><br/>
		<label for="confirm_pw">Confirm Password</label><input type="password" name="confirm_pw" id="confirm_password">
		<br/>
		<div id="error-confirm_password" class="error-div"></div><br/>
		<button type="button" id="register_submit">Register</button>
	</form>

	<pre id="register_response"></pre>

	<!-- page javscript -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="static/js/homepage.js"></script>
</body>
</html>