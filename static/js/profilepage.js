
$(document).ready(function(){

	var user_id = $("#user_id").val();
	var question_offset = 10;
	var question_limit = 10;

	var answer_offset = 10;
	var answer_limit = 10;
	/*$(window).on('scroll', function(){
		if( Math.round( $(window).scrollTop()) == ($(document).height() - $(window).height())){
			addMoreQuestions();
		}
	});*/

	$(window).on('scroll',function(){
      /*console.log($(window).height());
      console.log($(document).height());*/
      //console.log($(window).scrollTop());
      if( Math.ceil($(window).scrollTop()) == ($(document).height() - $(window).height() )){
          //addMoreQuestions();
          var active = $('.nav-tabs .active').attr("id");
          console.log('active is '+active);
          if( active == "question-tab"){
          	addMoreQuestions();
          }
          else if( active == "answer-tab"){
          	addMoreAnswers();
          }
          //to extend for following: else
      }

    });

	$("#change-photo-button").on('click', function(event) {
		//console.log('success');

        $("#change_photo_form").submit();
        //console.log('success');
    });

	//Function to add more question
	function addMoreQuestions(){
		var data = {
			user_id : user_id,
			offset : question_offset,
			limit : question_limit
		};
		//console.log(data);
		//console.log('insie');
		$.ajax({
			url : '/index.php/question/loadquestions',
			data: data,
			type: "POST",
			
			success: function(response){
				response.trim();
				if( response == "</div>")
				{
					console.log('empty response');
					//$(window).off('scroll');
				}
				else{
					response = '<div id="my-questions-'+(question_offset/question_limit)+'">'+response;
					$(response).insertAfter("#my-questions-"+((question_offset/question_limit)-1));
					question_offset = question_offset + question_limit;
					console.log(response);
				}	
			},
			error: function(response){
				console.log(response.responseText);
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
				console.log(response);
				if( response == "</div>")
				{
					console.log("answers finished");
					//$(window).off('scroll');
					return;
				}
				else
				{
					response = '<div role="tabpanel" class="tab-pane" id="my-answers-'+(answer_offset/answer_limit)+'">'+response;
					$(response).insertAfter("#my-answers-"+((answer_offset/answer_limit)-1));
					answer_offset += answer_limit;
					console.log(response);
				}
			},
			error: function(response){

			}
		});
	}
});