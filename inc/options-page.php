<?php



function agi_modal_register_settings() {
	
	global $needed_options;
	
	foreach($needed_options as $option => $value) {
		register_setting('agi_modal', $option);
	}
}

add_action( 'admin_init', 'agi_modal_register_settings');

function agi_modal_option_menu() {
	add_options_page('AGI Modal Options Page', 'AGI Modal Options', 'manage_options', 'agi-modal-options', 'agi_modal_option_page');
}

add_action('admin_menu', 'agi_modal_option_menu');

function agi_modal_option_page() {
	if( !current_user_can('manage_options')) {
		wp_die( __('Umm, what are you doing?', 'rincon'));
	}
	
	global $needed_options;
	
	foreach($needed_options as $option => $value) {
		$$option = get_option($option);
	}
	
	?>
	<div class="wrap">
		<h2>AGI Modal Options</h2>
		<form method="post" action="options.php">
			<?php settings_fields('agi_modal'); ?>
			<h3>Modal Look</h3>
			<table class="form-table">
				<tbody>
					<tr id="title">
						<th scope="row">
							<label for="agi_modal_title">Title</label>
						</th>
						<td>
							<input name="agi_modal_title" id="agi_modal_title" type="text" value="<?=$agi_modal_title?>" class="regular-text ">
						</td>
					</tr>
					<tr id="title-size">
						<th scope="row">
							<label for="agi_modal_title">Title Size</label>
						</th>
						<td>
							<select id="agi_modal_title_size" name="agi_modal_title_size">
							<?php
								$title_size_options = array(
									'h2', 'h3', 'h4', 'h5'
								);
								
								
								foreach($title_size_options as $title_option) {
									if($agi_modal_title_size == $title_option) {
										$selected = " selected='selected'";
									} else {
										$selected = "";
									}
									echo '<option value="' . $title_option . '" ' . $selected . '>&lt;' . $title_option . '&gt;</option>' . "\n";
								}
								
							?>
							</select>
						</td>
					</tr>
					<tr id="use-subtitle">
						<th scope="row">
							<label for="agi_modal_use_subtitle">Use Subtitle?</label>
						</th>
						<td>
							<?php $checked = ($agi_modal_use_subtitle ? 'checked' : ''); ?>
							<input name="agi_modal_use_subtitle" id="agi_modal_use_subtitle" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="subtitle">
						<th scope="row">
							<label for="agi_modal_subtitle">Subtitle</label>
						</th>
						<td>
							<input name="agi_modal_subtitle" id="agi_modal_subtitle" type="text" value="<?=$agi_modal_subtitle?>" class="regular-text ">
						</td>
					</tr>
					<tr id="subtitle-size">
						<th scope="row">
							<label for="agi_modal_subtitle">Subtitle Size</label><br />
							<small>Make sure it is a smaller size than the title size</small>
						</th>
						<td>
							<select id="agi_modal_subtitle_size" name="agi_modal_subtitle_size">
							<?php
								$subtitle_size_options = array(
									'h3', 'h4', 'h5', 'h6'
								);
								
								
								foreach($subtitle_size_options as $subtitle_option) {
									if($agi_modal_subtitle_size == $subtitle_option) {
										$selected = " selected='selected'";
									} else {
										$selected = "";
									}
									echo '<option value="' . $subtitle_option . '" ' . $selected . '>&lt;' . $subtitle_option . '&gt;</option>' . "\n";
								}
								
							?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<h3>Content</h3>
			<table class="form-table">
				<tbody>
					<tr id="using_shortcode">
						<th scope="row">
							<label for="agi_modal_using_shortcode">Using Shortcode?</label>
						</th>
						<td>
							<?php $checked = ($agi_modal_using_shortcode ? 'checked' : ''); ?>
							<input name="agi_modal_using_shortcode" id="agi_modal_using_shortcode" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="shortcode">
						<th scope="row">
							<label for="agi_modal_shortcode">Shortcode</label>
						</th>
						<td>
							<input name="agi_modal_shortcode" id="agi_modal_shortcode" type="text" value="<?=$agi_modal_shortcode?>" class="regular-text ">
						</td>
					</tr>
					<tr id="html">
						<th scope="row">
							<label for="agi_modal_html">HTML</label><br />
							<small>Usually a line of Javascript or something</small>
						</th>
						<td>
							<textarea name="agi_modal_html" id="agi_modal_html" class="large-text"><?=$agi_modal_html?></textarea>
						</td>
					</tr>
					<tr id="on-pages">
						<th scope="row">
							<label for="agi_modal_on_pages">Show Up on Pages?</label>
						</th>
						<td>
							<?php $checked = ($agi_modal_on_pages ? 'checked' : ''); ?>
							<input name="agi_modal_on_pages" id="agi_modal_on_pages" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="number-of-pages">
						<th scope="row">
							<label for="agi_modal_number_of_pages">How many pages until it shows?</label>
						</th>
						<td>
							<select id="agi_modal_number_of_pages" name="agi_modal_number_of_pages">
							<?php
								for($i = 1; $i < 10; $i++) {
									$selected = ($i == $agi_modal_number_of_pages ? " selected='selected'" : '');
									echo '<option' . $selected . '>' . $i . '</option>' . "\n";
								}
							?>
							</select>
						</td>
					</tr>
					<tr id="on-posts">
						<th scope="row">
							<label for="agi_modal_on_posts">Show Up on Posts?</label>
						</th>
						<td>
							<?php $checked = ($agi_modal_on_posts ? 'checked' : ''); ?>
							<input name="agi_modal_on_posts" id="agi_modal_on_posts" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="number-of-posts">
						<th scope="row">
							<label for="agi_modal_number_of_posts">How many posts until it shows?</label>
						</th>
						<td>
							<select id="agi_modal_number_of_posts" name="agi_modal_number_of_posts">
							<?php
								for($i = 1; $i < 10; $i++) {
									$selected = ($i == $agi_modal_number_of_pages ? " selected='selected'" : '');
									echo '<option' . $selected . '>' . $i . '</option>' . "\n";
								}
							?>
							</select>
						</td>
					</tr>
					<tr id="reset-time">
						<th scope="row">
							<label for="agi_modal_reset_time">Reset Time</label><br />
							<small>How much time before the timer resets?</small>
						</th>
						<td>
							<input name="agi_modal_reset_time" id="agi_modal_reset_time" type="text" value="<?=$agi_modal_reset_time?>" class="small-text"> minutes
						</td>
					</tr>
				</tbody>
			</table>
			<h3>Technical Details</h3>
			<table class="form-table">
				<tbody>
					<tr id="hook">
						<th scope="row">
							<label for="agi_modal_hook">Hook</label>
						</th>
						<td>
							<input name="agi_modal_hook" id="agi_modal_hook" type="text" value="<?=$agi_modal_hook?>" class="regular-text">
						</td>
					</tr>
					<tr id="hook-percent">
						<th scope="row">
							<label for="agi_modal_hook_percent"><abbr title="How far up should the element get on the page before the modal window is triggered?" style="border-bottom: 1px dashed #ccc;">Hook Percent</abbr></label><br />
							<small>0 is top of the page, 100 is bottom</small>
						</th>
						<td>
							<input name="agi_modal_hook_percent" id="agi_modal_hook_percent" type="text" value="<?=$agi_modal_hook_percent?>" class="small-text">%
						</td>
					</tr>
					<tr id="include-hook-el">
						<th scope="row">
							<label for="agi_modal_include_hook_el"><abbr title="If this is an element that is not already on the page, check the box to include it.  If it's already there, make sure the box is NOT checked." style="border-bottom: 1px dashed #ccc;">Include "<small><em><span id="userhook"><?=$agi_modal_hook?></span></em></small>"?</abbr></label>
						</th>
						<td>
							<?php $checked = ($agi_modal_include_hook_el ? 'checked' : ''); ?>
							<input name="agi_modal_include_hook_el" id="agi_modal_include_hook_el" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="load-jquery">
						<th scope="row">
							<label for="agi_modal_load_jquery">Load jQuery?</label><br />
							<small>Check if the theme doesn't already use jQuery</small>
						</th>
						<td>
							<?php $checked = ($agi_modal_load_jquery ? 'checked' : ''); ?>
							<input name="agi_modal_load_jquery" id="agi_modal_load_jquery" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="is-bootstrap">
						<th scope="row">
							<label for="agi_modal_is_bootstrap">Is Bootstrap?</label><br />
							<small>The modal is based off of Bootstrap's modals.  If this site is based on Bootstrap and Modals have been included, check this box.</small>
						</th>
						<td>
							<?php $checked = ($agi_modal_is_bootstrap ? 'checked' : ''); ?>
							<input name="agi_modal_is_bootstrap" id="agi_modal_is_bootstrap" type="checkbox" <?=$checked?>>
						</td>
					</tr>
					<tr id="bootstrap-version">
						<th scope="row">
							<label for="agi_modal_bootstrap_version">Bootstrap Version</label>
						</th>
						<td>
							<select id="agi_modal_bootstrap_version" name="agi_modal_bootstrap_version">
							<?php
								$bootstrap_versions = array(
									'2', '3'
								);
								
								
								foreach($bootstrap_versions as $bootstrap_version) {
									if(agi_modal_bootstrap_version == $bootstrap_version) {
										$selected = " selected='selected'";
									} else {
										$selected = "";
									}
									echo '<option value="' . $bootstrap_version . '" ' . $selected . '>' . $bootstrap_version . '.x.x</option>' . "\n";
								}
								
							?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<h3>Don't forget to use <code><?=plugins_url( 'agi-modal-redirect.php', __DIR__)?></code> as your redirect URL.</h3>
			<?php submit_button(); ?>
		</form>
	</div>
	<script>
		(function( $ ) {

			// Functions
			function switchQuotes(place) {
				var oldText = place.val();
				var newText = oldText.replace(new RegExp('"', "g"), "'");
				place.val(newText);
			}
			
			
			// Do this immediately
			if($('#agi_modal_use_subtitle').prop('checked')) {
				$('#subtitle').show();
				$('#subtitle-size').show();
			} else {
				$('#subtitle').hide();
				$('#subtitle-size').hide();
			}
			
			if($('#agi_modal_using_shortcode').prop('checked')) {
				$('#shortcode').show();
				$('#html').hide();
			} else {
				$('#shortcode').hide();
				$('#html').show();
			}
			
			if($('#agi_modal_on_pages').prop('checked')) {
				$('#number-of-pages').show();
			} else {
				$('#number-of-pages').hide();
			}
			
			if($('#agi_modal_on_posts').prop('checked')) {
				$('#number-of-posts').show();
			} else {
				$('#number-of-posts').hide();
			}
			
			if($('#agi_modal_is_bootstrap').prop('checked')) {
				$('#bootstrap-version').show();
			} else {
				$('#bootstrap-version').hide();
			}
			

			// Listeners
			$('#agi_modal_use_subtitle').change(function() {
				if(this.checked) {
					$('#subtitle').fadeIn(200);
					$('#subtitle-size').fadeIn(200);
				} else {
					$('#subtitle').fadeOut(200);
					$('#subtitle-size').fadeOut(200);
				}
			});


			$('#agi_modal_using_shortcode').change(function() {
				if(this.checked) {
					$('#html').fadeOut(200, function() {
						$('#shortcode').fadeIn(200);
					});
				} else {
					$('#shortcode').fadeOut(200, function() {
						$('#html').fadeIn(200);
					});
				}
			});
			
			$('#agi_modal_on_pages').change(function() {
				if($('#agi_modal_on_pages').prop('checked')) {
					$('#number-of-pages').fadeIn(200);
				} else {
					$('#number-of-pages').fadeOut(200);
				}
			});
			
			$('#agi_modal_on_posts').change(function() {
				if($('#agi_modal_on_posts').prop('checked')) {
					$('#number-of-posts').fadeIn(200);
				} else {
					$('#number-of-posts').fadeOut(200);
				}
			});

			$('#agi_modal_is_bootstrap').change(function() {
				if($('#agi_modal_is_bootstrap').prop('checked')) {
					$('#bootstrap-version').fadeIn(200);
				} else {
					$('#bootstrap-version').fadeOut(200);
				}
			});

			
			$('#agi_modal_shortcode').blur(function() {
				switchQuotes($(this));
			});
			
			$('#agi_modal_html').blur(function() {
				switchQuotes($(this));
			});
			
			$('#agi_modal_hook').keyup(function() {
				var hookVal = $(this).val();
				$('#userhook').html(hookVal);
			});


			
		})(jQuery);
		
	</script>
	<?php
}
