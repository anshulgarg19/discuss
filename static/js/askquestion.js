
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


	/*$('#post-question-button').prop('disabled',true);

	$('#question_title').focus(function(event) {
      if($(this).val() && $('#question_content').val() && $('#question_tags').val() ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_title').focusout(function(event) {
      if($(this).val() && $('#question_content').val() && $('#question_tags').val() ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_content').focus(function(event) {
      if($(this).val() && $('#question_title').val() && $('#question_tags').val() ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_content').focusout(function(event) {
      if($(this).val() && $('#question_title').val() && $('#question_tags').val() ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_tags').focus(function(event){
		if($(this).val() && $('#question_title').val() && $('#question_content').val() )
			$('#post-question-button').prop('disabled',false);
		else
			$('#post-question-button').prop('disabled',true);
	});

	$('#question_tags').focusout(function(event){
		if($(this).val() && $('#question_title').val() && $('#question_content').val() )
			$('#post-question-button').prop('disabled',false);
		else
			$('#post-question-button').prop('disabled',true);
	});*/

	 $('#question-modal').modal('show');

	$("#post-question-button").on('click', function(event) {
		event.preventDefault();
		var invalid = false;

		console.log($('#question_title').val());
		if( $('#question_title').val().length == 0 )
		{
			action_question_title_empty();
			invalid = true;
		}

		if( $('#question_content').val().length == 0 )
		{
			action_question_content_empty();
			invalid = true;
		}

		if( $('#question_tags').val().length == 0)
		{
			console.log($('#question_tags').val());
			invalid = true;
		}

		if( invalid )
			return;

        //$("#question_form").submit();
    });

	/*$('#post-question-button').click(function(event){

		//initialisations
		$("#error-question-title").html('');
		$('#error-question-content').html('');
		$('#error-question-tags').html('');
		//$('#question-response').hide();

		var question_title = $('#question-title').val();
		var question_content = $('#question-content').val();
		var question_tags = $('#question-tags').val();

		var invalid = false;


		if( !question_title.length )
		{
			action_question_title_empty();
			invalid = true;
		}

		
		//TODO: validation for tags
		if( invalid )
			return;

		var data = {
			questionTitle : question_title,
			questionContent : question_content,
			questionTags : question_tags
		};

		$.ajax({
			url : '/index.php/question/postquestion',
			data : data,
			type : 'POST',
			
			success: function( response ){
				console.log(response);
				//$('#question-form').hide();
				$('#question-response').html(response);
			},
			error: function( response ){
				console.log(response);
				$('#question-response').html(response.responseText);
			}
		});
	});*/

	//action on empty question title
	function action_question_title_empty(){
		$('#error-question-title').css("color","red");
		$('#error-question-title').html("Title cannot be empty");
	}

	//action on empty question content
	function action_question_content_empty(){
		$('#error-question-content').css("color","red");
		$('#error-question-content').html("Content cannot be empty");
	}
});