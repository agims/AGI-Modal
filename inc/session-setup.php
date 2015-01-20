<?php
	
	function agi_modal_start_session() {
		global $post;
				
	    if(!session_id()) {
	        session_start();
	    }
	    
	    $current_time = time();
	    
	    if(isset($_SESSION['agi_modal_last_activity'])) {
		    $reset_time = get_option('agi_modal_reset_time');
		    //$reset_time = '0.25';
		    if(($current_time - ($reset_time * 60)) > $_SESSION['agi_modal_last_activity']) {
			    $_SESSION['agi_modal_page_views'] = 0;
			    $_SESSION['agi_modal_post_views'] = 0;
			    $_SESSION['agi_modal_total_views'] = 0;
			    $_SESSION['agi_modal_form_loaded'] = FALSE;
		    }
	    }
		$_SESSION['agi_modal_total_views'] = $_SESSION['agi_modal_total_views'] + 1;
	    $_SESSION['agi_modal_last_activity'] = $current_time;
	    $_SESSION['agi_modal_last_page'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    if (is_single()) {
		    $_SESSION['agi_modal_post_views'] = $_SESSION['agi_modal_post_views'] + 1;
	    } else {
		    $_SESSION['agi_modal_page_views'] = $_SESSION['agi_modal_page_views'] + 1;
	    }
	}
	
	function agi_modal_end_session() {
		session_destroy();
	}
	
	if(!is_admin()) {
		add_action('wp', 'agi_modal_start_session', 1);
	}
