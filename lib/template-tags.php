<?php

function wp_hgrant_has_search_form() {
	return apply_filters('wp_hgrant_has_search_form', !!(wp_hgrant_get_search_form()));
}
function wp_hgrant_get_search_form() {
	return apply_filters('wp_hgrant_get_search_form', WP_hGrant::get_search_form());
}
function wp_hgrant_the_search_form() {
	echo apply_filters('wp_hgrant_the_search_form', wp_hgrant_get_search_form());
}

// Grantor information

/// Grantor - Basics
function wp_hgrant_has_grantor_name() {
	return apply_filters('wp_hgrant_has_grantor_name', !!(wp_hgrant_get_grantor_name()));
}
function wp_hgrant_get_grantor_name() {
	return apply_filters('wp_hgrant_get_grantor_name', WP_hGrant::get_grantor_name());
}
function wp_hgrant_the_grantor_name() {
	echo apply_filters('wp_hgrant_the_grantor_name', wp_hgrant_get_grantor_name());
}

function wp_hgrant_has_grantor_street_address() {
	return apply_filters('wp_hgrant_has_grantor_street_address', !!(wp_hgrant_get_grantor_street_address()));
}
function wp_hgrant_get_grantor_street_address() {
	return apply_filters('wp_hgrant_get_grantor_street_address', WP_hGrant::get_grantor_street_address());
}
function wp_hgrant_the_grantor_street_address() {
	echo apply_filters('wp_hgrant_the_grantor_street_address', wp_hgrant_get_grantor_street_address());
}

function wp_hgrant_has_grantor_extended_address() {
	return apply_filters('wp_hgrant_has_grantor_extended_address', !!(wp_hgrant_get_grantor_extended_address()));
}
function wp_hgrant_get_grantor_extended_address() {
	return apply_filters('wp_hgrant_get_grantor_extended_address', WP_hGrant::get_grantor_extended_address());
}
function wp_hgrant_the_grantor_extended_address() {
	echo apply_filters('wp_hgrant_the_grantor_extended_address', wp_hgrant_get_grantor_extended_address());
}

function wp_hgrant_has_grantor_po_box() {
	return apply_filters('wp_hgrant_has_grantor_po_box', !!(wp_hgrant_get_grantor_po_box()));
}
function wp_hgrant_get_grantor_po_box() {
	return apply_filters('wp_hgrant_get_grantor_po_box', WP_hGrant::get_grantor_po_box());
}
function wp_hgrant_the_grantor_po_box() {
	echo apply_filters('wp_hgrant_the_grantor_po_box', wp_hgrant_get_grantor_po_box());
}

function wp_hgrant_has_grantor_locality() {
	return apply_filters('wp_hgrant_has_grantor_locality', !!(wp_hgrant_get_grantor_locality()));
}
function wp_hgrant_get_grantor_locality() {
	return apply_filters('wp_hgrant_get_grantor_locality', WP_hGrant::get_grantor_locality());
}
function wp_hgrant_the_grantor_locality() {
	echo apply_filters('wp_hgrant_the_grantor_locality', wp_hgrant_get_grantor_locality());
}

function wp_hgrant_has_grantor_region() {
	return apply_filters('wp_hgrant_has_grantor_region', !!(wp_hgrant_get_grantor_region()));
}
function wp_hgrant_get_grantor_region() {
	return apply_filters('wp_hgrant_get_grantor_region', WP_hGrant::get_grantor_region());
}
function wp_hgrant_the_grantor_region() {
	echo apply_filters('wp_hgrant_the_grantor_region', wp_hgrant_get_grantor_region());
}

function wp_hgrant_has_grantor_postal_code() {
	return apply_filters('wp_hgrant_has_grantor_postal_code', !!(wp_hgrant_get_grantor_postal_code()));
}
function wp_hgrant_get_grantor_postal_code() {
	return apply_filters('wp_hgrant_get_grantor_postal_code', WP_hGrant::get_grantor_postal_code());
}
function wp_hgrant_the_grantor_postal_code() {
	echo apply_filters('wp_hgrant_the_grantor_postal_code', wp_hgrant_get_grantor_postal_code());
}

