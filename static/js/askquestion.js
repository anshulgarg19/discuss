
$(document).ready(function(){

	/*$('#ask-question').hover(
		function(){
			//change to add class and remove class
			$('#ask-question').css({'cursor':'pointer','background':'orange'});
		},
		function(){
			$('#ask-question').css('background','white');
		}
	);

	$('#ask-question').click(function(){
		
		$.ajax({
			url: '/index.php/question/showquestionform',
			type: 'GET',
			dataType:'json',
			success: function( response ){
				console.log(response.form);
				$('#result-question-form').html(response.form);
			},
			error: function(){
				console.log('ask-question error');
			}
		});
	});*/


	$('post-question-button').click(function(){

		//initialisations
		$("#error-question-title").html('');
		$('#error-question-content').html('');
		$('#error-question-tags').html('');

		var question_title = $('#question-title').val();
		var question_content = $('#question-content').val();
		var question_tags = $('#question-tags').val();

		var invalid = false;

		if( !question_title.length )
		{
			action_question_title_empty();
			invalid = true;
		}

		if( !question_content.length )
		{
			action_question_content_empty();
			invalid = true;
		}

		//TODO: validation for tags
		if( invalid )
			return;

		var data = {
			questionTitle : question-title,
			questionContent : question_content,
			questionTags : question_tags
		};

		$.ajax({
			data : data,
			type : "POST",
			url : "/index.php/question/postquestion",
			success: function( response ){
				console.log(response);

			},
			error: function( response ){
				console.log(response);
			}
		});
	});

	//action on empty question title
	function action_question_title_empty(){
		$('#error-question-title').css("color","red");
		$('#error-question-title').html("Title cannot be empty");
	}

	//action on empty question content
	function action_question_content_empty(){
		$('#error-question-content').red("color","red");
		$('#error-question-content').html("Title cannot be empty");
	}
});