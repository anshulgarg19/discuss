jQuery(document).ready(function($) {
	var offset = 0;

	var addMoreQuestions = function(offset) {
		var active = $('.nav-tabs .active').attr("id");
		$.ajax({
			url: '/index.php/userhome/morequestions',
			type: 'GET',
			data: {offset: offset, type: active}
		})
		.success(function(response) {
			if(active == "recenttab") {
				$('#recentlist').append(response);
			}
			else {
				$('#followinglist').append(response);
			}
		})
		.error(function(response) {
		});
		
	}
	$(window).on('scroll',function(){	
	  if( Math.ceil($(window).scrollTop()) == ($(document).height() - $(window).height() )){
	      addMoreQuestions((offset += 10));
	  }

	});
});