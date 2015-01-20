<?php
	
	// Register Styles
	
	function agi_modal_styles() {
		
		wp_register_style( 'agi-modal-style', plugins_url( 'css/style.css', __DIR__), array(), '1.0', 'screen');
		wp_enqueue_style( 'agi-modal-style');
		
	}
	
	add_action('wp_enqueue_scripts', 'agi_modal_styles');
	
?>