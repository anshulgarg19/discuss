
	
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
				$("#header_first_name").html(new_firstname + '<span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>');
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

	$("#change-photo-button").prop("disabled",true);

	$("#change-photo-button").on('click', function(event) {

        $("#change_photo_form").submit();
    });

    $("#userfile").change(function(){
    	$("#image-error").html("");
    	var file = this.files[0];

    	var imagefile = file.type;
    	var filesize = file.size;

    	var match = ["image/jpeg","image/jpg","image/png","image/gif"];
    	var error_message;

    	if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			error_message = "<p>Please Select valid File (Allowed:jpeg/jpg/png/gif)</p>";
			action_invalid_profile_pic(error_message);
			return false;
		}
		if(filesize > 2*1024*1024){
			error_message = "<p>Max file size allowed is 2MB.</p>";
			action_invalid_profile_pic(error_message);
			return false;
		}
		$("#change-photo-button").prop("disabled",false);
    	console.log(file);
    });

    function action_invalid_profile_pic(message){
    	$("#change-photo-button").prop("disabled",true);
		$("#image-error").html(message);
    }

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
				if( response == "")
				{
					return;
				}
				else{
					$("#my-questions").append(response);
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
				if( response == "")
				{
					console.log(answer_offset);
					return;
				}
				else
				{
					$("#my-answers").append(response);
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
				if( response == "")
				{
					return;
				}
				else{
					$("#my-followed").append(response);
					followed_question_offset = followed_question_offset + followed_question_limit;
				}	
			},
			error: function(response){
			}
		});
	}
});