function wp_hgrant_has_grantor_country_name() {
	return apply_filters('wp_hgrant_has_grantor_country_name', !!(wp_hgrant_get_grantor_country_name()));
}
function wp_hgrant_get_grantor_country_name() {
	return apply_filters('wp_hgrant_get_grantor_country_name', WP_hGrant::get_grantor_country_name());
}
function wp_hgrant_the_grantor_country_name() {
	echo apply_filters('wp_hgrant_the_grantor_country_name', wp_hgrant_get_grantor_country_name());
}

/// Grantor - Contact
function wp_hgrant_has_grantor_telephone() {
	return apply_filters('wp_hgrant_has_grantor_telephone', !!(wp_hgrant_get_grantor_telephone()));
}
function wp_hgrant_get_grantor_telephone() {
	return apply_filters('wp_hgrant_get_grantor_telephone', WP_hGrant::get_grantor_telephone());
}
function wp_hgrant_the_grantor_telephone() {
	echo apply_filters('wp_hgrant_the_grantor_telephone', wp_hgrant_get_grantor_telephone());
}

function wp_hgrant_has_grantor_email() {
	return apply_filters('wp_hgrant_has_grantor_email', !!(wp_hgrant_get_grantor_email()));
}
function wp_hgrant_get_grantor_email() {
	return apply_filters('wp_hgrant_get_grantor_email', WP_hGrant::get_grantor_email());
}
function wp_hgrant_the_grantor_email() {
	echo apply_filters('wp_hgrant_the_grantor_email', wp_hgrant_get_grantor_email());
}

function wp_hgrant_has_grantor_url() {
	return apply_filters('wp_hgrant_has_grantor_url', !!(wp_hgrant_get_grantor_url()));
}
function wp_hgrant_get_grantor_url() {
	return apply_filters('wp_hgrant_get_grantor_url', WP_hGrant::get_grantor_url());
}
function wp_hgrant_the_grantor_url() {
	echo apply_filters('wp_hgrant_the_grantor_url', wp_hgrant_get_grantor_url());
}

/// Grantor - Other
function wp_hgrant_has_grantor_ein() {
	return apply_filters('wp_hgrant_has_grantor_ein', !!(wp_hgrant_get_grantor_ein()));
}
function wp_hgrant_get_grantor_ein() {
	return apply_filters('wp_hgrant_get_grantor_ein', WP_hGrant::get_grantor_ein());
}
function wp_hgrant_the_grantor_ein() {
	echo apply_filters('wp_hgrant_the_grantor_ein', wp_hgrant_get_grantor_ein());
}

function wp_hgrant_has_grantor_fiscal_year_end() {
	return apply_filters('wp_hgrant_has_grantor_fiscal_year_end', !!(wp_hgrant_get_grantor_fiscal_year_end()));
}
function wp_hgrant_get_grantor_fiscal_year_end() {
	return apply_filters('wp_hgrant_get_grantor_fiscal_year_end', WP_hGrant::get_grantor_fiscal_year_end());
}
function wp_hgrant_the_grantor_fiscal_year_end() {
	echo apply_filters('wp_hgrant_the_grantor_fiscal_year_end', wp_hgrant_get_grantor_fiscal_year_end());
}

// Grant

/// Grant - Basics
function wp_hgrant_has_grant_id($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_id', !!(wp_hgrant_get_grant_id($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_id($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_id', WP_hGrant::get_grant_id($grant_id), $grant_id);
}
function wp_hgrant_the_grant_id($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_id', wp_hgrant_get_grant_id($grant_id), $grant_id);
}

function wp_hgrant_has_grant_amount_currency($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_amount_currency', !!(wp_hgrant_get_grant_amount_currency($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_amount_currency($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_amount_currency', WP_hGrant::get_grant_amount_currency($grant_id), $grant_id);
}
function wp_hgrant_the_grant_amount_currency($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_amount_currency', wp_hgrant_get_grant_amount_currency($grant_id), $grant_id);
}

