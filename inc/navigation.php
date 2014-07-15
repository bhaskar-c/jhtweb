<?php
/**
 * Generate the navigation based on settings
 * @since 0.1
 */
add_action( 'generate_after_header', 'generate_add_navigation_after_header', 5 );
function generate_add_navigation_after_header()
{
	$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
	
	if ( 'nav-below-header' == $generate_settings['nav_position_setting'] ) :
		generate_navigation_position();
	endif;
	
}
add_action( 'generate_before_header', 'generate_add_navigation_before_header', 5 );
function generate_add_navigation_before_header()
{
	$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
	
	if ( 'nav-above-header' == $generate_settings['nav_position_setting'] ) :
		generate_navigation_position();
	endif;
	
}
add_action( 'generate_before_header_content', 'generate_add_navigation_float_right', 5 );
function generate_add_navigation_float_right()
{
	$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
	
	if ( 'nav-float-right' == $generate_settings['nav_position_setting'] ) :
		generate_navigation_position();
	endif;
	
}
add_action( 'generate_before_right_sidebar_content', 'generate_add_navigation_before_right_sidebar', 5 );
function generate_add_navigation_before_right_sidebar()
{
	$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
	
	if ( 'nav-right-sidebar' == $generate_settings['nav_position_setting'] ) :
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	endif;
	
}
add_action( 'generate_before_left_sidebar_content', 'generate_add_navigation_before_left_sidebar', 5 );
function generate_add_navigation_before_left_sidebar()
{
	$generate_settings = get_option( 'generate_settings', generate_get_defaults() );
	
	if ( 'nav-left-sidebar' == $generate_settings['nav_position_setting'] ) :
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	endif;
	
}
function generate_navigation_position()
{
	?>
	<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" role="navigation" <?php generate_navigation_class(); ?>>
		<div class="inside-navigation grid-container grid-parent">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'generate' ); ?></h3>
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'generate' ); ?>"><?php _e( 'Skip to content', 'generate' ); ?></a></div>
				<div class="main-nav">
					<ul <?php generate_menu_class(); ?>>
						<?php 
						if ( has_nav_menu( 'primary' ) ) :
							wp_nav_menu( array( 
								'theme_location' => 'primary',
								'container_class' => 'main-nav',
								'menu_class' => 'menu',
								'items_wrap' => '%3$s'
							) );
						else :
							wp_list_pages('sort_column=menu_order&title_li=');
						endif;
						?>
					</ul>
				</div><!-- .main-nav -->
		</div><!-- .inside-navigation -->
	</nav><!-- #site-navigation -->
	<?php
}