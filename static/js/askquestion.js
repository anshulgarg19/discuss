
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


	//$('#post-question-button').prop('disabled',true);

	/*$('#question_title').focus(function(event) {
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

	/*$('#question_title').on('keyup',function(event) {
      if($(this).val().length && $('#question_content').val().length && $('#question_tags').val().length ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_content').on('keyup',function(event) {
      if($(this).val().length && $('#question_title').val().length && $('#question_tags').val().length ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });

	$('#question_tags').on('keyup',function(event) {
      if($(this).val().length && $('#question_content').val().length && $('#question_title').val().length ) {
          $('#post-question-button').prop('disabled' , false);
      }else{
          $('#post-question-button').prop('disabled' , true);
      }
    });*/

	/*$("#post-question-button").on('click', function(event) {

		event.preventDefault();

		var invalid = false;

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

		if( $('#question_tags').val().length == 0 )
		{
			console.log('invalid input tags');
			invalid = true;
		}

		if( invalid )
			return;
        //$("#question_form").submit();
    });*/
    $('#tag_select').select2({
    	tags: true,
    	tokenSeparators: [",", " "],
    	maximumSelectionSize: 5,
    	placeholder: "Enter the tags",
    	createSearchChoice: function(term, data) {
    	    if ($(data).filter(function() {
    	      return this.text === term;
    	    }).length === 0) {
    	      return {
    	        id: term,
    	        text: term
    	      };
    	    }
    	 },
    	results: function(data) {
    		return {
    			results: data
    		};
    	},
    	ajax: {
    	  url: 	function(params) {
    	  	return '/index.php/search/suggestForTags?term=' + params.term;
    	  },
    	  dataType:'json',
    	  processResults: function (data) {
    	  	console.log(data);
    	    return {
    	      results: data,
    	      more: false
    	    };
    	  },
    	  error: function(response) {
    	  	$('#error-question-tags').html(response.responseText);
    	  }
    	}
    });	

	$('#post-question-button').click(function(event){

		event.preventDefault();
		//initialisations
		$("#error-question-title").html('');
		$('#error-question-content').html('');
		$('#error-question-tags').html('');
		//$('#question-response').hide();

		var question_title = $('#question_title').val();
		var question_content = $('#question_content').val();
		var question_tags = $('#question_tags').val();

		var invalid = false;


		if( question_title.length == 0)
		{
			action_question_title_empty();
			invalid = true;
		}

		if( question_content.length ==0)
		{
			action_question_content_empty();
			invalid = true;
		}
		
		//TODO: validation for tags

		/*if( !validate_tags(question_tags) ) 
		{
			invalid = true;
		}*/

		if( invalid )
			return;

		var data = {
			questionTitle : question_title,
			questionContent : question_content,
			questionTags : $('#tag_select').select2("val")
		};

		$.ajax({
			url : '/index.php/question/postquestion',
			data : data,
			type : 'POST',
			success: function(response) {
				$('#questionmodal').modal('hide');
				$('body').html(response);
			},
			error: function( response ){
				console.log("called error");
				var restext = JSON.parse(response.responseText);
				if( !(restext["error_question_title"] == undefined) )
				{
					action_question_title_empty();
					invalid = true;
				}
				if( !(restext['error_question_content'] == undefined))
				{
					action_question_content_empty();
					invalid = true;
				}
				$('#question-response').html(response.responseText);
			}
		});
		console.log(data);
	});

	//action on empty question title
	function action_question_title_empty(){
		console.log('called title');
		$('#error-question-title').css("color","red");
		$('#error-question-title').html("Title cannot be empty");
	}

	//action on empty question content
	function action_question_content_empty(){
		console.log('called content');
		$('#error-question-content').css("color","red");
		$('#error-question-content').html("Content cannot be empty");
	}
});