function wp_hgrant_get_grant_amount_currency_symbol($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_amount_currency_symbol', WP_hGrant::get_grant_amount_currency_symbol($grant_id), $grant_id);
}

function wp_hgrant_has_grant_amount_amount($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_amount_amount', !!(wp_hgrant_get_grant_amount_amount($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_amount_amount($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_amount_amount', WP_hGrant::get_grant_amount_amount($grant_id), $grant_id);
}
function wp_hgrant_the_grant_amount_amount($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_amount_amount', wp_hgrant_get_grant_amount_amount($grant_id), $grant_id);
}

function wp_hgrant_has_grant_duration_amount($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_duration_amount', !!(wp_hgrant_get_grant_duration_amount($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_duration_amount($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_duration_amount', WP_hGrant::get_grant_duration_amount($grant_id), $grant_id);
}
function wp_hgrant_the_grant_duration_amount($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_duration_amount', wp_hgrant_get_grant_duration_amount($grant_id), $grant_id);
}

function wp_hgrant_has_grant_duration_period($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_duration_period', !!(wp_hgrant_get_grant_duration_period($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_duration_period($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_duration_period', WP_hGrant::get_grant_duration_period($grant_id), $grant_id);
}
function wp_hgrant_the_grant_duration_period($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_duration_period', wp_hgrant_get_grant_duration_period($grant_id), $grant_id);
}

function wp_hgrant_has_grant_activity($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_activity', !!(wp_hgrant_get_grant_activity($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_activity($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_activity', WP_hGrant::get_grant_activity($grant_id), $grant_id);
}
function wp_hgrant_the_grant_activity($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_activity', wp_hgrant_get_grant_activity($grant_id), $grant_id);
}

function wp_hgrant_get_grant_activities($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_activities', array_map('trim', explode(',', wp_hgrant_get_grant_activity($grant_id))), $grant_id);
}

function wp_hgrant_has_grant_population_group($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_population_group', !!(wp_hgrant_get_grant_population_group($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_population_group($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_population_group', WP_hGrant::get_grant_population_group($grant_id), $grant_id);
}
function wp_hgrant_the_grant_population_group($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_population_group', wp_hgrant_get_grant_population_group($grant_id), $grant_id);
}

function wp_hgrant_get_grant_population_groups($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_population_groups', array_map('trim', explode("\n", wp_hgrant_get_grant_population_group($grant_id))), $grant_id);
}

function wp_hgrant_has_grant_program_areas($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_program_areas', !!(wp_hgrant_get_grant_program_areas($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_program_areas($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_program_areas', WP_hGrant::get_grant_program_areas($grant_id), $grant_id);
}
function wp_hgrant_the_grant_program_areas($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_program_areas', wp_hgrant_get_grant_program_areas($grant_id), $grant_id);
}

function wp_hgrant_has_grant_support_types($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_support_types', !!(wp_hgrant_get_grant_support_types($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_support_types($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_support_types', WP_hGrant::get_grant_support_types($grant_id), $grant_id);
}
function wp_hgrant_the_grant_support_types($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_support_types', wp_hgrant_get_grant_support_types($grant_id), $grant_id);
}

function wp_hgrant_has_grant_strategies($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_strategies', !!(wp_hgrant_get_grant_strategies($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_strategies($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_strategies', WP_hGrant::get_grant_strategies($grant_id), $grant_id);
}
function wp_hgrant_the_grant_strategies($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_strategies', wp_hgrant_get_grant_strategies($grant_id), $grant_id);
}

function wp_hgrant_has_grant_initiatives($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_initiatives', !!(wp_hgrant_get_grant_initiatives($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_initiatives($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_initiatives', WP_hGrant::get_grant_initiatives($grant_id), $grant_id);
}
function wp_hgrant_the_grant_initiatives($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_initiatives', wp_hgrant_get_grant_initiatives($grant_id), $grant_id);
}

