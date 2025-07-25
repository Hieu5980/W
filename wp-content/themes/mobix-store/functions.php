<?php
/**
 * Mobix Store functions
 */

//Admin css
	add_editor_style( array( 'assets/css/admin.css' ) );

if ( ! function_exists( 'mobix_store_setup' ) ) :
function mobix_store_setup() {
    load_theme_textdomain( 'mobix-store', get_template_directory() . '/languages' );

	// Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'mobix_store_custom_background_args', array(
	    'default-color' => 'ffffff',
	    'default-image' => '',
    ) ) );

	 /**
	 * About Theme Function
	 */
	require get_theme_file_path( '/about-theme/about-theme.php' );

	/**
	 * Customizer
	 */
	require get_template_directory() . '/inc/customizer.php';

}
endif; 
add_action( 'after_setup_theme', 'mobix_store_setup' );

if ( ! function_exists( 'mobix_store_styles' ) ) :
	function mobix_store_styles() {
		// Register theme stylesheet.
		wp_register_style('mobix-store-style',
			get_template_directory_uri() . '/style.css',array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'mobix-store-style' );

		wp_style_add_data( 'mobix-store-style', 'rtl', 'replace' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'mobix_store_styles' );