<?php foreach ($answers as $answer) {?>
	<div class="panel-default panel-heading"><h5>
			<a href="/index.php/question/questiondetails?question=<?php echo $answer->question_id; ?>" class="link"><?php echo $answer->title; ?>
			</a>

		</h5><br/>
		<?php echo $answer->answer_content; ?>
	</div>
	<div class="partition">
	</div>
<?php } ?>