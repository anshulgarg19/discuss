<?php foreach ($questions as $question): ?>
	<li class="list-group-item"><a href="question/questiondetails?question=<?php echo $question['question_id']; ?>"><h2><?php echo $question['title']; ?></h2></a>
	<div class="row">
		<?php echo substr($question["question_content"], 0, 500);
		if( strlen($question['question_content']) > 500) {
				echo '<a href="question/questiondetails?question='.$question['question_id'].'"><strong>...MORE</strong></a>';
		}?>
	</div>
	<div class="row">
		<?php $tag_ids=array_keys($question['tag_list']); 
			foreach($tag_ids as $tag_id){?>
	
				<a href="tagdetails?tag=<?php echo $tag_id; ?>">
				<div class="badge">
					<?php echo $question['tag_list'][$tag_id]; ?>
				</div>
				</a>
		<?php }?>
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
