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
		<link rel="stylesheet" href="/static/css/homepage.css">
	</head>
	<body id="homepagebody">
		
		<div class="container">
			
			<!-- Nav tabs -->
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab">Login</a></li>
				<li role="presentation"><a href="#signup" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane" id="signup">
					<form id="register-form" class="form-signin" method="POST" enctype="multipart/form-data" action="/index.php/homepage/register">
						<label class="sr-only" autofocus for="first_name">First Name </label><input placeholder="Firstname" class="form-control" type="text" name="fname" id="first_name">
						<div id="error-first-name" class="error-div"></div>
						<label class="sr-only" for="last_name">Last Name </label><input placeholder="Lastname" class="form-control" type="text" name="lname" id="last_name">						
						<label class="sr-only" for="phone_num">Phone Num </label><input placeholder="phone number" class="form-control" type="text" name="pnum" id="phone_num">
						<div id="error-pnum" class="error-div"></div>
						<label class="sr-only" for="register_email">Email </label><input placeholder="email address" class="form-control" type="text" name="email" id="register_email">
						<div id="error-register_email" class="error-div"></div>
						<label class="sr-only" for="register_password">Password </label><input placeholder="password" class="form-control" type="password" name="password" id="register_password">
						<div id="error-register_password" class="error-div"></div>
						<label class="sr-only" for="confirm_password">Confirm Password</label><input placeholder="confirm password" class="form-control" type="password" name="confirm_pw" id="confirm_password">
						<label for="userfile">Profile pic(optional)</label>
						<input type="file" name="userfile"/>

						<div id="error-confirm_password" class="error-div"></div>
						<button type="button" class="btn btn-default" id="register_submit">Register</button>
					</form>
					
				</div>
				<div role="tabpanel" class="tab-pane active" id="login">
					<form class="form-signin">
						<label class="sr-only" for="login_email">E-mail </label><input placeholder="Email id" class="form-control" type="email" name="email" id="login_email" required autofocus>
						<div id="error-login_email"></div>
						<label class="sr-only" for="login_password">Password </label><input required placeholder="Password" class="form-control" type="password" name="password" id="login_password">
						<button type="button" class="btn btn-default" id="login_submit">Submit</button>
					</form>
					<div class="text-centered">
						<div class="alert alert-danger" role="alert" id="loginerror"></div>
						<div class="alert alert-success" role="alert" id="logininfo"></div>
						<!-- Button trigger modal -->
						<a type="button" data-toggle="modal" data-target="#ForgotPasswordModal">
							Forgot Password?
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="ForgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="ForgotPasswordModal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Forgot password</h4>
		      </div>
		      <div id="pwresetmodalbody" class="modal-body">
		        
		        <form id="pwresetemail" class="form-signin">
		        	<input type="text" class="form-control" name="forgotmail">
		        	<button class="btn btn-default" type="button" id="reset_button">Send password reset email
		        	</button>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		
		<!-- page javscript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script type="text/javascript" src="/static/js/homepage.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>