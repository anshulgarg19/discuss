<?php
defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="question">
<div id="question-tag">
	<?php foreach($tags as $row) {?>
		<a href="/index.php/tagdetails?tag=<?php echo $row->tag_name?>" target="_blank"><?php echo $row->tag_name; ?></a>
		<?php echo '   ';}?>
</div>
<div id="question-title"><h1><?php echo $title.'?'; ?></h1></div><br/>
<div id="question-content"><?php echo $question_content; ?></div><br/>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#answer-modal">Answer</button>
<br/>
<span id="answer_count"><?php echo $answer_count;?></span>
							<span id="answer_noun"><?php if($answer_count < 2 ) echo ' Answer'; 
							else echo ' Answers'; ?></span> 
							<?php echo '        Posted on: '.$created_on;			?>
							<a href="/index.php/userprofile/showprofile?user=<?php echo $user_id; ?>"><?php echo $user_name;?></a>


<!--Answers for the question -->
<div id="answers">
<?php foreach($answers as $row) { ?>
	<div id="answer-content"><h1><?php echo $row['answer_content']; ?></h1></div><br/><br/>
	<div id="answer-time">Posted on: <?php echo $row['created_on']; ?></div><br/>
	<div id="answer-user">Posted by: <a target="_blank" href='/index.php/userprofile/showprofile?user=<?php echo $row["user_id"]; ?>'><?php echo $row['firstname']; ?> </a><?php } ?></div>
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
	        <textarea name="text1" placeholder="Enter your answer here" id="answer_content"></textarea><br/>
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