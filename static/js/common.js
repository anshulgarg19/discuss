(function() {
	'use strict';

	$("#navbarsearcherror").hide();
	//browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		$back_to_top = $('.cd-top');

	jQuery(document).ready(function($) {

		//hide or show the "back to top" link
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
		});

		$('#searchfield').autocomplete({
		    serviceUrl: '/index.php/search/suggest',
		    autoSelectFirst: true,
		    showNoSuggestionNotice: true,
		    noSuggestionNotice: 'No matching tags found',
		    onInvalidateSelection: function() {
		    	$('#hiddensearchinput').val("");
		    },
		    onSelect: function (suggestion) {
		        $('#hiddensearchinput').val(suggestion.data);
	    	}
		});

		$('#navBarSearchForm').submit(function(event) {

			if($('#hiddensearchinput').val() === "") {
				event.preventDefault();
				$("#navbarsearcherror").show();
				$("#navbarsearcherror").html('No tags matching this name found');
			}
			else
				$('#navBarSearchForm')[0].submit();
		});
	});

})();