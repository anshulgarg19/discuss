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
					<button id="follow" type="button" class="btn btn-sm btn-danger">Unfollow Question</button>
					<?php }else {?>
					<button id="follow" type="button" class="btn btn-sm btn-success">Follow Question</button>
					<?php }
				}?>
				<input type="hidden" id="follow_status" name="following_question" value="<?php echo $following; ?>">
				
			</form>
		</div>
		<div class="row">
			
			<div id="question-title" class="question-title"><h1><?php echo $title;
				if($title[strlen($title)-1] != '?')
			echo '?'; ?></h1></div><br/>
			
			<div class="row">	
				<?php foreach($tags as $row) {?>
				<div id="question-tag" class="badge"><a class="tag" href="/index.php/tagdetails?tag=<?php echo $row->tag_id?>" ><?php echo $row->tag_name; ?></a></div>
				<?php echo '   ';}?>
				<br/>
			</div>
			<div class="row">
				<div id="question-content" class="question-content"><?php echo $question_content; ?></div><br/>
			</div>
			<div class="row">
				<div class="pull-right">
				<br/>posted by <a href="/index.php/userprofile/showprofile?user=<?php echo $user_id; ?>"><?php echo $user_name;?></a> <img height="50" width="50" src="<?php echo $profile_pic; ?>">
				<br/><?php echo 'on: '.date("F j, Y, g:i a",strtotime($created_on));			?>
				<br/>
				</div>
			</div>
		</div>
		<div class="row">
			
		<span id="answer_count"><?php echo $answer_count; ?></span><span id="answer_noun"> Answers</span>
			<!-- <div class="pull-right" id="#answerquestion">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#answer-modal">Answer this question</button>
			</div> -->
			<!-- <div class="partition"></div> -->
		</div>
	<div class="well">
	<form>
		<div class="modal-body">
			<!--<input class="noEnterSubmit" type="text" id="answer_content" onsubmit="return false;" placeholder="Enter your answer here :") />-->
			<textarea rows="5" class="form-control" name="text1" placeholder="Enter your answer here" id="answer_content"></textarea><br/>
			<div id="error-answer"></div><br/>
		</div>
		<div class="modal-footer">
			<input type="hidden" id="answer_question" value="<?php echo $question_id; ?>">
			<button type="button" class="btn btn-default" id="submit-answer">Submit</button>
		</div>
	</form>

		<!--Answers for the question -->
		<div id="answers">
			<?php foreach($answers as $row) { ?>
			
			<div class="answer-content"><?php echo $row['answer_content']; ?></div><br/>
			<div class="row">
				<div class="pull-right">
					Posted
					by <a  href='/index.php/userprofile/showprofile?user=<?php echo $row["user_id"]; ?>'><?php echo $row['firstname']; ?> </a> <img src="/uploads/<?php echo $row['profile_pic']; ?>" height="50" width="50"/>
					<br/><?php echo 'on: '.date("F j, Y, g:i a",strtotime($row['created_on'])); ?>
				</div>
			</div>
			<div class="row">
				<div class="partition"></div>
			</div>
			<?php } ?>
		</div>
	</div>
		
	</div>
</div>
<div id="result-answer"></div>
<script type="text/javascript" src="/static/js/postedquestion.js"></script>