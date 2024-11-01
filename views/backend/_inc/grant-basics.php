<h4 class="wp-hgrant-section-title"><?php _e('Grant &mdash; Basics'); ?></h4>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_id'); ?>"><?php _e('ID'); ?></label></th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grant_id'); ?>" name="<?php self::_meta_name('grant_id'); ?>" value="<?php echo esc_attr($grant_details['grant_id']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label class="wp-hgrant-required" for="content"><?php _e('Description'); ?></label></th>
			<td>
				<textarea class="large-text" rows="5" id="content" name="content"><?php echo esc_textarea($post->post_content); ?></textarea>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_amount_amount'); ?>"><?php _e('Amount'); ?></label></th>
			<td>
				<select id="<?php self::_meta_id('grant_amount_currency'); ?>" name="<?php self::_meta_name('grant_amount_currency'); ?>">
					<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
					<option <?php selected($currency_code, $grant_details['grant_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
					<?php } ?>
				</select>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grant_amount_amount'); ?>" name="<?php self::_meta_name('grant_amount_amount'); ?>" value="<?php echo esc_attr($grant_details['grant_amount_amount']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_duration_amount'); ?>"><?php _e('Duration'); ?></label></th>
			<td>
				<input type="text" class="small-text code" id="<?php self::_meta_id('grant_duration_amount'); ?>" name="<?php self::_meta_name('grant_duration_amount'); ?>" value="<?php echo esc_attr($grant_details['grant_duration_amount']); ?>" />
				<select id="<?php self::_meta_id('grant_duration_period'); ?>" name="<?php self::_meta_name('grant_duration_period'); ?>">
					<?php foreach(array('months' => __('Month(s)'), 'years' => __('Year(s)')) as $period_key => $period_name) { ?>
					<option <?php selected($period_key, $grant_details['grant_duration_period']); ?> value="<?php echo esc_attr($period_key); ?>"><?php echo $period_name; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_activity'); ?>"><?php _e('Grant Activity'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grant_activity'); ?>" name="<?php self::_meta_name('grant_activity'); ?>" value="<?php echo esc_attr($grant_details['grant_activity']); ?>" />
				<p class="description"><?php printf(__('Provide a code (like <code>A20</code>, <code>B30</code>, or <code>C40</code>) from the list of available <a href="%1$s" target="_blank">NTEE codes</a>. If you need to enter multiple codes, please separate them with a comma (<code>,</code>).'), 'http://foundationcenter.org/ntee'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_population_group'); ?>"><?php _e('Population Group(s)'); ?></label>
			</th>
			<td>
				<textarea class="large-text" rows="5" id="<?php self::_meta_id('grant_population_group'); ?>" name="<?php self::_meta_name('grant_population_group'); ?>"><?php echo esc_textarea($grant_details['grant_population_group']); ?></textarea>
				<p class="description">
					<?php _e('Provide the primary population groups served by this grant.'); ?>
					<?php _e('Enter each population group (such as <code>girls,ages 10-18</code> or <code>mothers,ages 18-25</code>) on a separate line.'); ?><br />
				</p>
			</td>
		</tr>
	</tbody>
</table>