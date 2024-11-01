<style type="text/css">
#wp-hgrant-search-field-container {
	margin: 1em 0;
	padding: 1em;
	background: #eeeeee;
	font-size: 0.9em;
}
.wp-hgrant-search-field-label {
	display: block;
	margin: .5em 0;
	font-weight: 700;
}
.wp-hgrant-keywords {
	width: 95%;
}
.wp-hgrant-search-field-container-start-date, .wp-hgrant-search-field-container-geo-area, .wp-hgrant-search-field-container-program {
	float: left;
	margin: 0 2em 1em 0;
}
.wp-hgrant-search-field-container-submit {
	clear: left;
}
</style>
<div id="wp-hgrant-search-field-container">
	<form action="<?php echo esc_attr(esc_url($archive_link)); ?>" method="post">
		<div class="wp-hgrant-search-field-container-keywords">
			<label>
				<span class="wp-hgrant-search-field-label"><?php _e('Keyword(s)'); ?></span>
				<input type="text" class="wp-hgrant-search-field wp-hgrant-search-field-text wp-hgrant-keywords" name="wp-hgrant-search[keywords]" value="<?php echo esc_attr($hgrant_keywords); ?>" />
			</label>
		</div>

		<div class="wp-hgrant-search-field-container-start-date">
			<label>
				<span class="wp-hgrant-search-field-label"><?php _e('Fiscal Year'); ?></span>
				<select class="wp-hgrant-search-field wp-hgrant-search-field-select wp-hgrant-date" name="wp-hgrant-search[start-date]">
					<option value=""><?php _e('Any'); ?></option>
					<?php foreach($start_years as $start_year) { ?>
					<option <?php selected($hgrant_start_year, $start_year); ?> value="<?php echo esc_html($start_year); ?>"><?php echo esc_html($start_year); ?></option>
					<?php } ?>
				</select>
			</label>
		</div>

		<?php if(!empty($countries) || !empty($continents)) { ?>
		<div class="wp-hgrant-search-field-container-geo-area">
			<label>
				<span class="wp-hgrant-search-field-label"><?php _e('Regions Served'); ?></span>
				<select class="wp-hgrant-search-field wp-hgrant-search-field-select wp-hgrant-geo-area" name="wp-hgrant-search[geo-area]">
					<option value=""><?php _e('Any'); ?></option>
					<?php if(!empty($continents)) { ?>
					<optgroup label="<?php _e('Continents'); ?>">
						<?php foreach($continents as $continent) { $val = "continent|{$continent}"; ?>
						<option <?php selected($val, $geo_area_string); ?> value="<?php echo esc_attr($val); ?>"><?php echo esc_html($continent); ?></option>
						<?php } ?>
					</optgroup>
					<?php } ?>

					<?php if(!empty($countries)) { ?>
					<optgroup label="<?php _e('Countries'); ?>">
						<?php foreach($countries as $country_key => $country) { $val = "country|{$country_key}"; ?>
						<option <?php selected($val, $geo_area_string); ?> value="<?php echo esc_attr($val); ?>"><?php echo esc_html($country); ?></option>
						<?php } ?>
					</optgroup>
					<?php } ?>
				</select>
			</label>
		</div>
		<?php } ?>

		<?php $terms = get_terms(array(WP_hGrant::TAXONOMY_PROGRAM_AREA)); if(!empty($terms)) { ?>
		<div class="wp-hgrant-search-field-container-program">
			<label>
				<span class="wp-hgrant-search-field-label"><?php _e('Program Area'); ?></span>
				<?php wp_dropdown_categories(array(
					'hide_empty' => true,
					'hierarchical' => true,
					'name' => 'wp-hgrant-search[program-area]',
					'id' => '',
					'orderby' => 'name',
					'selected' => $hgrant_program_area,
					'show_count' => 0,
					'show_option_all' => __('Any'),
					'taxonomy' => WP_hGrant::TAXONOMY_PROGRAM_AREA,
					'class' => 'wp-hgrant-search-field-select wp-hgrant-program-areas',
				)); ?>
			</label>
		</div>
		<?php } ?>

		<div class="wp-hgrant-search-field-container-submit">
			<input type="submit" class="wp-hgrant-search-field wp-hgrant-search-field-submit" name="wp-hgrant-search-submit" value="<?php _e('Search'); ?>" />
		</div>
	</form>
</div>