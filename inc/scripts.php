<?php
	
	// Register Scripts
	function agi_modal_scripts() {
		
		if(get_option('agi_modal_load_jquery')) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', '//code.jquery.com/jquery-1.11.2.min.js', array(), '1.11.2', FALSE);
			wp_enqueue_script( 'jquery' );
		}
		
		if(!get_option('agi_modal_is_bootstrap')) {
			
			wp_register_script( 'agi_modal_js', plugins_url( 'js/custom-bs-modal-ck.js',dirname(__FILE__)), array(), '3.3.1', TRUE);
			wp_enqueue_script( 'agi_modal_js');
			
		}
		
		$plugin_version = get_option('agi_modal_version');
				
		wp_register_script( 'agi_modal_main', plugins_url( 'js/main-ck.js', dirname(__FILE__)), array(), $plugin_version, TRUE);
		wp_enqueue_script( 'agi_modal_main' );
	}
	
	add_action('wp_enqueue_scripts', 'agi_modal_scripts');