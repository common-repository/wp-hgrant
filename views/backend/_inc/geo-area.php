<div class="wp-hgrant-geo-area">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><?php _e('Components'); ?></th>
				<td>
					<?php foreach($components as $component_key => $component_name) { ?>
					<label class="wp-hgrant-geo-area-component">
						<input type="checkbox" class="wp-hgrant-geo-area-component-picker" <?php checked(true, in_array($component_key, $geo_area['components'])); ?> name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][components][]" value="<?php echo esc_attr($component_key); ?>" />
						<?php echo esc_html($component_name); ?>
					</label>
					<?php } ?>
				</td>
			</tr>

			<?php foreach($components as $component_key => $component_name) { ?>
			<tr valign="top" data-wp-hgrant-geo-area-component="<?php echo esc_attr($component_key); ?>">
				<th scope="row"><?php echo esc_html($component_name); ?></th>
				<td>
					<?php if('continent' === $component_key) { ?>
					<select name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][<?php echo $component_key; ?>]">
						<?php foreach($continents as $continent_name) { ?>
						<option <?php selected($continent_name, $geo_area[$component_key]); ?> value="<?php echo esc_html($continent_name); ?>"><?php echo esc_html($continent_name); ?></option>
						<?php } ?>
					</select>
					<?php } else if('country' === $component_key) { ?>
					<select name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][<?php echo $component_key; ?>]">
						<?php foreach($countries as $country_key => $country_name) { ?>
						<option <?php selected($country_key, $geo_area[$component_key]); ?> value="<?php echo esc_html($country_key); ?>"><?php echo esc_html($country_name); ?></option>
						<?php } ?>
					</select>
					<?php } else if('state' === $component_key) { ?>
					<select class="wp-hgrant-other-chooser" name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][<?php echo $component_key; ?>]">
						<optgroup label="<?php _e('US States and Territories'); ?>">
							<?php foreach($states as $state_code => $state_name) { ?>
							<option <?php selected($state_code, $geo_area[$component_key]); ?> value="<?php echo esc_attr($state_code); ?>"><?php echo esc_html($state_name); ?></option>
							<?php } ?>
						</optgroup>
						<option <?php selected('00', $geo_area[$component_key]); ?> value="00"><?php _e('Other'); ?></option>
					</select>
					<div class="wp-hgrant-other">
						<input type="text" class="regular-text" name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][<?php echo $component_key; ?>_other]" value="<?php echo esc_attr($geo_area["{$component_key}_other"]); ?>" />
					</div>
					<?php } else { ?>
					<input type="text" class="regular-text" name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][<?php echo $component_key; ?>]" value="<?php echo esc_attr($geo_area[$component_key]); ?>" />
					<?php } ?>
				</td>
			</tr>
			<?php } ?>

			<tr valign="top">
				<th scope="row"><?php _e('Allocation Amount'); ?></th>
				<td>
					<select name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][allocation_amount_currency]">
						<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
						<option <?php selected($currency_code, $geo_area['allocation_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
						<?php } ?>
					</select>
					<input type="text" class="regular-text code" name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][allocation_amount_amount]" value="<?php echo esc_attr($geo_area['allocation_amount_amount']); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Allocation Percent'); ?></th>
				<td>
					<input type="text" class="small-text code" name="wp-hgrant[grant_geo_areas][<?php echo $geo_area_key; ?>][allocation_percent]" value="<?php echo esc_attr($geo_area['allocation_percent']); ?>" /><code>%</code>
				</td>
			</tr>

			<tr valign="top">
				<td colspan="2"><a class="wp-hgrant-geo-area-remove" href="#"><?php _e('Remove this Geo Area'); ?></a></td>
			</tr>
		</tbody>
	</table>
</div>