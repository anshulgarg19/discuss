<?php
 defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="personal_detail">
	<div id="profile_pic">
		<img src="/uploads/<?php echo $user->getProfilePicUrl() ?>" alt="Profile Picture" height="42" width="42">
		<!--<img src="/static/img/default.png" alt="Profile Picture" height="42" width="42">-->
	</div>

	<form action="/index.php/userprofile/changepic" method="POST" enctype="multipart/form-data">

		Update Profile Picture:<br/>
		<input type="file" name="userfile"><br/><br/>
		<input type="submit" name="submit" value="Upload"/>
	</form>

	<div id="name">Name: <?php echo $user->getFirstname().' '.$user->getLastname() ?></div><br/>
	<div id="email">Email: <?php echo $user->getEmail() ?></div><br/>
	<div id="phone_num">Phone Number: <?php echo $user->getPhone() ?></div><br/>

	<div id="my-questions"><?php if( count($questions) == 0 ) echo 'You have not posted any quesitons yet.'; 							else{
									foreach($questions as $question){?>Q: 
								<a href="/index.php/question/questiondetails?question=<?php echo $question->question_id; ?>" target="_blank"><?php echo $question->question_content; ?></a><br/>
								<?php }
								}?>		
	</div>

</div>

