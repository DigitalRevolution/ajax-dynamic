<?php
/**
 * Plugin Name: Ajax-Plugin
 * Plugin URI: []
 * Description: test ajax functionality on back end
 * Version: 1.0.0
 * Author: Stephen Van Delinder
 * Author URI: 
 * License: GPL2
 */

$plugin_url = WP_PLUGIN_URL . '/wp-dynamic-page'; 
$options = array(''); 
$section_count = get_option( 'section-count' ); 
$section_count = ( empty( $section_count ) ) ? 0 : $section_count;


add_action( 'admin_enqueue_scripts', 'ajax_plugin_enqueue_scripts' );
function ajax_plugin_enqueue_scripts() {
	wp_enqueue_script( 'test', plugins_url( '/test.js', __FILE__ ), array('jquery'), '1.0', true );
	// localizes test.js 
	wp_localize_script( 'test',               // handle for script to be localized
						'ajaxtest',           // The name of the variable which will contain the data
						array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )  // the data 
						// now the data is available at ajaxtest.ajax_url
						// I think localize script is a hack to make php var available in js
					  );
}

// create the admin page
add_action( 'admin_menu', 'ajax_plugin_page_menu' );  // Create the options menu when WP builds admin menu
function ajax_plugin_page_menu(){
/*
 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
 * This function adds the Dynamic Page Menu in Settings
*/
  add_options_page( 
  	'Ajax Plugin',  	        // Page Title
  	'Ajax Plugin', 			    // Menu Title 
  	'manage_options', 		    // Required Capabilities
  	'ajax-plugin', 			    // Slug
  	'ajax_plugin_options_page'	// Call back function, defined below
  );
}

function ajax_plugin_options_page(){ 

	if ( !current_user_can( 'manage_options' ) ) {   // Verify capabilities 
	wp_die('Please sign in as admin to use this feature.');  // Or die gracefully 
	}
// Scope the variables into the function 

	global $plugin_url; 
	global $options;
	global $section_count;

// The code that makes these if statements function is included in the form on option-page-wrapper.php

	if ( isset( $_POST['section_one_form_sumbitted'] ) ) {                 // if the forms been submitted
		$hidden_field = esc_html( $_POST['section_one_form_sumbitted'] );  // get the hidden field
		if ( $hidden_field == "Y") {                                       // test the hidden field

// Set up the keys

			$options['title'] = array('');
			$options['content'] = array('');
			$options['linktext'] = array('');
			$options['link'] = array('');

// Create the values 

			for($i=0; $i < $section_count; $i++){
				$options['title'][$i] = esc_html( $_POST['section_'.$i.'_title']);
				$options['content'][$i] = $_POST['section_'.$i.'_content'];
				$options['linktext'][$i] = esc_html( $_POST['section_'.$i.'_linktext']);
				$options['link'][$i] = $_POST['section_'.$i.'_link'];
			}

			$options['last_updated'] = time(); 			  // Make a note of the time	
			update_option( 'ajax-plugin', $options ); // And update the database
		} // end if
	} // end isset if

    $options = get_option( 'ajax-plugin' );       // load all the previous values from the DB
	if ( $options != '' ){
		$title[]    = $options['title'];
		$content[]  = $options['content']; 
		$linktext[] = $options['linktext']; 
		$text[]     = $options['link']; 
	}
	var_dump($options);
	require( 'inc/ajax-menu-page-wrapper.php' );
}


add_action( 'wp_ajax_post_add_a_section', 'post_add_a_section' );
function post_add_a_section() {
	global $section_count;
	$section_count++;
	update_option( 'section-count', $section_count );
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		echo $section_count;
		die();
	}
	else {
		exit();
	}
}
add_action( 'wp_ajax_post_remove_a_section', 'post_remove_a_section' );
function post_remove_a_section() {
	global $section_count;
	$section_count--;
	update_option( 'section-count', $section_count );
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		echo $section_count;
		die();
	}
	else {
		exit();
	}
}
?>