<?php
	
	// Register Styles
	
	function agi_modal_styles() {
		
		$plugin_version = get_option('agi_modal_version');
	
		if(!get_option('agi_modal_is_bootstrap')) {
			
			wp_register_style( 'agi-modal-style', plugins_url( 'css/style.css', dirname(__FILE__)), array(), $plugin_version, 'screen');
			wp_enqueue_style( 'agi-modal-style');
			
		} else {
			
			wp_register_style( 'agi-modal-style', plugins_url('css/agi-only-style.css', dirname(__FILE__)), array(), $plugin_version, 'screen');
			wp_enqueue_style('agi-modal-style');
			
		}
		
	}
	
	add_action('wp_enqueue_scripts', 'agi_modal_styles');
	
?>