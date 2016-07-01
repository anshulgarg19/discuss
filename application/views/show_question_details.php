<?php
defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="question" class="container">
	<div class="col-md-10 col-md-offset-1">
	  <div class="row">
		
			<?php foreach($tags as $row) {?>
				<div id="question-tag" class="badge"><a class="tag" href="/index.php/tagdetails?tag=<?php echo $row->tag_id?>" target="_blank"><?php echo $row->tag_name; ?></a></div>
				<?php echo '   ';}?>
		

		<div id="question-title" class="question-title"><h1><?php echo $title.'?'; ?></h1></div><br/>
		<div id="question-content" class="question-content"><?php echo $question_content; ?></div><br/>

		<?php echo '        Posted on: '.$created_on;			?>
							 by <a href="/index.php/userprofile/showprofile?user=<?php echo $user_id; ?>"><?php echo $user_name;?></a>
		<br/><br/>

		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#answer-modal">Answer</button>
		<br/><br/>
	  
		<div class="partition"></div>
	  </div>
	  <div class="row">
		<span id="answer_count"><?php echo $answer_count;?></span>
							<span id="answer_noun"><?php if($answer_count < 2 ) echo ' Answer'; 
							else echo ' Answers'; ?></span> 
		<br/><br/>
		<div class="partition"></div>
	  </div>						


<!--Answers for the question -->
		<div id="answers-0">
			<?php foreach($answers as $row) { ?>
				
				<div id="answer-content"><h3><?php echo $row['answer_content']; ?></h3></div><br/>
				<h6>Posted on <?php echo $row['created_on']; ?>
				by <a target="_blank" href='/index.php/userprofile/showprofile?user=<?php echo $row["user_id"]; ?>'><?php echo $row['firstname']; ?> </a>
				</h6>
				<div class="partition"></div>
			<?php } ?>
		</div>	
		
	</div>
</div>



<!-- Modal -->
<div id="answer-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Your Answer</h4>
      </div>
      <form>
	      <div class="modal-body">
	        <!--<input class="noEnterSubmit" type="text" id="answer_content" onsubmit="return false;" placeholder="Enter your answer here :") />-->
	        <textarea name="text1" placeholder="Enter your answer here" id="answer_content" class="content"></textarea><br/>
	        <div id="error-answer"></div><br/>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal" id="submit-answer">Submit</button>
	      </div>
	  </form>    
    </div>

  </div>
</div>
<div id="result-answer"></div>
<script type="text/javascript" src="/static/js/postedquestion.js"></script>
