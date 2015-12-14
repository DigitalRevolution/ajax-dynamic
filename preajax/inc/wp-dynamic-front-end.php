<article class = "site-block"> 
	<div class = "container"> 
		<div class = "row">
			<div class = "four columns" id = "thinglinks">
				<ul> 
					<?php for ($x = 0; $x < count($options['title']); $x++) {
					echo	"<li><a class = '' href = '" . $x . "'>" . stripslashes($options['title'][$x]) . "</a>";
					}?>
				</ul>
			</div> 
			<div class = "eight columns grey" id = "thing">
				<?php for ($x = 0; $x < count($options['title']); $x++) {
					echo 	"<div class = 'postab jtab'>
								<h3 class = 'center'>" . stripslashes($options['title'][$x]) . "</h3>
								<p>" . stripslashes($options['content'][$x]) . "</p>
								<a class = 'dynamic_cta' href = '" . $options['link'][$x] . "'>
									<p class = 'center'>
										<button>" . stripslashes($options['linktext'][$x]) . "
										</button>
									</p>
								</a>
							 </div>"; 
				}?>
			</div>
		</div>
	</div> 
</article> 

