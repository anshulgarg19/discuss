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
</body>
</html>