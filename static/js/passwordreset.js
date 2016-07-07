jQuery(document).ready(function($) {
	$('#form-error').hide();
	// Read a page's GET URL variables and return them as an associative array.
	function getUrlVars()
	{
	    var vars = {}, hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}

	console.log(getUrlVars());

	$('#resetbutton').click(function(event) {

		if($('#password').val() != $('#confirm').val()) {
			$('#form-error').html('The passwords entered do not match');
			$('#form-error').show();
			return;
		}
		$('#form-error').hide();
		var data = getUrlVars();
		data.password = $('#password').val();

		$.ajax({
			url: '/index.php/homepage/PasswordResetClose',
			type: 'POST',
			data: data
		})
		.success(function(response) {
			console.log('success');
			$('#form-error').html("You password has been successfully reset. Please login to continue.");
			$('#form-error').show();
		})
		.error(function(response) {
			console.log('error');
			$('#form-error').html("Could not change your password, make sure the link you're using has not been previously used and that you have activated your account.");
			$('#form-error').show();
		});
	});

});