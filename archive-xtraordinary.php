<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header" class="no-soriting">
			<h1 class="page-title"><span><?php post_type_archive_title(); ?></span></h1>
		</div>

		<article id="post-11" class="post-11 page type-page status-publish hentry about inner-page">
			<div id="entry-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<h3><?php the_title(); ?></h3>

					<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'size-thumbnail alignleft' ) ); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>	
			</div>
		</article>

	<?php else : ?>
		<?php get_template_part( 'no-results', 'search' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>