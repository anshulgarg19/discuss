
$(document).ready(function() {

    var url_value = getUrlVars();

    var offset = 10;
    var limit = 10;
    
    var question_id = url_value.question;

    $(window).on('scroll',function(){
      /*console.log($(window).height());
      console.log($(document).height());
      console.log($(window).scrollTop());*/
      if( Math.round($(window).scrollTop()) == ($(document).height() - $(window).height() )){
          addMoreAnswers();
      }

    });

    //allowing follow-unfollow
    $('#follow').click(function(){
      //console.log($('#changestatus').serialize());
      $.ajax({
        data: $('#changestatus').serialize(),
        type: "post",
        url : "/index.php/question/changefollowstatus",
        success: function(response){
          var current = $('#follow').html();
          if( current == 'Follow'){
            $('#follow').removeClass('btn-success');
            $('#follow').addClass('btn-danger');
            $('#follow').html('Unfollow');
            $('#follow_status').val(true);
          }
          else{
            $('#follow').removeClass('btn-danger');
            $('#follow').addClass('btn-success');
            $('#follow').html('Follow');
            $('#follow_status').val(false);
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

    //console.log($('#answer_count').text());

    $("#submit-answer").click(function(event){
      var data = getUrlVars();
      
      data['answer_content'] = $("#answer_content").val();
      var time = (new Date()).toUTCString();

      $.ajax({
          url : '/index.php/answer/postanswer',
          data : data,
          type : "POST",
          success: function(response){
            console.log('success');
            var answer_count = parseInt($('#answer_count').text());
            //console.log($('#answer_count').val());
            $('#answer_count').text(answer_count+1);
            if( answer_count == 1 )
              $('#answer_noun').text('Answers');

            var content = '<div id="answer-content"><h3>'+
        data['answer_content']+ '</h3></div><br/><h6>Posted on' + time +' Posted by You</h6><div class="partition"></div>'

            
            console.log(content);
            $('#answers-0').prepend(content);

            send_activity_mail(data);

          },
          error: function(response){
            console.log(response);
          }
      });

    });

    
    function send_activity_mail(data){
      $.ajax({
        url: '/index.php/answer/sendactivitymail',
        type: "POST",
        data: data,
        success: function(){
          console.log('mail sent');
        },
        error:function(){
          console.log(response);
        }
      });
    }
    

    //action if answer is empty
    function action_answer_empty(){
      $("#error-answer").css("color","red");
      $("#error-answer").html("Answer cannot be blank.");
    }

    // Read a page's GET URL variables and return them as an associative array.
    function getUrlVars()
    {
        var vars = {}, hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    //Function to add more content 
    function addMoreAnswers(){
        
        var data = {
          question: question_id ,
          offset: offset,
          limit: limit
        }  ; 
        console.log(data);
        $.ajax({
          url: '/index.php/answer/loadanswers',
          data:data,
          type : "post",
          success: function( response ){
            console.log(response);
            response.trim();
            if( response == '"></div>'){
              $(window).off('scroll');
              return;
            }
                
            response = '<div id="answers-'+(offset/limit)+response;
            $(response).insertAfter($('#answers-'+((offset/limit)-1)));
            offset = offset + limit;
            console.log(response);
            
          },
          error: function( response ){

          }
        });        
    }
});
