<xhtml:div class="grantor vcard">
	<xhtml:div class="fn org">
		<?php if(wp_hgrant_has_grantor_url()) { ?>
		<xhtml:a class="url" href="<?php echo esc_attr(esc_url(wp_hgrant_get_grantor_url())); ?>"><?php echo esc_html(wp_hgrant_get_grantor_name()); ?></xhtml:a>
		<?php } else { ?>
		<?php echo esc_html(wp_hgrant_get_grantor_name()); ?>
		<?php } ?>
	</xhtml:div>

	<xhtml:div class="adr">
		<xhtml:h3><?php _e('Address'); ?></xhtml:h3>

		<?php if(wp_hgrant_has_grantor_street_address()) { ?>
		<xhtml:div class="street-address"><?php echo esc_html(wp_hgrant_get_grantor_street_address()); ?></xhtml:div>
		<?php } ?>

		<?php if(wp_hgrant_has_grantor_extended_address()) { ?>
		<xhtml:div class="extended-address"><?php echo esc_html(wp_hgrant_get_grantor_extended_address()); ?></xhtml:div>
		<?php } ?>

		<?php if(wp_hgrant_has_grantor_po_box()) { ?>
		<xhtml:div class="post-office-box"><?php echo esc_html(wp_hgrant_get_grantor_po_box()); ?></xhtml:div>
		<?php } ?>

		<xhtml:div>
			<?php if(wp_hgrant_has_grantor_locality()) { ?>
			<xhtml:span class="locality"><?php echo esc_html(wp_hgrant_get_grantor_locality()); ?></xhtml:span>,
			<?php } ?>

			<?php if(wp_hgrant_has_grantor_region()) { ?>
			<xhtml:span class="region"><?php echo esc_html(wp_hgrant_get_grantor_region()); ?></xhtml:span>
			<?php } ?>

			<?php if(wp_hgrant_has_grantor_postal_code()) { ?>
			<xhtml:span class="postal-code"><?php echo esc_html(wp_hgrant_get_grantor_postal_code()); ?></xhtml:span>
			<?php } ?>
		</xhtml:div>

		<?php if(wp_hgrant_has_grantor_country_name()) { ?>
		<xhtml:div class="country-name"><?php echo esc_html(wp_hgrant_get_grantor_country_name()); ?></xhtml:div>
		<?php } ?>
	</xhtml:div>

	<xhtml:div>
		<xhtml:h3><?php _e('Contact'); ?></xhtml:h3>

		<?php if(wp_hgrant_has_grantor_email()) { ?>
		<xhtml:div>
			<xhtml:strong><?php _e('Email'); ?></xhtml:strong>:
			<xhtml:span class="email"><?php echo esc_html(wp_hgrant_get_grantor_email()); ?></xhtml:span>
		</xhtml:div>
		<?php } ?>

		<?php if(wp_hgrant_has_grantor_telephone()) { ?>
		<xhtml:div>
			<xhtml:strong><?php _e('Telephone'); ?></xhtml:strong>:
			<xhtml:span class="tel"><?php echo esc_html(wp_hgrant_get_grantor_telephone()); ?></xhtml:span>
		</xhtml:div>
		<?php } ?>
	</xhtml:div>

	<xhtml:div>
		<xhtml:h3><?php _e('Business Information'); ?></xhtml:h3>

		<?php if(wp_hgrant_has_grantor_ein()) { ?>
		<xhtml:div>
			<xhtml:strong><?php _e('EIN'); ?></xhtml:strong>:
			<xhtml:span class="grantor_EIN"><?php echo esc_html(wp_hgrant_get_grantor_ein()); ?></xhtml:span>
		</xhtml:div>
		<?php } ?>
	</xhtml:div>
</xhtml:div>