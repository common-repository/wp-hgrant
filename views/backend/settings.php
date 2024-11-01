<div class="wrap">
	<form action="options.php" method="post">
		<?php //screen_icon(); ?>
		<h2><?php _e('Grantor Settings'); ?></h2>

		<?php settings_errors(); ?>

		<p>
			<?php _e('Please provide as much information as you can. Fields with a bold label are required by the hGrant specification and it is strongly recommended you provide values for those fields.'); ?>
		</p>

		<h3><?php _e('Grantor &mdash; Basics'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label class="wp-hgrant-required" for="<?php self::_settings_id('name'); ?>"><?php _e('Organization Name'); ?></label>
					</th>
					<td>
						<input type="text" class="large-text" id="<?php self::_settings_id('name'); ?>" name="<?php self::_settings_name('name'); ?>" value="<?php echo esc_attr($settings['name']); ?>" />
						<p class="description"><?php _e('Provide the full legal name of the grantor organization as registered with the IRS or international equivalent.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('street_address'); ?>"><?php _e('Street Address'); ?></label>
					</th>
					<td>
						<input type="text" class="large-text" id="<?php self::_settings_id('street_address'); ?>" name="<?php self::_settings_name('street_address'); ?>" value="<?php echo esc_attr($settings['street_address']); ?>" />
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('extended_address'); ?>"><?php _e('Extended Address'); ?></label>
					</th>
					<td>
						<input type="text" class="large-text" id="<?php self::_settings_id('extended_address'); ?>" name="<?php self::_settings_name('extended_address'); ?>" value="<?php echo esc_attr($settings['extended_address']); ?>" />
						<p class="description"><?php _e('Provide secondary address information such as floor, department name, building name, etc.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('po_box'); ?>"><?php _e('PO Box'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" id="<?php self::_settings_id('po_box'); ?>" name="<?php self::_settings_name('po_box'); ?>" value="<?php echo esc_attr($settings['po_box']); ?>" />
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label class="wp-hgrant-required" for="<?php self::_settings_id('locality'); ?>"><?php _e('Locality'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" id="<?php self::_settings_id('locality'); ?>" name="<?php self::_settings_name('locality'); ?>" value="<?php echo esc_attr($settings['locality']); ?>" />
						<p class="description"><?php _e('Provide the city for a domestic grantor organization and the equivalent for an international grantor organization.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label class="wp-hgrant-required" for="<?php self::_settings_id('region'); ?>"><?php _e('Region'); ?></label>
					</th>
					<td>
						<select class="wp-hgrant-other-chooser" id="<?php self::_settings_id('region'); ?>" name="<?php self::_settings_name('region'); ?>">
							<optgroup label="<?php _e('US States and Territories'); ?>">
								<?php foreach($states as $state_code => $state_name) { ?>
								<option <?php selected($state_code, $settings['region']); ?> value="<?php echo esc_attr($state_code); ?>"><?php echo esc_html($state_name); ?></option>
								<?php } ?>
							</optgroup>
							<option <?php selected('00', $settings['region']); ?> value="00"><?php _e('Other'); ?></option>
						</select>
						<div class="wp-hgrant-other">
							<input type="text" class="regular-text" id="<?php self::_settings_id('region_other'); ?>" name="<?php self::_settings_name('region_other'); ?>" value="<?php echo esc_attr($settings['region_other']); ?>" />
						</div>
						<p class="description"><?php _e('Select a state for a domestic grantor organization or select "Other" and enter the full name of a comparable administrative division for an international grantor organization.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('postal_code'); ?>"><?php _e('Postal Code'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" id="<?php self::_settings_id('postal_code'); ?>" name="<?php self::_settings_name('postal_code'); ?>" value="<?php echo esc_attr($settings['postal_code']); ?>" />
						<p class="description"><?php _e('Provide the zip code for a domestic grantor organization or equivalent for an international grantor organization.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label class="wp-hgrant-required" for="<?php self::_settings_id('country_name'); ?>"><?php _e('Country Name'); ?></label>
					</th>
					<td>
						<select id="<?php self::_settings_id('country_name'); ?>" name="<?php self::_settings_name('country_name'); ?>">
							<?php foreach($countries as $country_code => $country_name) { ?>
							<option <?php selected($country_code, $settings['country_name']); ?> value="<?php echo esc_attr($country_code); ?>"><?php echo esc_html($country_name); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grantor &mdash; Contact'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('telephone'); ?>"><?php _e('Telephone'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text code" id="<?php self::_settings_id('telephone'); ?>" name="<?php self::_settings_name('telephone'); ?>" value="<?php echo esc_attr($settings['telephone']); ?>" />
						<p class="description"><?php _e('Provide only digits. International numbers should be prefixed with <code>011</code>.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('email'); ?>"><?php _e('Email'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text code" id="<?php self::_settings_id('email'); ?>" name="<?php self::_settings_name('email'); ?>" value="<?php echo esc_attr($settings['email']); ?>" />
						<p class="description"><?php _e('Provide the general contact email of the grantor organization.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('url'); ?>"><?php _e('URL'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text code" id="<?php self::_settings_id('url'); ?>" name="<?php self::_settings_name('url'); ?>" value="<?php echo esc_attr($settings['url']); ?>" />
						<p class="description"><?php _e('Provide the full URL of the grantor organization\'s website. This should include the protocol (like <code>http://</code> or <code>https://</code>).'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Grantor &mdash; Other'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('ein'); ?>"><?php _e('EIN'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text code" id="<?php self::_settings_id('ein'); ?>" name="<?php self::_settings_name('ein'); ?>" value="<?php echo esc_attr($settings['ein']); ?>" />
						<p class="description"><?php _e('Provide the EIN of the grantor organization as registered with the IRS or international equivalent.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('fiscal_year_end'); ?>"><?php _e('Fiscal Year End'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text code wp-hgrant-datepicker-special" id="<?php self::_settings_id('fiscal_year_end'); ?>" name="<?php self::_settings_name('fiscal_year_end'); ?>" value="<?php echo esc_attr($settings['fiscal_year_end']); ?>" />
						<p class="description"><?php _e('Select the month and day on which the grantor\'s fiscal year ends.'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Defaults'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('default_duration_amount'); ?>"><?php _e('Default Duration'); ?></label></th>
					<td>
						<input type="text" class="small-text code" id="<?php self::_settings_id('default_duration_amount'); ?>" name="<?php self::_settings_name('default_duration_amount'); ?>" value="<?php echo esc_attr($settings['default_duration_amount']); ?>" />
						<select id="<?php self::_settings_id('default_duration_period'); ?>" name="<?php self::_settings_name('default_duration_period'); ?>">
							<?php foreach(array('months' => __('Month(s)'), 'years' => __('Year(s)')) as $period_key => $period_name) { ?>
							<option <?php selected($period_key, $settings['default_duration_period']); ?> value="<?php echo esc_attr($period_key); ?>"><?php echo $period_name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('default_amount_currency'); ?>"><?php _e('Default Currency'); ?></label></th>
					<td>
						<select id="<?php self::_settings_id('default_amount_currency'); ?>" name="<?php self::_settings_name('default_amount_currency'); ?>">
							<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
							<option <?php selected($currency_code, $settings['default_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('default_iati_flag_yes'); ?>"><?php _e('IATI Inclusion'); ?></label>
					</th>
					<td>
						<input type="hidden" id="<?php self::_settings_id('default_iati_flag_no'); ?>" name="<?php self::_settings_name('default_iati_flag'); ?>" value="n" />
						<label>
							<input type="checkbox" <?php checked($settings['default_iati_flag'], 'y'); ?> id="<?php self::_settings_id('default_iati_flag_yes'); ?>" name="<?php self::_settings_name('default_iati_flag'); ?>" value="y" />
							<?php _e('By default, allow the Foundation Center to include your organization\'s published grants in the registry provided to the International Aid Transparency Initiative (IATI). This setting can be overridden for individual grants.'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Taxonomies'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('enable_support_types_yes'); ?>"><?php _e('Support Types'); ?></label></th>
					<td>
						<input type="hidden" name="<?php self::_settings_name('enable_support_types'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked($settings['enable_support_types'], 'yes'); ?> id="<?php self::_settings_id('enable_support_types_yes'); ?>" name="<?php self::_settings_name('enable_support_types'); ?>" value="yes" />
							<?php _e('Use Support Types'); ?> - <em><?php _e('Define types of support to define, sort and organize your grants. Examples include: General Operating Support, Annual Campaign, Student Aid, etc.'); ?></em>
						</label>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('enable_strategies_yes'); ?>"><?php _e('Strategies'); ?></label></th>
					<td>
						<input type="hidden" name="<?php self::_settings_name('enable_strategies'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked($settings['enable_strategies'], 'yes'); ?> id="<?php self::_settings_id('enable_strategies_yes'); ?>" name="<?php self::_settings_name('enable_strategies'); ?>" value="yes" />
							<?php _e('Use Strategies'); ?> - <em><?php _e('Define strategy groups to define, sort and organize your grants.'); ?></em>
						</label>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('enable_initiatives_yes'); ?>"><?php _e('Initiatives'); ?></label></th>
					<td>
						<input type="hidden" name="<?php self::_settings_name('enable_initiatives'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked($settings['enable_initiatives'], 'yes'); ?> id="<?php self::_settings_id('enable_initiatives_yes'); ?>" name="<?php self::_settings_name('enable_initiatives'); ?>" value="yes" />
							<?php _e('Use Initiatives'); ?> - <em><?php _e('Define initiative groups to define, sort and organize your grants.'); ?></em>
						</label>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('enable_themes_yes'); ?>"><?php _e('Themes'); ?></label></th>
					<td>
						<input type="hidden" name="<?php self::_settings_name('enable_themes'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked($settings['enable_themes'], 'yes'); ?> id="<?php self::_settings_id('enable_themes_yes'); ?>" name="<?php self::_settings_name('enable_themes'); ?>" value="yes" />
							<?php _e('Use Themes'); ?> - <em><?php _e('Define theme groups to define, sort and organize your grants.'); ?></em>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Other'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('dtend_warning_yes'); ?>"><?php _e('Protect Expired Grants'); ?></label></th>
					<td>
						<input type="hidden" id="<?php self::_settings_id('dtend_warning_no'); ?>" name="<?php self::_settings_name('dtend_warning'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked('yes', $settings['dtend_warning']); ?> id="<?php self::_settings_id('dtend_warning_yes'); ?>" name="<?php self::_settings_name('dtend_warning'); ?>" value="yes" />
							<?php _e('User authorization is required before editing Grants with an expired duration dates'); ?>
						</label>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="<?php self::_settings_id('initial_geo_area_yes'); ?>"><?php _e('Initial Geo Area'); ?></label></th>
					<td>
						<input type="hidden" id="<?php self::_settings_id('initial_geo_area_no'); ?>" name="<?php self::_settings_name('initial_geo_area'); ?>" value="no" />
						<label>
							<input type="checkbox" <?php checked('yes', $settings['initial_geo_area']); ?> id="<?php self::_settings_id('initial_geo_area_yes'); ?>" name="<?php self::_settings_name('initial_geo_area'); ?>" value="yes" />
							<?php _e('New grants should have a single Geo Area added'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Display Options'); ?></h3>

		<p>
			<?php printf(__('By default, grant archive data is displayed at <code>%s</code>, and single grant listings at <code>%s</code>. You can override these URLs here. Please note that these settings will affect both search listings and the location of your grant data feed. If you change these settings after activating your feed, you will need to re-activate to reflect the new URL.'), home_url('/grants/'), home_url('/grant/grant-slug/')); ?>
		</p>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('archive_slug'); ?>"><?php _e('Grants Archive Display URL'); ?></label>
					</th>
					<td>
						<code><?php echo esc_html(home_url('/')); ?></code><input type="text" class="regular-text code" id="<?php self::_settings_id('archive_slug'); ?>" name="<?php self::_settings_name('archive_slug'); ?>" value="<?php echo esc_attr($settings['archive_slug']); ?>" /><code>/</code>
						<p class="description"><?php _e('Only alphabetical characters, hyphens, and the forward slash are allowed. All other characters will be stripped.'); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="<?php self::_settings_id('single_slug'); ?>"><?php _e('Single Grant Display URL'); ?></label>
					</th>
					<td>
						<code><?php echo esc_html(home_url('/')); ?></code><input type="text" class="regular-text code" id="<?php self::_settings_id('single_slug'); ?>" name="<?php self::_settings_name('single_slug'); ?>" value="<?php echo esc_attr($settings['single_slug']); ?>" /><code>/grant-slug/</code>
						<p class="description"><?php _e('Only alphabetical characters, hyphens, and the forward slash are allowed. All other characters will be stripped.'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<?php settings_fields(self::SETTINGS_NAME); ?>
			<input type="submit" class="button button-primary" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>

	<h2><?php _e('Activate Your Feed!'); ?></h2>

	<p><?php printf(__('Please visit the <a href="%s">Tools</a> page when you are ready to activate your hGrant feed.'), $tools_link); ?></p>
</div>