function wp_hgrant_has_grant_themes($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_themes', !!(wp_hgrant_get_grant_themes($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_themes($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_themes', WP_hGrant::get_grant_themes($grant_id), $grant_id);
}
function wp_hgrant_the_grant_themes($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_themes', wp_hgrant_get_grant_themes($grant_id), $grant_id);
}

/// Grant - Dates
function wp_hgrant_has_grant_dtstart($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_dtstart', !!(wp_hgrant_get_grant_dtstart($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_dtstart($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_dtstart', WP_hGrant::get_grant_dtstart($grant_id), $grant_id);
}
function wp_hgrant_the_grant_dtstart($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_dtstart', wp_hgrant_get_grant_dtstart($grant_id), $grant_id);
}

function wp_hgrant_has_grant_dtend($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_dtend', !!(wp_hgrant_get_grant_dtend($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_dtend($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_dtend', WP_hGrant::get_grant_dtend($grant_id), $grant_id);
}
function wp_hgrant_the_grant_dtend($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_dtend', wp_hgrant_get_grant_dtend($grant_id), $grant_id);
}

function wp_hgrant_has_grant_fiscal_year_end($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_fiscal_year_end', !!(wp_hgrant_get_grant_fiscal_year_end($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_fiscal_year_end($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_fiscal_year_end', WP_hGrant::get_grant_fiscal_year_end($grant_id), $grant_id);
}
function wp_hgrant_the_grant_fiscal_year_end($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_fiscal_year_end', wp_hgrant_get_grant_fiscal_year_end($grant_id), $grant_id);
}

/// Grant - Other
function wp_hgrant_has_grant_outcome($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_outcome', !!(wp_hgrant_get_grant_outcome($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_outcome($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_outcome', WP_hGrant::get_grant_outcome($grant_id), $grant_id);
}
function wp_hgrant_the_grant_outcome($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_outcome', wp_hgrant_get_grant_outcome($grant_id), $grant_id);
}

function wp_hgrant_has_grant_outputs($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_outputs', !!(wp_hgrant_get_grant_outputs($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_outputs($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_outputs', WP_hGrant::get_grant_outputs($grant_id), $grant_id);
}
function wp_hgrant_the_grant_outputs($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_outputs', wp_hgrant_get_grant_outputs($grant_id), $grant_id);
}

function wp_hgrant_has_grant_challenge_grant($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_challenge_grant', !!(wp_hgrant_get_grant_challenge_grant($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_challenge_grant($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_challenge_grant', WP_hGrant::get_grant_challenge_grant($grant_id), $grant_id);
}
function wp_hgrant_the_grant_challenge_grant($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_challenge_grant', wp_hgrant_get_grant_challenge_grant($grant_id), $grant_id);
}

function wp_hgrant_has_grant_matching_grant($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_matching_grant', !!(wp_hgrant_get_grant_matching_grant($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_matching_grant($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_matching_grant', WP_hGrant::get_grant_matching_grant($grant_id), $grant_id);
}
function wp_hgrant_the_grant_matching_grant($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_matching_grant', wp_hgrant_get_grant_matching_grant($grant_id), $grant_id);
}

function wp_hgrant_has_grant_continuing_support_grant($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_continuing_support_grant', !!(wp_hgrant_get_grant_continuing_support_grant($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_continuing_support_grant($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_continuing_support_grant', WP_hGrant::get_grant_continuing_support_grant($grant_id), $grant_id);
}
function wp_hgrant_the_grant_continuing_support_grant($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_continuing_support_grant', wp_hgrant_get_grant_continuing_support_grant($grant_id), $grant_id);
}

function wp_hgrant_has_grant_fiscal_agent($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_fiscal_agent', !!(wp_hgrant_get_grant_fiscal_agent($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_fiscal_agent($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_fiscal_agent', WP_hGrant::get_grant_fiscal_agent($grant_id), $grant_id);
}
function wp_hgrant_the_grant_fiscal_agent($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_fiscal_agent', wp_hgrant_get_grant_fiscal_agent($grant_id), $grant_id);
}

