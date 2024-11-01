<h4 class="wp-hgrant-section-title"><?php _e('Grant &mdash; Geo Areas'); ?></h4>

<?php
$components = array(
	'continent' => __('Continent'),
	'inter_country_region' => __('Inter-Country Region'),
	'country' => __('Country'),
	'intra_country_region' => __('Intra-Country Region'),
	'intra_state_region' => __('Intra-State Region'),
	'state' => __('State'),
	'county' => __('County'),
	'city' => __('City'),
	'neighborhood' => __('Neighborhood'),
);
?>

<div class="wp-hgrant-geo-area-template">
	<?php
	$geo_area_key = 'XXX';
	$geo_area = array(
		'components' => array('country', 'state'),
		'allocation_amount_amount' => '0.00',
		'allocation_amount_currency' => $settings['default_amount_currency'],
		'allocation_percent' => '100',
	);
	foreach($components as $component_key => $component_name) {
		$geo_area[$component_key] = '';
	}
	$geo_area['country'] = 'US';
	$geo_area['continent'] = 'North America';
	$geo_area['state_other'] = '';
	include('geo-area.php');
	?>
</div>

<div class="wp-hgrant-geo-areas">
	<?php
	foreach($grant_details['grant_geo_areas'] as $geo_area_key => $geo_area) {
		include('geo-area.php');
	}
	?>
</div>

<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<a class="wp-hgrant-geo-area-add" href="#"><?php _e('Add Geo Area'); ?></a>
			</th>
		</tr>
	</tbody>
</table>