<di	v class="container">
	<div id="questionsfortag" class="col-md-10 col-md-offset-1">
		<h3>Showing recent questions tagged with: <?php echo $tag_name;	?></h3>
		<form id="changestatus">
			<input type="hidden" id="tagid" name="tag" value="<?php echo $tag; ?>">
			<?php if($following) {?>
				<button id="follow" type="button" class="btn btn-danger">Unfollow</button>
			<?php } else {?>
				<button id="follow" type="button" class="btn btn-success">Follow</button>
			<?php }?>
				<input type="hidden" name="followstatus" id="change" value="<?php echo $following; ?>">
		</form>
		<span>No. of users following this tag: <?php echo $num_followers;?></span>
		<?php foreach($questions as $question) {?>
			<div class="panel panel-default">
			  <div class="panel-heading"><a href="question/questiondetails?question=<?php echo $question->id;?>"><strong><?php echo $question->title; ?></strong></a></div>
			  <div class="panel-body">
			    <?php echo substr($question->question_content, 0, 500); 
			    if(strlen($question->question_content) > 500) {
			    	echo "...<a href=\"/index.php/question/questiondetails?question=".$question->id."\">continued</a>";	
			    }?>
			  </div>
			  <footer class="footer">
			  	<a href="/index.php/question/questiondetails?question=<?php echo $question->id; ?>">
			  		<?php echo $question->answer_count; ?> answers</a>
			  	<div class="pull-right">
			  		Last modified on <?php echo $question->last_modified; ?>
			  	</div>
			  </footer>
			</div>
		<?php } ?>
	</div>
</div>
<script src="/static/js/tagdetails.js" type="text/javascript" charset="utf-8" async defer></script>