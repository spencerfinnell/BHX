<?php
/**
 * The template for displaying search forms in BHX
 *
 * @package BHX
 * @since BHX 1.0
 */
?>

	<form method="get" id="searchform" class="row" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" name="s" class="span4" value="<?php echo esc_attr( get_search_query() ); ?>" />
		<input type="submit" name="submit" class="span2" value="<?php esc_attr_e( 'Search', 'bhx' ); ?>" />
	</form>