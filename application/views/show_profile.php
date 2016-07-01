<?php
 defined('BASEPATH') or exit('No direct access to script allowed');
?>
<div id="personal_detail" class="container">
	<div class="row">
		<div id="profile_pic" class="col-md-1 col-md-offset-1">
			<img src="/uploads/<?php echo $user->getProfilePicUrl() ?>" alt="Profile Picture"  height="140" width="140" class=" img-circle" id="photo">
			<!--<img src="/static/img/default.png" alt="Profile Picture" height="42" width="42">-->
			<p class="edit-link"><a data-toggle="modal" data-target="#photo-modal" >Edit Photo</a></p>
		</div>

		<div class="col-md-offset-2 col-md-5">
			<input id="user_id" type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<div id="name"><h3><?php echo $user->getFirstname().' '.$user->getLastname() ?></h3></div><br/>
			<p><i class="glyphicon glyphicon-envelope"></i><?php echo '  '.$user->getEmail() ?><br/>
			<i class="glyphicon glyphicon-earphone"></i><?php echo '  '.$user->getPhone() ?><br/></p>
		</div>
	</div><br/>
	<div class="row">
		<div class="col-md-offset-1 col-md-10 partition"></div>
	</div>
	
		<div class="col-md-2 col-md-offset-1">
			<div id="my-tags">
			
			<?php if( count($tags) == 0 ) echo 'No tags';
			 							else{ ?><span>Tags Followed</span><br/>
										<?php	foreach($tags as $tag){?>
										<a href="/index.php/tagdetails?tag=<?php echo $tag->tag_id; ?>" target="_blank" class="link link-tag"><?php echo $tag->tag_name.' ('.$tag->user_count.')'; ?></a><br/>
										<?php }
										}?>		
			
			</div>
		</div>
		<div class="col-md-8 ">
			<div id="my-questions-0">
					
					<?php if( count($questions) == 0 ) 
							echo 'You have not posted any quesitons yet.'; 
						else{
							foreach($questions as $question){?> 
								<div class="panel-default panel-heading"><h5><a href="/index.php/question/questiondetails?question=<?php echo $question->question_id; ?>" target="_blank" class="link"><?php echo $question->title; ?></a></h5><br/>
									<?php echo $question->answer_count.' '; ?>Answers<br/> 
								</div><br/>
					<?php }
					}?>		
					
			</div>
		</div>
	
</div>

<div id="photo-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Upload Profile Picture</h4>
	      </div>
	      
		      <div class="modal-body">
		        <!--<input class="noEnterSubmit" type="text" id="answer_content" onsubmit="return false;" placeholder="Enter your answer here :") />-->
		        <form method="POST" action="/index.php/userprofile/changepic" id="change_photo_form" enctype="multipart/form-data">
		  			<input type="file" name="userfile"/>
				</form>		
		      </div>
		      <div class="modal-footer">
		        <!--<button type="submit" class="btn btn-default" data-dismiss="modal" id="post-question-button">Post</button>-->
		        <input type="submit" name="submit" id="change-photo-button"  class="btn btn-default" data-dismiss="modal" value="Upload">
		        
		      </div>
		      
	    </div>

	</div>
</div>

<script type="text/javascript" src="/static/js/profilepage.js"></script>