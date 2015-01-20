<?php
	
	function temp_show_var() {
		echo "<pre>\n";
		print_r($_SESSION);
		echo "</pre>";
		echo "Number of Posts: " . get_option('agi_modal_number_of_posts') . "<br />\n";
		echo "Number of Pages: " . get_option('agi_modal_number_of_pages') . "<br />\n";
	}

	add_action('get_footer', 'temp_show_var', 1);