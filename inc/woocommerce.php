<?php
/**
 * WooCommerce Functionality
 *
 * Anything that has to do with the WooCommerce eCommerce plugin.
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Single Template
 *
 * WooCommerce tries to load a single-product.php,
 * but that is the same as our single.php. After they think
 * they have it, lets set tehm straight and load the correct thing.
 *
 * @since BXH 1.0
 *
 * @param string $template The current loaded template
 * @return string $template The new template to load
 */
function bhx_shop_load_single( $template ) {
	if ( ! is_singular( 'product' ) )
		return $template;

	$find     = array( 'single.php' );
	$template = locate_template( $find );

	return $template;
}
add_filter( 'template_include', 'bhx_shop_load_single', 20 );