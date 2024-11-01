<!-- Start hGrant data display -->
<table border="0" class="hgrant_info">
<?php
if (wp_hgrant_has_grant_program_areas()) {
	echo	'<style>
			.hgrant_info #termlist, .hgrant_info ul.children {	padding: 0; list-style: none; display: inline; }
			.hgrant_info ul.children li { display: inline; margin: 0; padding: 0; }
			.hgrant_info li.cat-item { font-weight: bold; }
			.hgrant_info .children li.cat-item { font-weight: normal !important; }
			.hgrant_info .children:before { content:"\00bb";  }
			.hgrant_info .children li + li:before { content: ", "; }
		</style>';

	$taxonomy = 'hgrant_program_area';
	$post_terms = wp_get_object_terms( get_the_ID(), $taxonomy, array( 'fields' => 'ids' ) );
	$separator = ', ';
	if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
		$term_ids = implode( ',' , $post_terms );
		$terms = wp_list_categories( 'title_li=&style=list&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		echo '<tr valign="top"><td><strong>Program&nbsp;Area(s)</strong></td><td><ul id="termlist">'.$terms.'</ul></td></tr>';
	}
};

if (wp_hgrant_has_grantee_name()) {
	echo '<tr><td><strong>Grantee&nbsp;Name</strong></td><td>'.wp_hgrant_get_grantee_name().'</td></tr>';
};

if (wp_hgrant_has_grantee_street_address()) {
	echo '<tr><td valign="top"><strong>Address</strong></td><td>'.wp_hgrant_get_grantee_street_address();
	if (wp_hgrant_has_grantee_extended_address()) {	echo '<br />'.wp_hgrant_get_grantee_extended_address(); }
	if (wp_hgrant_has_grantee_po_box()) {			echo '<br />PO Box '.wp_hgrant_get_grantee_po_box(); }
	if (wp_hgrant_has_grantee_locality()) {			echo '<br />'.wp_hgrant_get_grantee_locality(); }
	if (wp_hgrant_has_grantee_region()) {			echo ' '.wp_hgrant_get_grantee_region(); } // ? not finding value
	if (wp_hgrant_has_grantee_postal_code()) {		echo ', '.wp_hgrant_get_grantee_postal_code(); }
	if (wp_hgrant_has_grantee_country_name()) {		echo '<br />'.wp_hgrant_get_grantee_country_name(); }
	echo '</td></tr>';
};

if (wp_hgrant_has_grantee_url()) {
	echo '<tr><td><strong>Website</strong></td><td><a href="'.wp_hgrant_get_grantee_url().'" target="_blank">'.wp_hgrant_get_grantee_url().'</a></td></tr>';
};

if (wp_hgrant_has_grant_fiscal_agent()) {
	echo '<tr><td><strong>Fiscal&nbsp;Agent</strong></td><td>'.wp_hgrant_get_grant_fiscal_agent().'</td></tr>';
};

if (!empty($_content)) {
	echo '<tr><td valign="top"><strong>Description</strong></td><td>'.$_content.'</td></tr>';
};

if (wp_hgrant_has_grant_amount_amount()) {
	echo '<tr><td><strong>Grant&nbsp;Amount</strong></td><td>'.wp_hgrant_get_grant_amount_currency_symbol().wp_hgrant_get_grant_amount_amount().'</td></tr>';
};

if (wp_hgrant_has_grant_dtstart()) {
	echo '<tr><td><strong>Project&nbsp;Dates</strong></td><td>'.wp_hgrant_get_grant_dtstart().' - '.wp_hgrant_get_grant_dtend().'</td></tr>';
};

if(wp_hgrant_has_grant_geo_areas()) { ?>
	<tr>
		<td><strong>Serving</strong></td>
		<td>
			<?php
			$serving = array();
			foreach(wp_hgrant_get_grant_geo_areas() as $geo_area) {
				$serving[] = implode('/', $geo_area['name_parts']);
			}
			echo implode('<br />', $serving);
			?>
		</td>
	</tr>
<?php } ?>
</table>
<!-- End hGrant data display -->