<?php
/**
 * Plugin Name: Dynamic Plugin
 * Plugin URI: []
 * Description: Create multiple sections within single section of website. 
 * Version: 1.0.0
 * Author: Stephen Van Delinder
 * Author URI: 
 * License: GPL2
 */

$plugin_url = WP_PLUGIN_URL . '/ajax-plugin'; 
$options = array(''); 
$section_count = get_option( 'section-count' ); 
$section_count = ( empty( $section_count ) ) ? 5 : $section_count;

add_action( 'admin_enqueue_scripts', 'dynamic_plugin_enqueue_scripts' );
function dynamic_plugin_enqueue_scripts() {
	wp_enqueue_script( 'test', plugins_url( '/dynamic-plugin-javascript.js', __FILE__ ), array('jquery'), '1.0', true );
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
  	'Dynamic Plugin',  	        // Page Title
  	'Dynamic Plugin', 		    // Menu Title 
  	'manage_options', 		    // Required Capabilities
  	'wp-dynamic-plugin', 		// Slug
  	'dynamic_plugin_admin_page'	// Call back function, defined below
  );
}

function dynamic_plugin_admin_page(){ 

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

// Create the values from the form in the page-wrapper file

			for($i=0; $i < $section_count; $i++){
				$options['title'][$i] = esc_html( $_POST['section_'.$i.'_title']);
				$options['content'][$i] = $_POST['section_'.$i.'_content'];
				$options['linktext'][$i] = esc_html( $_POST['section_'.$i.'_linktext']);
				$options['link'][$i] = $_POST['section_'.$i.'_link'];
			}

// Make a note of the time

			$options['last_updated'] = time(); 			 

// And update the Database

			update_option( 'ajax-plugin', $options ); 
	
		} // end if	
	} // end isset if

// Reset the page by loading all values back from the DB

    $options = get_option( 'ajax-plugin' );       	
	if ( $options != '' ){
		$title[]    = $options['title'];
		$content[]  = $options['content']; 
		$linktext[] = $options['linktext']; 
		$text[]     = $options['link']; 
	}

// Require the framework for the Admin Page

	require( 'inc/dynamic-plugin-admin.php' );

}


// Server side event handler to create a new section

add_action( 'wp_ajax_post_add_a_section', 'post_add_a_section' );
function post_add_a_section() {
	global $section_count;
	$section_count = $section_count + 0;
	if ($section_count < 9){ 
		$section_count++;
		update_option( 'section-count', $section_count );
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
			echo $section_count;
			die();
		} else {
			exit();
		}
	} else {
		echo 10; 
		die();
	}
}

// Server side event handler to remove section

add_action( 'wp_ajax_post_remove_a_section', 'post_remove_a_section' );
function post_remove_a_section() {
	global $section_count;
	$section_count = $section_count + 0;
	if ($section_count > 1){
		$section_count--;
		update_option( 'section-count', $section_count );
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
			echo $section_count;
			die();
		} else {
			exit();
		}
	} else {
		echo 0; 
		die();
	}
}

function dynamic_plugin_shortcode( $atts ){
	wp_enqueue_style( 'dynamic-app-style', plugins_url( 'ajax-plugin/css/style.css' ) ); 
	wp_enqueue_script('dynamic-app-frontend', plugins_url( 'js/dynamic-app-frontend.js' , __FILE__ ), array( 'jQuery' ));	

		$section_count = get_option( 'section-count' );
		$section_count = (integer) $section_count;
		$options = get_option( 'ajax-plugin' );

		$title[]    = $options['title'];
		$content[]  = $options['content']; 
		$linktext[] = $options['linktext']; 
		$text[]     = $options['link']; 

require( 'inc/dynamic-plugin-frontend.php' );
}
add_shortcode( 'dynamic', 'dynamic_plugin_shortcode' );

// [foobar]
function foobar_func( $atts ){
	return "foo and bar";
}
add_shortcode( 'foobar', 'foobar_func' );

// TODO: 
// Create the shortcode
// Build the Front End -- namespaced css
// Style the back end 
// Ensure aherance to standards

?>