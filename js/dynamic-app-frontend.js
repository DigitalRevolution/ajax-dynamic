jQuery(document).ready(function(){

divSizeFixer(); 
jQuery('div#dynamic-data0').show();
jQuery('.dynamic-left li:first-child').addClass('dynamic-focus');

	jQuery('.dynamic-section').on('click', 'a', function(e){
	  e.preventDefault();
	  var title = jQuery(this).data('title');
	  jQuery('div#dynamic-right').children().hide();
	  jQuery('.dynamic-left li').removeClass('dynamic-focus');
	  jQuery('div#dynamic-data'+title).show();
	  jQuery(this).closest('li').addClass('dynamic-focus'); 
	  divSizeFixer(); 
	})
});

jQuery(window).on('resize', function(){
	divSizeFixer(); 
}); 


function divSizeFixer(){
	if ( jQuery(document).width() > 850 ){
			console.log('width over 850');
		if ( jQuery('.dynamic-left').height() > jQuery('#dynamic-right').height() ){
			console.log('so far so good.');
			var newHeight = jQuery('.dynamic-left').height();
			jQuery('.dynamic-content-section').css('min-height', newHeight + 30);	
		}
	}
}
