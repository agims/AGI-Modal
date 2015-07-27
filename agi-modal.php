<?php
/*
Plugin Name:		AGI Modal
Plugin URI:			https://github.com/chris-agims/AGI-Modal
Description:		This is a WordPress Plugin that allows you to have a modal pop up. Can be used to either make it pop up when a certain waypoint is reached or after a certain amount of time.  <strong>Version 1.4 - Weslaco</strong>
Version:			1.4
Author:				Chris G. Clapp
Author URI:			http://www.chrisclapp.com
Text Domain:		agi-modal
GitHub Plugin URI:	https://github.com/chris-agims/AGI-Modal
GitHub Branch:		master
*/
 
 defined('ABSPATH') or die("Dude seriously?");
 
 if (!defined('MYPLUGIN_VERSION_KEY'))
    define('MYPLUGIN_VERSION_KEY', 'agi_modal_version');

if (!defined('MYPLUGIN_VERSION_NUM'))
    define('MYPLUGIN_VERSION_NUM', '1.4');


 
 
 // Set up required files
 $files_to_require = array(
	 'scripts.php',
	 'styles.php',
	 'checks.php',
	 'modal.php',
	 'options-page.php',
	 'session-setup.php',
	 // Uncomment while testing
	 //'temp.php',
 );
 
 foreach($files_to_require as $file_to_require) {
	 $filename = 'inc/' . $file_to_require;
	 require_once($filename);
 }
 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_action_links' );

function my_plugin_action_links( $links ) {
   $links[] = '<a href="'. get_admin_url(null, 'options-general.php?page=agi-modal-options') .'">Settings</a>';
   $links[] = '<a href="http://www.agims.com" target="_blank">AGI Marketing</a>';
   return $links;
}