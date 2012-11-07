<?php
/**
 * The Template for displaying all single posts.
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>