<h4 class="wp-hgrant-section-title"><?php _e('Grantee &mdash; Other'); ?></h4>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_unit'); ?>"><?php _e('Department / Subdivision'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_unit'); ?>" name="<?php self::_meta_name('grantee_unit'); ?>" value="<?php echo esc_attr($grant_details['grantee_unit']); ?>" />
				<p class="description"><?php _e('Provide the specific department or subdivision of the grantee organization to which the grant was awarded.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_ein'); ?>"><?php _e('EIN'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grantee_ein'); ?>" name="<?php self::_meta_name('grantee_ein'); ?>" value="<?php echo esc_attr($grant_details['grantee_ein']); ?>" />
				<p class="description"><?php _e('Provide the EIN of the grantee organization as registered with the IRS or international equivalent.'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_aka'); ?>"><?php _e('Also Known As'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_aka'); ?>" name="<?php self::_meta_name('grantee_aka'); ?>" value="<?php echo esc_attr($grant_details['grantee_aka']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_dba'); ?>"><?php _e('Doing Business As'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_dba'); ?>" name="<?php self::_meta_name('grantee_dba'); ?>" value="<?php echo esc_attr($grant_details['grantee_dba']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_fka'); ?>"><?php _e('Formerly Known As'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text" id="<?php self::_meta_id('grantee_fka'); ?>" name="<?php self::_meta_name('grantee_fka'); ?>" value="<?php echo esc_attr($grant_details['grantee_fka']); ?>" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_type'); ?>"><?php _e('Grantee Type'); ?></label>
			</th>
			<td>
				<input type="text" class="regular-text code" id="<?php self::_meta_id('grantee_type'); ?>" name="<?php self::_meta_name('grantee_type'); ?>" value="<?php echo esc_attr($grant_details['grantee_type']); ?>" />
				<p class="description"><?php printf(__('Provide a code (like <code>A20</code>, <code>B30</code>, or <code>C40</code>) from the list of available <a href="%1$s" target="_blank">NTEE codes</a>. If you need to enter multiple codes, please separate them with a comma (<code>,</code>).'), 'http://foundationcenter.org/ntee'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="<?php self::_meta_id('grantee_population_group'); ?>"><?php _e('Grantee Population Group(s)'); ?></label>
			</th>
			<td>
				<textarea class="large-text" rows="5" id="<?php self::_meta_id('grantee_population_group'); ?>" name="<?php self::_meta_name('grantee_population_group'); ?>"><?php echo esc_textarea($grant_details['grantee_population_group']); ?></textarea>
				<p class="description">
					<?php _e('Provide the primary population groups served by the grantee organization as part of their ongoing mission.'); ?>
					<?php _e('Enter each population group (such as <code>girls,ages 10-18</code> or <code>mothers,ages 18-25</code>) on a separate line.'); ?><br />
					<?php _e('<strong>Note</strong>: This does not represent the specific population served by this grant.'); ?>
				</p>
			</td>
		</tr>
	</tbody>
</table>