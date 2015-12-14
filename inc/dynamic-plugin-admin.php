<h2><?php esc_attr_e( '2 Columns Layout: static (px)', 'wp_admin_style' ); ?></h2>

<style> 
input.all-options {
	width: 100%;
}
</style> 

<?php
$section_count = get_option( 'section-count' ); // get section count from the database. 
$section_count = ( empty( $section_count ) ) ? 0 : $section_count;
?>

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'Heading String', 'wp_admin_style' ); ?></h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- main content -->
			<div id="post-body-content">
				<div class="postbox">
					<h2 class="hndle"><span><?php esc_attr_e( 'Main Content Header', 'wp_admin_style' ); ?></span></h2>

					<div class="inside">
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
											<textarea id='section_" . $x . "_content' name='section_" . $x . "_content' cols='60' rows='10'>" . stripslashes($options['content'][$x]) . "</textarea><br>
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
					</div>
					<!-- .inside -->
				</div>
					<!-- .postbox -->
			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->
						<h2 class="hndle"><span><?php esc_attr_e(
									'Sidebar Content Header', 'wp_admin_style'
								); ?></span></h2>
						<div class="inside">
							<?php
							$add_section_button = '<a class = "add-a-section" href="' . admin_url( 'admin-ajax.php?action=post_add_a_section">' . '<button>Add Section</button>' . '</a>');
							echo $add_section_button; 

							$remove_section_button = '<a class = "remove-a-section" href="' . admin_url( 'admin-ajax.php?action=post_remove_a_section">' . '<button>Remove Section</button>' . '</a>');
							echo $remove_section_button; 
							?>
							<p><?php esc_attr_e( 'Everything you see here, from the documentation to the code itself, was created by and for the community. WordPress is an Open Source project, which means there are hundreds of people all over the world working on it. (More than most commercial platforms.) It also means you are free to use it for anything from your cat’s home page to a Fortune 500 web site without paying anyone a license fee and a number of other important freedoms.', 'wp_admin_style' ); ?></p>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->
				</div>
				<!-- .meta-box-sortables -->
			</div>
			<!-- #postbox-container-1 .postbox-container -->
		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		<br class="clear">
	</div>
	<!-- #poststuff -->
</div> <!-- .wrap -->
