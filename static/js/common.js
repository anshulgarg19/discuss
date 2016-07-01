(function() {
	'use strict';

	jQuery(document).ready(function($) {
		$('#searchfield').autocomplete({
		    serviceUrl: '/index.php/search/suggest',
		    onSelect: function (suggestion) {
		        $('#hiddensearchinput').val(suggestion.data);
	    	}
		});
	});

})();