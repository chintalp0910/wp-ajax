'use strict';
jQuery(document).ready(function($) {
	
	//button click
	$( document ).on( 'click', '#wp_ajax_post_data', function() {
		
		var name    = $('#wp_ajax_name').val();
		var email   = $('#wp_ajax_email').val();
		var content = $('#wp_ajax_comment').val();
		var postid  = $('#wp_ajax_post_id').val();
		
		var data = { 
						action 	:	'wp_ajax_call',
						name	:	name,
						email	:	email,
						comment :	content,
						post_id	:	postid
					};
		//ajax call to save data to database
		
		//show loader while process is running
		$('#wp_ajax_loader').show();
		
		//hide button while process is running
		$(this).hide();
		
		$.post(Wp_Ajax.ajaxurl,data,function(response) {
			
			//hide loader after process completed
			$('#wp_ajax_loader').hide();
			
			//show button after process completed
			$(this).show();
			
			if(response != '') { //data saved successfully then reload page if needed
				
				//make all fields to null
				$('#wp_ajax_name').val('');
				$('#wp_ajax_email').val('');
				$('#wp_ajax_comment').val('');
				
				window.location.reload();
			}
		});
	});
	
});
