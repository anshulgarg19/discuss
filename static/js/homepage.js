
$(document).ready(function(){
	function resendActivation() {	
		$.ajax({
			url: '/index.php/homepage/resendActivation',
			type: 'POST',
			data: {email: login_email},
		})
		.success(function() {
			$('#logininfo').html("The activation link has been successfully resent.");
			$('#logininfo').show();
		})
		.error(function(response) {
			$('#loginerror').html("We were not able to send the activation link to your email, please <a id=\"resend\">try again</a>.");
			$('#resend').on('click', resendActivation);
			$('#loginerror').show();
		});
		
	}

	//onClick function for login submit
	$('#loginerror').hide();
	$('#logininfo').hide();
	var login_email;

	$('#login_submit').click(function(event) {

		$('#error-login_email').html('');

		var invalid = false;
		login_email = $('#login_email').val();

		//validate login email
		if( !validate_email(login_email) )
		{

			if(!validate_phonenumber(login_email)) {
				action_invalid_login_email();
				invalid = true;
			}
		}

		if( invalid )
			return;

		var data = {
			email: login_email,
			password: $('#login_password').val()
		};

		$.ajax({
			url: '/index.php/homepage/login',
			type: 'POST',
			data: data
		})
		.success(function(response) {
			if( response.indexOf('error-login_email') > -1 )
			{
				action_invalid_login_email();
				return;
			}
			window.location.reload(true);
		})
		.error(function(response) {
			if(response.status == 401) {
				$('#loginerror').html("Wrong email-id/phone number and password combo, if you have not registered please do the same now.");
				$('#loginerror').show();
			}
			else if(response.status == 403) {
				$('#loginerror').html("Your account has not been activted yet. ");
				$('#loginerror').append('<a id="resend">Click here</a> to re-send activation link to your email id');
				$('#loginerror').show();
				$('#resend').on('click', resendActivation);
				// $('#logininfo').show();
			}
		});
	});

	//onClick function for register submit
	$('#register_submit').click(function(event){

		//initialisations
		$('#error-first-name').html('');
		$('#error-pnum').html('');
		$('#error-register_email').html('');
		$('#error-register_password').html('');
		$('#error-confirm_password').html('');

		//values stored in variables
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var pnum = $('#phone_num').val();
		var register_email = $('#register_email').val();
		var register_password = $('#register_password').val();
		var confirm_passwd = $('#confirm_password').val();

		var invalid = false;

		/*
		** client side valditions
		*/
		//first name cant be empty
		if( !first_name.length )
		{
			action_first_name_empty();
			invalid = true;
		}

		// integer phone num validation
		if( !validate_phonenumber(pnum) )
		{
			action_invalid_register_phonenumber();
			invalid = true;
		}

		//validate email
		if( !validate_email(register_email) )
		{
			action_invalid_register_email();
			invalid = true;
		}

		//validate password
		if( !validate_password( register_password) )
		{
			action_invalid_register_password();
			invalid = true;
		}

		//validate confirm password
		if( confirm_passwd != register_password )
		{
			action_mismatch_register_password();
			invalid = true;
		}
	

		if( invalid )
			return;

		var data = {
			fname : first_name,
			lname : last_name,
			phone_num : pnum,
			email : register_email,
			password : register_password,
			confirm_password : confirm_passwd
		}

		$.ajax({
			url : '/index.php/homepage/validateuser',
			type: 'POST',
			data : data,
			success: function(response){
				

				$('#register-form').submit();
				//$('#register_response').html(response);
			},
			error: function(response){
				response = JSON.parse(response.responseText);
				if( response['error-first-name'] > -1 )
				{
					action_first_name_empty();
				}

				if( response['error-phone'] > -1  )
				{
					action_invalid_register_phonenumber();
				}
				if( response['error-email'] > -1 )
				{
					action_invalid_register_email();
				}
				if( response['error-password'] > -1 )
				{
					action_invalid_register_password();
				}
				if( response['error-mismatch-password'] > -1  )
				{
					action_mismatch_register_password();
				}

				if( response['phone-exists'] > -1 )
				{
					action_phone_exists();
				}

				if( response['email-exists'] > -1 )
				{
					action_email_exists();
				}
				$('#register_response').html(response.responseText);
			}
		});
		
	});

	$("#userfile").change(function(){
		$("#register_submit").prop("disabled",false);
    	$("#image-error").html("");
    	var file = this.files[0];

    	var imagefile = file.type;
    	var filesize = file.size;

    	var match = ["image/jpeg","image/jpg","image/png","image/gif"];
    	var error_message;

    	if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			error_message = "<p>Please Select valid File (Allowed:jpeg/jpg/png/gif)</p>";
			action_invalid_profile_pic(error_message);
			return false;
		}
		if(filesize > 2*1024*1024){
			error_message = "<p>Max file size allowed is 2MB.</p>";
			action_invalid_profile_pic(error_message);
			return false;
		}
    	
    });

    function action_invalid_profile_pic(message){
    	$("#register_submit").prop("disabled",true);
		$("#image-error").html(message);
    }

	// Function for password reset submit
	$('#reset_button').click(function(event) {
		$('#reset_button').append('<span class="glyphicon glyphicon-refresh spinning"></span>');
		$.ajax({
			url: '/index.php/homepage/forgot',
			type: 'POST',
			data: $('#pwresetemail').serialize()
		})
		.success(function (response) {
			$('#pwresetmodalbody').html('<span style="color:green;">A reset e-mail was successfully sent.</span>');
		})
		.error(function(response) {
			$('#pwresetmodalbody').html('<span style="color:red;">A reset e-mail could not be sent. The email you entered is either not registered or your account has not been activated.</span>');
		});
		
	});

	//function to validate phone number
	function validate_phonenumber(inputtxt)  
	{  
	  	var phoneno = /^\d{10}$/;  
	  	if( inputtxt.match(phoneno) )  
		{  
	      	return true;  
	    }  
	    else  
	    {  
	        return false;  
	    }  
	}  

	//function to validate email
	function validate_email( inputtxt ) {
	    var atpos = inputtxt.indexOf("@");
	    var dotpos = inputtxt.lastIndexOf(".");
	    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=inputtxt.length) {
	        return false;
	    }
	    return true;
    }

    //function to validate password
    function validate_password(inputtxt){
    	if( inputtxt.length < 6 || inputtxt.length > 20 ){
    		return false;
    	}
    	return true;
    }

    //empty first name
    function action_first_name_empty(){
    	$('#error-first-name').css("color","red");
    	$('#error-first-name').html("First name cant be empty");
    }

    //action to take on invalid phone number 
    function action_invalid_register_phonenumber(){
    	
    	$('#error-pnum').css("color","red");
		$('#error-pnum').html("Phone Number can only be 10 digits");
    }

    //action to take on invalid email
    function action_invalid_register_email(){
    	
    	$("#error-register_email").css("color","red");
		$("#error-register_email").html("Invalid email format");
    }

    //action to take on invalid password
    function action_invalid_register_password(){
    	
    	$("#error-register_password").css("color","red");
		$("#error-register_password").html("Invalid password.Length should be between 6 to 20 characters");
    }

    //action to take if phone already exists
    function action_phone_exists(){
    	$('#error-pnum').css("color","red");
		$('#error-pnum').html("Phone Number already exists :/");	
    }

    //action if email already exists
    function action_email_exists(){
    	$("#error-register_email").css("color","red");
		$("#error-register_email").html("Email already exists :/");	
    }

    //action to take if passwords dont match
    function action_mismatch_register_password(){
    	
    	$("#error-confirm_password").css("color","red");
		$("#error-confirm_password").html("Password doesnt match");
    }

    //action to take if login email invalid
    function action_invalid_login_email(){
    	$("#error-login_email").css("color","red");
		$("#error-login_email").html("Invalid Email or mobile number format");
    }
});