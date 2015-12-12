// Click event handler
$(document).ready(function ($){                                  // When the DOM loads
$('#thinglinks ul li a').eq(0).addClass('focus');                // Focus on the first link item
$('#thing div').eq(0).removeClass('jtab');                       // Remove display:none from section one content
 if($('.dynamic_cta').eq(0).attr('href') == ""){                 // Check to see if the href is set for the first CTA
  	$('.dynamic_cta button').css('display', 'none');             // If it's blank, hide it. 
  }	else { $('.dynamic_cta button').css('display', 'inline');}	 // If it's not, show it. 
});

$("#thinglinks ul li a").on('click',function( e ) {              // Whenever someone a link in the widget menu
  e.preventDefault(); 											 // Ignore what you usually do

  var thing = $(this).attr('href');                              // Grab the number of the link (0 indexed array)

  if($('.dynamic_cta').eq(thing).attr('href') == ""){            // Check to see if the href is set for the first CTA                 
  	$('.dynamic_cta button').css('display', 'none');             // If it's blank, hide it. 
  }	else { $('.dynamic_cta button').css('display', 'inline');}	 // If it's not, show it. 

  $("#thinglinks ul li a").removeClass('focus');                 // Clear the focus class from all links
  $(this).addClass('focus');                                     // Add it back to the one you clicked on
  $('#thing .postab').addClass('jtab');                          // adds display: none to all contnet sections
  $('#thing .postab').eq(thing).removeClass('jtab');             // remove display:none from this content section
  $('#thing div').eq(thing).find('div').removeClass('jtab');     // remove display:none from all children divs 
  																 // (if the user put them in the back end)
});
