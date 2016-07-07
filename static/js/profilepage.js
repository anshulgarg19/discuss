
	
$(document).ready(function(){


	var user_id = $("#user_id").val();
	var question_offset = 10;
	var question_limit = 10;

	var answer_offset = 10;
	var answer_limit = 10;

	var followed_question_offset = 10;
	var followed_question_limit = 10;

	$(window).on('scroll',function(){
      if( Math.ceil($(window).scrollTop()) == ($(document).height() - $(window).height() )){
          var active = $('.nav-tabs .active').attr("id");
          if( active == "question-tab"){
          	addMoreQuestions();
          }
          else if( active == "answer-tab"){
          	addMoreAnswers();
          }
          else{
          	addMoreFollowedQuestions();
          }
          
      }

    });


	$("#edit-name").click(function(){
		$('#edit-name-form').show();
	});

	$("#update-name").click(function(){
		var new_firstname = $("#new-firstname").val();
		var new_lastname = $("#new-lastname").val();

		if( new_firstname.length == 0 )
		{
			window.alert("First Name can't be empty.")
			return;
		}

		var data = {
			firstname: new_firstname,
			lastname : new_lastname
		}

		$.ajax({
			data: data,
			type: "post",
			url: "/index.php/userprofile/changename",
			success: function(response){
				$("#edit-name-form").hide();
				$("#first_name").html(new_firstname+" "+new_lastname);
				$("#link_first_name").html(new_firstname);
				$("#new-firstname").val("");
				$("#new-firstname").attr("placeholder",new_firstname);
				$("#new-lastname").val("");
				$("#new-lastname").attr("placeholder",new_lastname);
			},
			error: function(response){

			}
		});
	});

	$(".unfollow-tag").click(function(event){
		var tag_id = this.id.substring(4);
		var data = {
			tag_id : tag_id,
		}
		$.ajax({
			data: data,
			type: "POST",
			url: "/index.php/userprofile/unfollowtag",
			success: function(){
				$("#tag-div-"+tag_id).remove();
			},
			error: function(){

			}
		});
	});

	$("#change-photo-button").on('click', function(event) {

        $("#change_photo_form").submit();
    });

	function action_empty_first_name(){
		$("#error-new-firstname").css("color","red");
		$("#error-new-firstname").html("First name cant be empty");
	}

	//Function to add more question
	function addMoreQuestions(){
		
		var data = {
			user_id : user_id,
			offset : question_offset,
			limit : question_limit,
			type: "POST"
		};
		$.ajax({
			url : '/index.php/question/loadquestions',
			data: data,
			type: "POST",
			
			success: function(response){
				response.trim();
				if( response == "</div>")
				{
					return;
				}
				else{
					response = '<div id="my-questions-'+(question_offset/question_limit)+'">'+response;
					$(response).insertAfter("#my-questions-"+((question_offset/question_limit)-1));
					question_offset = question_offset + question_limit;
				}	
			},
			error: function(response){
			}
		});
	}

	function addMoreAnswers(){
		var data = {
			user_id : user_id,
			offset : answer_offset,
			limit: answer_limit
		};
		
		$.ajax({
			url : '/index.php/answer/getuseranswers',
			data: data,
			type:"post",
			success: function(response){
				response.trim();
				if( response == "</div>")
				{
					return;
				}
				else
				{
					response = '<div role="tabpanel" class="tab-pane" id="my-answers-'+(answer_offset/answer_limit)+'">'+response;
					$(response).insertAfter("#my-answers-"+((answer_offset/answer_limit)-1));
					answer_offset += answer_limit;
				}
			},
			error: function(response){

			}
		});
	}

	function addMoreFollowedQuestions(){
		var data = {
			user_id : user_id,
			offset : followed_question_offset,
			limit : followed_question_limit,
			type: "FOLLOW"
		};
		$.ajax({
			url : '/index.php/question/loadquestions',
			data: data,
			type: "POST",
			
			success: function(response){
				response.trim();
				if( response == "</div>")
				{
					return;
				}
				else{
					response = '<div id="my-followed-'+(followed_question_offset/followed_question_limit)+'">'+response;
					$(response).insertAfter("#my-followed-"+((followed_question_offset/followed_question_limit)-1));
					followed_question_offset = followed_question_offset + followed_question_limit;
				}	
			},
			error: function(response){
			}
		});
	}
});