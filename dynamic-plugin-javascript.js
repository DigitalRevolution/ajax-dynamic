jQuery( document ).ready(function(){

	jQuery( document ).on( 'click', '.add-a-section', function() {
		jQuery.ajax({
			url : ajaxtest.ajax_url,
			type : 'post',
			data : {
				action : 'post_add_a_section'
			},
			success : function( response ) {
				parseInt(response);
				if ( response <= 9 ){
					jQuery('#section-count').html( response );
					jQuery( "#target" ).submit();
				} else {
					jQuery('.form-invalid').slideDown();
				}
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
				parseInt(response);
				if (response > 0){
				console.log(response + " " + typeof(response)); 
					jQuery('#section-count').html( response );
					jQuery( "#target" ).submit();
				} else {
					jQuery('.form-invalid').slideDown();
				}
			}	
		});
		return false;
	});

	jQuery('.remove-invalid-error').on('click', function(){
		jQuery('.form-invalid').slideUp();
	})
});


