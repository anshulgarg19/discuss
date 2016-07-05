<?php foreach($questions as $question) {?>
	<div class="panel panel-default">
	  <div class="panel-heading"><a href="question/questiondetails?question=<?php echo $question->id;?>"><strong><?php echo $question->title; ?></strong></a></div>
	  <div class="panel-body">
	  	<div class="row">
	    <?php echo substr($question->question_content, 0, 500); 
	    if(strlen($question->question_content) > 500) {
	    	echo "...<a href=\"/index.php/question/questiondetails?question=".$question->id."\">continued</a>";	
	    }?>
	    </div>
	    <div class="row">
	    <?php
	    	for($i=0, $cnt = count($question->id_list); $i < $cnt; $i++) {
	    ?>
	    	<a href="tagdetails?tag=<?php echo $question->id_list[$i]; ?>">
	    		<div class="badge">
	    			<?php echo $question->tag_names[$i]; ?>
	    		</div>
	    	</a>
	    <?php
	    	} 
	    ?>
	    </div>
	    
	    <div class="row">
	    	Posted by <a href="/index.php/userprofile/showprofile?user=<?php echo $question->user_id; ?>"><?php echo $question->name; ?></a>
	    </div>
	  </div>
	  <footer class="footer">
	  	<a href="/index.php/question/questiondetails?question=<?php echo $question->id;?>">
	  		<?php echo $question->answer_count; ?> answers</a>
	  	<div class="pull-right">
	  		Last modified on <?php echo date("F j, Y, g:i a",strtotime($question->last_modified)); ?>
	  	</div>
	  </footer>
	</div>
<?php } ?>
