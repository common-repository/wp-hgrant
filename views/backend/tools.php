<div class="wrap wrap-tools">
	<form action="<?php echo esc_attr(esc_url($tools_link)); ?>" method="post">
		<?php //screen_icon(); ?>

		<h2><?php _e('Grant Tools'); ?></h2>

		<h3><?php _e('Feed Activation'); ?></h3>

		<?php settings_errors(); ?>

		<p><strong><?php _e('Please activate your feed after you have configured Open hGrant, published at least one grant, and are ready to share your grant information with Foundation Center.'); ?></strong></p>

		<p><?php printf(__('Activating your feed transmits your <a href="%s" target="_blank">feed address</a> and your site\'s <a href="mailto:%s">administrative email address</a> to the Open hGrant team and to the Foundation Center. In response, you will receive:'), esc_attr(esc_url($feed_url)), esc_attr($admin_email)); ?></p>

		<ul class="tools-benefits">
			<li><?php _e('a list of Open hGrant resources,'); ?></li>
			<li><?php printf(__('information on connecting to the <a href="%s" target="_blank">peer network</a> of Open hGrant users through <a href="%s" target="_blank">WordPress</a> and <a href="%s" target="_blank">LinkedIn</a>, and'), 'http://openhgrant.wpengine.com/contact/', 'http://wordpress.org/support/plugin/wp-hgrant', 'https://www.linkedin.com/groups?home=&gid=6642977'); ?></li>
			<li><?php printf(__('instructions on how to include your Open hGrant data in the <a href="%s" target="_blank">Foundation Center\'s open data initiatives</a>'), 'http://www.foundationcenter.org/grantmakers/e-grants.html'); ?></li>
		</ul>

		<p>
			<?php
			if(!empty($activated_timestamp)) {
				printf(__('<h3>Feed is active as of %s. Thanks!</h3>'), date(get_option('date_format') . ' \a\t ' . get_option('time_format'), $activated_timestamp));
			}
			?>
			<input type="hidden" name="wp-hgrant-activate-feed" value="no" />
			<label>
				<input type="checkbox" <?php checked(true, !empty($activated_timestamp)); ?> name="wp-hgrant-activate-feed" value="yes" />
				<?php _e('Activate feed'); ?>
			</label>
		</p>

		<p>
			<?php wp_nonce_field('wp-hgrant-activate-feed', 'wp-hgrant-activate-feed-nonce'); ?>
			<input type="submit" class="button button-primary" value="<?php _e('Save Settings'); ?>" />
		</p>
	</form>
</div>