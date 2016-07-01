"><?php foreach($answers as $row) { ?>
			
			<div id="answer-content"><h3><?php echo $row['answer_content']; ?></h3></div><br/>
			<h6>Posted on <?php echo $row['created_on']; ?>
			by <a target="_blank" href='/index.php/userprofile/showprofile?user=<?php echo $row["user_id"]; ?>'><?php echo $row['firstname']; ?> </a>
			</h6>
			<div class="partition"></div>
		<?php } ?>
</div>