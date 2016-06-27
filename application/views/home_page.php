<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>discuss.io</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
	<!-- login form -->
	<form>
		<label for="login_email">E-mail </label><input type="text" name="email" id="login_email"><br/>
		<div id="error-login_email"></div><br/>
		<label for="login_password">Password </label><input type="password" name="password" id="login_password"><br/>
		<button type="button" id="login_submit">Submit</button>
	</form>

	<pre id="result"></pre>

	<!-- register form -->	

	<br/>
	<br/>
	Register:
	<br/>

	<form>
		<label for="first_name">First Name </label><input type="text" name="fname" id="first_name"><br/>
		<div id="error-first-name" class="error-div"></div><br/>
		<label for="last_name">Last Name </label><input type="text" name="lname" id="last_name"><br/>
		
		<label for="phone_num">Phone Num </label><input type="text" name="pnum" id="phone_num"><br/>
		<div id="error-pnum" class="error-div"></div><br/>
		<label for="register_email">Email </label><input type="text" name="email" id="register_email"><br/>
		<div id="error-register_email" class="error-div"></div><br/>
		<label for="register_password">Password </label><input type="password" name="password" id="register_password"><br/>
		<div id="error-register_password" class="error-div"></div><br/>
		<label for="confirm_password">Confirm Password</label><input type="password" name="confirm_pw" id="confirm_password">
		<br/>
		<div id="error-confirm_password" class="error-div"></div><br/>
		<button type="button" id="register_submit">Register</button>
	</form>

	<pre id="register_response"></pre>
	

	<div id="modal">
		<form id="pwresetemail">
			<input type="text" name="forgotmail">
			<button type="button" id="reset_button">Send password reset email</button>
		</form>
		<pre id="reset_result"></pre>
	</div>
	<!-- page javscript -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="static/js/homepage.js"></script>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>