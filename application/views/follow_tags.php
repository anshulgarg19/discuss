<div id="body">
	<p>
		<h2>Choose at least 3 tags you want to follow</h2>
			<form>
			<?php foreach ($tags as $tag) { ?>
				<input type="checkbox" name="tag" value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['tag_name']; ?>
			<?php } ?>
				<button id="submit" type="button" value="Submit">Submit</button>
			</form>
			<pre id="result"></pre>
	</p>
</div>

<script type="text/javascript">

	jQuery(document).ready(function($) {

		var tags = [];
		$('#submit').click(function(event) {

			$(':checked').each(function() {
				tags.push($(this).val());
			});

			if(tags.length < 3) {
				tags = [];
			}
			else {
				$.ajax({
					url: '/index.php/followtags/TagSelect',
					type: 'POST',
					data: {data: JSON.stringify(tags)}
				})
				.success(function(response) {
					console.log('succsess');
					$('#result').html(response);
				})
				.error(function(response) {
					console.log('error');
					$('#result').html(response.responseText);
				});

			}
		});
	});

</script>