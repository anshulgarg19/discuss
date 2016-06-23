<?php
 defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="personal_detail">
	<div id="profile_pic">
		<!--<img src="<?php echo $user->getProfilePicUrl() ?>" alt="Profile Picture" height="42" width="42">-->
		<img src="/static/img/default.png" alt="Profile Picture" height="42" width="42">
	</div>

	<form action="/index.php/userprofile/changepic" method="POST" enctype="multipart/form-data">

	Select a Profile Picture to upload:<br/>
	<input type="file" name="userfile"/><br/><br/>
	<input type="button" name="submit" value="Upload"/>
	</form>

	<div id="name">Name: <?php echo $user->getFirstname().' '.$user->getLastname() ?></div><br/>
	<div id="email">Email: <?php echo $user->getEmail() ?></div><br/>
	<div id="phone_num">Phone Number: <?php echo $user->getPhone() ?></div><br/>

</div>

