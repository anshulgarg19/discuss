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
	  	<a href="/index.php/question/questiondetails?question=<?php echo $question->id;?>">
	  		<?php echo $question->answer_count; ?> answers</a>
	  	<div class="pull-right">
	  		Last modified on <?php echo $question->last_modified; ?>
	  	</div>
	  </footer>
	</div>
<?php } ?>
