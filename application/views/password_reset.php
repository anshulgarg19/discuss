<h1>Please enter your new password</h1>
<form id="reset">
	<input type="password" id="password" name="password">
	<input type="password" name="confirm" id="confirm">
	<button id="resetbutton" type="button">Reset My password</button>
</form>
<pre id="result"></pre>

<script type="text/javascript">
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
		var data = getUrlVars();
		data.password = $('#password').val();

		$.ajax({
			url: '/index.php/homepage/PasswordResetClose',
			type: 'POST',
			data: data
		})
		.success(function(response) {
			console.log('success');
			$('#result').html(response);
		})
		.error(function(response) {
			console.log('error');
			$('#result').html(response.responseText);
			console.log(response.responseText);
		});
	});
</script>