(function() {
	'use strict';

	jQuery(document).ready(function($) {
		$('#searchfield').autocomplete({
		    serviceUrl: 'search/suggest',
		    onSelect: function (suggestion) {
		        $('#hiddensearchinput').val(suggestion.data);
	    	}
		});
	});

})();