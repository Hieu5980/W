<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage mobix-store
 * @since mobix-store 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mobix_store_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
    // Add the "Go to Premium" upsell section
	$wp_customize->add_section( new Mobix_Store_Upsell_Section( $wp_customize, 'upsell_premium_section', array(
		'title'       => __( 'Mobix Store', 'mobix-store' ),
		'button_text' => __( 'GO TO PREMIUM', 'mobix-store' ),
		'url'         => esc_url( MOBIX_INFULUENCER_BLOGS_BUY_NOW ),
		'priority'    => 0,
	)));

	// Add the "Bundle" upsell section
	$wp_customize->add_section( new Mobix_Store_Upsell_Section( $wp_customize, 'upsell_bundle_section', array(
		'title'       => __( 'All themes in Single Package', 'mobix-store' ),
		'button_text' => __( 'GET BUNDLE', 'mobix-store' ),
		'url'         => esc_url( MOBIX_INFULUENCER_BLOGS_BUNDLE ),
		'priority'    => 1,
	)));
}
add_action( 'customize_register', 'mobix_store_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class Mobix_Store_Upsell_Section extends WP_Customize_Section {
		public $type = 'mobix-store-upsell';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="mobix_store_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h2 class="accordion-section-title premium-details">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h2>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function mobix_store_custom_control_scripts() {
	wp_enqueue_script( 'mobix-store-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'mobix-store-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'mobix_store_custom_control_scripts' );
