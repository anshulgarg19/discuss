jQuery(document).ready(function($) {

		var offset = 10;
		var limit = 10;

		$('#tag_details').on('scroll',function(){
			if( Math.round($('#tag_details').scrollTop()) == ($('#tag_details')[0].scrollHeight - $('#tag_details').height())){
				addMoreTags();
			}
		});

		var tags = [];
		$('#submit').click(function(event) {

			$(':checked').each(function() {
				tags.push($(this).val());
			});

			if(tags.length < 3) {
				window.alert("Choose atleast 3 tags");
				tags = [];
			}
			else {
				$.ajax({
					url: '/index.php/followtags/TagSelect',
					type: 'POST',
					data: {data: JSON.stringify(tags)}
				})
				.success(function(response) {
					console.log('succsess');
					$('#result').html(response);
				})
				.error(function(response) {
					console.log('error');
					$('#result').html(response.responseText);
				});

			}
		});

		function addMoreTags(){
			var data = {
				offset : offset,
				limit: limit
			};

			$.ajax({
				url:'/index.php/followtags/loadtags',
				data: data,
				type: "POST",
				success: function(response){
		            
		            response.trim();
		            if( response == '"></div>'){
		              $(window).off('scroll');
		              return;
		            }
		                
		            response = '<div id="tags-'+(offset/limit)+response;
		            $(response).insertAfter($('#tags-'+((offset/limit)-1)));
		            offset = offset + limit;
		            

				},
				error: function(response){

				}
			});			
		}
	});