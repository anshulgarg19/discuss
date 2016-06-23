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
		<label for="password">Password </label><input type="password" name="password" id="login_password"><br/>
		<button type="button" id="login_submit">Submit</button>
	</form>

	<pre id="result"></pre>
	
	<!-- page javscript -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="static/js/homepage.js"></script>
</body>
</html>