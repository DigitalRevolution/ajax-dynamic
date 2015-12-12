<h2>Dynamic Page</h2>
  <div class="wrap">
    <h3><?php var_dump($options) ?> </h3>
      <?php for ($x = 0; $x < $dynamic_instances; $x++) {
	  $y = $x+1; 
	echo "
	<div id='col-container'>
		<div id='col-right'>
			<div class='col-wrap'>
				<h3>Section "  . $y . " Content</h3> 
				<div class='inside'>
				<form name = 'section_" . $x . "_form' method = 'post' action=''>
				<input type = 'hidden' name = 'section_one_form_sumbitted' value = 'Y'> 
				<textarea id='section_" . $x . "_content' name='section_" . $x . "_content' cols='80' rows='10'>" . stripslashes($options['content'][$x]) . "</textarea><br>
			</div>
		</div>
	  <!-- /col-wrap -->
	</div>
	<!-- /col-right -->
	<div id='col-left'>
		<div class='col-wrap'>
			<h3>Section " .$y . " Title</h3>
			<div class='inside'>
				<table class='form-table'>
					<tr>
						<td>Title</td>
						<td><input name = 'section_" . $x . "_title' type='text' class='all-options' value ='" . stripslashes($options['title'][$x]) . "'/></td>
					</tr>
					<tr>
						<td>CTA Text</td>
						<td><input name = 'section_" . $x . "_linktext' type='text' class='all-options' value ='" . stripslashes($options['linktext'][$x]) . "'/></td>
					</tr>
					<tr>
						<td>CTA Link</td>
						<td><input name = 'section_" . $x . "_link' type='text' class='all-options' value ='" . $options['link'][$x] . "'/></td>
					</tr>
				</table>
			</div>
		</div>
	  <!-- /col-wrap -->
	</div>
	<!-- /col-left -->
	<input style = 'float:right' class='button-primary' type='submit' name='dynamic_content_save' value='Save All' />
    </div>
	<!-- /col-container -->
	"; 
}?>
</form>
</div> <!-- .wrap -->

