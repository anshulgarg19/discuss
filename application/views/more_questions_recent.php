<?php foreach ($questions as $question): ?>
<li class="list-group-item"><a href="question/questiondetails?question=<?php echo $question['id']; ?>"><h2><?php echo $question['title']; ?></h2></a>
<div class="row">
	<?php echo substr($question["question_content"], 0, 500);
	if( strlen($question['question_content']) > 500) {
			echo '<a href="question/questiondetails?question='.$question['id'].'"><strong>...MORE</strong></a>';
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
</div>
<div class="row">
	<div class="pull-left">
		<a href="question/questiondetails?question=<?php echo $question['id']; ?>">No. of Answers: <?php echo $answer_counts[(int)$question['id']]; ?></a><br/><br/>
		Last activity: <?php echo date("F j, Y, g:i a",strtotime($question['last_modified']));?>
	</div>
	<div class="pull-right">
		Posted by: <a href="<?php echo $question['user_id']; ?>"><?php echo $question['name']?></a> <img src="/uploads/<?php echo $question['profile_pic']; ?>" height="50" width="50">
		<br/><div style="margin-top:5px;">on: <?php echo date("F j, Y, g:i a",strtotime($question['created_on'])); ?></div><br/>
	</div>
</div>
<div class="row">
	<div class="pull-right">
	</div>
</div>
</li>
<?php endforeach; ?>