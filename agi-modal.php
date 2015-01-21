<?php
/**
 * Plugin Name: AGI Modal
 * Description: Add a modal window that pops up when a certain point is reached.
 * Version: 0.1a
 * Author: Chris G. Clapp
 * Author URI: http://www.chrisclapp.com
 * Text Domain: agi-modal
 */
 
 defined('ABSPATH') or die("Dude seriously?");
 
 // Set up required files
 $files_to_require = array(
	 'scripts.php',
	 'styles.php',
	 'checks.php',
	 'modal.php',
	 'options-page.php',
	 'session-setup.php'
 );
 
 foreach($files_to_require as $file_to_require) {
	 $filename = 'inc/' . $file_to_require;
	 require_once($filename);
 }