function wp_hgrant_has_grant_shared_grant($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_shared_grant', !!(wp_hgrant_get_grant_shared_grant($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_shared_grant($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_shared_grant', WP_hGrant::get_grant_shared_grant($grant_id), $grant_id);
}
function wp_hgrant_the_grant_shared_grant($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_shared_grant', wp_hgrant_get_grant_shared_grant($grant_id), $grant_id);
}

function wp_hgrant_get_grant_shared_grants($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_shared_grants', array_map('trim', explode("\n", wp_hgrant_get_grant_shared_grant($grant_id))), $grant_id);
}

function wp_hgrant_has_grant_fund_name($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_fund_name', !!(wp_hgrant_get_grant_fund_name($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_fund_name($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_fund_name', WP_hGrant::get_grant_fund_name($grant_id), $grant_id);
}
function wp_hgrant_the_grant_fund_name($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_fund_name', wp_hgrant_get_grant_fund_name($grant_id), $grant_id);
}

function wp_hgrant_has_grant_fund_type($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_fund_type', !!(wp_hgrant_get_grant_fund_type($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_fund_type($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_fund_type', WP_hGrant::get_grant_fund_type($grant_id), $grant_id);
}
function wp_hgrant_the_grant_fund_type($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_fund_type', wp_hgrant_get_grant_fund_type($grant_id), $grant_id);
}

function wp_hgrant_has_grant_fund_subtype($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_fund_subtype', !!(wp_hgrant_get_grant_fund_subtype($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_fund_subtype($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_fund_subtype', WP_hGrant::get_grant_fund_subtype($grant_id), $grant_id);
}
function wp_hgrant_the_grant_fund_subtype($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_fund_subtype', wp_hgrant_get_grant_fund_subtype($grant_id), $grant_id);
}

function wp_hgrant_has_grant_iati_flag($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_iati_flag', !!(wp_hgrant_get_grant_iati_flag($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_iati_flag($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_iati_flag', WP_hGrant::get_grant_iati_flag($grant_id), $grant_id);
}
function wp_hgrant_the_grant_iati_flag($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_iati_flag', wp_hgrant_get_grant_iati_flag($grant_id), $grant_id);
}

/// Grant - Geo Areas
function wp_hgrant_has_grant_geo_areas($grant_id = null) {
	return apply_filters('wp_hgrant_has_grant_geo_areas', !!(wp_hgrant_get_grant_geo_areas($grant_id)), $grant_id);
}
function wp_hgrant_get_grant_geo_areas($grant_id = null) {
	return apply_filters('wp_hgrant_get_grant_geo_areas', WP_hGrant::get_grant_geo_areas($grant_id), $grant_id);
}
function wp_hgrant_the_grant_geo_areas($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grant_geo_areas', wp_hgrant_get_grant_geo_areas($grant_id), $grant_id);
}

