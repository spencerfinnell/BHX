<?php
/**
 * BHX functions and definitions
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since BHX 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'bhx_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since BHX 1.0
 */
function bhx_setup() {
	/**
	 * Translation, if needed (isn't)
	 */
	load_theme_textdomain( 'bhx', get_template_directory() . '/languages' );
	
	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bhx' ),
	) );
}
endif; // bhx_setup
add_action( 'after_setup_theme', 'bhx_setup' );

/**
 * Enqueue scripts and styles
 */
function bhx_scripts() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.min.js' );

	if ( is_home() )
		wp_enqueue_script( 'jcarousellite', get_template_directory_uri() . '/js/jcarousellite.min.js' );

	wp_enqueue_script( 'bhx', get_template_directory_uri() . '/js/bhx.js' );
}
add_action( 'wp_enqueue_scripts', 'bhx_scripts' );
