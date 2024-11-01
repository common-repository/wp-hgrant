<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
					else :
						_e( 'Archives', 'twentythirteen' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php if(function_exists('wp_hgrant_the_search_form')) { ?>

			<div class="entry-content">
				 <?php wp_hgrant_the_search_form(); ?>
			</div>

			<?php } ?>

			<style type="text/css">
			.wp-hgrant-grants-table #termlist {	padding: 0; list-style: none; display: inline; }
			</style>

			<div class="entry-content">
				<table class="wp-hgrant-grants-table">
					<thead>
						<tr valign="top">
							<th scope="col" width="25%" class="wp-hgrant-grants-table-column-title"><?php _e('Title'); ?></th>
							<th scope="col" width="25%" class="wp-hgrant-grants-table-column-regions"><?php _e('Serving'); ?></th>
							<th scope="col" width="15%" class="wp-hgrant-grants-table-column-start"><?php _e('Start&nbsp;Date'); ?></th>
							<th scope="col" width="20%" class="wp-hgrant-grants-table-column-program-areas"><?php _e('Program&nbsp;Areas'); ?></th>
							<th scope="col" width="15%" class="wp-hgrant-grants-table-column-amount"><?php _e('Amount'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php /* The loop */ ?>

						<?php while ( have_posts() ) : the_post(); ?>
						<tr valign="top">
							<td class="wp-hgrant-grants-table-column-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</td>

							<td class="wp-hgrant-grants-table-column-regions">
								<?php
								$serving = array();
								foreach(wp_hgrant_get_grant_geo_areas() as $geo_area) {
									$serving[] = trim(current($geo_area['name_parts']));
									break;
								}
								echo implode('<br />', array_filter($serving));
								?>
							</td>

							<td class="wp-hgrant-grants-table-column-start">
								<?php echo wp_hgrant_get_grant_dtstart(); ?>
							</td>

							<td class="wp-hgrant-grants-table-column-program-areas">
								<?php
								$taxonomy = 'hgrant_program_area';
								$post_terms = wp_get_object_terms( get_the_ID(), $taxonomy, array( 'fields' => 'ids' ) );
								$separator = ', ';
								if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
									$term_ids = implode( ', ' , $post_terms );
									$terms = wp_list_categories( 'title_li=&style=none&echo=0&exclude=1&depth=1&taxonomy=' . $taxonomy . '&include=' . $term_ids );
									$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
									echo '<p>' . $terms . '</p>';
								}
								?>
							</td>

							<td class="wp-hgrant-grants-table-column-amount">
								<?php echo wp_hgrant_get_grant_amount_currency_symbol() . number_format_i18n(wp_hgrant_get_grant_amount_amount()); ?>
							</td>
						</tr>
						<?php endwhile; ?>

						<?php /* The loop */ ?>
					</tbody>
				</table>
			</div>

			<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
			<nav class="navigation paging-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
				<div class="nav-links">

					<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Next page' ) ); ?></div>
					<?php endif; ?>

					<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Previous page <span class="meta-nav">&rarr;</span>' ) ); ?></div>
					<?php endif; ?>

				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php } ?>

		<?php else : ?>
			<?php if(function_exists('wp_hgrant_the_search_form')) { wp_hgrant_the_search_form(); } ?>

			<div class="entry-content">
				<p><?php _e('No results found'); ?></p>
			</div>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>