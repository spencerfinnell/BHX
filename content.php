	<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry">
		<div class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bhx' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</div>

		<div class="entry-featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bhx' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'content-grid' ); ?></a>
		</div>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php if ( is_search() || is_post_type_archive( 'visit' ) ) : ?>
		<div class="entry-type">
			<?php if ( is_post_type_archive( 'visit' ) ) : ?>
				<?php $type = wp_get_object_terms( $post->ID, array( 'visit-type' ) ); ?>
				<a href="<?php echo get_term_link( $type[0], 'visit-type' ); ?>" class="button flat"><?php echo esc_attr( $type[0]->name ); ?></a>
				<a href="<?php echo get_term_link( $type[0], 'visit-type' ); ?>" class="all"><?php _e( 'View All', 'bhx' ); ?></a>
			<?php else : ?>
				<?php
					$post_type_obj = get_post_type_object( get_post_type() );
					$title = apply_filters( 'post_type_archive_title', $post_type_obj->labels->name );
				?>
				<a href="<?php echo get_post_type_archive_link( get_post_type() ); ?>" class="button flat"><?php echo esc_attr( $title ); ?></a>
				<a href="<?php echo get_post_type_archive_link( get_post_type() ); ?>" class="all"><?php _e( 'View All', 'bhx' ); ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
