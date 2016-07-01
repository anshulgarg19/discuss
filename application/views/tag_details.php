<div class="container">
	<div class="col-md-10 col-md-offset-1">
		<h3>Showing recent questions tageed with: <?php echo $tag; var_dump($following)	?></h3>
		<form id="changestatus">
			<input type="hidden" name="tag" value="<?php echo $tag; ?>">
			<?php if($following) {?>
				<button id="follow" type="button" class="btn btn-danger">Unfollow</button>
			<?php } else {?>
				<button id="follow" type="button" class="btn btn-success">Follow</button>
			<?php }?>
				<input type="hidden" name="followstatus" id="change" value="<?php echo $following; ?>">
		</form>
		<?php foreach($questions as $question) {?>
			<div class="panel panel-default">
			  <div class="panel-heading"><a href="question/questiondetails?question=<?php echo $question['question_id'];?>"><strong><?php echo $question['title']; ?></strong></a></div>
			  <div class="panel-body">
			    <?php echo substr($question['question_content'], 0, 500); 
			    if(strlen($question['question_content']) > 500) {
			    	echo "...<a>continued</a>";	
			    }?>
			  </div>
			  <footer class="footer">
			  	<a href="question/questiondetails?question=<?php echo $question['question_id'];?>">
			  		<?php echo $question['answer_count']?> answers</a>
			  	<div class="pull-right">
			  		Posted on <?php echo $question['created_on']?>
			  	</div>
			  </footer>
			</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$('#follow').click(function(event) {

			$.ajax({
				data: $('#changestatus').serialize(),
				method: 'POST',
				url: '/index.php/tagdetails/changeFollowStatus'
			})
			.success(function(response) {
				var current = $('#follow').html();
				if (current == "Follow") {
					$('#follow').removeClass('btn-success');
					$('#follow').addClass('btn-danger');
					$('#follow').html("Unfollow");
					$('#change').val(1);
				}
				else {
					$('#follow').removeClass('btn-danger');
					$('#follow').addClass('btn-success');
					$('#follow').html("Follow");
					$('#change').val(0);
				}
			});
		});
	});
</script>