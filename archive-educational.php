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
					<li><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_timeline' ) ) ); ?>"><?php _e( 'Interactive Timeline', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><?php _e( 'Historic Sites', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'literature', 'educational-resource-type' ); ?>"><?php _e( 'Literature', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'documentary', 'educational-resource-type' ); ?>"><?php _e( 'Documentaries', 'bhx' ); ?></a></li>
				<?php else : ?>
					<li><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_builder' ) ) ); ?>"><?php _e( 'Plan a Trip', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'tours', 'visit-type' ); ?>"><?php _e( 'Tours', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'attractions', 'visit-type' ); ?>"><?php _e( 'Attractions', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'lodging', 'visit-type' ); ?>"><?php _e( 'Lodging', 'bhx' ); ?></a></li>
					<li><a href="<?php echo get_term_link( 'restaurants', 'visit-type' ); ?>"><?php _e( 'Restaurants', 'bhx' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</div>

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>
		</div>

		<div id="pagination">
			<?php previous_posts_link(); ?>
			<?php next_posts_link(); ?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>