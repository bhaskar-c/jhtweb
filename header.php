<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Generate
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.jpg">
<?php 
wp_head();
//$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
?>
</head>

<body itemtype="http://schema.org/WebPage" itemscope="itemscope" <?php body_class(); ?>>
	<?php //do_action( 'generate_before_header' ); ?>
	<header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" role="banner" <?php generate_header_class(); ?>>
		<div <?php generate_inside_header_class(); ?>>
			<?php do_action( 'generate_before_header_content'); ?>
			
			<?php if ( is_active_sidebar('header') ) : ?>
				<div class="header-widget">
					<?php dynamic_sidebar( 'header' ); ?>
				</div>
			<?php endif; // end sidebar widget area ?>
		
		
				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" width="385" height="135" />
					</a>
				</div>

			<?php //do_action( 'generate_after_header_content'); ?>
		</div><!-- .inside-header -->
	</header><!-- #masthead -->
	<?php do_action( 'generate_after_header' ); ?>
	
	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">