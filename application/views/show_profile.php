<?php
 defined('BASEPATH') or exit('No direct access to script allowed');
?>
<script type="text/javascript" src="/static/js/profilepage.js"></script>
<div id="personal_detail" class="container">
	<div class="row">
		<div id="profile_pic" class="col-md-1 col-md-offset-1">
			<img src="/uploads/<?php echo $user->getProfilePicUrl() ?>" alt="Profile Picture"  height="140" width="140" class=" img-circle" id="photo">
			<!--<img src="/static/img/default.png" alt="Profile Picture" height="42" width="42">-->	
		</div>

		<div class="col-md-offset-2 col-md-7">
			<input id="current_user_id" type="hidden" name="current_user_id" value="<?php echo $current_user; ?>">
			<input id="user_id" type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<div id="name"><h3><span id="first_name"><?php echo $user->getFirstname().' '.$user->getLastname() ?></span>
			<?php if($current_user == $user_id){ ?>
			<button type="button" id="edit-name" style="font-size:20px" class="glyphicon glyphicon-pencil"></button></h3></div><br/>
				<!-- edit first and last name form-->
				<form id="edit-name-form" class="form-inline" style="display:none">
				  <div class="form-group">
				    <label for="new-firstname">First Name</label>
				    <input type="text" class="form-control" id="new-firstname" placeholder="<?php echo $user->getFirstname();?>">
		    		<div id="error-new-firstname"></div>
				  </div>
				  <div class="form-group">
				    <label for="new-lastname">Last Name</label>
				    <input type="text" class="form-control" id="new-lastname" placeholder="<?php echo $user->getLastname(); ?>">
				  </div>
				  <button id="update-name" type="button" class="btn btn-default">Update</button>
				</form><br/>
			<?php }else{?>
				</h3></div><br/>
			<?php }?>	
			<p><i class="glyphicon glyphicon-envelope"></i><?php echo '  '.$user->getEmail() ?><br/>
			<i class="glyphicon glyphicon-earphone"></i><?php echo '  '.$user->getPhone() ?><br/></p>
		</div>
	</div>
	<div class="row">
		<?php if( $current_user == $user_id){?>
		<div class="col-md-3 col-md-offset-1" >
			<p><a style="margin-left: 25px;" data-toggle="modal" data-target="#photo-modal" >Edit Photo</a></p>
		</div>
		<?php }?>
	</div>
	
		<div class="col-md-3 col-md-offset-1" >
			<h4>Tags Followed</h4>
			<div id="my-tags" style="height:350px;overflow-y:auto">
			
			<?php if( count($tags) == 0 ) echo 'No tags';
			 							else{ ?><br/>
										<?php	foreach($tags as $tag){?>
										<div id="tag-div-<?php echo $tag->tag_id; ?>">	
											
												<form id="changestatus-<?php echo $tag->tag_id; ?>">
													<a href="/index.php/tagdetails?tag=<?php echo $tag->tag_id; ?>" class="link link-tag"><?php echo $tag->tag_name.' ('.$tag->user_count.')'; ?></a>
													<?php if($current_user == $user_id){ ?>	
														<button style="float:right" id="tag-<?php echo $tag->tag_id?>" type="button" class="btn btn-sm unfollow-tag" value="<?php echo $tag->tag_id;?>">Unfollow</button>
													<?php }?>
												</form><br/>

										</div>
										<?php }
									} ?>		
			
			</div>
		</div>
		<div class="col-md-8 ">
			<!-- navbar -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" id="question-tab" class="active"><a href="#my-questions" aria-controls="home" role="tab" data-toggle="tab">Questions</a>
				</li>
				<li role="presentation" id="answer-tab"><a href="#my-answers" aria-controls="profile" role="tab" data-toggle="tab">Answers</a>
				</li>
				<li role="presentation" id="followed-tab"><a href="#my-followed" aria-controls="profile" role="tab" data-toggle="tab">Followed</a>
			</ul>

			<!-- questions nav bar-->
			<div class="tab-content">
				
					<div role="tabpanel" class="tab-pane active" id="my-questions">
						<div id="my-questions-0">
							<?php 
								if( count($questions) == 0 ) 
									echo '<br/>Not posted any quesitons yet.'; 
								else{
									foreach($questions as $question){?> 
										<div class="panel-default panel-heading"><h5><a href="/index.php/question/questiondetails?question=<?php echo $question->question_id; ?>"  class="link"><?php echo $question->title; ?></a></h5><br/>
											<?php echo $question->answer_count.' '; ?>Answers<br/> 
										</div><br/>
							<?php }
							}?>		
						</div>
					</div>
				
				<!-- answers nav bar -->
				
					<div role="tabpanel" class="tab-pane" id="my-answers">
						<div id="my-answers-0">
							<?php 
							  if( count($answers) == 0 )
								echo '<br/>Not answered any question yet.';
							  else{
							  	foreach ($answers as $answer) {?>
							  		<div class="panel-default panel-heading"><h5>
							  				<a href="/index.php/question/questiondetails?question=<?php echo $answer->question_id; ?>" class="link"><?php echo $answer->title; ?>
							  				</a>

							  			</h5><br/>
							  			<?php echo $answer->answer_content; ?>
							  		</div>
							  		<div class="partition">
							  		</div>
							  	<?php }
							  	}?>
						</div>	
					</div>

				<!-- followed question nav bar -->	

				<div role="tabpanel" class="tab-pane" id="my-followed">
					<div id="my-followed-0">
						<?php 
							if( count($followed_questions) == 0 )
								echo '<br/>Not followed any question yet.';
							else{
								foreach($followed_questions as $followed_question){?> 
										<div class="panel-default panel-heading"><h5><a href="/index.php/question/questiondetails?question=<?php echo $followed_question->question_id; ?>"  class="link"><?php echo $followed_question->title; ?></a></h5><br/>
											<?php echo $followed_question->answer_count.' '; ?>Answers<br/> 
										</div><br/>
							<?php }
							}?>
					</div>
				</div>
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
		  			<input type="file" name="userfile" id="userfile"/>
		  			<div id="image-error"></div>
				</form>		
		      </div>
		      <div class="modal-footer">
		        <!--<button type="submit" class="btn btn-default" data-dismiss="modal" id="post-question-button">Post</button>-->
		        <input type="submit" name="submit" id="change-photo-button"  class="btn btn-default" data-dismiss="modal" value="Upload">
		        
		      </div>
		      
	    </div>

	</div>
</div>

