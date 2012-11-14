<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

global $wp_query;

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header">
			<h1 class="page-title"><span><?php echo is_post_type_archive() ? post_type_archive_title() : single_term_title(); ?></span></h1>
			<ul class="page-sorting">
				<?php bhx_archive_sorting_sites(); ?>
			</ul>

			<?php get_search_form(); ?>
		</div>

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content' ); ?>
			<?php endwhile; ?>
		</div>

		<?php bhx_pagination(); ?>

	<?php else : ?>
		<?php get_template_part( 'no-results', 'search' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>