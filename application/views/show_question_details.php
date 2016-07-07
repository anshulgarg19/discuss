<?php
defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="question" class="container">
	<div class="col-md-10 col-md-offset-1">
		<div class="pull-right">
			<form id="changestatus">
				<input type="hidden" id="questionid" name="question_id" value="<?php echo $question_id; ?>">
				<?php if( !$posted ){
				if( $following ){ ?>
				<button id="follow" type="button" class="btn btn-sm btn-danger">Unfollow</button>
				<?php }else {?>
				<button id="follow" type="button" class="btn btn-sm btn-success">Follow</button>
				<?php }
				}?>
				<input type="hidden" id="follow_status" name="following_question" value="<?php echo $following; ?>">
				
			</form>
		</div>
		<div class="row">
			
			<div id="question-title" class="question-title"><h1><?php echo $title;
				if($title[strlen($title)-1] != '?')
			echo '?'; ?></h1></div><br/>
			<div id="question-content" class="question-content"><?php echo $question_content; ?></div><br/>
			<?php echo 'Posted on: '.date("F j, Y, g:i a",strtotime($created_on));			?>
			by <a href="/index.php/userprofile/showprofile?user=<?php echo $user_id; ?>"><?php echo $user_name;?></a> <img class="img-circle" height="35" width="35" src="<?php echo $profile_pic; ?>">
			<br/><br/>
			
			<?php foreach($tags as $row) {?>
			<div id="question-tag" class="badge"><a class="tag" href="/index.php/tagdetails?tag=<?php echo $row->tag_id?>" ><?php echo $row->tag_name; ?></a></div>
			<?php }?>
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
			
			<div class="answer-content"><h5><?php echo $row['answer_content']; ?></h5></div><br/>
			<h6>Posted on <?php echo $row['created_on']; ?>
			by <a  href='/index.php/userprofile/showprofile?user=<?php echo $row["user_id"]; ?>'><?php echo $row['firstname']; ?> </a>
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
					<textarea rows="10" class="form-control" name="text1" placeholder="Enter your answer here" id="answer_content"></textarea><br/>
					<div id="error-answer"></div><br/>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="answer_question" value="<?php echo $question_id; ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="submit-answer">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="result-answer"></div>
<script type="text/javascript" src="/static/js/postedquestion.js"></script>