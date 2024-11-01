<div class="wrap">
	<form action="<?php echo esc_attr(esc_url($import_link)); ?>" enctype="multipart/form-data" method="post">
		<?php //screen_icon(); ?>

		<h2><?php _e('Import Grants'); ?></h2>

		<?php settings_errors(); ?>

		<?php if($error) { ?>
		<div id="wp-hgrant-import-error" class="updated error settings-error">
			<p><strong><?php _e('Error:'); ?></strong> <?php echo esc_html($error); ?></p>
		</div>
		<?php } ?>

		<?php if('fields' === $step) { ?>

		<p>
			<?php printf(_n('You are importing %d grant.', 'You are importing %d grants.', count($data)), count($data)); ?>
		</p>

		<p>
			<?php _e('Select the header name that corresponds to the field indicated. If an appropriate header isn\'t present, select "No Value".'); ?>
		</p>

		<h3><?php _e('Import Configuration'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-configuration-yes"><?php _e('Yes / True Indicator'); ?></label></th>
					<td>
						<input type="text" class="code regular-text" id="wp-hgrant-import-configuration-yes" name="wp-hgrant-import[configuration][yes]" value="<?php echo esc_attr($saved['configuration']['yes']); ?>" />
						<p class="description"><?php _e('Enter the text that indicates a Yes/No field should be evaluated as Yes (e.g. "Y", "Yes", "X", etc.). You can enter multiple values by separating them with a comma (in case there are multiple ways to indicate a Yes / True value).'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-configuration-separator"><?php _e('Separator'); ?></label></th>
					<td>
						<input type="text" class="code small-text" id="wp-hgrant-import-configuration-separator" name="wp-hgrant-import[configuration][separator]" value="<?php echo esc_attr($saved['configuration']['separator']); ?>" />
						<p class="description"><?php _e('Enter the text used as a separator for fields that can contain multiple values to be imported (e.g. Program Areas)'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grant &mdash; Basics'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-post_title"><?php _e('Name'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'post_title', $saved['post_title']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_id"><?php _e('ID'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_id', $saved['grant_id']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-post_content"><?php _e('Description'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'post_content', $saved['post_content']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_amount_currency"><?php _e('Amount'); ?></label></th>
					<td>
						<select id="wp-hgrant-import-fields-grant_amount_currency" name="wp-hgrant-import[fields][grant_amount_currency]">
							<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
							<option <?php selected($currency_code, $saved['grant_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
							<?php } ?>
						</select>
						<?php self::_display_import_page_selector($headers, 'grant_amount_amount', $saved['grant_amount_amount']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_duration_amount"><?php _e('Duration'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_duration_amount', $saved['grant_duration_amount']); ?>
						<select id="wp-hgrant-import-fields-grant_duration_period" name="wp-hgrant-import[fields][grant_duration_period]">
							<?php foreach($periods as $period_key => $period_name) { ?>
							<option <?php selected($period_key, $saved['grant_duration_period']); ?> value="<?php echo esc_attr($period_key); ?>"><?php echo $period_name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_activity"><?php _e('Grant Activity'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_activity', $saved['grant_activity']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_population_group"><?php _e('Population Group(s)'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_population_group', $saved['grant_population_group']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grant &mdash; Classification'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-taxonomy_program_area"><?php _e('Program Areas'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'taxonomy_program_area', $saved['taxonomy_program_area']); ?>
					</td>
				</tr>

				<?php if('yes' === self::_get_settings('enable_support_types')) { ?>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-taxonomy_support_type"><?php _e('Support Types'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'taxonomy_support_type', $saved['taxonomy_support_type']); ?>
					</td>
				</tr>
				<?php } ?>

				<?php if('yes' === self::_get_settings('enable_strategies')) { ?>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-taxonomy_strategy"><?php _e('Strategies'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'taxonomy_strategy', $saved['taxonomy_strategy']); ?>
					</td>
				</tr>
				<?php } ?>

				<?php if('yes' === self::_get_settings('enable_initiatives')) { ?>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-taxonomy_initiative"><?php _e('Initiatives'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'taxonomy_initiative', $saved['taxonomy_initiative']); ?>
					</td>
				</tr>
				<?php } ?>

				<?php if('yes' === self::_get_settings('enable_themes')) { ?>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-taxonomy_theme"><?php _e('Themes'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'taxonomy_theme', $saved['taxonomy_theme']); ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3><?php _e('Grant &mdash; Dates'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_dtstart"><?php _e('Start Date'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_dtstart', $saved['grant_dtstart']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_dtend"><?php _e('End Date'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_dtend', $saved['grant_dtend']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grant_fiscal_year_end"><?php _e('Fiscal Year End'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_fiscal_year_end', $saved['grant_fiscal_year_end']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grant &mdash; Geo Areas'); ?></h3>

		<?php
		$components = array(
			'continent' => __('Continent'),
			'inter_country_region' => __('Inter-Country Region'),
			'country' => __('Country'),
			'intra_country_region' => __('Intra-Country Region'),
			'intra_state_region' => __('Intra-State Region'),
			'state' => __('State'),
			'county' => __('County'),
			'city' => __('City'),
			'neighborhood' => __('Neighborhood'),
			'allocation_amount_amount' => __('Allocation Amount'),
			'allocation_percent' => __('Allocation Amount Percent'),
		);
		?>

		<table class="form-table">
			<tbody>
				<?php foreach($components as $component_key => $component_name) { ?>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-geo_area_<?php echo esc_attr($component_key); ?>"><?php echo esc_html($component_name); ?></label></th>
					<td>
						<?php if('allocation_amount_amount' === $component_key) { ?>
						<select id="wp-hgrant-import-fields-geo_area_allocation_amount_currency" name="wp-hgrant-import[fields][geo_area_allocation_amount_currency]">
							<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
							<option <?php selected($currency_code, $saved['geo_area_allocation_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
							<?php } ?>
						</select>
						<?php } ?>

						<?php self::_display_import_page_selector($headers, "geo_area_{$component_key}", $saved["geo_area_{$component_key}"]); ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3><?php _e('Grant &mdash; Other'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_outcome"><?php _e('Outcome'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_outcome', $saved['grant_outcome']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_outputs"><?php _e('Outputs'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_outputs', $saved['grant_outputs']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_challenge_grant"><?php _e('Challenge Grant'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_challenge_grant', $saved['grant_challenge_grant']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_matching_grant"><?php _e('Matching Grant'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_matching_grant', $saved['grant_matching_grant']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_continuing_support_grant"><?php _e('Continuing Support Grant'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_continuing_support_grant', $saved['grant_continuing_support_grant']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_fiscal_agent"><?php _e('Fiscal Agent'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_fiscal_agent', $saved['grant_fiscal_agent']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_shared_grant"><?php _e('Shared Grant'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_shared_grant', $saved['grant_shared_grant']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_fund_name"><?php _e('Fund Name'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_fund_name', $saved['grant_fund_name']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_fund_type"><?php _e('Fund Type'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_fund_type', $saved['grant_fund_type']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grant_fund_subtype"><?php _e('Fund Subtype'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grant_fund_subtype', $saved['grant_fund_subtype']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-iati_flag"><?php _e('IATI Inclusion'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'iati_flag', $saved['iati_flag']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grantee &mdash; Basics'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grantee_name"><?php _e('Organization Name'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_name', $saved['grantee_name']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_street_address"><?php _e('Street Address'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_street_address', $saved['grantee_street_address']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_extended_address"><?php _e('Extended Address'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_extended_address', $saved['grantee_extended_address']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_po_box"><?php _e('PO Box'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_po_box', $saved['grantee_po_box']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grantee_locality"><?php _e('Locality'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_locality', $saved['grantee_locality']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label class="wp-hgrant-required" for="wp-hgrant-import-fields-grantee_region"><?php _e('Region'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_region', $saved['grantee_region']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_postal_code"><?php _e('Postal Code'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_postal_code', $saved['grantee_postal_code']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_country_name"><?php _e('Country Name'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_country_name', $saved['grantee_country_name']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grantee &mdash; Contact'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_telephone"><?php _e('Telephone'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_telephone', $saved['grantee_telephone']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_email"><?php _e('Email'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_email', $saved['grantee_email']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_url"><?php _e('URL'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_url', $saved['grantee_url']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grantee &mdash; Other'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_unit"><?php _e('Department / Subdivision'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_unit', $saved['grantee_unit']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_ein"><?php _e('EIN'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_ein', $saved['grantee_ein']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_aka"><?php _e('Also Known As'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_aka', $saved['grantee_aka']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_dba"><?php _e('Doing Business As'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_dba', $saved['grantee_dba']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_fka"><?php _e('Formerly Known As'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_fka', $saved['grantee_fka']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_type"><?php _e('Grantee Type'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_type', $saved['grantee_type']); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-fields-grantee_population_group"><?php _e('Grantee Population Group(s)'); ?></label></th>
					<td>
						<?php self::_display_import_page_selector($headers, 'grantee_population_group', $saved['grantee_population_group']); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<input type="hidden" name="wp-hgrant-import[data]" value="<?php echo esc_attr(json_encode($data)); ?>" />
		<input type="hidden" name="wp-hgrant-import[headers]" value="<?php echo esc_attr(json_encode($headers)); ?>" />

		<p class="submit">
			<?php wp_nonce_field('wp-hgrant-import', 'wp-hgrant-import-nonce'); ?>
			<input type="submit" class="button button-primary" value="<?php _e('Import Grants'); ?>" />
		</p>

		<?php } else { ?>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="wp-hgrant-import-file"><?php _e('Grants File'); ?></label></th>
					<td>
						<input type="file" id="wp-hgrant-import-file" name="wp-hgrant-import-file" value="" />
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<?php wp_nonce_field('wp-hgrant-import-file', 'wp-hgrant-import-file-nonce'); ?>
			<input type="submit" class="button button-primary" value="<?php _e('Map Fields'); ?>" />
		</p>
		<?php } ?>
	</form>
</div>
