jQuery(document).ready(function($) {
	var offset = 0;

	var addMoreQuestions = function(offset) {
		$.ajax({
			url: '/index.php/tagdetails/moreQuestions',
			type: 'GET',
			data: {offset: offset, tag: $('#tagid').val()}
		})
		.success(function(response) {
			$('#questionsfortag').append(response);
		})
		.error(function(response) {
		});
		
	}
	$(window).on('scroll',function(){	
	  if( Math.ceil($(window).scrollTop()) == ($(document).height() - $(window).height() )){
	      addMoreQuestions((offset += 10));
	  }

	});


	$('#follow').click(function(event) {

		$.ajax({
			data: $('#changestatus').serialize(),
			method: 'POST',
			url: '/index.php/tagdetails/changeFollowStatus'
		})
		.success(function(response) {
			var current = $('#follow').html();
			if (current == "Follow Tag") {
				$('#follow').removeClass('btn-success');
				$('#follow').addClass('btn-danger');
				$('#follow').html("Unfollow Tag");
				$('#numfollowerscontainer').html("No. of users following this tag:<span id=\"numfollowers\">" + (parseInt($('#numfollowers').html()) + 1).toString() + "</span>");
				$('#change').val(1);				

			}
			else {
				$('#follow').removeClass('btn-danger');
				$('#follow').addClass('btn-success');
				$('#follow').html("Follow Tag");
				$('#numfollowerscontainer').html("No. of users following this tag:<span id=\"numfollowers\">" + (parseInt($('#numfollowers').html()) - 1).toString() + "</span>");
				$('#change').val(0);
				
			}
		});
	});
});