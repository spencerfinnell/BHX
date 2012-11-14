<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header">
			<h1 class="page-title"><span><?php post_type_archive_title(); ?></span></h1>
			<ul class="page-sorting">
				<?php if ( is_post_type_archive( 'educational' ) ) : ?>
					<?php bhx_archive_sorting( 'educational-resource-type' ); ?>
				<?php else : ?>
					<?php bhx_archive_sorting( 'visit-type' ); ?>
				<?php endif; ?>
			</ul>
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