=== Open hGrant for WordPress ===

Contributors: Mission Minded, nickohrn
Donate link:
Tags: hgrant, open hgrant, grant management, grantmaking, grant reporting
Requires at least: 3.8
Tested up to: 5.7
Stable tag: 1.1.3
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

The Open hGrant Plugin is a WordPress plugin that helps grantmakers publish and report grant data.

== Description ==

The Open hGrant Plugin is a WordPress plugin that helps grantmakers publish and report grant data from any grants management system to both their websites and to machine-readable open data initiatives, such as the Foundation Center’s <a href="http://glasspockets.org/philanthropy-in-focus/reporting-commitment-map" target="_blank">Reporting Commitment</a>.

With the Open hGrant Plugin installed, WordPress creates a new ‘grant’ post type that includes core information about each grant, and additional fields specified by the <a href="https://candid.org/use-our-data/about-our-data/hgrant" target="_blank">hGrant format</a> supported by <a href="https://candid.org/" target="_blank">Candid</a>, a leading source of information on philanthropy, fundraising, and grant programs. These posts can then be displayed on your site via a customizable, sortable, searchable index. They are also published to an independent hGrant-compatible feed. For a live example, see the grant listings on the WordPress site operated by plugin sponsor, <a href="https://haassr.org/grants/" target="_blank">The Walter & Elise Haas Fund</a>. For a description of the hGrant specification, download <a href="http://foundationcenter.org/content/download/688717/15617116/version/2/file/hGrant_Spec.pdf">this PDF</a>.

Please note that the Open hGrant Plugin is designed to automatically report published grant data to the Foundation Center and, by default, to the <a href="http://www.aidtransparency.net/" target="_blank">International Aid Transparency Initiative</a> (IATI).

For more information, including documentation, visit <a href="http://openhgrant.org/" target="_blank">http://openhgrant.org/</a>.

== Installation ==

1. Upload `wp-hgrant` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click the 'hGrants > Grantor Settings' link in the plugins row to configure the plugin

== Frequently Asked Questions ==

= This is a new plugin, our FAQ is still being developed. =

Send us your questions! In the meantime, please visit <a href="http://openhgrant.org/support-docs/" target="_blank">http://openhgrant.org/support-docs/</a> for additional information.

= Q: How do I enable the search functionality and customize the appearance of my grant listings? =
A: Move or copy the following two files from /wp-content/plugins/wp-hgrant/templates/ into your theme directory:

'archive-hgrant_grant.php'

'hgrant-content.php'

The first file replaces your default theme archive template with a customizable list layout as well as a fully-integrated search function (this file will need to be edited to match your existing theme). The second file controls the content that is returned for single grant listings.

By default, single grant listings use your theme's 'single.php' template; if you wish to customize them, create a copy of 'single.php' and name it 'single-hgrant_grant.php', and then make your modifications to that new template.

== Screenshots ==

1. Set up your organization's details on the Grantor Settings page.
2. Enter Grant data individually, or...
3. Use the Bulk Add tool to draft multiple grants into the system at a time.

== Changelog ==

= 1.1.3 =

* Properly handle UTF8 characters on CSV import

= 1.1.2 =

* Confirmed compatibility with WP 4.8. Plugin functionality is stable.

= 1.1.1 =

* Added ability to specify grants archive url base
* Added ability to specify single grant url base

= 1.1.0 =

* Added Import from CSV functionality (with full field mapping control) - see hGrants > Import CSV
* Added Feed Activation functionality - see hGrants > Tools

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.x =

Future upgrades will continue to enhance usability and add features to make the Open hGrant plugin easier to use.