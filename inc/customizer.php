<?php
/**
 * GeneratePress Customizer
 *
 * @package Generate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action( 'customize_register', 'generate_customize_register' );
function generate_customize_register( $wp_customize ) {

	$defaults = generate_get_defaults();

	// Load custom controls
	require_once GENERATE_DIR . '/inc/controls.php';
	require_once GENERATE_DIR . '/inc/sanitize.php';
	

/**
 * Heading area
 *
 * Since 0.1
 **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class GenerateLabelControl extends WP_Customize_Control {
        public $type = 'label';
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'generate' ) );
            parent::__construct( $manager, $id, $args );
        }
 
        public function render_content() {
            echo '<span class="generate_customize_label">' . esc_html( $this->label ) . '</span>';
        }
    }
 
}

/**
 * Class Generate_Customize_Misc_Control
 *
 * Control for adding arbitrary HTML to a Customizer section.
 *
 * @since 1.0.7
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Generate_Customize_Misc_Control extends WP_Customize_Control {
		public $settings = 'blogname';
		public $description = '';
		public $url = '';
		public $group = '';

		public function render_content() {
			switch ( $this->type ) {
				default:
				case 'text' :
					echo '<p class="description">' . $this->description . '</p>';
					break;

				case 'addon':
					echo '<span class="get-addon">' . sprintf(
								'<a href="%1$s" target="_blank">%2$s</a>',
								esc_url( $this->url ),
								'Addon available'
							) . '</span>';
					echo '<p class="description" style="margin-top:5px;">' . $this->description . '</p>';
					break;
					
				case 'line' :
					echo '<hr />';
					break;
			}
		}
	}
}



}