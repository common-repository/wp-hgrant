<div class="wrap">
	<form action="<?php echo esc_attr($bulk_entry_link); ?>" method="post">
		<?php // screen_icon(); ?>
		<h2><?php _e('Bulk Add Grants'); ?></h2>

		<?php settings_errors(); ?>

		<p>
			<?php _e('Please provide values for all fields.'); ?>
		</p>

		<div class="wp-hgrant-grants"></div>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<td>
						<a class="wp-hgrant-grant-add" href="#"><?php _e('Add Grant'); ?></a>
					</td>
				</tr>
			</tbody>
		</table>

		<p>
			<input type="submit" class="button button-primary" value="<?php _e('Save Grants'); ?>" />
			&nbsp;<small><?php _e('Grants added through the bulk-add interface will be saved as Drafts.'); ?></small>
			<?php wp_nonce_field('wp-hgrant-bulk-add-grants', 'wp-hgrant-bulk-add-grants-nonce'); ?>
		</p>
	</form>

	<div class="wp-hgrant-grant-template">
		<div class="wp-hgrant-grant">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><?php _e('Title'); ?></th>
						<td>
							<input type="text" class="regular-text wp-hgrant-changes-grantee-name" name="wp-hgrant-bulk[grants][XXX][grant_title]" value="" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Description'); ?></th>
						<td>
							<input type="text" class="large-text" name="wp-hgrant-bulk[grants][XXX][grant_description]" value="" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('ID'); ?></th>
						<td>
							<input type="text" class="regular-text code" name="wp-hgrant-bulk[grants][XXX][grant_id]" value="" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Amount'); ?></th>
						<td>
							<select name="wp-hgrant-bulk[grants][XXX][grant_amount_currency]">
								<?php foreach($currencies as $currency_code => $currency_symbol) { ?>
								<option <?php selected($currency_code, $grant_details['grant_amount_currency']); ?> value="<?php echo esc_attr($currency_code); ?>"><?php echo $currency_symbol; ?></option>
								<?php } ?>
							</select>
							<input type="text" class="regular-text code" name="wp-hgrant-bulk[grants][XXX][grant_amount_amount]" value="0.00" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Program Area'); ?></th>
						<td>
							<?php wp_dropdown_categories(array(
								'show_option_all' => __('None'),
								'show_option_none' => false,
								'orderby' => 'name',
								'order' => 'ASC',
								'show_count' => false,
								'hide_empty' => false,
								'child_of' => 0,
								'exclude' => '',
								'echo' => 1,
								'selected' => '',
								'hierarchical' => true,
								'name' => 'wp-hgrant-bulk[grants][XXX][grant_program_areas][]',
								'id' => 'wp-hgrant-bulk-grants-XXX-grant_program_areas',
								'class' => '',
								'depth' => 0,
								'tab_index' => 0,
								'taxonomy' => self::TAXONOMY_PROGRAM_AREA,
								'hide_if_empty' => false

							)); ?>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Start Date'); ?></th>
						<td>
							<input type="text" class="regular-text code wp-hgrant-datepicker" name="wp-hgrant-bulk[grants][XXX][grant_dtstart]" value="<?php echo esc_attr($grant_details['grant_dtstart']); ?>" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('End Date'); ?></th>
						<td>
							<input type="text" class="regular-text code wp-hgrant-datepicker" name="wp-hgrant-bulk[grants][XXX][grant_dtend]" value="<?php echo esc_attr($grant_details['grant_dtend']); ?>" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Grantee Name'); ?></th>
						<td>
							<input type="text" class="regular-text wp-hgrant-grantee-name" name="wp-hgrant-bulk[grants][XXX][grantee_name]" value="" />
						</td>
					</tr>

					<tr valign="top">
						<th colspan="2"><a class="wp-hgrant-grant-remove" href="#"><?php _e('Remove Grant'); ?></a></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>