<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<div id="page-header" class="no-sorting">
	<h1 class="page-title"><span><?php the_title(); ?></span></h1>
</div>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
<div class="featured-hero" style="background-image: url(<?php echo $image[0]; ?>);">
	<a class="fancybox" href="<?php echo esc_url( $image[0] ); ?>"><?php the_post_thumbnail(); ?></a>
	<div class="target"></div>
</div>

<script>
jQuery(document).ready(function($) {
	$( '.target' ).blurjs({
		radius : 30,
		source: '.featured-hero'
	});
});
</script>

<div id="stuff-list">
	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class( array( $post->post_name, is_page( 'timeline' ) ? 'span16' : 'span14 offset1' ) ); ?>>
			<div id="entry-content">
				<?php the_content(); ?>
			</div>
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>