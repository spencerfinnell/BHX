<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header" class="no-sorting">
			<h1 class="page-title"><span>&#8220;<?php echo get_search_query(); ?>&#8221;</span></h1>
			
			<?php get_search_form(); ?>
		</div>

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'grid' ); ?>
			<?php endwhile; ?>
		</div>

		<?php bhx_pagination(); ?>

	<?php else : ?>
		<?php get_template_part( 'no-results', 'search' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>