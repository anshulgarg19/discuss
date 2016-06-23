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
