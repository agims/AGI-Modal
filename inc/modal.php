<?php
	
	
	function display_agi_modal() {

		// Set up our variables
		$title				= get_option('agi_modal_title');
		$title_size			= get_option('agi_modal_title_size');
		$use_subtitle		= get_option('agi_modal_use_subtitle');
		$subtitle			= get_option('agi_modal_subtitle');
		$subtitle_size		= get_option('agi_modal_subtitle_size');
		if(get_option('agi_modal_using_shortcode')) {
			$content			= do_shortcode(get_option('agi_modal_shortcode'));
		} else {
			$content			= get_option('agi_modal_html');
		}
		if(get_option('agi_modal_hook')) {
			$hook				= get_option('agi_modal_hook');
		} else {
			$hook				= '#agi-modal-hook';
		}
		$hook_percent			= get_option('agi_modal_hook_percent') . "%";
		
		
		if(strpos($hook, '#') !== FALSE) {
			$hook_id = str_replace('#', '', $hook)
			?><script>console.log('<?=$hook_id?>');</script><?php
		}
		
		$put_hook				= (get_option('agi_modal_include_hook_el') ? '<!-- Hook --><div id="' . str_replace('#', '', $hook) . '"></div><!-- END Hook -->' : '');
		
		$is_bootstrap		= get_option('agi_modal_is_bootstrap');
		$bootstrap_version	= get_option( 'agi_modal_bootstrap_version');
		
		
		
		// Which version of the modal are we using?
		if($is_bootstrap) {
			if($bootstrap_version == "2") { // Bootstrap Modal Version 2
				?>
					<!-- Modal -->
					<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<<?=$title_size?> class="modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
							<?php
								if($use_subtitle) {
									echo "<{$subtitle_size} class=\"modal-subtitle\">{$subtitle}</{$subtitle_size}>";
								}
							?>
						</div>
						<div class="modal-body">
							<?=$content?>
						</div>
					</div>
				<?php
			} else { // Bootstrap Modal Version 3
				?>
					<!-- Modal -->
					<div class="modal fade" id="myAGIModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<<?=$title_size?> class="modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
									<?php
										if($use_subtitle) {
											echo "<{$subtitle_size} class=\"modal-subtitle\">{$subtitle}</{$subtitle_size}>";
										}
									?>
								</div>
								<div class="modal-body">
									<?=$content?>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		} else { // Modified Bootstrap Modal Version 3
			?>
			<!-- Modal -->
			<div class="agi-modal fade" id="myAGIModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="agi-modal-dialog">
					<div class="agi-modal-content">
						<div class="agi-modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<<?=$title_size?> class="agi-modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
							<?php
								if($use_subtitle) {
									echo "<{$subtitle_size} class=\"agi-modal-subtitle\">{$subtitle}</{$subtitle_size}>";
								}
							?>
						</div>
						<div class="agi-modal-body">
							<?=$content?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		
		echo $put_hook;


		$modal_shown = plugins_url( 'agi-modal-shown.php', __DIR__);
		
		if($is_bootstrap && $bootstrap_version == "2") {
			$show_modal_event = "show";
		} else {
			$show_modal_event = "show.bs.modal";
		}
		
		echo "
			<script>
				(function( $ ) {
					$(document).ready(function() {
	
						$('#myAGIModal').on('{$show_modal_event}', function (e) {
							$.get('{$modal_shown}');
						});
						
						var waypoints = $('{$hook}').waypoint(function(direction) {
							$('#myAGIModal').modal('show');
							console.log('Waypoint Tripped');
							this.destroy(); 
						}, {
							offset: '{$hook_percent}'
						});						
					});
				})(jQuery);
			</script>
		";
			
		
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
			add_action('wp_footer','display_agi_modal');
		}
		
		
	}
	
	add_action('wp', 'load_after_wp');
