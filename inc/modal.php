<?php
	function display_agi_modal() {

		// Set up our variables
		$title = get_option('agi_modal_title');
		$title_size = get_option('agi_modal_title_size');
		if(get_option('agi_modal_use_subtitle')) {
			$subtitle = get_option('agi_modal_subtitle');
		}
		if(get_option('agi_modal_using_shortcode')) {
			$content = do_shortcode(get_option('agi_modal_shortcode'));
		} else {
			$content = get_option('agi_modal_html');
		}
		if(get_option('agi_modal_hook')) {
			$hook = get_option('agi_modal_hook');
		} else {
			$hook = '#agi-modal-hook';
		}
		$hook_percent = get_option('agi_modal_hook_percent') . "%";
		$put_hook = (get_option('agi_modal_include_hook_el') ? '<div id="' . $hook . '"></div>' : '');
		

			?>
			<!-- Modal -->
			<div class="agi-modal fade" id="myAGIModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="agi-modal-dialog">
			    <div class="agi-modal-content">
			      <div class="agi-modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h2 class="agi-modal-title" id="myModalLabel"><?=$title?></h2>
			      </div>
			      <div class="agi-modal-body">
			        <?=$content?>
			      </div>
			    </div>
			  </div>
			</div>

			<?php
			$modal_shown = plugins_url( 'agi-modal-shown.php', __DIR__);
			
			echo "
				<script>
					(function( $ ) {
						$(document).ready(function() {
		
							$('#myAGIModal').on('show.bs.modal', function (e) {
								$.get('" . $modal_shown . "');
							});
							
						});
					})(jQuery);
				</script>
			";
			
		
	}
	

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

	function load_after_wp() {
		function show_agi_modal() {
			if($_SESSION['agi_modal_form_finished']) {
				return FALSE;
			} 
			if($_SESSION['agi_modal_form_loaded'] > 3) {
				return FALSE;
			}
			if(!is_single() && !get_option('agi_modal_on_pages')) {
				return FALSE;
			}
			if(is_single() && !get_option('agi_modal_on_posts')) {
				return FALSE;
			}
			if(!is_single() && $_SESSION['agi_modal_page_views'] < get_option('agi_modal_number_of_pages')) {
				return FALSE;
			}
			if(is_single() && $_SESSION['agi_modal_post_views'] < get_option('agi_model_number_of_posts')) {
				return FALSE;
			}
			return TRUE;
		}
		
		if( show_agi_modal() ) {
			add_action('get_footer','display_agi_modal');
			add_action('get_footer', 'display_agi_modal_button');
		}
		
		
	}
	
	add_action('wp', 'load_after_wp');
