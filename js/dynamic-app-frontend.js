jQuery(document).ready(function(){

	alert('script running'); 

	jQuery('.section').on('click', 'a', function(e){
	  e.preventDefault();
	  var title = jQuery(this).data('title');
	  jQuery('div#right').removeClass(); 
	  jQuery('div#right').addClass(title); 
	})
});