$('#login_submit').click(function(event) {

	var data = {
		email: $('#login_email').val(),
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
	});
			
});

//onClick function for register submit
$('#register_submit').click(function(event){

	var data = {
		fname : $('#first_name').val(),
		lname : $('#last_name').val(),
		phone_num : $('#phone_num').val(),
		email : $('#register_email').val(),
		password : $('#register_password').val(),
		confirm_password : $('#confirm_password').val()
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
		}
	});
});
