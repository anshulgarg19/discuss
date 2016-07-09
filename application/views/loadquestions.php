<?php foreach($questions as $question){?>
	<div class="panel-default panel-heading">
	<h5><a href="/index.php/question/questiondetails?question=<?php echo $question->question_id; ?>" target="_blank" class="link"><?php echo $question->title; ?></a></h5><br/>
	<?php echo $question->answer_count.' '; ?>Answers<br/> 
	</div><br/>
<?php } ?>
