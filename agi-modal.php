<?php
/*
Plugin Name:		AGI Modal
Plugin URI:			https://github.com/chris-agims/AGI-Modal
Description:		Add a modal window that pops up when a certain point is reached.  Version 1.2.10 - Balmorhea
Version:			1.2.11
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
    define('MYPLUGIN_VERSION_NUM', '1.2.11');


 
 
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