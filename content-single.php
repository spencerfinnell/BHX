<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<div id="page-header" class="no-sorting">
	<h1 class="page-title"><span><?php the_title(); ?></span></h1>
</div>

<div id="stuff-list">
	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class( is_page( 'timeline' ) ? 'span16' : 'span14 offset1'  ); ?>>
			<div id="entry-content">
				<?php the_content(); ?>
			</div>
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>