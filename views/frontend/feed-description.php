<div class="hgrant">
	<div class="grantee vcard">
		<h2><?php _e('Grantee'); ?></h2>

		<?php if(wp_hgrant_has_grantee_name()) { ?>
		<div class="fn org">
			<?php if(wp_hgrant_has_grantee_url()) { ?>
			<a class="url" href="<?php echo esc_attr(esc_url(wp_hgrant_get_grantee_url())); ?>"><?php echo esc_html(wp_hgrant_get_grantee_name()); ?></a>
			<?php } else { ?>
			<?php echo esc_html(wp_hgrant_get_grantee_name()); ?>
			<?php } ?>
		</div>
		<?php } ?>

		<div class="adr">
			<h3><?php _e('Address'); ?></h3>

			<?php if(wp_hgrant_has_grantee_street_address()) { ?>
			<div class="street-address"><?php echo esc_html(wp_hgrant_get_grantee_street_address()); ?></div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_extended_address()) { ?>
			<div class="extended-address"><?php echo esc_html(wp_hgrant_get_grantee_extended_address()); ?></div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_po_box()) { ?>
			<div class="post-office-box"><?php echo esc_html(wp_hgrant_get_grantee_po_box()); ?></div>
			<?php } ?>

			<div>
				<?php if(wp_hgrant_has_grantee_locality()) { ?>
				<span class="locality"><?php echo esc_html(wp_hgrant_get_grantee_locality()); ?></span>,
				<?php } ?>

				<?php if(wp_hgrant_has_grantee_region()) { ?>
				<span class="region"><?php echo esc_html(wp_hgrant_get_grantee_region()); ?></span>
				<?php } ?>

				<?php if(wp_hgrant_has_grantee_postal_code()) { ?>
				<span class="postal-code"><?php echo esc_html(wp_hgrant_get_grantee_postal_code()); ?></span>
				<?php } ?>
			</div>

			<?php if(wp_hgrant_has_grantee_country_name()) { ?>
			<div class="country-name"><?php echo esc_html(wp_hgrant_get_grantee_country_name()); ?></div>
			<?php } ?>
		</div>

		<div>
			<h3><?php _e('Contact'); ?></h3>

			<?php if(wp_hgrant_has_grantee_email()) { ?>
			<div>
				<strong><?php _e('Email'); ?></strong>:
				<span class="email"><?php echo esc_html(wp_hgrant_get_grantee_email()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_telephone()) { ?>
			<div>
				<strong><?php _e('Telephone'); ?></strong>:
				<span class="tel"><?php echo esc_html(wp_hgrant_get_grantee_telephone()); ?></span>
			</div>
			<?php } ?>
		</div>

		<div>
			<h3><?php _e('Business Information'); ?></h3>

			<?php if(wp_hgrant_has_grantee_ein()) { ?>
			<div>
				<strong><?php _e('EIN'); ?></strong>:
				<span class="grantee_EIN"><?php echo esc_html(wp_hgrant_get_grantee_ein()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_unit()) { ?>
			<div>
				<strong><?php _e('Subdivision or Department'); ?></strong>:
				<span class="grantee_unit"><?php echo esc_html(wp_hgrant_get_grantee_unit()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_aka()) { ?>
			<div>
				<strong><?php _e('Also Known As'); ?></strong>:
				<span class="grantee_aka"><?php echo esc_html(wp_hgrant_get_grantee_aka()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_dba()) { ?>
			<div>
				<strong><?php _e('Doing Business As'); ?></strong>:
				<span class="grantee_dba"><?php echo esc_html(wp_hgrant_get_grantee_dba()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_fka()) { ?>
			<div>
				<strong><?php _e('Formerly Known As'); ?></strong>:
				<span class="grantee_fka"><?php echo esc_html(wp_hgrant_get_grantee_fka()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_type()) { ?>
			<div>
				<strong><?php _e('Type'); ?></strong>;
				<div>
					<?php foreach(wp_hgrant_get_grantee_types() as $grantee_type) { ?>
					<div class="grantee_type"><?php echo esc_html($grantee_type); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grantee_population_group()) { ?>
			<div>
				<strong><?php _e('Population Groups'); ?></strong>:
				<div>
					<?php foreach(wp_hgrant_get_grantee_population_groups() as $grantee_population_group) { ?>
					<div class="grantee_population_group"><?php echo esc_html($grantee_population_group); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>

	<div>
		<h2><?php _e('Grant'); ?></h2>

		<div>
			<h3><?php _e('Identification'); ?></h3>

			<?php if(wp_hgrant_has_grant_id()) { ?>
			<div>
				<strong><?php _e('Grant ID'); ?></strong>:
				<span class="grant_id"><?php echo esc_html(wp_hgrant_get_grant_id()); ?></span>
			</div>
			<?php } ?>
		</div>

		<div>
			<h3><?php _e('Basic Information'); ?></h3>

			<div class="title"><?php echo esc_html($post->post_title); ?></div>

			<div class="description"><?php echo esc_html($post->post_content); ?></div>

			<div class="amount">
				<strong><?php _e('Amount'); ?></strong>:
				<abbr class="currency" title="<?php echo esc_attr(wp_hgrant_get_grant_amount_currency()); ?>"><?php echo esc_html(wp_hgrant_get_grant_amount_currency_symbol()); ?></abbr>
				<abbr class="amount" title="<?php echo esc_attr(wp_hgrant_get_grant_amount_amount()); ?>"><?php echo esc_html(number_format_i18n(wp_hgrant_get_grant_amount_amount())); ?></abbr>
			</div>

			<div class="period">
				<strong><?php _e('Period'); ?></strong>:
				<abbr class="dtstart" title="<?php echo esc_attr(date('Ymd', strtotime(wp_hgrant_get_grant_dtstart()))); ?>"><?php echo esc_html(wp_hgrant_get_grant_dtstart()); ?></abbr>
				<?php _e('to'); ?>
				<abbr class="dtend" title="<?php echo esc_attr(date('Ymd', strtotime(wp_hgrant_get_grant_dtend()))); ?>"><?php echo esc_html(wp_hgrant_get_grant_dtend()); ?></abbr>
			</div>

			<div class="fiscal-year">
				<strong><?php _e('Fiscal Year End'); ?></strong>:
				<span class="fiscal_year_end"><?php echo esc_html(wp_hgrant_get_grant_fiscal_year_end()); ?></span>
			</div>

			<div>
				<strong><?php _e('Duration'); ?></strong>:

				<?php if('months' === wp_hgrant_get_grant_duration_period()) { ?>

				<span class="duration_month"><?php echo esc_html(wp_hgrant_get_grant_duration_amount()); ?></span>
				<?php echo _n('Month', 'Months', wp_hgrant_get_grant_duration_amount()); ?>

				<?php } else if('years' === wp_hgrant_get_grant_duration_period()) { ?>

				<span class="duration_year"><?php echo esc_html(wp_hgrant_get_grant_duration_amount()); ?></span>
				<?php echo _n('Year', 'Years', wp_hgrant_get_grant_duration_amount()); ?>

				<?php } ?>
			</div>
		</div>

		<div>
			<h3><?php _e('Extended Information'); ?></h3>

			<?php if(wp_hgrant_has_grant_activity()) { ?>
			<div>
				<strong><?php _e('Activities'); ?></strong>:
				<?php foreach(wp_hgrant_get_grant_activities() as $activity) { ?>
				<div class="grant_activity"><?php echo esc_html($activity); ?></div>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_population_group()) { ?>
			<div>
				<strong><?php _e('Population Groups'); ?></strong>:
				<?php foreach(wp_hgrant_get_grant_population_groups() as $grant_population_group) { ?>
				<div class="grant_population_group"><?php echo esc_html($grant_population_group); ?></div>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_program_areas()) { ?>
			<div>
				<strong><?php _e('Program Areas'); ?></strong>:
				<?php foreach(wp_hgrant_get_grant_program_areas() as $program_area) { ?>
				<div class="grant_program_area"><?php echo esc_html($program_area); ?></div>
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_support_types()) { ?>
			<div>
				<strong><?php _e('Support Types'); ?></strong>:
				<span class="grant_support_type">
					<?php echo implode('; ', array_map('esc_html', wp_hgrant_get_grant_support_types())); ?>
				</span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_strategies()) { ?>
			<div>
				<strong><?php _e('Strategy'); ?></strong>:
				<span class="strategy">
					<?php echo implode('; ', array_map('esc_html', wp_hgrant_get_grant_strategies())); ?>
				</span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_initiatives()) { ?>
			<div>
				<strong><?php _e('Initiative'); ?></strong>:
				<span class="initiative">
					<?php echo implode('; ', array_map('esc_html', wp_hgrant_get_grant_initiatives())); ?>
				</span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_themes()) { ?>
			<div>
				<strong><?php _e('Theme'); ?></strong>:
				<span class="theme">
					<?php echo implode('; ', array_map('esc_html', wp_hgrant_get_grant_themes())); ?>
				</span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_outcome()) { ?>
			<div>
				<strong><?php _e('Grant Outcome'); ?></strong>:
				<p class="grant_outcome"><?php echo esc_html(wp_hgrant_get_grant_outcome()); ?></p>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_outputs()) { ?>
			<div>
				<strong><?php _e('Grant Outputs'); ?></strong>:
				<p class="grant_outputs"><?php echo esc_html(wp_hgrant_get_grant_outputs()); ?></p>
			</div>
			<?php } ?>

			<div>
				<strong><?php _e('Challenge Grant'); ?></strong>:
				<span class="challenge_grant"><?php echo esc_html(wp_hgrant_get_grant_challenge_grant()); ?></span>
			</div>

			<div>
				<strong><?php _e('Matching Grant'); ?></strong>:
				<span class="matching_grant"><?php echo esc_html(wp_hgrant_get_grant_matching_grant()); ?></span>
			</div>

			<div>
				<strong><?php _e('Continuing Support Grant'); ?></strong>:
				<span class="continuing_support_grant"><?php echo esc_html(wp_hgrant_get_grant_continuing_support_grant()); ?></span>
			</div>

			<?php if(wp_hgrant_has_grant_fiscal_agent()) { ?>
			<div>
				<strong><?php _e('Fiscal Agent'); ?></strong>:
				<span class="fiscal_agent"><?php echo esc_html(wp_hgrant_get_grant_fiscal_agent()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_shared_grant()) { ?>
			<div>
				<strong><?php _e('Grant Shared With'); ?></strong>:
				<span class="shared_grant"><?php echo implode('/', array_map('esc_html', wp_hgrant_get_grant_shared_grants())); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_fund_name()) { ?>
			<div>
				<strong><?php _e('Fund Name'); ?></strong>:
				<span class="fund_name"><?php echo esc_html(wp_hgrant_get_grant_fund_name()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_fund_type()) { ?>
			<div>
				<strong><?php _e('Fund Type'); ?></strong>:
				<span class="fund_type"><?php echo esc_html(wp_hgrant_get_grant_fund_type()); ?></span>
			</div>
			<?php } ?>

			<?php if(wp_hgrant_has_grant_fund_subtype()) { ?>
			<div>
				<strong><?php _e('Fund Subtype'); ?></strong>:
				<span class="fund_subtype"><?php echo esc_html(wp_hgrant_get_grant_fund_subtype()); ?></span>
			</div>
			<?php } ?>

			<div>
				<strong><?php _e('Include in registry provided to the IATI'); ?></strong>:
				<span class="IATI_flag"><?php echo esc_html(wp_hgrant_get_grant_iati_flag()); ?></span>
			</div>
		</div>

		<div>
			<h3><?php _e('Geographic Focus'); ?></h3>
			<?php foreach(wp_hgrant_get_grant_geo_areas() as $geo_area) { ?>
			<div class="geo-focus">

				<?php
				$geo_area_components = array();
				foreach($geo_area['components'] as $component) {
					$geo_area_components[] = sprintf('<span class="%1$s">%2$s</span>', esc_attr($component), esc_html($geo_area[$component]));
				}
				echo implode('/', $geo_area_components);
				?>

				<div class="allocation">
					<abbr class="allocation_currency" title="<?php echo esc_attr($geo_area['allocation_amount_currency']); ?>"><?php echo esc_attr($geo_area['allocation_amount_currency_symbol']); ?></abbr>
					<abbr class="allocation_amount" title="<?php echo esc_attr($geo_area['allocation_amount_amount_raw']); ?>"><?php echo esc_html($geo_area['allocation_amount_amount']); ?></abbr>
					(<span class="allocation_percent"><?php echo esc_html($geo_area['allocation_percent']); ?></span>%)
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>