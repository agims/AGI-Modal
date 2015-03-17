<?php
	
	$hook = FALSE;
	$use_hook = FALSE;
	
	function display_agi_modal() {
		
		// Pull in our globals
		global $use_hook;
		global $hook;

		// Set up our variables
		$using_header		= get_option('agi_modal_using_header');
		$title				= get_option('agi_modal_title');
		$title_size			= get_option('agi_modal_title_size');
		$use_subtitle		= get_option('agi_modal_use_subtitle');
		$subtitle			= get_option('agi_modal_subtitle');
		$subtitle_size		= get_option('agi_modal_subtitle_size');
		$remove_padding		= get_option('agi_modal_remove_padding');
		$redirect_links		= get_option('agi_modal_redirect_links');
		$use_hook			= get_option('agi_modal_use_hook');

		if(get_option('agi_modal_hook')) {
			$hook			= get_option('agi_modal_hook');
		} else {
			$hook			= '#agi-modal-hook';
		}


		if(get_option('agi_modal_using_shortcode')) {
			$content			= do_shortcode(get_option('agi_modal_shortcode'));
		} else {
			$content			= get_option('agi_modal_html');
		}
		
		if($remove_padding == TRUE) {
			$padding_class = " no-padding";
		} else {
			$padding_class = '';
		}
		
		if(strpos($hook, '#') !== FALSE) {
			$hook_id = str_replace('#', '', $hook)
			?><script>console.log('<?=$hook_id?>');</script>
			<?php
		}
		
		$put_hook			= (get_option('agi_modal_include_hook_el') ? '<!-- Hook --><div id="' . str_replace('#', '', $hook) . '"></div><!-- END Hook -->' : '');
		
		$is_bootstrap		= get_option('agi_modal_is_bootstrap');
		$bootstrap_version	= get_option( 'agi_modal_bootstrap_version');
		
		
		
		// Which version of the modal are we using?
		if($is_bootstrap) {
			if($bootstrap_version == "2") { // Bootstrap Modal Version 2
				?>
					<!-- Modal -->
					<div id="myAGIModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color:#000;">
						<div id="myAGIModalWrap">
							<?php
								if($using_header) {
									?>
							<div class="modal-header">
								<<?=$title_size?> class="modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
								<?php
									if($use_subtitle) {
										echo "<{$subtitle_size} class=\"modal-subtitle\">{$subtitle}</{$subtitle_size}>";
									}
								?>
							</div>
									<?php
									$agi_modal_close_button = '';
								} else {
									$agi_modal_close_button = '<div id="floating-button"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>';
								} 
								?>
							<?=$agi_modal_close_button?>
							<div class="modal-body<?=$padding_class?>">
								<div id="agi-content">
									<?=$content?>
								</div>
							</div>
						</div>
					</div>
				<?php
			} else { // Bootstrap Modal Version 3
				?>
					<!-- Modal -->
					<div class="modal fade" id="myAGIModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color:#000;">
						<div id="myAGIModalWrap" class="modal-dialog<?=padding_class?>">
							<div class="modal-content">
							<?php if($using_header) { ?>
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<<?=$title_size?> class="modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
									<?php
										if($use_subtitle) {
											echo "<{$subtitle_size} class=\"modal-subtitle\">{$subtitle}</{$subtitle_size}>";
										}
									?>
								</div>
							<?php
								$agi_modal_close_button = '';
							} else {
								$agi_modal_close_button = '<div id="floating-button"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							}	?>
								<?=$agi_modal_close_button?>
								<div class="modal-body<?=$padding_class?>">
									<div id="agi-content">
										<?=$content?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		} else { // Modified Bootstrap Modal Version 3
			?>
			<!-- Modal -->
			<div class="agi-modal fade" id="myAGIModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color:#000;">
				<div id="myAGIModalWrap" class="agi-modal-dialog">
					<div class="agi-modal-content">
					<?php if($using_header) { ?>
						<div class="agi-modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<<?=$title_size?> class="agi-modal-title" id="myModalLabel"><?=$title?></<?=$title_size?>>
							<?php
								if($use_subtitle) {
									echo "<{$subtitle_size} class=\"agi-modal-subtitle\">{$subtitle}</{$subtitle_size}>";
								}
							?>
						</div>
							<?php
								$agi_modal_close_button = '';
							} else {
								$agi_modal_close_button = '<div id="floating-button"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							}	?>
						<?=$agi_modal_close_button?>
						<div class="agi-modal-body<?=$padding_class?>">
							<div id="agi-content">
								<?=$content?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		
		echo $put_hook . "\n";


		$modal_shown = plugins_url( 'agi-modal-shown.php', dirname(__FILE__));
		
		
		
		if($is_bootstrap && $bootstrap_version == "2") {
			$show_modal_event 		= "show";
			$shown_modal_event 		= "shown";
			$hide_modal_event 		= "hide";
			$hidden_modal_event 	= "hidden";
		} else {
			$show_modal_event 		= "show.bs.modal";
			$shown_modal_event 		= "shown.bs.modal";
			$hide_modal_event		= "hide.bs.modal";
			$hidden_modal_event		= "hidden.bs.modal";
		}
		
		function agi_modal_launcher() {
			
			global $use_hook;
			
			if($use_hook == TRUE) {
				$hook_percent			= get_option('agi_modal_hook_percent') . "%";
				
				global $hook;
				
				$to_return = "
						// Set up our waypoint
						var waypoints = $('{$hook}').waypoint(function(direction) {
							$('#myAGIModal').modal('show');
							console.log('Waypoint Tripped');
							this.destroy(); 
						}, {
							offset: '{$hook_percent}'
						});

				";
			} else {
				$load_time			= get_option('agi_modal_time');

				$to_return = "
						// Set up our timer
						var agiLaunchDelay = {$load_time} * 1000;
						
						setTimeout(function() {
							$('#myAGIModal').modal('show');
							console.log('Timer Tripped');
						}, agiLaunchDelay);
				";
			}
			
			return $to_return;
		}
		
		function agi_redirect_links() {
			$to_redirect = get_option('agi_modal_redirect_links');
			
			$passthrough_script = plugins_url('agi-modal-passthrough.php', dirname(__FILE__));
			
			if($to_redirect) {
				$to_return = "
					$('#agi-content a').click(function(event) {
						// Don't let it actually go where the link says
						event.preventDefault();
						
						// Capture the href
						var redirectHref = $(this).attr('href');
						
						// Send to the redirect php file
						window.location = '" . $passthrough_script . "?passthrough_url=' + redirectHref;
					});
				";
			} else {
				$to_return = '';
			}
			
			return $to_return;
		}
		
		echo "
			<script>
			
				var agiModalWindowHeight = 0;
				var agiModalWindowWidth = 0;
				var agiModalModalHeight = 0;
				var agiModalModalTop = 0;
				var agiModalIsOpen = false;
			

				(function( $ ) {
					$(document).ready(function() {

						function agiModalSetTop() {
							agiModalWindowHeight = $(window).height() * 0.7;
							console.log('Window: ' + agiModalWindowHeight);
							agiModalModalHeight = $('#myAGIModalWrap').height();
							console.log('Modal: ' + agiModalModalHeight);
							agiModalModalTop = (agiModalWindowHeight / 2) - (agiModalModalHeight / 2);
							console.log('Top: ' + agiModalModalTop);
							$('#myAGIModalWrap').css('margin-top',agiModalModalTop + 'px');
						}


						$('#myAGIModal').on('{$show_modal_event}', function (e) {
							agiModalIsOpen = true;
							
							agiModalSetTop();						

							// AJAX - Update the Session to show that the modal has been loaded
							$.get('{$modal_shown}');
						});
						
						
						
						" . agi_modal_launcher() . "
						
						
						" . agi_redirect_links() . "
						
						$('#myAGIModal').on('{$shown_modal_event}', function (e) {
							agiModalSetTop();
						});
						
						$('#myAGIModal').on('{$hide_modal_event}', function (e) {
							agiModalIsOpen = false;
						});
						
						$(window).resize(function() {
							agiModalWindowWidth = $(window).width();
							if(agiModalWindowWidth >= 768) {
								if(agiModalIsOpen == true) {
									agiModalSetTop();
								}
							} else {
								console.log('Do something here for mobile');
							}
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
			if($_SESSION['agi_modal_form_loaded'] >= get_option('agi_modal_number_of_views')) {
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
