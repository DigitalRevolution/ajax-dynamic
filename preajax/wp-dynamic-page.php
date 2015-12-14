<?php
/**
 * Plugin Name: Dynamic Page
 * Plugin URI: [to be anounced]
 * Description: Dynamic Page section provides overview of site content on single page
 * Version: 0.0.1
 * Author: Stephen Van Delinder
 * Author URI: http://digitalrevolutionco.com
 * License: GPL2
 */

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
 * Assign Global Variables
*/
$plugin_url = WP_PLUGIN_URL . '/wp-dynamic-page'; 
$options = array(); 
$dynamic_instances = 5; 

/*
 * Add a link to our plugin in the admin menu
 * under 'settings > Dynamic Page'
 * 
*/

function wp_dynaimc_page_menu(){
/*
 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
 * This function adds the Dynamic Page Menu in Settings
*/
  add_options_page( 
  	'Dynamic Page Plugin',  	// Page Title
  	'Dynamic Page', 			// Menu Title 
  	'manage_options', 			// Required Capabilities
  	'wp-dynamic-page', 			// Slug
  	'wp_dynaimc_options_page'	// Call back function, defined below
  );
}
add_action( 'admin_menu', 'wp_dynaimc_page_menu' );  // Create the options menu when WP builds admin menu

function wp_dynaimc_options_page(){                  // This function will run every time we click "save all"
	if ( !current_user_can( 'manage_options' ) ) {   // Verify capabilities 
		wp_die('Please sign in as admin, to use this feature.');  // Or die gracefully 
	}
// Scope the variables into the function 
	global $plugin_url; 
	global $options;
	global $dynamic_instances;

// The code that makes these if statements function is included in the form on option-page-wrapper.php

	if ( isset( $_POST['section_one_form_sumbitted'] ) ) {                 // if the forms been submitted
		$hidden_field = esc_html( $_POST['section_one_form_sumbitted'] );  // get the hidden field
		if ( $hidden_field == "Y") {                                       // test the hidden field

			$options['title'] = array('');
			$options['content'] = array('');
			$options['linktext'] = array('');
			$options['link'] = array('');

			for($i=0; $i < $dynamic_instances ; $i++){
				$options['title'][$i] = esc_html( $_POST['section_'.$i.'_title']);
			}
			for($i=0; $i < $dynamic_instances ; $i++){
				$options['content'][$i] = $_POST['section_'.$i.'_content'];
			}
			for($i=0; $i < $dynamic_instances ; $i++){
				$options['linktext'][$i] = esc_html( $_POST['section_'.$i.'_linktext']);
			}
			for($i=0; $i < $dynamic_instances ; $i++){
				$options['link'][$i] = $_POST['section_'.$i.'_link'];
			}

			$options['last_updated'] = time(); 			  // Make a note of the time	
			update_option( 'wp-dynamic-page', $options ); // And update the database
		} // end if
	} // end isset if

    $options = get_option( 'wp-dynamic-page' );       // load all the previous values from the DB
	if ( $options != '' ){
		$title[]    = $options['title'];
		$content[]  = $options['content']; 
		$linktext[] = $options['linktext']; 
		$text[]     = $options['link']; 
	}
	require( 'inc/option-page-wrapper.php' );
}


//[dynamic] shortcode
function dynamic_func( $atts ){
	wp_enqueue_style( 'wp_dynamic_styles', plugins_url( 'wp-dynamic-page/css/style.css' ) ); 
	wp_enqueue_script( 'jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
	wp_enqueue_script( 'dynamic_js', plugins_url( 'wp-dynamic-page/js/app.js' ) ); 	
	$options = get_option( 'wp-dynamic-page' );

		$title[]    = $options['title'];
		$content[]  = $options['content']; 
		$linktext[] = $options['linktext']; 
		$text[]     = $options['link']; 

	require( 'inc/wp-dynamic-front-end.php' );
}
add_shortcode( 'dynamic', 'dynamic_func' );

?>