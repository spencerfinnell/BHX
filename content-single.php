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
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="entry-content">
			<?php the_content(); ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>