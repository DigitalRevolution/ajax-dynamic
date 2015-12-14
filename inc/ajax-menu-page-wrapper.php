<h1>THIS IS THE FUTURE</h1>
<?php
$section_count = get_option( 'section-count' ); // get section count from the database. 
$section_count = ( empty( $section_count ) ) ? 0 : $section_count;

$add_section_button = '<a class = "add-a-section" href="' . admin_url( 'admin-ajax.php?action=post_add_a_section">' . '<button>Add Section</button>' . '</a>');
echo $add_section_button; 

$remove_section_button = '<a class = "remove-a-section" href="' . admin_url( 'admin-ajax.php?action=post_remove_a_section">' . '<button>Remove Section</button>' . '</a>');
echo $remove_section_button; 

$save_dynamic_data = '<a class = "save-dynamic-data" href="' . admin_url( 'admin-ajax.php?action=post_save_dynamic_data">' . '<button>Save Data</button>' . '</a>');
echo $save_dynamic_data; 
?>

<h3>Section Count: <span id = "section-count"><?php echo $section_count; ?></span></h3> 

<form id = "target" name = "ajax-dynamic-pluign" method = "post" action = "">
<input type = 'hidden' name = 'section_one_form_sumbitted' value = 'Y'> 
<input class='button-primary' type='submit' name='dynamic_content_save' value='Save All' />

<?php for ($x = 0; $x < $section_count; $x++) {
	  $y = $x+1; 
	echo "
	<div id='col-container'>
		<div id='col-right'>
			<div class='col-wrap'>
				<h3>Section "  . $y . " Content</h3> 
				<div class='inside'>
					<textarea id='section_" . $x . "_content' name='section_" . $x . "_content' cols='80' rows='10'>" . stripslashes($options['content'][$x]) . "</textarea><br>
				</div>
			</div><!-- /col-wrap -->
		</div><!-- /col-right -->
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
			</div><!-- /col-wrap -->
		</div><!-- /col-left -->
    </div><!-- /col-container -->
	"; 
}?>
<input class='button-primary' type='submit' name='dynamic_content_save' value='Save All' />
</form> 