/// Grantee - Address
function wp_hgrant_has_grantee_name($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_name', !!(wp_hgrant_get_grantee_name($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_name($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_name', WP_hGrant::get_grantee_name($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_name($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_name', wp_hgrant_get_grantee_name($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_street_address($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_street_address', !!(wp_hgrant_get_grantee_street_address($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_street_address($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_street_address', WP_hGrant::get_grantee_street_address($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_street_address($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_street_address', wp_hgrant_get_grantee_street_address($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_extended_address($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_extended_address', !!(wp_hgrant_get_grantee_extended_address($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_extended_address($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_extended_address', WP_hGrant::get_grantee_extended_address($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_extended_address($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_extended_address', wp_hgrant_get_grantee_extended_address($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_po_box($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_po_box', !!(wp_hgrant_get_grantee_po_box($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_po_box($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_po_box', WP_hGrant::get_grantee_po_box($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_po_box($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_po_box', wp_hgrant_get_grantee_po_box($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_locality($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_locality', !!(wp_hgrant_get_grantee_locality($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_locality($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_locality', WP_hGrant::get_grantee_locality($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_locality($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_locality', wp_hgrant_get_grantee_locality($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_region($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_region', !!(wp_hgrant_get_grantee_region($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_region($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_region', WP_hGrant::get_grantee_region($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_region($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_region', wp_hgrant_get_grantee_region($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_region_other($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_region_other', !!(wp_hgrant_get_grantee_region_other($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_region_other($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_region_other', WP_hGrant::get_grantee_region_other($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_region_other($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_region_other', wp_hgrant_get_grantee_region_other($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_postal_code($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_postal_code', !!(wp_hgrant_get_grantee_postal_code($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_postal_code($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_postal_code', WP_hGrant::get_grantee_postal_code($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_postal_code($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_postal_code', wp_hgrant_get_grantee_postal_code($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_country_name($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_country_name', !!(wp_hgrant_get_grantee_country_name($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_country_name($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_country_name', WP_hGrant::get_grantee_country_name($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_country_name($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_country_name', wp_hgrant_get_grantee_country_name($grant_id), $grant_id);
}

/// Grantee - Contact
function wp_hgrant_has_grantee_telephone($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_telephone', !!(wp_hgrant_get_grantee_telephone($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_telephone($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_telephone', WP_hGrant::get_grantee_telephone($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_telephone($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_telephone', wp_hgrant_get_grantee_telephone($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_email($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_email', !!(wp_hgrant_get_grantee_email($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_email($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_email', WP_hGrant::get_grantee_email($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_email($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_email', wp_hgrant_get_grantee_email($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_url($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_url', !!(wp_hgrant_get_grantee_url($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_url($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_url', WP_hGrant::get_grantee_url($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_url($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_url', wp_hgrant_get_grantee_url($grant_id), $grant_id);
}

/// Grantee - Classification
function wp_hgrant_has_grantee_type($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_type', !!(wp_hgrant_get_grantee_type($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_type($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_type', WP_hGrant::get_grantee_type($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_type($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_type', wp_hgrant_get_grantee_type($grant_id), $grant_id);
}

function wp_hgrant_get_grantee_types($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_types', array_map('trim', explode(',', wp_hgrant_get_grantee_type($grant_id))), $grant_id);
}

function wp_hgrant_has_grantee_population_group($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_population_group', !!(wp_hgrant_get_grantee_population_group($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_population_group($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_population_group', WP_hGrant::get_grantee_population_group($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_population_group($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_population_group', wp_hgrant_get_grantee_population_group($grant_id), $grant_id);
}

function wp_hgrant_get_grantee_population_groups($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_population_groups', array_map('trim', explode("\n", wp_hgrant_get_grantee_population_group($grant_id))), $grant_id);
}

/// Grantee - Other
function wp_hgrant_has_grantee_ein($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_ein', !!(wp_hgrant_get_grantee_ein($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_ein($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_ein', WP_hGrant::get_grantee_ein($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_ein($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_ein', wp_hgrant_get_grantee_ein($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_unit($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_unit', !!(wp_hgrant_get_grantee_unit($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_unit($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_unit', WP_hGrant::get_grantee_unit($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_unit($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_unit', wp_hgrant_get_grantee_unit($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_aka($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_aka', !!(wp_hgrant_get_grantee_aka($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_aka($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_aka', WP_hGrant::get_grantee_aka($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_aka($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_aka', wp_hgrant_get_grantee_aka($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_dba($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_dba', !!(wp_hgrant_get_grantee_dba($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_dba($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_dba', WP_hGrant::get_grantee_dba($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_dba($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_dba', wp_hgrant_get_grantee_dba($grant_id), $grant_id);
}

function wp_hgrant_has_grantee_fka($grant_id = null) {
	return apply_filters('wp_hgrant_has_grantee_fka', !!(wp_hgrant_get_grantee_fka($grant_id)), $grant_id);
}
function wp_hgrant_get_grantee_fka($grant_id = null) {
	return apply_filters('wp_hgrant_get_grantee_fka', WP_hGrant::get_grantee_fka($grant_id), $grant_id);
}
function wp_hgrant_the_grantee_fka($grant_id = null) {
	echo apply_filters('wp_hgrant_the_grantee_fka', wp_hgrant_get_grantee_fka($grant_id), $grant_id);
}
