<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>discuss.io</title>
</head>
<body>
<form action="/index.php/homepage/login" method="POST">
	<label for="email">E-mail </label><input type="text" name="email"><br/>
	<label for="password">Password </label><input type="password" name="password"><br/>
	<input type="submit" name="submit" value="Log in">
</form>
</body>
</html>