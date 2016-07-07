<!DOCTYPE html>
<html>
	<head>
		<title>Discuss</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<!-- Select 2-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
		<link rel="stylesheet" href="/static/css/custom.css">
	</head>
	<body>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<h1>Please enter your new password</h1>
				<form class="form-signin" id="reset">
					<form-group>
					<input type="password" class="form-control" id="password" placeholder="new password" name="password">
					<input type="password" name="confirm" class="form-control" placeholder="confirm new password" id="confirm">
					<pre id="form-error"></pre>
					</form-group>
					<form-group>
					<button id="resetbutton" style="margin-top: 10px;" class="btn btn-default" type="button">Reset My password</button>
					</form-group>
				</form>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="pull-left">
					Avishkar Gupta<br/>
					Anshul Garg
				</div>
				<div class="pull-right">
					Copyright 2016, discuss.io
				</div>
			</div>
		</footer>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="/static/js/passwordreset.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>