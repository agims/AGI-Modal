<?php
/**
 * Plugin Name: AGI Modal
 * Description: Add a modal window that pops up when a certain point is reached.
 * Version: 1.2.1 - Balmorhea
 * Author: Chris G. Clapp
 * Author URI: http://www.chrisclapp.com
 * Text Domain: agi-modal
 * GitHub Theme URI: https://github.com/chris-agims/AGI-Modal
 * GitHub Branch: master
 */
 
 defined('ABSPATH') or die("Dude seriously?");
 
 
 // Set up required files
 $files_to_require = array(
	 'scripts.php',
	 'styles.php',
	 'checks.php',
	 'modal.php',
	 'options-page.php',
	 'session-setup.php',
	 // Uncomment while testing
	 // 'temp.php',
 );
 
 foreach($files_to_require as $file_to_require) {
	 $filename = 'inc/' . $file_to_require;
	 require_once($filename);
 }