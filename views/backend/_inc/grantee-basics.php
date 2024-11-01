<h4 class="wp-hgrant-section-title"><?php _e('Grantee &mdash; Basics'); ?></h4>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label class="wp-hgrant-required" for="<?php self::_meta_id('grantee_name'); ?>"><?php _e('Organization Name'); ?></label>
			</th>
			<td>
				<input type="text" class="large-text wp-hgrant-grantee-name" id="<?php self::_meta_id('grantee_name'); ?>" name="<?php self::_meta_name('grantee_name'); ?>" value="<?php echo esc_attr($grant_details['grantee_name']); ?>" />
				<p class="description"><?php _e('Provide the full legal name of the grantee organization as registered with the IRS or international equivalent.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_street_address'); ?>"><?php _e('Street Address'); ?></label>
			</th>
			<td>
				<input type="text" class="large-text" id="<?php self::_meta_id('grantee_street_address'); ?>" name="<?php self::_meta_name('grantee_street_address'); ?>" value="<?php echo esc_attr($grant_details['grantee_street_address']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_extended_address'); ?>"><?php _e('Extended Address'); ?></label>
			</th>
			<td>
				<input type="text" class="large-text" id="<?php self::_meta_id('grantee_extended_address'); ?>" name="<?php self::_meta_name('grantee_extended_address'); ?>" value="<?php echo esc_attr($grant_details['grantee_extended_address']); ?>" />
				<p class="description"><?php _e('Provide secondary address information such as floor, department name, building name, etc.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_po_box'); ?>"><?php _e('PO Box'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_po_box'); ?>" name="<?php self::_meta_name('grantee_po_box'); ?>" value="<?php echo esc_attr($grant_details['grantee_po_box']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label class="wp-hgrant-required" for="<?php self::_meta_id('grantee_locality'); ?>"><?php _e('Locality'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_locality'); ?>" name="<?php self::_meta_name('grantee_locality'); ?>" value="<?php echo esc_attr($grant_details['grantee_locality']); ?>" />
				<p class="description"><?php _e('Provide the city for a domestic grantee organization or the equivalent for an international grantee organization.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label class="wp-hgrant-required" for="<?php self::_meta_id('grantee_region'); ?>"><?php _e('Region'); ?></label>
			</th>
			<td>
				<select class="wp-hgrant-other-chooser" id="<?php self::_meta_id('grantee_region'); ?>" name="<?php self::_meta_name('grantee_region'); ?>">
					<optgroup label="<?php _e('US States and Territories'); ?>">
						<?php foreach($states as $state_code => $state_name) { ?>
						<option <?php selected($state_code, $grant_details['grantee_region']); ?> value="<?php echo esc_attr($state_code); ?>"><?php echo esc_html($state_name); ?></option>
						<?php } ?>
					</optgroup>
					<option <?php selected('00', $grant_details['grantee_region']); ?> value="00"><?php _e('Other'); ?></option>
				</select>
				<div class="wp-hgrant-other">
					<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_region_other'); ?>" name="<?php self::_meta_name('grantee_region_other'); ?>" value="<?php echo esc_attr($grant_details['grantee_region_other']); ?>" />
				</div>
				<p class="description"><?php _e('Select a state for a domestic grantee organization or select "Other" and enter the full name of a comparable administrative division for an international grantee organization.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_postal_code'); ?>"><?php _e('Postal Code'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_postal_code'); ?>" name="<?php self::_meta_name('grantee_postal_code'); ?>" value="<?php echo esc_attr($grant_details['grantee_postal_code']); ?>" />
				<p class="description"><?php _e('Provide the zip code for a domestic grantee organization or equivalent for an international grantee organization.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label class="wp-hgrant-required" for="<?php self::_meta_id('grantee_country_name'); ?>"><?php _e('Country Name'); ?></label>
			</th>
			<td>
				<select id="<?php self::_meta_id('grantee_country_name'); ?>" name="<?php self::_meta_name('grantee_country_name'); ?>">
					<?php foreach($countries as $country_code => $country_name) { ?>
					<option <?php selected($country_code, $grant_details['grantee_country_name']); ?> value="<?php echo esc_attr($country_code); ?>"><?php echo esc_html($country_name); ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
	</tbody>
</table>