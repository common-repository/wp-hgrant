<h4 class="wp-hgrant-section-title"><?php _e('Grant &mdash; Other'); ?></h4>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_outcome'); ?>"><?php _e('Outcome'); ?></label>
			</th>
			<td>
				<textarea class="large-text" rows="5" id="<?php self::_meta_id('grant_outcome'); ?>" name="<?php self::_meta_name('grant_outcome'); ?>"><?php echo esc_textarea($grant_details['grant_outcome']); ?></textarea>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_outputs'); ?>"><?php _e('Outputs'); ?></label>
			</th>
			<td>
				<textarea class="large-text" rows="5" id="<?php self::_meta_id('grant_outputs'); ?>" name="<?php self::_meta_name('grant_outputs'); ?>"><?php echo esc_textarea($grant_details['grant_outputs']); ?></textarea>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_challenge_grant_yes'); ?>"><?php _e('Challenge Grant'); ?></label>
			</th>
			<td>
				<input type="hidden" id="<?php self::_meta_id('grant_challenge_grant_no'); ?>" name="<?php self::_meta_name('grant_challenge_grant'); ?>" value="N" />
				<label>
					<input type="checkbox" <?php checked($grant_details['grant_challenge_grant'], 'Y'); ?> id="<?php self::_meta_id('grant_challenge_grant_yes'); ?>" name="<?php self::_meta_name('grant_challenge_grant'); ?>" value="Y" />
					<?php _e('This is a challenge grant'); ?>
				</label>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_matching_grant_yes'); ?>"><?php _e('Matching Grant'); ?></label>
			</th>
			<td>
				<input type="hidden" id="<?php self::_meta_id('grant_matching_grant_no'); ?>" name="<?php self::_meta_name('grant_matching_grant'); ?>" value="N" />
				<label>
					<input type="checkbox" <?php checked($grant_details['grant_matching_grant'], 'Y'); ?> id="<?php self::_meta_id('grant_matching_grant_yes'); ?>" name="<?php self::_meta_name('grant_matching_grant'); ?>" value="Y" />
					<?php _e('This is a matching grant'); ?>
				</label>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_continuing_support_grant_yes'); ?>"><?php _e('Continuing Support Grant'); ?></label>
			</th>
			<td>
				<input type="hidden" id="<?php self::_meta_id('grant_continuing_support_grant_no'); ?>" name="<?php self::_meta_name('grant_continuing_support_grant'); ?>" value="N" />
				<label>
					<input type="checkbox" <?php checked($grant_details['grant_continuing_support_grant'], 'Y'); ?> id="<?php self::_meta_id('grant_continuing_support_grant_yes'); ?>" name="<?php self::_meta_name('grant_continuing_support_grant'); ?>" value="Y" />
					<?php _e('This grant is for continuing support or is a grant renewal'); ?>
				</label>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_fiscal_agent'); ?>"><?php _e('Fiscal Agent'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grant_fiscal_agent'); ?>" name="<?php self::_meta_name('grant_fiscal_agent'); ?>" value="<?php echo esc_attr($grant_details['grant_fiscal_agent']); ?>" />
				<p class="description"><?php _e('If this grant was made through a fiscal agent or sponsor, enter that organization\'s name in this field. Otherwise, leave this field blank.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_shared_grant'); ?>"><?php _e('Shared Grant'); ?></label>
			</th>
			<td>
				<textarea class="large-text" rows="5" id="<?php self::_meta_id('grant_shared_grant'); ?>" name="<?php self::_meta_name('grant_shared_grant'); ?>"><?php echo esc_textarea($grant_details['grant_shared_grant']); ?></textarea>
				<p class="description"><?php _e('If this grant was made with one or more other grantor(s), enter the name(s) of those grantor organization(s). Please enter one organization name per line.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_fund_name'); ?>"><?php _e('Fund Name'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grant_fund_name'); ?>" name="<?php self::_meta_name('grant_fund_name'); ?>" value="<?php echo esc_attr($grant_details['grant_fund_name']); ?>" />
				<p class="description"><?php _e('If this grant was made from a specific fund, supply that fund\'s name in this field.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_fund_type'); ?>"><?php _e('Fund Type'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grant_fund_type'); ?>" name="<?php self::_meta_name('grant_fund_type'); ?>" value="<?php echo esc_attr($grant_details['grant_fund_type']); ?>" />
				<p class="description"><?php _e('This field allows public charities and community foundations to indicate the type of fund from which this grant was awarded. Examples include <code>Donor Advised Fund</code>, <code>Giving Circle</code>, and <code>Supporting Organization</code>.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grant_fund_subtype'); ?>"><?php _e('Fund Subtype'); ?></label>
			</th>
			<td>
				<select id="<?php self::_meta_id('grant_fund_subtype'); ?>" name="<?php self::_meta_name('grant_fund_subtype'); ?>">
					<option <?php selected($grant_details['grant_fund_subtype'], ''); ?> value=""><?php _e('N/A'); ?></option>
					<option <?php selected($grant_details['grant_fund_subtype'], 'Unrestricted Funds'); ?> value="Unrestricted Funds"><?php _e('Unrestricted Funds'); ?></option>
					<option <?php selected($grant_details['grant_fund_subtype'], 'Temporarily Restricted Funds'); ?> value="Temporarily Restricted Funds"><?php _e('Temporarily Restricted Funds'); ?></option>
					<option <?php selected($grant_details['grant_fund_subtype'], 'Permanently Restricted Funds'); ?> value="Permanently Restricted Funds"><?php _e('Permanently Restricted Funds'); ?></option>
				</select>
				<p class="description"><?php _e('This field allows public charities and community foundations to indicate if this grant was made from unrestricted, temporarily restricted, or permanently restricted funds.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('iati_flag_yes'); ?>"><?php _e('IATI Inclusion'); ?></label>
			</th>
			<td>
				<input type="hidden" id="<?php self::_meta_id('iati_flag_no'); ?>" name="<?php self::_meta_name('iati_flag'); ?>" value="n" />
				<label>
					<input type="checkbox" <?php checked(strtolower($grant_details['iati_flag']), 'y'); ?> id="<?php self::_meta_id('iati_flag_yes'); ?>" name="<?php self::_meta_name('iati_flag'); ?>" value="y" />
					<?php _e('Include this grant in the registry the Foundation Center provides to the International Aid Transparency Initiative.'); ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>