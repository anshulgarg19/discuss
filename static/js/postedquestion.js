
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


    $("#submit-answer").click(function(event){
      var data = getUrlVars();
      data['answer_content'] = $("#answer_content").val();


      $.ajax({
          url : '/index.php/answer/postanswer',
          data : data,
          type : "POST",
          success: function(response){
            console.log('success');
            $("result-answer").html(response);
          },
          error: function(response){
            console.log(response);
            $("result-answer").html(response.responseText);
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
