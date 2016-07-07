
$(document).ready(function(){
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
    	results: function(data, page) {
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


		if( question_title.length == 0 || question_title.length > 200)
		{
			action_question_title_empty();
			invalid = true;
		}

		if( question_content.length ==0)
		{
			action_question_content_empty();
			invalid = true;
		}
		
		if($('#tag_select').select2("val") == null) {
			action_question_tag_empty();
			invalid = true;
		}
		//TODO: validation for tags
		if( invalid )
			return;

		$('#question_form').submit();
	});

	//action on empty question title
	function action_question_title_empty(){
		$('#error-question-title').css("color","red");
		$('#error-question-title').html("Title should be between one and 200 characters");
	}

	//action on empty question content
	function action_question_content_empty(){
		$('#error-question-content').css("color","red");
		$('#error-question-content').html("Content cannot be empty");
	}

	//action on empty tag content
	function action_question_tag_empty(){
		$('#error-question-tags').css("color","red");
		$('#error-question-tags').html("Question should have at least one tag");
	}
});