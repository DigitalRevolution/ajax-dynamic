jQuery( document ).ready(function(){

	jQuery( document ).on( 'click', '.add-a-section', function() {
		jQuery.ajax({
			url : ajaxtest.ajax_url,
			type : 'post',
			data : {
				action : 'post_add_a_section'
			},
			success : function( response ) {
				jQuery('#section-count').html( response );
				jQuery( "#target" ).submit();
			}
		});
		return false;
	});

	jQuery( document ).on( 'click', '.remove-a-section', function() {
		jQuery.ajax({

			url : ajaxtest.ajax_url,
			type : 'post',
			data : {
				action : 'post_remove_a_section'
			},
			success : function( response ) {
				jQuery('#section-count').html( response );
				jQuery( "#target" ).submit();
			}
		});
		return false;
	});
});


