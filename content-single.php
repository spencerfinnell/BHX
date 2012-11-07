<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<div id="page-header" <?php echo ! is_singular( 'product' ) ? ' class="no-sorting"' : null; ?>>
	<h1 class="page-title"><span><?php the_title(); ?></span></h1>

	<?php if ( is_singular( 'product' ) ) : ?>
		<span class="page-meta"><?php woocommerce_breadcrumb( array( 'wrap_before' => '', 'wrap_after' => '' ) ); ?>
	<?php endif; ?>
</div>

<?php if ( has_post_thumbnail() ) : ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
	<div class="featured-hero" style="background-image: url(<?php echo $image[0]; ?>);">
		<a class="fancybox" href="<?php echo esc_url( $image[0] ); ?>"><?php the_post_thumbnail(); ?></a>
		<div class="target"></div>
	</div>
<?php endif; ?>

<script>
jQuery(document).ready(function($) {
	$( '.target' ).blurjs({
		radius : 30,
		source: '.featured-hero'
	});
});
</script>


<article id="post-<?php the_ID(); ?>" <?php post_class( array( $post->post_name, is_page( 'timeline' ) ? '' : 'page' ) ); ?>>
	<div id="entry-content">
		<?php the_content(); ?>

		<?php if ( is_singular( 'product' ) ) : ?>
			<?php woocommerce_template_single_add_to_cart(); ?>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->