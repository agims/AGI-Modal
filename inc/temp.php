<?php
	
	function temp_show_var() {
		echo "<pre>\n";
		print_r($_SESSION);
		echo "</pre>";
		echo "Use Hook = " . (get_option('agi_modal_use_hook') == TRUE ? "T" : "F") . "<br />\n";
		echo "Number of Posts: " . get_option('agi_modal_number_of_posts') . "<br />\n";
		echo "Number of Pages: " . get_option('agi_modal_number_of_pages') . "<br />\n";
	}

	add_action('get_footer', 'temp_show_var', 1);

	function display_agi_modal_button() {
		?>
			<!-- Button trigger modal -->
			<div style="margin-bottom: 1em;text-align:center;">
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myAGIModal">
				  Launch demo modal
				</button>
			</div>
		<?php

	}


	add_action('get_footer', 'display_agi_modal_button');