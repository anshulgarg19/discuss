jQuery(document).ready(function($) {
	var recent_offset = 10;
	var following_offset = 10;

	var addMoreQuestions = function() {
		var active = $('.nav-tabs .active').attr("id");
		var offset;
		if( active == "recenttab")
			offset = recent_offset;
		else
			offset = following_offset;
		$.ajax({
			url: '/index.php/userhome/morequestions',
			type: 'GET',
			data: {offset: offset, type: active}
		})
		.success(function(response) {
			if(active == "recenttab") {
				$('#recentlist').append(response);
				recent_offset += 10;
			}
			else {
				$('#followinglist').append(response);
				following_offset += 10;
			}
		})
		.error(function(response) {
			$(window).off('scroll');
		});
		
	}
	$(window).on('scroll',function(){	
	  if( Math.ceil($(window).scrollTop()) == ($(document).height() - $(window).height() )){
	      addMoreQuestions();
	  }

	});
});