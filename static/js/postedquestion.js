
$(document).ready(function() {

    var offset = 10;
    var limit = 10;
    
    var question_id = $('#answer_question').val();

    $(window).on('scroll',function(){
      if( Math.round($(window).scrollTop()) == ($(document).height() - $(window).height() )){
          addMoreAnswers();
      }

    });

    //allowing follow-unfollow
    $('#follow').click(function(){
      $.ajax({
        data: $('#changestatus').serialize(),
        type: "post",
        url : "/index.php/question/changefollowstatus",
        success: function(response){
          var current = $('#follow').html();
          if( current == 'Follow Question'){
            $('#follow').removeClass('btn-success');
            $('#follow').addClass('btn-danger');
            $('#follow').html('Unfollow Question');
            $('#follow_status').val(1);
          }
          else{
            $('#follow').removeClass('btn-danger');
            $('#follow').addClass('btn-success');
            $('#follow').html('Follow Question');
            $('#follow_status').val(0);
          }
        },
        error: function(response){

        }
      });
    });

    

    //enable submit button only when text is not empty
    $('#submit-answer').prop('disabled', true);
    $('#answer_content').on('keyup',function() {
      if($(this).val()) {
          $('#submit-answer').prop('disabled' , false);
      }else{
          $('#submit-answer').prop('disabled' , true);
      }
    });

    $("#submit-answer").click(function(event){
      var data = {};
      
      data['answer_content'] = $("#answer_content").val();
      data['question'] = $('#answer_question').val();

      var time = (new Date()).toUTCString();

      $.ajax({
          url : '/index.php/answer/postanswer',
          data : data,
          type : "POST",
          success: function(response){
            var answer_count = parseInt($('#answer_count').text());
            $('#answer_count').text(answer_count+1);
            if( answer_count == 1 )
              $('#answer_noun').text(' Answers');

            var content = '<div class="answer-content">'+data['answer_content']+'</div><br/><div class="row">  <div class="pull-right">Posted by You <br/>on: '+time+'</div></div><div class="row"><div class="partition"></div>';

            
            $('#answers').prepend(content);

            $("#answer_content").val('');
            send_activity_mail(data);

          },
          error: function(response){
          }
      });

    });

    
    function send_activity_mail(data){
      $.ajax({
        url: '/index.php/answer/sendactivitymail',
        type: "POST",
        data: data,
        success: function(){
        },
        error:function(){
        }
      });
    }
    

    //action if answer is empty
    function action_answer_empty(){
      $("#error-answer").css("color","red");
      $("#error-answer").html("Answer cannot be blank.");
    }

    //Function to add more content 
    function addMoreAnswers(){
        
        var data = {
          question: question_id ,
          offset: offset,
          limit: limit
        }  ; 
        $.ajax({
          url: '/index.php/answer/loadanswers',
          data:data,
          type : "post",
          success: function( response ){
            response.trim();
            if( response == ''){
              $(window).off('scroll');
              return;
            }
                
            
            $("#answers").append(response);
            offset = offset + limit;
            
          },
          error: function( response ){

          }
        });        
    }
});
