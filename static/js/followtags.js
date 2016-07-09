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
				
				tags = [];
				event.preventDefault();
			}
			else {
				$('#followtagform').submit();

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
		            if( response == ''){
		              $(window).off('scroll');
		              return;
		            }
		                
		            $("#tag_details").append(response);
		            offset = offset + limit;
		            

				},
				error: function(response){

				}
			});			
		}
	});