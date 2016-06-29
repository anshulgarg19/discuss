
$(document).ready(function() {

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
            var content = '<div class="answer-content"><h1>' +
            data['answer_content'] +
            '</h1></div>' +
            '<div class="answer-time">' +
            time +
            '</div>' + 
            '<div id="answer-user">' +
            'Posted by you' +
            '</div>';
            console.log(content);
            $('#answers').prepend(content);
          },
          error: function(response){
            console.log(response);
          }
      });

    });

    

    

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
});
