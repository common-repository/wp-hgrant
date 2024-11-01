<?php
/*
 Plugin Name: Open hGrant for WordPress
 Description: Manage grant data on your website with associated regions and progrms.
 Version: 1.1.3
 Author: Mission Minded, with Nick Ohrn of http://plugin-developer.com/
 Author URI: http://mission-minded.com/
 */

if(!class_exists('WP_hGrant')) {
	class WP_hGrant {
		/// Constants

		//// Plugin Version
		const VERSION = '1.1.2';

		//// Keys
		const ACTIVATED_NAME = '_wp_hgrant_activated';
		const INDEXES_NAME = '_wp_hgrant_indices';
		const SETTINGS_NAME = '_wp_hgrant_settings';

		const META_NAME__GRANT_AMOUNT = '_wp_hgrant_grant_amount';
		const META_NAME__GRANT_DETAILS = '_wp_hgrant_grant_details';
		const META_NAME__GRANT_ID = '_wp_hgrant_grant_id';
		const META_NAME__GRANT_FISCAL_YEAR_END = '_wp_hgrant_grant_fye';
		const META_NAME__GRANT_START_DATE = '_wp_hgrant_grant_dtstart';
		const META_NAME__GRANT_GEO_AREA_CONTINENT = '_wp_hgrant_grant_geoarea_continent';
		const META_NAME__GRANT_GEO_AREA_COUNTRY = '_wp_hgrant_grant_geoarea_country';

		//// Slugs
		const BULK_ENTRY_PAGE_SLUG = 'wp-hgrant-bulk';
		const IMPORT_PAGE_SLUG = 'wp-hgrant-import';
		const SETTINGS_PAGE_SLUG = 'wp-hgrant-settings';
		const TOOLS_PAGE_SLUG = 'wp-hgrant-tools';

		//// Taxonomies
		const TAXONOMY_INITIATIVE = 'hgrant_initiative';
		const TAXONOMY_PROGRAM_AREA = 'hgrant_program_area';
		const TAXONOMY_STRATEGY = 'hgrant_strategy';
		const TAXONOMY_SUPPORT_TYPE = 'hgrant_support_type';
		const TAXONOMY_THEME = 'hgrant_theme';

		//// Types
		const TYPE_GRANT = 'hgrant_grant';

		//// Defaults
		private static $default_grant_details = null;

		private static $default_settings = null;

		public static function init() {
			self::add_actions();
			self::add_filters();
		}

		private static function add_actions() {
			// Common actions
			add_action('generate_rewrite_rules', array(__CLASS__, 'add_rewrite_rules'));
			add_action('init', array(__CLASS__, 'register_resources'), 0);
			add_action('init', array(__CLASS__, 'register_taxonomies'));
			add_action('init', array(__CLASS__, 'register_types'));
			add_action('pre_get_posts', array(__CLASS__, 'modify_query'));
			add_action('rss2_head', array(__CLASS__, 'output_grantor_information'));
			add_action('rss2_ns', array(__CLASS__, 'output_xhtml_ns'));

			if(is_admin()) {
				// Administrative only actions
				add_action('admin_enqueue_scripts', array(__CLASS__, 'possibly_enqueue_scripts'));
				add_action('admin_init', array(__CLASS__, 'register_settings'));
				add_action('admin_menu', array(__CLASS__, 'add_interface_items'));
				add_action('admin_notices', array(__CLASS__, 'edit_notice'));
				add_action('edit_form_after_editor', array(__CLASS__, 'output_editing_fields'));
				add_action('manage_' . self::TYPE_GRANT . '_posts_custom_column', array(__CLASS__, 'output_grant_columns'), 10, 2);
				add_action('restrict_manage_posts', array(__CLASS__, 'add_program_area_dropdown'));
				add_action('save_post_' . self::TYPE_GRANT, array(__CLASS__, 'save_post_meta'), 10, 2);
				add_action('save_post_revision', array(__CLASS__, 'save_revision_meta'), 11, 2);
				add_action('wp_restore_post_revision', array(__CLASS__, 'restore_revision_meta'), 10, 2);
			} else {
				// Frontend only actions
			}
		}

		private static function add_filters() {
			// Common filters
			add_filter('do_parse_request', array(__CLASS__, 'intercept_search'));
			add_filter('term_link', array(__CLASS__, 'transform_program_area_links'), 11, 3);
			add_filter('the_excerpt_rss', array(__CLASS__, 'the_excerpt_rss'), 11);
			add_filter('query_vars', array(__CLASS__, 'add_query_vars'));
			add_filter('wp_hgrant_get_grant_details', array(__CLASS__, 'validate_grant_details'), 10, 2);
			add_filter('wp_hgrant_set_grant_details', array(__CLASS__, 'sanitize_grant_details'), 10, 2);
			add_filter('wp_save_post_revision_check_for_changes', array(__CLASS__, 'wp_save_post_revision_check_for_changes__true'), 11, 3);

			if(is_admin()) {
				// Administrative only filters
				add_filter('post_updated_messages', array(__CLASS__, 'add_post_updated_messages'));
				add_filter('manage_' . self::TYPE_GRANT . '_posts_columns', array(__CLASS__, 'add_grant_columns'));
				add_filter('manage_edit-' . self::TYPE_GRANT . '_sortable_columns', array(__CLASS__, 'add_grant_columns_sortable'));
				add_filter('manage_taxonomies_for_' . self::TYPE_GRANT . '_columns', array(__CLASS__, 'add_program_area_taxonomy'), 10, 2);
				add_filter('wp_terms_checklist_args', array(__CLASS__, 'remove_checked_on_top_for_custom_taxonomies'), 11, 2);
			} else {
				// Frontend only filters
				add_filter('the_content', array(__CLASS__, 'output_grant_details'));
			}
		}

		/// Callbacks

		//// Generic operation

		public static function register_resources() {
			wp_register_style('jquery-ui-datepicker', plugins_url('resources/vendor/jquery-ui/jquery-ui.min.css', __FILE__), array(), '1.10.3.custom');
			wp_register_style('wp-hgrant-backend', plugins_url('resources/backend/wp-hgrant.css', __FILE__), array('jquery-ui-datepicker'), self::VERSION);

			wp_register_script('wp-hgrant-backend', plugins_url('resources/backend/wp-hgrant.js', __FILE__), array('jquery', 'jquery-ui-datepicker'), self::VERSION, true);

			$settings = self::_get_settings();
			wp_localize_script('wp-hgrant-backend', 'WP_hGrant', array(
				'default_duration_amount' => $settings['default_duration_amount'],
				'default_duration_period' => $settings['default_duration_period'],
				'initial_geo_area' => 'yes' === $settings['initial_geo_area'],
			));
		}

		public static function wp_save_post_revision_check_for_changes__true($save, $last, $post) {
			if(self::TYPE_GRANT === $post->post_type) {
				$save = true;
			}

			return $save;
		}

		//// Data exposure and querying

		public static function add_query_vars($vars) {
			$vars[] = self::TAXONOMY_PROGRAM_AREA . '_id';
			$vars[] = 'wp_hgrant_keywords';
			$vars[] = 'wp_hgrant_start_year';
			$vars[] = 'wp_hgrant_geo_area_type';
			$vars[] = 'wp_hgrant_geo_area';

			return $vars;
		}

		public static function add_rewrite_rules($wp_rewrite) {
			$archive_slug = self::_get_settings('archive_slug');

			$rules = array(
				$archive_slug . '/search(/keywords/([^/]+))?(/start/([0-9]{4}))?(/program/(\d+))?(/(continent|country)/([^/]+))?(/page/?([0-9]+))?/?$' => sprintf('index.php?post_type=%s&wp_hgrant_keywords=%s&wp_hgrant_start_year=%s&%s_id=%s&wp_hgrant_geo_area_type=%s&wp_hgrant_geo_area=%s&paged=%s', self::TYPE_GRANT, $wp_rewrite->preg_index(2), $wp_rewrite->preg_index(4), self::TAXONOMY_PROGRAM_AREA, $wp_rewrite->preg_index(6), $wp_rewrite->preg_index(8), $wp_rewrite->preg_index(9), $wp_rewrite->preg_index(11)),
			);

			$wp_rewrite->rules = $rules + $wp_rewrite->rules;
		}

		public static function force_feed_nopaging($search, $wp_query) {
			$wp_query->query_vars['nopaging'] = true;

			return $search;
		}

		public static function intercept_search($do) {
			if(isset($_POST['wp-hgrant-search']) && is_array($_POST['wp-hgrant-search'])) {
				$search = stripslashes_deep($_POST['wp-hgrant-search']);

				$keywords = isset($search['keywords']) ? $search['keywords'] : '';
				$start_date = isset($search['start-date']) ? $search['start-date'] : '';
				$program_area = isset($search['program-area']) ? $search['program-area'] : '';

				if(isset($search['geo-area']) && !empty($search['geo-area'])) {
					list($geo_area_type, $geo_area) = explode('|', $search['geo-area']);
				} else {
					$geo_area_type = $geo_area = null;
				}

				$url = self::_build_search_url($keywords, $start_date, $program_area, $geo_area_type, $geo_area);
				wp_redirect($url);
				exit;
			}

			return $do;
		}

		private static function _build_search_url($keywords = null, $start_date = null, $program_area = null, $geo_area_type = null, $geo_area = null) {
			$archive_slug = self::_get_settings('archive_slug');

			$url = home_url("{$archive_slug}/search/");

			if(!empty($keywords)) {
				$url .= sprintf('keywords/%s/', urlencode($keywords));
			}

			if(!empty($start_date)) {
				$url .= sprintf('start/%d/', $start_date);
			}

			if(!empty($program_area)) {
				$url .= sprintf('program/%s/', $program_area);
			}

			if(!empty($geo_area_type) && !empty($geo_area)) {
				$url .= sprintf('%s/%s/', $geo_area_type, urlencode($geo_area));
			}

			return $url;
		}

		public static function the_excerpt_rss($excerpt) {
			if(self::TYPE_GRANT === get_post_type()) {
				global $post;

				ob_start();
				include('views/frontend/feed-description.php');
				$excerpt = ob_get_clean();
			}

			return $excerpt;
		}

		public static function modify_query($wp_query) {
			if($wp_query->is_main_query() && self::_query_is_for_program_area_id($wp_query)) {
				$tax_query = isset($wp_query->query_vars['tax_query']) && is_array($wp_query->query_vars['tax_query']) ? $wp_query->query_vars['tax_query'] : array();

				$tax_query[] = array(
					'field' => 'term_id',
					'include_children' => false,
					'taxonomy' => self::TAXONOMY_PROGRAM_AREA,
					'terms' => array_map('absint', array($wp_query->get(self::TAXONOMY_PROGRAM_AREA . '_id'))),
				);

				$wp_query->query_vars['tax_query'] = $tax_query;
			}

			if($wp_query->is_main_query() && self::_query_is_for_grants_and_is_ordered($wp_query)) {
				$key = false;
				$orderby = false;

				switch($wp_query->query_vars['orderby']) {
					case 'hgrant_grant_amount':
						$key = self::META_NAME__GRANT_AMOUNT;
						$orderby = 'meta_value_num';
						break;
					case 'hgrant_grant_id':
						$key = self::META_NAME__GRANT_ID;
						$orderby = 'meta_value';
						break;
					case 'hgrant_grant_start_date':
						$key = self::META_NAME__GRANT_START_DATE;
						$orderby = 'meta_value_num';
						break;
				}

				$wp_query->query_vars['meta_key'] = $key;
				$wp_query->query_vars['orderby'] = $orderby;
			}

			if($wp_query->is_main_query() && self::_query_is_for_grants_feed($wp_query)) {
				add_filter('posts_search', array(__CLASS__, 'force_feed_nopaging'), 10, 2);
			}

			if($wp_query->is_main_query() && self::_query_is_for_grants_and_is_unordered($wp_query)) {
				$wp_query->query_vars['orderby'] = 'title';
				$wp_query->query_vars['order'] = 'ASC';
			}

			if($wp_query->get('wp_hgrant_start_year')) {
				$start_year = $wp_query->get('wp_hgrant_start_year');

				$year_beginning = mktime(0, 0, 0, 1, 1, $start_year);
				$year_end = mktime(0, 0, 0, 1, 1, $start_year + 1);

				$meta_query = isset($wp_query->query_vars['meta_query']) && is_array($wp_query->query_vars['meta_query']) ? $wp_query->query_vars['meta_query'] : array();
				$meta_query[] = array(
					'key' => self::META_NAME__GRANT_FISCAL_YEAR_END,
					'value' => array($year_beginning, $year_end),
					'compare' => 'BETWEEN',
					'type' => 'UNSIGNED',
				);

				$wp_query->query_vars['meta_query'] = $meta_query;
			}

			if($wp_query->get('wp_hgrant_keywords')) {
				$keywords = urldecode($wp_query->get('wp_hgrant_keywords'));

				$wp_query->query_vars['s'] = $keywords;
			}

			if(($geo_area_type = $wp_query->get('wp_hgrant_geo_area_type')) && ($geo_area = $wp_query->get('wp_hgrant_geo_area')) && in_array($geo_area_type, array('continent', 'country'))) {
				$meta_query = isset($wp_query->query_vars['meta_query']) && is_array($wp_query->query_vars['meta_query']) ? $wp_query->query_vars['meta_query'] : array();
				$meta_query[] = array(
					'key' => 'continent' === $geo_area_type ? self::META_NAME__GRANT_GEO_AREA_CONTINENT : self::META_NAME__GRANT_GEO_AREA_COUNTRY,
					'value' => urldecode($geo_area),
					'compare' => '=',
				);

				$wp_query->query_vars['meta_query'] = $meta_query;
			}
		}

		private static function _query_is_for_grants_and_is_ordered($query) {
			$orderby_keys = array('hgrant_grant_amount', 'hgrant_grant_id', 'hgrant_grant_start_date');

			return $query->is_post_type_archive(array(self::TYPE_GRANT)) && isset($query->query_vars['orderby']) && in_array($query->query_vars['orderby'], $orderby_keys);
		}

		private static function _query_is_for_grants_and_is_unordered($query) {
			return $query->is_post_type_archive(array(self::TYPE_GRANT)) && (!isset($query->query_vars['orderby']) || empty($query->query_vars['orderby']));
		}

		private static function _query_is_for_grants_feed($query) {
			return $query->is_post_type_archive(array(self::TYPE_GRANT)) && $query->is_feed();
		}

		private static function _query_is_for_program_area_id($query) {
			return $query->get(self::TAXONOMY_PROGRAM_AREA . '_id');
		}

		public static function output_grant_details($content) {
			if(is_singular() && self::TYPE_GRANT === get_post_type()) {
				ob_start();

				$template = locate_template('hgrant-content.php');
				$template = $template ? $template : path_join(dirname(__FILE__), 'templates/hgrant-content.php');

				$_content = $content;

				include($template);

				$content = ob_get_clean();
			}

			return $content;
		}

		public static function output_grantor_information() {
			include('views/frontend/grantor-vcard.php');
		}

		public static function output_xhtml_ns() {
			echo 'xmlns:xhtml="http://www.w3.org/1999/xhtml" ';
		}

		//// Types and taxonomies

		public static function add_post_updated_messages($messages) {
			global $post_ID, $post;

			$messages[self::TYPE_GRANT] = array(
				0 => '',
				1 => sprintf(__('Grant updated. <a href="%s">View grant</a>'), esc_url(get_permalink($post_ID))),
				4 => __('Grant updated.'),
				6 => sprintf(__('Grant published. <a href="%s">View grant</a>'), esc_url(get_permalink($post_ID))),
				7 => __('Grant saved.'),
				8 => sprintf(__('Grant submitted. <a target="_blank" href="%s">Preview grant</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
				9 => sprintf(__('Grant scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview grant</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
				10 => sprintf(__('Grant draft updated. <a target="_blank" href="%s">Preview grant</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			);

			return $messages;
		}

		public static function output_editing_fields($post) {
			if(self::TYPE_GRANT === $post->post_type) {
				wp_nonce_field('wp-hgrant-save-details', 'wp-hgrant-save-details-nonce');

				$continents = self::_get_continents();
				$countries = self::_get_countries();
				$currencies = self::_get_currencies();
				$states = self::_get_states();

				$grant_details = self::_get_grant_details($post->ID);
				$settings = self::_get_settings();

				if('auto-draft' === $post->post_status && 'yes' === self::_get_settings('initial_geo_area')) {
					if(empty($grant_details['grant_geo_areas'])) {
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

						$geo_area = array();
						foreach($components as $component_key => $component_name) {
							$geo_area[$component_key] = isset($geo_area[$component_key]) ? $geo_area[$component_key] : '';
						}
						$geo_area['country'] = isset($countries[$geo_area['country']]) ? $countries[$geo_area['country']] : $geo_area['country'];
						$geo_area['state'] = isset($geo_area['state']) && '00' == $geo_area['state']  && isset($geo_area['state_other']) ? $geo_area['state_other'] : $geo_area['state'];

						$geo_area['components'] = (isset($geo_area['components']) && is_array($geo_area['components'])) ? $geo_area['components'] : array();
						$geo_area['allocation_amount_currency'] = isset($geo_area['allocation_amount_currency']) ? $geo_area['allocation_amount_currency'] : 'USD';
						$geo_area['allocation_amount_currency_symbol'] = $currencies[$geo_area['allocation_amount_currency']];
						$geo_area['allocation_amount_amount'] = isset($geo_area['allocation_amount_amount']) ? $geo_area['allocation_amount_amount'] : '0.00';
						$geo_area['allocation_percent'] = isset($geo_area['allocation_percent']) ? $geo_area['allocation_percent'] : '0';

						$grant_details['grant_geo_areas'][] = $geo_area;
					}
				}

				include('views/backend/grant-details.php');
			}
		}

		public static function possibly_enqueue_scripts() {
			$screen = get_current_screen();

			if(isset($screen->post_type) && self::TYPE_GRANT === $screen->post_type) {
				wp_enqueue_script('wp-hgrant-backend');
				wp_enqueue_style('wp-hgrant-backend');
			}
		}

		public static function register_taxonomies() {
			self::_register_taxonomy_program_area();

			if('yes' === self::_get_settings('enable_support_types')) {
				self::_register_taxonomy_support_type();
			}

			if('yes' === self::_get_settings('enable_strategies')) {
				self::_register_taxonomy_strategy();
			}

			if('yes' === self::_get_settings('enable_initiatives')) {
				self::_register_taxonomy_initiative();
			}

			if('yes' === self::_get_settings('enable_themes')) {
				self::_register_taxonomy_theme();
			}
		}

		public static function register_types() {
			self::_register_type_grant();
		}

		public static function remove_checked_on_top_for_custom_taxonomies($args, $post_id) {
			if(self::TYPE_GRANT === get_post_type($post_id) && in_array($args['taxonomy'], array(self::TAXONOMY_INITIATIVE, self::TAXONOMY_PROGRAM_AREA, self::TAXONOMY_STRATEGY, self::TAXONOMY_SUPPORT_TYPE, self::TAXONOMY_THEME))) {
				$args['checked_ontop'] = false;
			}

			return $args;
		}

		public static function transform_program_area_links($link, $term, $taxonomy) {
			if(self::TAXONOMY_PROGRAM_AREA === $taxonomy) {
				$link = self::_build_search_url(null, null, $term->term_id);
			}

			return $link;
		}

		private static function _register_taxonomy_initiative() {
			$archive_slug = self::_get_settings('archive_slug');

			$initiative_options = array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __('Initiatives'),
					'singular_name' => __('Initiative'),
					'search_items' => __('Search Initiatives'),
					'popular_items' => null,
					'all_items' => __('All Initiatives'),
					'parent_item' => __('Parent Initiative'),
					'parent_item_colon' => __('Parent Initiative:'),
					'edit_item' => __('Edit Initiative'),
					'view_item' => __('View Initiative'),
					'update_item' => __('Update Initiative'),
					'add_new_item' => __('Add New Initiative'),
					'new_item_name' => __('New Initiative Name'),
					'separate_items_with_commas' => null,
					'add_or_remove_items' => null,
					'choose_from_most_used' => null,
					'not_found' => null,
				),
				'public' => true,
				'rewrite' => array(
					'slug' => $archive_slug . '/initiative',
					'with_front' => false,
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'show_in_nav_menus' => false,
			);

			register_taxonomy(self::TAXONOMY_INITIATIVE, array(), $initiative_options);
		}

		private static function _register_taxonomy_program_area() {
			$archive_slug = self::_get_settings('archive_slug');

			$program_options = array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __('Program Areas'),
					'singular_name' => __('Program Area'),
					'search_items' => __('Search Program Areas'),
					'popular_items' => null,
					'all_items' => __('All Program Areas'),
					'parent_item' => __('Parent Program Area'),
					'parent_item_colon' => __('Parent Program Area:'),
					'edit_item' => __('Edit Program Area'),
					'view_item' => __('View Program Area'),
					'update_item' => __('Update Program Area'),
					'add_new_item' => __('Add New Program Area'),
					'new_item_name' => __('New Program Area Name'),
					'separate_items_with_commas' => null,
					'add_or_remove_items' => null,
					'choose_from_most_used' => null,
					'not_found' => null,
				),
				'public' => true,
				'rewrite' => array(
					'slug' => $archive_slug . '/program-area',
					'with_front' => false,
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'show_in_nav_menus' => false,
			);

			register_taxonomy(self::TAXONOMY_PROGRAM_AREA, array(), $program_options);
		}

		private static function _register_taxonomy_support_type() {
			$archive_slug = self::_get_settings('archive_slug');

			$program_options = array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __('Support Types'),
					'singular_name' => __('Support Type'),
					'search_items' => __('Search Support Types'),
					'popular_items' => null,
					'all_items' => __('All Support Types'),
					'parent_item' => __('Parent Support Type'),
					'parent_item_colon' => __('Parent Support Type:'),
					'edit_item' => __('Edit Support Type'),
					'view_item' => __('View Support Type'),
					'update_item' => __('Update Support Type'),
					'add_new_item' => __('Add New Support Type'),
					'new_item_name' => __('New Support Type Name'),
					'separate_items_with_commas' => null,
					'add_or_remove_items' => null,
					'choose_from_most_used' => null,
					'not_found' => null,
				),
				'public' => true,
				'rewrite' => array(
					'slug' => $archive_slug . '/support-type',
					'with_front' => false,
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'show_in_nav_menus' => false,
			);

			register_taxonomy(self::TAXONOMY_SUPPORT_TYPE, array(), $program_options);
		}

		private static function _register_taxonomy_strategy() {
			$archive_slug = self::_get_settings('archive_slug');

			$strategy_options = array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __('Strategies'),
					'singular_name' => __('Strategy'),
					'search_items' => __('Search Strategies'),
					'popular_items' => null,
					'all_items' => __('All Strategies'),
					'parent_item' => __('Parent Strategy'),
					'parent_item_colon' => __('Parent Strategy:'),
					'edit_item' => __('Edit Strategy'),
					'view_item' => __('View Strategy'),
					'update_item' => __('Update Strategy'),
					'add_new_item' => __('Add New Strategy'),
					'new_item_name' => __('New Strategy Name'),
					'separate_items_with_commas' => null,
					'add_or_remove_items' => null,
					'choose_from_most_used' => null,
					'not_found' => null,
				),
				'public' => true,
				'rewrite' => array(
					'slug' => $archive_slug . '/strategy',
					'with_front' => false,
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'show_in_nav_menus' => false,
			);

			register_taxonomy(self::TAXONOMY_STRATEGY, array(), $strategy_options);
		}

		private static function _register_taxonomy_theme() {
			$archive_slug = self::_get_settings('archive_slug');

			$theme_options = array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __('Themes'),
					'singular_name' => __('Theme'),
					'search_items' => __('Search Themes'),
					'popular_items' => null,
					'all_items' => __('All Themes'),
					'parent_item' => __('Parent Theme'),
					'parent_item_colon' => __('Parent Theme:'),
					'edit_item' => __('Edit Theme'),
					'view_item' => __('View Theme'),
					'update_item' => __('Update Theme'),
					'add_new_item' => __('Add New Theme'),
					'new_item_name' => __('New Theme Name'),
					'separate_items_with_commas' => null,
					'add_or_remove_items' => null,
					'choose_from_most_used' => null,
					'not_found' => null,
				),
				'public' => true,
				'rewrite' => array(
					'slug' => $archive_slug . '/theme',
					'with_front' => false,
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'show_in_nav_menus' => false,
			);

			register_taxonomy(self::TAXONOMY_THEME, array(), $theme_options);
		}

		private static function _register_type_grant() {
			$archive_slug = self::_get_settings('archive_slug');
			$single_slug = self::_get_settings('single_slug');

			$grant_options = array(
				'labels' => array(
					'name' => __('Grants'),
					'singular_name' => __('Grant'),
					'add_new' => __('Add New Grant'),
					'add_new_item' => __('Add New Grant'),
					'edit_item' => __('Edit Grant'),
					'new_item' => __('New Grant'),
					'view_item' => __('View Grant'),
					'search_items' => __('Search Grants'),
					'not_found' => __('No grants found.'),
					'not_found_in_trash' => __('No grants found in Trash.'),
					'parent_item_colon' => __('Parent Grant:'),
					'all_items' => __('All Grants'),
					'menu_name' => 'hGrants',
				),
				'description' => __('Store information about individual grants, including grantor, amount, grant term, and award date.'),
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'map_meta_cap' => null,
				'hierarchical' => true,
				'public' => true,
				'rewrite' => array(
					'slug' => $single_slug,
					'with_front' => false,
				),
				'has_archive' => $archive_slug,
				'query_var' => true,
				'supports' => array('title', 'revisions'),
				'register_meta_box_cb' => null,
				'taxonomies' => array(self::TAXONOMY_INITIATIVE, self::TAXONOMY_PROGRAM_AREA, self::TAXONOMY_STRATEGY, self::TAXONOMY_SUPPORT_TYPE, self::TAXONOMY_THEME,),
				'show_ui' => true,
				'menu_position' => 10000,
				'menu_icon' => plugins_url('resources/backend/img/icon-16x16-color.png', __FILE__),
				'can_export' => true,
				'show_in_nav_menus' => false,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'delete_with_user' => false,
			);
			register_post_type(self::TYPE_GRANT, $grant_options);
		}

		//// Grant Data

		public static function restore_revision_meta($post_id, $revision_id) {
			$grant_details = self::_get_grant_details($revision_id);
			if($grant_details) {
				self::_set_grant_details($post_id, $grant_details);
			}
		}

		public static function save_post_meta($post_id, $post) {
			$data = stripslashes_deep($_POST);

			if(self::TYPE_GRANT !== $post->post_type
				|| wp_is_post_autosave($post_id)
				|| wp_is_post_revision($post_id)
				|| !isset($data['wp-hgrant-save-details-nonce'])
				|| !wp_verify_nonce($data['wp-hgrant-save-details-nonce'], 'wp-hgrant-save-details')) {
				return;
			}

			$hgrant = isset($data['wp-hgrant']) && is_array($data['wp-hgrant']) ? $data['wp-hgrant'] : array();

			self::_save_grant_data($post_id, $hgrant);
		}

		public static function save_revision_meta($revision_id, $post) {
			$data = stripslashes_deep($_POST);
			$parent_id = wp_is_post_revision($revision_id);

			if($parent_id && self::TYPE_GRANT === get_post_type($parent_id)) {
				$hgrant = isset($data['wp-hgrant']) && is_array($data['wp-hgrant']) ? $data['wp-hgrant'] : array();

				self::_save_grant_data($revision_id, $hgrant);
			}
		}

		public static function sanitize_grant_details($grant_details, $grant_id) {
			$grant_details_defaults = self::_get_grant_details_defaults();

			$grant_details = is_array($grant_details) ? $grant_details : array();

			$grant_details['grant_geo_areas'] = isset($grant_details['grant_geo_areas']) && is_array($grant_details['grant_geo_areas']) ? $grant_details['grant_geo_areas'] : array();
			unset($grant_details['grant_geo_areas']['XXX']);

			foreach($grant_details['grant_geo_areas'] as $key => $grant_geo_area) {
				$grant_details['grant_geo_areas'][$key]['components'] = isset($grant_geo_area['components']) && is_array($grant_geo_area['components']) ? $grant_geo_area['components'] : array();
			}
			$grant_details['grant_geo_areas'] = array_values($grant_details['grant_geo_areas']);

			delete_metadata('post', $grant_id, self::META_NAME__GRANT_GEO_AREA_CONTINENT);
			delete_metadata('post', $grant_id, self::META_NAME__GRANT_GEO_AREA_COUNTRY);
			foreach($grant_details['grant_geo_areas'] as $grant_geo_area) {
				if(in_array('continent', $grant_geo_area['components'])) {
					add_metadata('post', $grant_id, self::META_NAME__GRANT_GEO_AREA_CONTINENT, $grant_geo_area['continent']);
				}

				if(in_array('country', $grant_geo_area['components'])) {
					add_metadata('post', $grant_id, self::META_NAME__GRANT_GEO_AREA_COUNTRY, $grant_geo_area['country']);
				}
			}

			$grant_details = shortcode_atts($grant_details_defaults, $grant_details);

			if(isset($grant_details['grant_amount_amount'])) {
				update_metadata('post', $grant_id, self::META_NAME__GRANT_AMOUNT, $grant_details['grant_amount_amount']);
			} else {
				delete_metadata('post', $grant_id, self::META_NAME__GRANT_AMOUNT);
			}

			if(isset($grant_details['grant_id'])) {
				update_metadata('post', $grant_id, self::META_NAME__GRANT_ID, $grant_details['grant_id']);
			} else {
				delete_metadata('post', $grant_id, self::META_NAME__GRANT_ID);
			}

			if(isset($grant_details['grant_dtstart'])) {
				update_metadata('post', $grant_id, self::META_NAME__GRANT_START_DATE, strtotime($grant_details['grant_dtstart']));
			} else {
				delete_metadata('post', $grant_id, self::META_NAME__GRANT_START_DATE);
			}

			if(isset($grant_details['grant_fiscal_year_end'])) {
				update_metadata('post', $grant_id, self::META_NAME__GRANT_FISCAL_YEAR_END, strtotime($grant_details['grant_fiscal_year_end']));
			} else {
				delete_metadata('post', $grant_id, self::META_NAME__GRANT_FISCAL_YEAR_END);
			}

			return $grant_details;
		}

		public static function validate_grant_details($grant_details, $grant_id) {
			$grant_details = is_array($grant_details) ? $grant_details : array();
			$grant_details_defaults = self::_get_grant_details_defaults();

			return shortcode_atts($grant_details_defaults, $grant_details);
		}

		private static function _meta_id($key, $echo = true) {
			$id = "wp-hgrant-{$key}";

			if($echo) {
				echo $id;
			}

			return $id;
		}

		private static function _meta_name($key, $echo = true) {
			$name = "wp-hgrant[{$key}]";

			if($echo) {
				echo $name;
			}

			return $name;
		}

		private static function _save_grant_data($grant_id, $grant_data) {
			self::_set_grant_details($grant_id, $grant_data);
		}

		private static function _get_grant_details($grant_id, $grant_details_key = null) {
			$grant_id = absint(is_null($grant_id) ? get_the_ID() : $grant_id);

			$grant_details = apply_filters('wp_hgrant_get_grant_details', get_post_meta($grant_id, self::META_NAME__GRANT_DETAILS, true), $grant_id);

			return is_null($grant_details_key) ? $grant_details : (isset($grant_details[$grant_details_key]) ? $grant_details[$grant_details_key] : false);
		}

		private static function _get_grant_details_defaults() {
			if(is_null(self::$default_grant_details)) {
				$settings = self::_get_settings();

				self::$default_grant_details = array(
					// Grant - Basics
					'grant_id' => '',
					'grant_amount_currency' => $settings['default_amount_currency'],
					'grant_amount_amount' => '0.00',
					'grant_duration_amount' => $settings['default_duration_amount'],
					'grant_duration_period' => $settings['default_duration_period'],
					'grant_activity' => '',
					'grant_population_group' => '',

					// Grant - Dates
					'grant_dtstart' => date('m/d/y'),
					'grant_dtend' => date('m/d/y', strtotime("+{$settings['default_duration_amount']} {$settings['default_duration_period']}")),
					'grant_fiscal_year_end' => date('m/d/y', strtotime("{$settings['fiscal_year_end']}/" . date('Y'))),

					// Grant - Other
					'grant_outcome' => '',
					'grant_outputs' => '',
					'grant_challenge_grant' => 'N',
					'grant_matching_grant' => 'N',
					'grant_continuing_support_grant' => 'N',
					'grant_fiscal_agent' => '',
					'grant_shared_grant' => '',
					'grant_fund_name' => '',
					'grant_fund_type' => '',
					'grant_fund_subtype' => '',
					'iati_flag' => $settings['default_iati_flag'],

					// Grant - Geo Areas
					'grant_geo_areas' => array(),

					// Grantee - Address
					'grantee_name' => '',
					'grantee_street_address' => '',
					'grantee_extended_address' => '',
					'grantee_po_box' => '',
					'grantee_locality' => '',
					'grantee_region' => '',
					'grantee_region_other' => '',
					'grantee_postal_code' => '',
					'grantee_country_name' => 'US',

					// Grantee - Contact
					'grantee_telephone' => '',
					'grantee_email' => '',
					'grantee_url' => '',

					// Grantee - Classification
					'grantee_type' => '',
					'grantee_population_group' => '',

					// Grantee - Other
					'grantee_ein' => '',
					'grantee_unit' => '',
					'grantee_aka' => '',
					'grantee_dba' => '',
					'grantee_fka' => '',
				);
			}

			return self::$default_grant_details;
		}

		private static function _set_grant_details($grant_id, $grant_details) {
			$grant_id = absint($grant_id);

			$grant_details = apply_filters('wp_hgrant_set_grant_details', $grant_details, $grant_id);

			update_metadata('post', $grant_id, self::META_NAME__GRANT_DETAILS, $grant_details);

			return $grant_details;
		}

		//// Admin interface

		public static function add_interface_items() {
			$bulk_entry_page_hook_suffix = add_submenu_page(sprintf('edit.php?post_type=%s', self::TYPE_GRANT), __('WP hGrant - Bulk Add Grants'), __('Bulk Add Grants'), 'edit_posts', self::BULK_ENTRY_PAGE_SLUG, array(__CLASS__, 'display_bulk_entry_page'));
			$settings_page_hook_suffix = add_submenu_page(sprintf('edit.php?post_type=%s', self::TYPE_GRANT), __('WP hGrant - Grantor Settings'), __('Grantor Settings'), 'manage_options', self::SETTINGS_PAGE_SLUG, array(__CLASS__, 'display_settings_page'));
			$import_page_hook_suffix = add_submenu_page(sprintf('edit.php?post_type=%s', self::TYPE_GRANT), __('WP hGrant - Import CSV'), __('Import CSV'), 'manage_options', self::IMPORT_PAGE_SLUG, array(__CLASS__, 'display_import_page'));
			$tools_page_hook_suffix = add_submenu_page(sprintf('edit.php?post_type=%s', self::TYPE_GRANT), __('WP hGrant - Tools'), __('Tools'), 'manage_options', self::TOOLS_PAGE_SLUG, array(__CLASS__, 'display_tools_page'));

			if($bulk_entry_page_hook_suffix) {
				add_action("load-{$bulk_entry_page_hook_suffix}", array(__CLASS__, 'load_interface_item'));
			}

			if($settings_page_hook_suffix) {
				add_action("load-{$settings_page_hook_suffix}", array(__CLASS__, 'load_interface_item'));
			}

			if($import_page_hook_suffix) {
				add_action("load-{$import_page_hook_suffix}", array(__CLASS__, 'load_interface_item'));
			}

			if($tools_page_hook_suffix) {
				add_action("load-{$tools_page_hook_suffix}", array(__CLASS__, 'load_interface_item'));
			}

			global $submenu;
			$submenu_key = sprintf('edit.php?post_type=%s', self::TYPE_GRANT);

			if(isset($submenu[$submenu_key])) {
				$bulk = $import = $settings = false;

				foreach($submenu[$submenu_key] as $submenu_item_index => $submenu_item) {
					if(self::BULK_ENTRY_PAGE_SLUG === $submenu_item[2]) {
						unset($submenu[$submenu_key][$submenu_item_index]);
						$bulk = $submenu_item;
					} else if(self::SETTINGS_PAGE_SLUG === $submenu_item[2]) {
						unset($submenu[$submenu_key][$submenu_item_index]);
						$settings = $submenu_item;
					} else if(self::IMPORT_PAGE_SLUG === $submenu_item[2]) {
						unset($submenu[$submenu_key][$submenu_item_index]);
						$import = $submenu_item;
					} else if(self::TOOLS_PAGE_SLUG === $submenu_item[2]) {
						unset($submenu[$submenu_key][$submenu_item_index]);
						$tools = $submenu_item;
					}
				}

				if($bulk) {
					$submenu[$submenu_key][11] = $bulk;
				}

				if($import) {
					$submenu[$submenu_key][12] = $import;
				}

				if($settings) {
					$submenu[$submenu_key][2] = $settings;
				}

				if($tools) {
					$submenu[$submenu_key][13] = $tools;
				}

				ksort($submenu[$submenu_key]);
			}
		}

		public static function add_grant_columns($columns) {
			unset($columns['date']);

			self::_array_insert($columns, 1, array(
				'wp-hgrant-grant-id' => __('ID'),
			));

			$columns['wp-hgrant-grant-amount'] = __('Amount');
			$columns['wp-hgrant-grant-start-date'] = __('Start Date');

			return $columns;
		}

		public static function add_grant_columns_sortable($sortable) {
			$sortable['wp-hgrant-grant-amount'] = array('hgrant_grant_amount', true);
			$sortable['wp-hgrant-grant-id'] = array('hgrant_grant_id', true);
			$sortable['wp-hgrant-grant-start-date'] = array('hgrant_grant_start_date', true);

			return $sortable;
		}

		public static function add_program_area_dropdown() {
			$screen = get_current_screen();
			if(isset($screen->post_type) && self::TYPE_GRANT === $screen->post_type) {
				$term = get_query_var(self::TAXONOMY_PROGRAM_AREA . '_id');

				if(!$term && self::TAXONOMY_PROGRAM_AREA === get_query_var('taxonomy')) {
					$term_object = get_term_by('slug', get_query_var('term'), self::TAXONOMY_PROGRAM_AREA);
					if($term_object) {
						$term = $term_object->term_id;
					}
				}

				wp_dropdown_categories(array(
					'hide_empty' => 0,
					'hierarchical' => 1,
					'name' => self::TAXONOMY_PROGRAM_AREA . '_id',
					'orderby' => 'name',
					'selected' => $term,
					'show_count' => 0,
					'show_option_all' => __('View all Program Areas'),
					'taxonomy' => self::TAXONOMY_PROGRAM_AREA,
				));
			}
		}

		public static function add_program_area_taxonomy($taxonomies, $post_type) {
			$taxonomies[self::TAXONOMY_PROGRAM_AREA] = self::TAXONOMY_PROGRAM_AREA;

			return $taxonomies;
		}

		public static function edit_notice() {
			$edit_notice = 'yes' === self::_get_settings('dtend_warning');

			$screen = get_current_screen();
			if(isset($screen->id) && self::TYPE_GRANT === $screen->id) {
				$current_time = current_time('timestamp');
				$end_time = strtotime(self::_get_grant_details(get_the_ID(), 'grant_dtend'));
				if($edit_notice && $current_time > $end_time) {
					printf('<div id="wp-hgrant-dtend-warning" class="error"><p>%s</p></div>', __('This Grant has expired, for reporting purposes you should not change this data. Are you sure you want to edit?'));
				}

				$geo_areas = self::_get_grant_details(get_the_ID(), 'grant_geo_areas');

				$geo_area_percentage_sum = 0;
				foreach($geo_areas as $geo_area) {
					$geo_area_percentage_sum += floatval($geo_area['allocation_percent']);
				}
				if(!empty($geo_areas) && 100 != $geo_area_percentage_sum) {
					printf('<div id="wp-hgrant-dtend-warning" class="error"><p>%s</p></div>', __('Please double check this Grant\'s Geo Areas. The sum of the allocation percents does not equal 100%.'));
				}
			}
		}

		public static function load_interface_item() {
			wp_enqueue_script('wp-hgrant-backend');
			wp_enqueue_style('wp-hgrant-backend');


			$data = stripslashes_deep($_POST);
			if(isset($data['wp-hgrant-bulk-add-grants-nonce']) && wp_verify_nonce($data['wp-hgrant-bulk-add-grants-nonce'], 'wp-hgrant-bulk-add-grants')) {
				$grants = isset($data['wp-hgrant-bulk']) && isset($data['wp-hgrant-bulk']['grants']) ? $data['wp-hgrant-bulk']['grants'] : array();

				self::_process_bulk_entry($grants);
			} else if(isset($data['wp-hgrant-import-file-nonce']) && wp_verify_nonce($data['wp-hgrant-import-file-nonce'], 'wp-hgrant-import-file')) {
				self::_process_import_grants_file();
			} else if(isset($data['wp-hgrant-import-nonce']) && wp_verify_nonce($data['wp-hgrant-import-nonce'], 'wp-hgrant-import')) {
				$import = isset($data['wp-hgrant-import']) && is_array($data['wp-hgrant-import']) ? $data['wp-hgrant-import'] : array();

				self::_process_import_grants($import);
			} else if(isset($data['wp-hgrant-activate-feed-nonce']) && wp_verify_nonce($data['wp-hgrant-activate-feed-nonce'], 'wp-hgrant-activate-feed')) {
				self::_process_activate_feed();
			}

			if(isset($_GET['settings-updated']) && 'true' === $_GET['settings-updated'] && isset($_GET['page']) && self::SETTINGS_PAGE_SLUG === $_GET['page']) {
				flush_rewrite_rules(false);
			}
		}

		public static function output_grant_columns($column_name, $post_id) {
			$currencies = self::_get_currencies();
			$grant_details = self::_get_grant_details($post_id);

			switch($column_name) {
				case 'wp-hgrant-grant-amount':
					printf('%1$s%2$2s', $currencies[$grant_details['grant_amount_currency']], number_format_i18n($grant_details['grant_amount_amount'], 2));
					break;
				case 'wp-hgrant-grant-id':
					echo esc_html($grant_details['grant_id']);
					break;
				case 'wp-hgrant-grant-program-areas':
					$program_areas = wp_hgrant_get_grant_program_areas($post_id);
					if(empty($program_areas)) {
						_e('None');
					} else {
						echo implode(', ', array_map('esc_html', $program_areas));
					}
					break;
				case 'wp-hgrant-grant-start-date':
					echo esc_html($grant_details['grant_dtstart']);
					break;
			}
		}

		//// Bulk editing

		public static function display_bulk_entry_page() {
			$bulk_entry_link = self::_get_bulk_entry_link();
			$currencies = self::_get_currencies();
			$grant_details = self::_get_grant_details_defaults();

			include('views/backend/bulk-entry.php');
		}

		private static function _process_bulk_entry($grants) {
			$post_ids = array();

			unset($grants['XXX']);

			foreach($grants as $grant) {
				$post_id = wp_insert_post(array(
					'post_content' => $grant['grant_description'],
					'post_status' => 'draft',
					'post_title' => $grant['grant_title'],
					'post_type' => self::TYPE_GRANT,
				));

				if(!is_wp_error($post_id)) {
					$post_ids[] = $post_id;

					self::_set_grant_details($post_id, $grant);

					$program_areas = is_array($grant['grant_program_areas']) ? array_filter(array_map('absint', $grant['grant_program_areas'])) : array();

					if(!empty($program_areas)) {
						wp_set_object_terms($post_id, $program_areas, self::TAXONOMY_PROGRAM_AREA, false);
					}
				}
			}

			add_settings_error('general', 'settings_updated', sprintf(_n('%d Grant Created', '%d Grants Created', count($post_ids)), count($post_ids)), 'updated');
			set_transient('settings_errors', get_settings_errors(), 30);

			wp_redirect(self::_get_bulk_entry_link(array('settings-updated' => 'true')));
			exit;
		}

		//// Import

		private static $_import_error = false;
		private static $_import_step = 'file';
		private static $_uploaded_import_contents = '';
		private static $_uploaded_import_contents_data = array();
		private static $_uploaded_import_contents_headers = array();

		public static function display_import_page() {
			$error = self::$_import_error;
			$import_link = self::_get_import_page_link();
			$step = self::$_import_step;

			$data = self::$_uploaded_import_contents_data;
			$headers = self::$_uploaded_import_contents_headers;

			$fields = self::_get_fields();
			$saved = self::_get_indexes();

			$currencies = self::_get_currencies();
			$periods = array('months' => __('Month(s)'), 'years' => __('Year(s)'));

			include('views/backend/import.php');
		}

		private static function _display_import_page_selector($headers, $field_key, $saved) {
			printf('<select id="wp-hgrant-import-fields-%1$s" name="wp-hgrant-import[fields][%1$s]">', esc_attr($field_key));
			printf('<option %s value="-1">%s</option>', ('-1' == $saved ? 'selected="selected"' : ''), __('No Value'));
			foreach($headers as $index => $header) {
				printf('<option %s value="%s">%s</option>', ($index == $saved ? 'selected="selected"' : ''), esc_attr($index), esc_html($header));
			}
			printf('</select>');
		}

		private static function _process_import_grants_file() {
			$file = isset($_FILES['wp-hgrant-import-file']) && is_array($_FILES['wp-hgrant-import-file']) ? $_FILES['wp-hgrant-import-file'] : array();

			$file_name = isset($file['tmp_name']) ? $file['tmp_name'] : false;

			$is_file_csv = isset($file['name']) ? 'csv' === substr($file['name'], -3) : false;
			$is_file_error_free = isset($file['error']) ? 0 == $file['error'] : false;
			$is_file_not_empty = isset($file['size']) && $file['size'] > 0;

			if($file_name && $is_file_csv && $is_file_error_free && $is_file_not_empty) {
				self::$_uploaded_import_contents = file_get_contents($file_name);

				$lines = wp_hgrant_parse_csv(self::$_uploaded_import_contents);
				$lines_count = count($lines);

				if($lines_count >= 2) {
					self::$_import_step = 'fields';

					self::$_uploaded_import_contents_headers = array_shift($lines);
					self::$_uploaded_import_contents_data = $lines;
				}
			}

			if('fields' !== self::$_import_step) {
				self::$_import_error = __('Please upload a CSV file with headers and at least one row of data');
			}
		}

		private static function _process_import_grants($import) {
			set_time_limit(0);

			$data = isset($import['data']) ? json_decode($import['data'], true) : array();
			$headers = isset($import['headers']) ? json_decode($import['headers'], true) : array();

			$configuration = isset($import['configuration']) ? $import['configuration'] : array();
			$fields = isset($import['fields']) ? $import['fields'] : array();

			$countries = self::_get_countries();
			$states = self::_get_states();

			$separator = isset($configuration['separator']) && !empty($configuration['separator']) ? $configuration['separator'] : ',';
			$yes = array_map('strtolower', array_map('trim', explode(',', isset($configuration['yes']) && !empty($configuration['yes']) ? $configuration['yes'] : 'Y')));

			$allocation_amount_currency = $fields['geo_area_allocation_amount_currency'];

			$saved = array_merge(array('configuration' => $configuration), $fields);
			self::_save_indexes($saved);

			$counter = 0;
			foreach($data as $datum) {

				// Special case the name and description
				$content = $fields['post_content'] >= 0 ? (isset($datum[$fields['post_content']]) ? $datum[$fields['post_content']] : '') : '';
				$title = $fields['post_title'] >= 0 ? (isset($datum[$fields['post_title']]) ? $datum[$fields['post_title']] : '') : '';

				$post_id = wp_insert_post(array(
					'post_content' => $content,
					'post_status' => 'draft',
					'post_title' => $title,
					'post_type' => self::TYPE_GRANT,
				));

				if(!is_wp_error($post_id)) {
					$counter++;

					// Accumulate the meta and save it
					$grant_details = self::_get_grant_details_defaults();
					$displayable_name_parts = array( 'continent', 'inter_country_region', 'country', 'intra_country_region', 'intra_state_region', 'state', 'county', 'city', 'neighborhood', );

					foreach($fields as $field_key => $field_index) {
						if(isset($datum[$field_index])) {
							$value = $datum[$field_index];
						} elseif(-1 == $field_index) {
							$value = '';
						} else {
							$value = $field_index;
						}

						$amount_fields = array('grant_amount_amount', 'grant_duration_amount');
						$date_fields = array('grant_dtstart', 'grant_dtend', 'grant_fiscal_year_end');
						$toggle_fields = array('grant_challenge_grant', 'grant_matching_grant', 'grant_continuing_support_grant', 'iati_flag');

						if(in_array($field_key, $amount_fields)) {
							// For amounts / durations, parse out all non-numbers
							$value = floatval(preg_replace('/[^\d\.]/', '', $value));
						} else if(in_array($field_key, $date_fields) && !empty($value)) {
							// For dates, convert to timestamp and then back to properly formatted date
							$value = date('m/d/y', strtotime($value));
						} else if(in_array($field_key, $toggle_fields)) {
							$value = in_array(strtolower($value), $yes) ? 'Y' : 'N';
						} else if('grantee_telephone' === $field_key) {
							$value = preg_replace('/[^\d]/', '', $value);
						} else if('grantee_region' === $field_key) {
							list($grant_details['grantee_region'], $grant_details['grantee_region_other']) = self::_normalize_state($value);

							$value = '';
						} else if('grantee_country_name' === $field_key) {
							$value = self::_normalize_country($value);
						}

						if(0 === strpos($field_key, 'taxonomy_')) {
							// Special case the classification stuff and add as terms
							$terms = explode($separator, $value);
							$taxonomy = str_replace('taxonomy_', 'hgrant_', $field_key);

							if(!empty($terms)) {
								wp_set_object_terms($post_id, $terms, $taxonomy);
							}
						} else if(0 === strpos($field_key, 'geo_area_')) {
							if(!isset($grant_details['grant_geo_areas']) || !is_array($grant_details['grant_geo_areas'])) {
								$grant_details['grant_geo_areas'] = array();
							}

							$geo_area_key = str_replace('geo_area_', '', $field_key);
							$parts = explode($separator, $value);

							foreach($parts as $index => $part) {
								$skip_assignment = false;

								if(!isset($grant_details['grant_geo_areas'][$index])) {
									$grant_details['grant_geo_areas'][$index] = array(
										'allocation_amount_amount' => 0,
										'allocation_amount_currency' => $allocation_amount_currency,
										'allocation_percent' => 100,
										'state_other' => '',
									);
								}

								if('country' === $geo_area_key) {
									$part = self::_normalize_country($part);
								} else if('state' === $geo_area_key) {
									list($state, $state_other) = self::_normalize_state($part);

									$grant_details['grant_geo_areas'][$index]['state'] = $state;
									$grant_details['grant_geo_areas'][$index]['state_other'] = $state_other;
									$skip_assignment = true;
								} else if(in_array($geo_area_key, array('allocation_amount_amount', 'allocation_percent'))) {
									$part = floatval(preg_replace('/[^\d\.]/', '', $part));
								}

								if(!empty($part) && in_array($geo_area_key, $displayable_name_parts)) {
									$grant_details['grant_geo_areas'][$index]['components'][$geo_area_key] = $geo_area_key;
								}

								if(!$skip_assignment) {
									$grant_details['grant_geo_areas'][$index][$geo_area_key] = $part;
								}
							}
						} else if(!empty($value)) {
							// Everything else is a grant details field
							$grant_details[$field_key] = $value;
						}
					}

					$grant_details = self::_set_grant_details($post_id, $grant_details);
				}
			}

			add_settings_error('general', 'settings_updated', sprintf(_n('%d Grant Imported', '%d Grants Imported', $counter), $counter), 'updated');
			set_transient('settings_errors', get_settings_errors(), 30);

			wp_redirect(self::_get_import_page_link(array('settings-updated' => 'true')));
			exit;
		}

		private static function _normalize_country($country_name_or_code) {
			$countries = self::_get_countries();

			if(!isset($countries[$country_name_or_code])) {
				// Special cased USA because it is used so frequently
				if('USA' === $country_name_or_code) {
					$country_name_or_code = 'US';
				} else {
					// Try to find the country's name in the countries array
					$possible_country_key = array_search($country_name_or_code, $countries);

					if(false === $possible_country_key) {
						$country_name_or_code = '';
					} else {
						$country_name_or_code = $possible_country_key;
					}
				}
			}

			return $country_name_or_code;
		}

		private static function _normalize_state($state_name_or_code) {
			$states = self::_get_states();

			if(isset($states[$state_name_or_code])) {
				$state = $state_name_or_code;
				$state_other = '';
			} else {
				$possible_state_key = array_search($state_name_or_code, $states);

				if(false === $possible_state_key) {
					$state = '00';
					$state_other = $state_name_or_code;
				} else {
					$state = $possible_state_key;
					$state_other = '';
				}
			}

			return array($state, $state_other);
		}

		private static function _get_fields() {
			return array(
				'post_title' => __('Grant Name'),
				'post_content' => __('Grant Description'),

				// Grant - Basics
				'grant_id' => __('ID'),
				'grant_amount_currency' => __('Amount Currency'),
				'grant_amount_amount' => __('Amount Amount'),
				'grant_duration_amount' => __('Duration Amount'),
				'grant_duration_period' => __('Duration Period'),
				'grant_activity' => __('Activity'),
				'grant_population_group' => __('Population Group'),

				// Grant - Classifications
				'taxonomy_initiative' => '',
				'taxonomy_program_area' => '',
				'taxonomy_strategy' => '',
				'taxonomy_support_type' => '',
				'taxonomy_theme' => '',

				// Grant - Dates
				'grant_dtstart' => __('Start Date'),
				'grant_dtend' => __('End Date'),
				'grant_fiscal_year_end' => __('Fiscal Year End'),

				// Grant - Geo Areas
				'geo_area_continent' => __('Continent'),
				'geo_area_inter_country_region' => __('Inter-Country Region'),
				'geo_area_country' => __('Country'),
				'geo_area_intra_country_region' => __('Intra-Country Region'),
				'geo_area_intra_state_region' => __('Intra-State Region'),
				'geo_area_state' => __('State'),
				'geo_area_county' => __('County'),
				'geo_area_city' => __('City'),
				'geo_area_neighborhood' => __('Neighborhood'),
				'geo_area_allocation_amount_amount' => __('Allocation Amount'),
				'geo_area_allocation_amount_currency' => __('Allocation Currency'),
				'geo_area_allocation_percent' => __('Allocation Percent'),

				// Grant - Other
				'grant_outcome' => __('Outcome'),
				'grant_outputs' => __('Outputs'),
				'grant_challenge_grant' => __('Challenge Grant?'),
				'grant_matching_grant' => __('Matching Grant?'),
				'grant_continuing_support_grant' => __('Continuing Support Grant?'),
				'grant_fiscal_agent' => __('Fiscal Agent'),
				'grant_shared_grant' => __('Shared Grant'),
				'grant_fund_name' => __('Fund Name'),
				'grant_fund_type' => __('Fund Type'),
				'grant_fund_subtype' => __('Fund Subtype'),
				'iati_flag' => __('IATI Flag'),

				// Grant - Geo Areas
				'grant_geo_areas' => array(),

				// Grantee - Address
				'grantee_name' => __('Grantee Name'),
				'grantee_street_address' => __('Grantee Street Address'),
				'grantee_extended_address' => __('Grantee Extended Address'),
				'grantee_po_box' => __('Grantee PO Box'),
				'grantee_locality' => __('Grantee Locality'),
				'grantee_region' => __('Grantee Region'),
				'grantee_postal_code' => __('Grantee Postal Code'),
				'grantee_country_name' => __('Grantee Country'),

				// Grantee - Contact
				'grantee_telephone' => __('Grantee Phone Number'),
				'grantee_email' => __('Grantee Email Address'),
				'grantee_url' => __('Grantee URL'),

				// Grantee - Classification
				'grantee_type' => __('Grantee Type'),
				'grantee_population_group' => __('Grantee Population Group'),

				// Grantee - Other
				'grantee_ein' => __('Grantee EIN'),
				'grantee_unit' => __('Grantee Unit'),
				'grantee_aka' => __('Grantee AKA'),
				'grantee_dba' => __('Grantee DBA'),
				'grantee_fka' => __('Grantee FKA'),
			);
		}

		private static function _get_indexes() {
			$fields_keys = array_keys(self::_get_fields());

			$indexes = array_merge(array('configuration' => array()), array_combine($fields_keys, array_fill(0, count($fields_keys), '-1')));
			$saved = get_option(self::INDEXES_NAME, $indexes);

			if(!is_array($saved)) {
				$saved = array();
			}

			if(!isset($saved['configuration'])) {
				$saved['configuration'] = array();
			}

			if(!isset($saved['configuration']['yes'])) {
				$saved['configuration']['yes'] = 'Y';
			}

			if(!isset($saved['configuration']['separator'])) {
				$saved['configuration']['separator'] = ',';
			}

			return shortcode_atts($indexes, $saved);
		}

		private static function _save_indexes($indexes) {
			update_option(self::INDEXES_NAME, $indexes);
		}

		//// Tools

		public static function display_tools_page() {
			$activated_timestamp = get_option(self::ACTIVATED_NAME);
			$admin_email = get_option('admin_email');
			$feed_url = get_post_type_archive_feed_link(self::TYPE_GRANT);
			$tools_link = self::_get_tools_page_link();

			include('views/backend/tools.php');
		}

		private static function _process_activate_feed() {
			$admin_email = get_option('admin_email');
			$feed_url = get_post_type_archive_feed_link(self::TYPE_GRANT);

			if(defined('OPEN_HGRANT_ACTIVATION_EMAIL')) {
				$email = OPEN_HGRANT_ACTIVATION_EMAIL;
			} else {
				$email = 'hgrant@foundationcenter.org,support@openhgrant.org';
			}

			$subject = __('Open hGrant Feed Activation');
			$message = __('A new site has requested feed activation. The site\'s information is as follows:') . "\n\n" . __('* Feed URL:') . $feed_url . "\n" . __('* Admin Email: ') . $admin_email . "\n\n" . __('-- Message Sent by Open hGrant Plugin for WordPress --') . "\n";

			wp_mail($email, $subject, $message);

			add_settings_error('general', 'settings_updated', __('Feed activated.'), 'updated');
			set_transient('settings_errors', get_settings_errors(), 30);

			update_option(self::ACTIVATED_NAME, current_time('timestamp'));

			wp_redirect(self::_get_tools_page_link(array('settings-updated' => 'true')));
			exit;
		}

		//// Settings related

		public static function display_settings_page() {
			$settings = self::_get_settings();
			$settings_link = self::_get_settings_page_link();
			$tools_link = self::_get_tools_page_link();

			$countries = self::_get_countries();
			$states = self::_get_states();

			$currencies = self::_get_currencies();

			if(isset($_GET['settings-updated'])) {
				flush_rewrite_rules();
			}

			include('views/backend/settings.php');
		}

		public static function register_settings() {
			register_setting(self::SETTINGS_NAME, self::SETTINGS_NAME, array(__CLASS__, 'sanitize_settings'));
		}

		public static function sanitize_settings($settings) {
			$defaults = self::_get_settings_default();

			if(isset($settings['archive_slug'])) {
				$settings['archive_slug'] = trim(preg_replace('#[^a-zA-Z-/]#', '', $settings['archive_slug']), '/');

				if(empty($settings['archive_slug'])) {
					unset($settings['archive_slug']);
				}
			}

			if(isset($settings['single_slug'])) {
				$settings['single_slug'] = trim(preg_replace('#[^a-zA-Z-/]#', '', $settings['single_slug']), '/');

				if(empty($settings['single_slug'])) {
					unset($settings['single_slug']);
				}
			}

			add_settings_error('general', 'settings_updated', __('Grantor information saved.'), 'updated');

			return shortcode_atts($defaults, $settings);
		}

		private static function _get_settings($settings_key = null) {
			$defaults = self::_get_settings_default();

			$settings = get_option(self::SETTINGS_NAME, $defaults);
			$settings = shortcode_atts($defaults, $settings);

			return is_null($settings_key) ? $settings : (isset($settings[$settings_key]) ? $settings[$settings_key] : false);
		}

		private static function _get_settings_default() {
			if(is_null(self::$default_settings)) {
				self::$default_settings = array(
					// Grantor - Address
					'name' => '',
					'street_address' => '',
					'extended_address' => '',
					'po_box' => '',
					'locality' => '',
					'region' => '',
					'region_other' => '',
					'postal_code' => '',
					'country_name' => 'US',

					// Grantor - Contact
					'telephone' => '',
					'email' => '',
					'url' => '',

					// Grantor - Other
					'ein' => '',
					'fiscal_year_end' => '12/31',

					// Defaults
					'default_duration_amount' => '1',
					'default_duration_period' => 'years',
					'default_amount_currency' => 'USD',
					'default_iati_flag' => 'y',

					// Other
					'dtend_warning' => 'yes',
					'enable_support_types' => 'no',
					'enable_strategies' => 'no',
					'enable_initiatives' => 'no',
					'enable_themes' => 'no',
					'initial_geo_area' => 'no',
					'archive_slug' => 'grants',
					'single_slug' => 'grant',
				);
			}

			return self::$default_settings;
		}

		private static function _settings_id($key, $echo = true) {
			$settings_name = self::SETTINGS_NAME;

			$id = "{$settings_name}-{$key}";
			if($echo) {
				echo $id;
			}

			return $id;
		}

		private static function _settings_name($key, $echo = true) {
			$settings_name = self::SETTINGS_NAME;

			$name = "{$settings_name}[{$key}]";
			if($echo) {
				echo $name;
			}

			return $name;
		}

		/// Utility

		private static function _array_insert(&$array, $position, $insert_array) {
			$first_array = array_splice($array, 0, $position);
			$array = array_merge($first_array, $insert_array, $array);
		}

		private static function _get_bulk_entry_link($query_args = array()) {
			$query_args = array_merge(array('post_type' => self::TYPE_GRANT, 'page' => self::BULK_ENTRY_PAGE_SLUG), $query_args);

			return add_query_arg($query_args, admin_url('edit.php'));
		}

		private static function _get_continents() {
			return array(
				'Asia',
				'Africa',
				'North America',
				'South America',
				'Antarctica',
				'Europe',
				'Australia',
			);
		}

		private static function _get_continents_stored() {
			global $wpdb;

			return $wpdb->get_col($wpdb->prepare("SELECT meta_value FROM {$wpdb->postmeta} pm JOIN {$wpdb->posts} p ON pm.post_id = p.ID AND p.post_type = %s AND p.post_status = %s WHERE pm.meta_key = %s ORDER BY meta_value ASC", self::TYPE_GRANT, 'publish', self::META_NAME__GRANT_GEO_AREA_CONTINENT));
		}

		private static function _get_countries() {
			include('lib/countries.php');

			return isset($countries) ? $countries : array();
		}

		private static function _get_countries_stored() {
			global $wpdb;

			$keys = $wpdb->get_col($wpdb->prepare("SELECT meta_value FROM {$wpdb->postmeta} pm JOIN {$wpdb->posts} p ON pm.post_id = p.ID AND p.post_type = %s AND p.post_status = %s WHERE pm.meta_key = %s", self::TYPE_GRANT, 'publish', self::META_NAME__GRANT_GEO_AREA_COUNTRY));

			$countries = self::_get_countries();

			$returned = array();
			foreach($countries as $key => $name) {
				if(in_array($key, $keys)) {
					$returned[$key] = $name;
				}
			}

			return $returned;
		}

		private static function _get_currencies() {
			return array(
				'USD' => '$',
				'GBP' => '£',
				'EUR' => '€',
				'JPY' => '¥',
			);
		}

		private static function _get_import_page_link($query_args = array()) {
			$query_args = array_merge(array('post_type' => self::TYPE_GRANT, 'page' => self::IMPORT_PAGE_SLUG), $query_args);

			return add_query_arg($query_args, admin_url('edit.php'));
		}

		private static function _get_settings_page_link($query_args = array()) {
			$query_args = array_merge(array('post_type' => self::TYPE_GRANT, 'page' => self::SETTINGS_PAGE_SLUG), $query_args);

			return add_query_arg($query_args, admin_url('edit.php'));
		}

		private static function _get_tools_page_link($query_args = array()) {
			$query_args = array_merge(array('post_type' => self::TYPE_GRANT, 'page' => self::TOOLS_PAGE_SLUG), $query_args);

			return add_query_arg($query_args, admin_url('edit.php'));
		}

		private static function _get_states() {
			include('lib/states.php');

			return isset($states) ? $states : array();
		}

		/// Template tags

		public static function get_search_form($overrides = array()) {
			$hgrant_data = shortcode_atts(array(
				'hgrant_keywords' => get_query_var('wp_hgrant_keywords'),
				'hgrant_program_area' => get_query_var(self::TAXONOMY_PROGRAM_AREA . '_id'),
				'hgrant_start_year' => get_query_var('wp_hgrant_start_year'),
				'hgrant_geo_area_type' => get_query_var('wp_hgrant_geo_area_type'),
				'hgrant_geo_area' => urldecode(get_query_var('wp_hgrant_geo_area')),
			), $overrides);

			extract($hgrant_data);

			$continents = self::_get_continents_stored();
			$countries = self::_get_countries_stored();
			$start_years = self::_get_start_years();

			$archive_link = get_post_type_archive_link(self::TYPE_GRANT);

			$geo_area_string = ($hgrant_geo_area_type && $hgrant_geo_area) ? "{$hgrant_geo_area_type}|{$hgrant_geo_area}" : '';

			ob_start();
			include('views/frontend/search.php');
			return ob_get_clean();
		}

		private static function _get_start_years() {
			global $wpdb;

			list($fiscal_year_end_month, $fiscal_year_end_day) = explode('/', wp_hgrant_get_grantor_fiscal_year_end());

			$query = $wpdb->prepare("SELECT DISTINCT YEAR(FROM_UNIXTIME(meta_value)) AS year FROM {$wpdb->postmeta} JOIN {$wpdb->posts} ON post_id = ID AND post_type = %s AND post_status = %s WHERE meta_key = %s ORDER BY year DESC", self::TYPE_GRANT, 'publish', self::META_NAME__GRANT_FISCAL_YEAR_END);
			$years = $wpdb->get_col($query);

			return $years;
		}

		//// Grantor

		///// Grantor - Basics
		public static function get_grantor_name() {
			return self::_get_settings('name');
		}

		public static function get_grantor_street_address() {
			return self::_get_settings('street_address');
		}

		public static function get_grantor_extended_address() {
			return self::_get_settings('extended_address');
		}

		public static function get_grantor_po_box() {
			return self::_get_settings('po_box');
		}

		public static function get_grantor_locality() {
			return self::_get_settings('locality');
		}

		public static function get_grantor_region() {
			$region = self::_get_settings('region');

			return '00' === $region ? self::_get_settings('region_other') : $region;
		}

		public static function get_grantor_postal_code() {
			return self::_get_settings('postal_code');
		}

		public static function get_grantor_country_name() {
			$country_code = self::_get_settings('country_name');

			$countries = self::_get_countries();

			return $countries[$country_code];
		}


		///// Grantor - Contact
		public static function get_grantor_telephone() {
			return self::_get_settings('telephone');
		}

		public static function get_grantor_email() {
			return self::_get_settings('email');
		}

		public static function get_grantor_url() {
			return self::_get_settings('url');
		}


		///// Grantor - Other
		public static function get_grantor_ein() {
			return self::_get_settings('ein');
		}

		public static function get_grantor_fiscal_year_end() {
			return self::_get_settings('fiscal_year_end');
		}

		//// Grant

		///// Grant - Basics
		public static function get_grant_id($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_id');
		}

		public static function get_grant_amount_currency($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_amount_currency');
		}

		public static function get_grant_amount_currency_symbol($grant_id) {
			$currency_code = self::_get_grant_details($grant_id, 'grant_amount_currency');
			$currencies = self::_get_currencies();

			return $currencies[$currency_code];
		}

		public static function get_grant_amount_amount($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_amount_amount');
		}

		public static function get_grant_duration_amount($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_duration_amount');
		}

		public static function get_grant_duration_period($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_duration_period');
		}

		public static function get_grant_activity($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_activity');
		}

		public static function get_grant_population_group($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_population_group');
		}

		public static function get_grant_program_areas($grant_id) {
			$grant_id = is_null($grant_id) ? get_the_ID() : $grant_id;

			return wp_get_object_terms(array($grant_id), array(self::TAXONOMY_PROGRAM_AREA), array('fields' => 'names'));
		}

		public static function get_grant_support_types($grant_id) {
			$grant_id = is_null($grant_id) ? get_the_ID() : $grant_id;

			$terms = wp_get_object_terms(array($grant_id), array(self::TAXONOMY_SUPPORT_TYPE), array('fields' => 'names'));

			if(is_wp_error($terms)) {
				return array();
			} else {
				return $terms;
			}
		}

		public static function get_grant_strategies($grant_id) {
			$grant_id = is_null($grant_id) ? get_the_ID() : $grant_id;

			$terms = wp_get_object_terms(array($grant_id), array(self::TAXONOMY_STRATEGY), array('fields' => 'names'));

			if(is_wp_error($terms)) {
				return array();
			} else {
				return $terms;
			}
		}

		public static function get_grant_initiatives($grant_id) {
			$grant_id = is_null($grant_id) ? get_the_ID() : $grant_id;

			$terms = wp_get_object_terms(array($grant_id), array(self::TAXONOMY_INITIATIVE), array('fields' => 'names'));

			if(is_wp_error($terms)) {
				return array();
			} else {
				return $terms;
			}
		}

		public static function get_grant_themes($grant_id) {
			$grant_id = is_null($grant_id) ? get_the_ID() : $grant_id;

			$terms = wp_get_object_terms(array($grant_id), array(self::TAXONOMY_THEME), array('fields' => 'names'));

			if(is_wp_error($terms)) {
				return array();
			} else {
				return $terms;
			}
		}

		///// Grant - Dates
		public static function get_grant_dtstart($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_dtstart');
		}

		public static function get_grant_dtend($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_dtend');
		}

		public static function get_grant_fiscal_year_end($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_fiscal_year_end');
		}

		///// Grant - Other
		public static function get_grant_outcome($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_outcome');
		}

		public static function get_grant_outputs($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_outputs');
		}

		public static function get_grant_challenge_grant($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_challenge_grant');
		}

		public static function get_grant_matching_grant($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_matching_grant');
		}

		public static function get_grant_continuing_support_grant($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_continuing_support_grant');
		}

		public static function get_grant_fiscal_agent($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_fiscal_agent');
		}

		public static function get_grant_shared_grant($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_shared_grant');
		}

		public static function get_grant_fund_name($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_fund_name');
		}

		public static function get_grant_fund_type($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_fund_type');
		}

		public static function get_grant_fund_subtype($grant_id) {
			return self::_get_grant_details($grant_id, 'grant_fund_subtype');
		}

		public static function get_grant_iati_flag($grant_id) {
			return 'y' === strtolower(self::_get_grant_details($grant_id, 'iati_flag')) ? 'y' : 'n';
		}

		///// Grant - Geo Areas
		public static function get_grant_geo_areas($grant_id) {
			$geo_areas = self::_get_grant_details($grant_id, 'grant_geo_areas');

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
			$countries = self::_get_countries();
			$currencies = self::_get_currencies();
			$states = self::_get_states();

			if(!is_array($geo_areas)) {
				$geo_areas = array();
			}

			$displayable_name_parts = array( 'continent', 'inter_country_region', 'country', 'intra_country_region', 'intra_state_region', 'state', 'county', 'city', 'neighborhood', );

			$sanitized = array();
			foreach($geo_areas as $geo_area) {
				$sanitized_geo_area = array();
				foreach($components as $component_key => $component_name) {
					$sanitized_geo_area[$component_key] = isset($geo_area[$component_key]) ? $geo_area[$component_key] : '';
				}
				$sanitized_geo_area['country_code'] = $geo_area['country'];
				$sanitized_geo_area['country'] = isset($countries[$geo_area['country']]) ? $countries[$geo_area['country']] : $geo_area['country'];
				$sanitized_geo_area['state_code'] = $geo_area['state'];
				$sanitized_geo_area['state'] = isset($geo_area['state']) && '00' == $geo_area['state'] && isset($geo_area['state_other']) ? $geo_area['state_other'] : (isset($states[$geo_area['state']]) ? $states[$geo_area['state']] : $geo_area['state']);

				$sanitized_geo_area['components'] = (isset($geo_area['components']) && is_array($geo_area['components'])) ? $geo_area['components'] : array();
				$sanitized_geo_area['allocation_amount_currency'] = isset($geo_area['allocation_amount_currency']) ? $geo_area['allocation_amount_currency'] : 'USD';
				$sanitized_geo_area['allocation_amount_currency_symbol'] = $currencies[$sanitized_geo_area['allocation_amount_currency']];
				$sanitized_geo_area['allocation_amount_amount_raw'] = (isset($geo_area['allocation_amount_amount']) ? $geo_area['allocation_amount_amount'] : '0.00');;
				$sanitized_geo_area['allocation_amount_amount'] = number_format_i18n(isset($geo_area['allocation_amount_amount']) ? $geo_area['allocation_amount_amount'] : '0.00', 2);
				$sanitized_geo_area['allocation_percent'] = isset($geo_area['allocation_percent']) ? $geo_area['allocation_percent'] : '0';

				$sanitized_geo_area['name_parts'] = array();
				foreach($sanitized_geo_area['components'] as $component) {
					if(isset($sanitized_geo_area[$component]) && !empty($sanitized_geo_area[$component]) && in_array($component, $displayable_name_parts)) {
						$sanitized_geo_area['name_parts'][] = $sanitized_geo_area[$component];
					}
				}

				$sanitized[] = $sanitized_geo_area;
			}

			return $sanitized;
		}


		///// Grantee - Address
		public static function get_grantee_name($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_name');
		}

		public static function get_grantee_street_address($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_street_address');
		}

		public static function get_grantee_extended_address($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_extended_address');
		}

		public static function get_grantee_po_box($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_po_box');
		}

		public static function get_grantee_locality($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_locality');
		}

		public static function get_grantee_region($grant_id) {
			$region = self::_get_grant_details($grant_id, 'grantee_region');

			return '00' === $region ? self::get_grantee_region_other($grant_id) : $region;
		}

		public static function get_grantee_region_other($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_region_other');
		}

		public static function get_grantee_postal_code($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_postal_code');
		}

		public static function get_grantee_country_name($grant_id) {
			$country_code = self::_get_grant_details($grant_id, 'grantee_country_name');

			$countries = self::_get_countries();

			return $countries[$country_code];
		}


		///// Grantee - Contact
		public static function get_grantee_telephone($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_telephone');
		}

		public static function get_grantee_email($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_email');
		}

		public static function get_grantee_url($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_url');
		}


		///// Grantee - Classification
		public static function get_grantee_type($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_type');
		}

		public static function get_grantee_population_group($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_population_group');
		}


		///// Grantee - Other
		public static function get_grantee_ein($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_ein');
		}

		public static function get_grantee_unit($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_unit');
		}

		public static function get_grantee_aka($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_aka');
		}

		public static function get_grantee_dba($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_dba');
		}

		public static function get_grantee_fka($grant_id) {
			return self::_get_grant_details($grant_id, 'grantee_fka');
		}
	}

	require_once('lib/csv.php');
	require_once('lib/template-tags.php');
	WP_hGrant::init();
}
