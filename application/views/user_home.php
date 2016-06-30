<div>
	<?php 
			echo "<h2>Recent questions</h2>";
			foreach ($questions as $question):
				var_dump($question);
			endforeach; 
			echo "<h2>Followed tags</h2>";	
			foreach ($followed_tags_questions as $question):
				var_dump($question);
			endforeach; 
	?>
</div>