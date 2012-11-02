<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package BHX
 * @since BHX 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<hgroup id="branding">
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			<nav id="access">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>
		</div>
	</header><!-- #masthead -->

	<div id="hero">
		<ul id="actions">
			<li><a href="<?php echo get_post_type_archive_link( 'educational' ); ?>" data-section="#section-educate" class="educate fancybox"><span><i data-icon="&#x28;"></i></span> Educate</a>
			<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>" class="sites"><span><i data-icon="&#x27;"></i></span> Sites</a>
			<li><a href="<?php echo get_post_type_archive_link( 'visit' ); ?>" data-section="#section-visit" class="visit fancybox"><span><i data-icon="&#x23;"></i></span> Visit</a>
			<li><a href="#" class="store"><span><i data-icon="&#x26;"></i></span> Store</a>
		</ul>

		<img src="<?php echo get_template_directory_uri(); ?>/images/hero.jpg" alt="" />
	</div>

	<div id="section-educate" class="section-modal">
		<ul id="sections">
			<li><a href="<?php echo get_permalink( get_page_by_title( 'Interactive Timeline' ) ); ?>"><i class="icon-share"></i> Timeline</a></li>
			<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><i class="icon-picture"></i> Historic Sites</a></li>
			<li><a href="<?php echo get_term_link( 'literature', 'educational-resource-type' ); ?>"><i class="icon-newspaper"></i> Literature</a></li>
			<li><a href="<?php echo get_term_link( 'documentary', 'educational-resource-type' ); ?>"><i class="icon-mic"></i> Documentaries</a></li>
		</ul>
	</div>

	<div id="section-visit" class="section-modal">
		<ul id="sections">
			<li class="full"><a href="#"><i class="icon-attachment"></i> Build a Trip</a></li>
			<li class="fake"></li>
			<li><a href="<?php echo get_term_link( 'tours', 'visit-type' ); ?>"><i class="icon-pin"></i> Tours</a></li>
			<li><a href="<?php echo get_term_link( 'attractions', 'visit-type' ); ?>"><i class="icon-rocket"></i> Attractions</a></li>
			<li><a href="<?php echo get_term_link( 'lodging', 'visit-type' ); ?>"><i class="icon-home"></i> Lodging</a></li>
			<li><a href="<?php echo get_term_link( 'restaurants', 'visit-type' ); ?>"><i class="icon-coffee"></i> Restaurants</a></li>
		</ul>
	</div>

	<div id="wrapper" class="container">
		<div id="content" role="main">