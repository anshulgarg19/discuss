
$(document).ready(function(){
	//onClick function for login submit
	$('#login_submit').click(function(event) {

		var invalid = false;

		var login_email = $('#login_email').val();

		//validate login email
		if( !validate_email(login_email) )
		{
			$("#error-login_email").css("color","red");
			$("#error-login_email").html("Invalid Email format");
			invalid = true;
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
			console.log(response);
			console.log("success");
			$('#result').html(response);
		})
		.error(function(response) {
			console.log(response);
			$('#result').html(response.responseText);
		});
				
	});

	//onClick function for register submit
	$('#register_submit').click(function(event){

		//values stored in variables
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var pnum = $('#phone_num').val();
		var register_email = $('#register_email').val();
		var register_password = $('#register_password').val();
		var confirm_passwd = $('#confirm_password').val();

		var invalid = false;

		// integer phone num validation
		if( !validate_phonenumber(pnum) )
		{
			$('#error-pnum').css("color","red");
			$('#error-pnum').html("Phone Number can only be 10 digits");
			invalid = true;
		}

		//validate email
		if( !validate_email(register_email) )
		{
			$("#error-email").css("color","red");
			$("#error-email").html("Invalid email format");
			invalid = true;
		}

		//validate password
		if( !validate_password( register_password) )
		{
			$("#error-password").css("color","red");
			$("#error-password").html("Invalid password.Length should be between 6 to 20 characters");
			invalid = true;
		}

		//validate confirm password
		if( confirm_passwd != register_password )
		{
			$("#error-confirm_password").css("color","red");
			$("#error-confirm_password").html("Password doesnt match");
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
			url : 'index.php/homepage/register',
			type: 'POST',
			data : data,
			success: function(response){
				console.log(response);
				console.log("register success");
				$('#register_response').html(response);
			},
			error: function(response){
				console.log(response);
				console.log("register failure");
				$('#register_response').html(response.responseText);
			}
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
    		console.log("pwd check");
    		return false;
    	}
    	return true;
    }

});