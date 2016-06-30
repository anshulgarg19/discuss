<div class="container">
	<div class="col-md-8 col-md-offset-2">

	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#recents" aria-controls="home" role="tab" data-toggle="tab">Recent Questions</a></li>
	    <li role="presentation"><a href="#following" aria-controls="profile" role="tab" data-toggle="tab">Questions in followed tags</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="recents">
			<ul class="list-group">
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
						<?php for($i=0; $i < count($question['tag_names']); $i++) { ?>
						<a href="<?php echo $question['id_list'][$i]; ?>">
							<div class="badge">
								<?php echo $question['tag_names'][$i]; ?>
							</div>
						<?php } ?>
						</a>
					</div>
					<div class="pull-left">
						<a href="question/questiondetails?question=<?php echo $question['question_id']; ?>">No. of Answers: <?php echo $question['answer_count']; ?></a>
					</div>
					<div class="row">
					<div class="pull-right">
						Posted on: <?php echo $question['created_on']; ?>
					</div>
					</div>
					<div class="row">
					<div class="pull-right">
						Last activity: <?php echo $question['last_modified_on'];?>
					</div>
					</div>
				</li>
			<?php
					endforeach; 
			?>
			</ul>
	    </div>
	    
	    <div role="tabpanel" class="tab-pane active" id="following">
	    	<ul class="list-group">
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
	    				<a href="<?php echo $question['id_list'][$i]; ?>">
	    					<div class="badge">
	    						<?php echo $question['tag_names'][$i]; ?>
	    					</div>
	    				<?php } ?>
	    				</a>
	    			</div>
	    			<div class="pull-left">
	    				<a href="question/questiondetails?question=<?php echo $question['question_id']; ?>">No. of Answers: <?php echo $question['answer_count']; ?></a>
	    			</div>
	    			<div class="row">
	    			<div class="pull-right">
	    				Posted on: <?php echo $question['created_on']; ?>
	    			</div>
	    			</div>
	    			<div class="row">
	    			<div class="pull-right">
	    				Last activity: <?php echo $question['last_modified_on'];?>
	    			</div>
	    			</div>
	    		</li>
	    	<?php
	    			endforeach; 
	    	?>
	    	</ul>
	    </div>
	  </div>

	</div>
</div>