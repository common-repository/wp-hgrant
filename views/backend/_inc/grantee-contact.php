<h4 class="wp-hgrant-section-title"><?php _e('Grantee &mdash; Contact'); ?></h4>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_telephone'); ?>"><?php _e('Telephone'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grantee_telephone'); ?>" name="<?php self::_meta_name('grantee_telephone'); ?>" value="<?php echo esc_attr($grant_details['grantee_telephone']); ?>" />
				<p class="description"><?php _e('Provide only digits. International numbers should be prefixed with <code>011</code>.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_email'); ?>"><?php _e('Email'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grantee_email'); ?>" name="<?php self::_meta_name('grantee_email'); ?>" value="<?php echo esc_attr($grant_details['grantee_email']); ?>" />
				<p class="description"><?php _e('Provide the general contact email of the grantee organization.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_url'); ?>"><?php _e('URL'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grantee_url'); ?>" name="<?php self::_meta_name('grantee_url'); ?>" value="<?php echo esc_attr($grant_details['grantee_url']); ?>" />
				<p class="description"><?php _e('Provide the full URL of the grantee organization\'s website. This should include the protocol (like <code>http://</code> or <code>https://</code>).'); ?></p>
			</td>
		</tr>
	</tbody>
</table>