<?php

function bhx_shop_load_single( $template ) {
	if ( ! is_singular( 'product' ) )
		return $template;

	$find     = array( 'single.php' );
	$template = locate_template( $find );

	return $template;
}
add_filter( 'template_include', 'bhx_shop_load_single', 20 );