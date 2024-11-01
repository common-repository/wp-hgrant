<h4 class="wp-hgrant-section-title"><?php _e('Grant &mdash; Dates'); ?></h4>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_dtstart'); ?>"><?php _e('Start Date'); ?></label></th>
			<td>
				<input type="text" class="regular-text code wp-hgrant-datepicker" id="<?php self::_meta_id('grant_dtstart'); ?>" name="<?php self::_meta_name('grant_dtstart'); ?>" value="<?php echo esc_attr($grant_details['grant_dtstart']); ?>" data-duration-amount="<?php self::_meta_id('grant_duration_amount'); ?>" data-duration-period="<?php self::_meta_id('grant_duration_period'); ?>" />
			</td>
		</tr>

		<tr>
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_dtend'); ?>"><?php _e('End Date'); ?></label></th>
			<td>
				<input type="text" class="regular-text code wp-hgrant-datepicker" id="<?php self::_meta_id('grant_dtend'); ?>" name="<?php self::_meta_name('grant_dtend'); ?>" value="<?php echo esc_attr($grant_details['grant_dtend']); ?>" />
			</td>
		</tr>

		<tr>
			<th scope="row"><label class="wp-hgrant-required" for="<?php self::_meta_id('grant_fiscal_year_end'); ?>"><?php _e('Fiscal Year End'); ?></label></th>
			<td>
				<input type="text" class="regular-text code wp-hgrant-datepicker" id="<?php self::_meta_id('grant_fiscal_year_end'); ?>" name="<?php self::_meta_name('grant_fiscal_year_end'); ?>" value="<?php echo esc_attr($grant_details['grant_fiscal_year_end']); ?>" />
			</td>
		</tr>
	</tbody>
</table>