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