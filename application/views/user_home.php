<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" id="recenttab" class="active"><a href="#recents" aria-controls="home" role="tab" data-toggle="tab">Recent Questions</a></li>
			<li role="presentation" id="followingtab"><a href="#following" aria-controls="profile" role="tab" data-toggle="tab">Questions in followed tags</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="recents">
				<ul id="recentlist" class="list-group">
					<?php
							foreach ($questions as $question):
					?>
					<li class="list-group-item"><a href="question/questiondetails?question=<?php echo $question['question_id']; ?>"><h2><?php echo $question['title']; ?></h2></a>
					<div class="row">
						<?php echo substr($question["question_content"], 0, 500);
						if( strlen($question['question_content']) > 500) {
								echo '<a href="question/questiondetails?question='.$question['question_id'].'"><strong>...MORE</strong></a>';
						}?>
					</div>
					<div class="row">
						<?php
						if(array_key_exists("tag_names", $question)) { 
						for($i=0; $i < count($question['tag_names']); $i++) { ?>
						<a href="tagdetails?tag=<?php echo $question['id_list'][$i]; ?>">
							<div class="badge">
								<?php echo $question['tag_names'][$i]; ?>
							</div>
						</a>
						<?php }} ?>
					</div>
					<div class="pull-left">
						<a href="question/questiondetails?question=<?php echo $question['question_id']; ?>">No. of Answers: <?php echo $question['answer_count']; ?></a>
					</div>
					<div class="row">
						<div class="pull-right">
							Posted on: <?php echo date("F j, Y, g:i a",strtotime($question['created_on'])); ?>
						</div>
					</div>
					<div class="row">
						<div class="pull-right">
							Last activity: <?php echo date("F j, Y, g:i a",strtotime($question['last_modified_on']));?>
						</div>
					</div>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>

			<div role="tabpanel" class="tab-pane" id="following">
				<ul id="followinglist" class="list-group">
					<?php
							foreach ($followed_questions as $question):
					?>
					<li class="list-group-item"><a href="question/questiondetails?question=<?php echo $question['question_id']; ?>"><h2><?php echo $question['title']; ?></h2></a>
					<div class="row">
						<?php echo substr($question["question_content"], 0, 500);
						if( strlen($question['question_content']) > 500) {
								echo '<a href="question/questiondetails?question='.$question['question_id'].'"><strong>...MORE</strong></a>';
						}?>
					</div>
					<div class="row">
						<?php for($i=0; $i < count($question['tag_names']); $i++) { ?>
						<a href="tagdetails?tag=<?php echo $question['id_list'][$i]; ?>">
							<div class="badge">
								<?php echo $question['tag_names'][$i]; ?>
							</div>
						</a>
						<?php } ?>
					</div>
					<div class="pull-left">
						<a href="question/questiondetails?question=<?php echo $question['question_id']; ?>">No. of Answers: <?php echo $question['answer_count']; ?></a>
					</div>
					<div class="row">
						<div class="pull-right">
							Posted on: <?php echo date("F j, Y, g:i a",strtotime($question['created_on'])); ?>
						</div>
					</div>
					<div class="row">
						<div class="pull-right">
							Last activity: <?php echo date("F j, Y, g:i a",strtotime($question['last_modified_on']));?>
						</div>
					</div>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<script src="/static/js/userhome.js" type="text/javascript" charset="utf-8" async defer></script>