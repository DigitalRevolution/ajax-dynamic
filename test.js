jQuery( document ).ready(function(){

jQuery( document ).on( 'click', '.add-a-section', function() {
// when a element with the class love-button is clicked in the document, run this function: 
// in this case, that's the post ID
	jQuery.ajax({
		url : ajaxtest.ajax_url,
	// wordpress url handeling property
		type : 'post',
	// could be get or post
		data : {
			action : 'post_add_a_section'
	// post_id : post_id
	// data to be passed action is the function we're going to call with 
	// add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );
		},
		success : function( response ) {
	// define the success method
			jQuery('#section-count').html( response );
			jQuery( "#target" ).submit();
	// find the element with love-count id and insert the response
	// notify me that this all took place correctly. 
		}
	});
	return false;
	// tell the browser not to do anything else becasue we clicked on a link... we're done. 

});

jQuery( document ).on( 'click', '.remove-a-section', function() {
// when a element with the class love-button is clicked in the document, run this function: 
  //	var post_id = jQuery(this).data('id');
// declare a variabel called post_id and set it eqal to the data-id value in the <a href> tag
// in this case, that's the post ID
	jQuery.ajax({

		url : ajaxtest.ajax_url,
	// wordpress url handeling property
		type : 'post',
	// could be get or post
		data : {
			action : 'post_remove_a_section'
	//		post_id : post_id
	// data to be passed action is the function we're going to call with 
	// add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );
		},
		success : function( response ) {
	// define the success method
			jQuery('#section-count').html( response );
	// find the element with love-count id and insert the response
	// notify me that this all took place correctly. 
		}
	});
	return false;
	// tell the browser not to do anything else becasue we clicked on a link... we're done. 

});

jQuery( document ).on( 'click', '.save-dynamic-data', function() {
// when a element with the class love-button is clicked in the document, run this function: 
  //	var post_id = jQuery(this).data('id');
// declare a variabel called post_id and set it eqal to the data-id value in the <a href> tag
// in this case, that's the post ID
	jQuery.ajax({

		url : ajaxtest.ajax_url,
	// wordpress url handeling property
		type : 'post',
	// could be get or post
		data : {
			action : 'post_save_dynamic_data'
	//		post_id : post_id
	// data to be passed action is the function we're going to call with 
	// add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );
		},
		success : function( response ) {
	// define the success method
	//		console.log( response );
			alert('that button does something');
	//		jQuery('#section-count').html( response );
	// find the element with love-count id and insert the response
	// notify me that this all took place correctly. 
		}
	});
	return false;
	// tell the browser not to do anything else becasue we clicked on a link... we're done. 

})

});


