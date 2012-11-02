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
				<li><a href="#">Timeline</a></li>
				<li><a href="#">Historic Sites</a></li>
				<li><a href="#">Literature</a></li>
				<li><a href="#">Documentaries</a></li>
				<?php else : ?>
				<li><a href="#">Build a Trip</a></li>
				<li><a href="#">Tours</a></li>
				<li><a href="#">Attractions</a></li>
				<li><a href="#">Lodging</a></li>
				<li><a href="#">Restaurants</a></li>
				<?php endif; ?>
			</ul>
		</div>

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'grid' ); ?>

			<?php endwhile; ?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>