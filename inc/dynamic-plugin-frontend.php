<article class = "dynamic-plugin-container"> 
	<div class = "dynamic-container">
		<div style = "overflow: hidden;" class = "row"> 
	  <div class = "three columns dynamic-left"> 
		  <ul>
		  	<?php for ($x = 0; $x < $section_count; $x++) { echo 
		    '<li class = "dynamic-section"><a data-title =' . $x . ' href = "">' . $options['title'][$x] . '</a></li>';
		  	}?> 
		  </ul> 
	  </div> 
	  <div id = "dynamic-right" class = "nine columns">
	  	<?php for ($x = 0; $x < $section_count; $x++) { echo 
	  		'<div id = "dynamic-data'. $x .'" class = "dynamic-content-section"><h2>' . $options['title'][$x] .'</h2><p class = "dynamic-content">'. $options['content'][$x] . '</p>'; 

	  		if ( !empty( $options['link'][$x] ) && !empty( $options['linktext'][$x] ) ){ echo 
		  		'<p class = "center"><a class = "" href = "' . $options['link'][$x] . '">
					<button>' . stripslashes($options['linktext'][$x]) . '</button>
				</a></p>
			</div>';
			} else {
				echo 
			'</div>';
			}	
	  	}?>
	  </div> 
	</div> 
</article> 

