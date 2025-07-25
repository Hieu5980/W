<?php
/**
 * Nodicwp Notice Handler
 */

defined( 'ABSPATH' ) || exit;

define('MOBIX_INFULUENCER_BLOGS_PREMIUM_DOCUMENTATION',__('https://www.nordicwptheme.com/Documentation/','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_SUPPORT',__('https://wordpress.org/support/theme/mobix-store/','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_REVIEW',__('https://wordpress.org/support/theme/mobix-store/reviews/#new-post','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_BUY_NOW',__('https://www.nordicwptheme.com/product/mobix-pro-wordpress-theme-for-multipurpose/','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_DOC_URL',__('https://www.nordicwptheme.com/Documentation/','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_LIVE_DEMO',__('https://nordicwptheme.se/mobix/','mobix-store'));
define('MOBIX_INFULUENCER_BLOGS_BUNDLE',__('https://www.nordicwptheme.com/product/all-premium-wordpress-themes-for-multipurpose/','mobix-store'));
/**
 * Admin Hook
 */
function mobix_store_admin_menu_page() {
    $mobix_store_theme = wp_get_theme( get_template() );

    add_theme_page(
        $mobix_store_theme->display( 'Name' ),
        $mobix_store_theme->display( 'Name' ),
        'manage_options',
        'mobix-store',
        'mobix_store_do_admin_page'
    );
}
add_action( 'admin_menu', 'mobix_store_admin_menu_page' );

/**
 * Enqueue getting started styles and scripts
 */
function nodicwp_widgets_backend_enqueue() {
    wp_enqueue_style( 'nodicwp-getting-started', get_template_directory_uri() . '/about-theme/about-theme.css' );
}
add_action( 'admin_enqueue_scripts', 'nodicwp_widgets_backend_enqueue' );

/**
 * Class Nodicwp_Notice_Handler
 */
class Nodicwp_Notice_Handler {

    public static $nonce;

    /**
     * Empty Constructor
     */
    public function __construct() {
        // Activation notice
        add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
        add_action( 'admin_init', array( $this, 'getting_started_notice_dismissed' ) );
        add_action( 'admin_notices', array( $this, 'nodicwp_theme_info_welcome_admin_notice' ), 3 );
        add_action( 'wp_ajax_nodicwp_getting_started', array( $this, 'nodicwp_getting_started' ) );
    }

    /**
     * Display an admin notice linking to the about page
     */
    public function nodicwp_theme_info_welcome_admin_notice() {

    $current_screen = get_current_screen();

    $mobix_store_theme = wp_get_theme();
    if ( is_admin() && ! get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) && $current_screen->base != 'appearance_page_mobix-store' ) {
        echo '<div class="updated notice notice-success is-dismissible getting-started">';
        echo '<p><strong>' . sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s.', 'mobix-store' ), esc_html( $mobix_store_theme->get( 'Name' ) ) ) . '</strong></p>';
        echo '<p class="plugin-notice">' . esc_html__( 'By clicking "Get Started," you can access our theme features.', 'mobix-store' ) . '</p>';
        echo '<div class="nodicwp-buttons">';
        echo '<p><a href="' . esc_url(admin_url('themes.php?page=mobix-store')) . '" class="nodicwp-install-plugins button button-primary">' . sprintf( esc_html__( 'Get started with %s', 'mobix-store' ), esc_html( $mobix_store_theme->get( 'Name' ) ) ) . '</a></p>';
        echo '<p><a href="' . esc_url( MOBIX_INFULUENCER_BLOGS_BUY_NOW ) . '" class="button button-secondary" target="_blank">' . esc_html__( 'GO FOR PREMIUM', 'mobix-store' ) . '</a></p>';
        echo '</div>';
        echo '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss">Dismiss</a>';
        echo '</div>';
    }
}

    /**
     * Register dismissal of the getting started notification.
     * Acts on the dismiss link.
     * If clicked, the admin notice disappears and will no longer be visible to this user.
     */
    public function getting_started_notice_dismissed() {
        if ( isset( $_GET['gs-notice-dismissed'] ) ) {
            add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
        }
    }

    /**
     * Deletes the getting started notice's dismiss status upon theme switch.
     */
    public function flush_dismiss_status() {
        delete_user_meta( get_current_user_id(), 'gs_notice_dismissed' );
    }
}
new Nodicwp_Notice_Handler();

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function mobix_store_do_admin_page() { 
    $mobix_store_theme = wp_get_theme(); ?>
    <div class="mobix-store-themeinfo-page--wrapper">
        <div class="free&pro">
            <div id="mobix-store-admin-about-page-1">
                <div class="theme-detail">
                   <div class="mobix-store-admin-card-header-1">
                    <div class="mobix-store-header-left">
                        <h2>
                            <?php echo esc_html( $mobix_store_theme->Name ); ?> <span><?php echo esc_html($mobix_store_theme['Version']);?></span>
                        </h2>
                        <p>
                            <?php
                            echo wp_kses_post( apply_filters( 'nodicwp_theme_description', esc_html( $mobix_store_theme->get( 'Description' ) ) ) );
                        ?>
                        </p>
                    </div>
                    <div class="mobix-store-header-right">
                        <div class="mobix-store-pro-button">
                            <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_BUY_NOW ); ?>" class="mobix-store-button button-primary" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'UPGRADE TO PREMIUM', 'mobix-store' ); ?>
                            </a>
                        </div>
                    </div>
                </div>   
                </div>   
                <div class="mobix-store-features">
                    <div class="mobix-store-features-box">
                        <h3><?php esc_html_e( 'PREMIUM Theme', 'mobix-store' ); ?></h3>
                        <p><?php esc_html_e( 'Easily build and personalize your website with the Gutenberg editor—just drag, drop, and arrange text, images, and other elements. No coding needed, perfect for all skill levels.', 'mobix-store' ); ?></p>
                        <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_LIVE_DEMO ); ?>" class="mobix-store-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DEMONSTRATION', 'mobix-store' ); ?>
                            </a>
                    </div>
                    <div class="mobix-store-features-box">
                        <h3><?php esc_html_e( 'REVIEWS', 'mobix-store' ); ?></h3>
                        <p><?php esc_html_e( 'We sincerely welcome your thoughts and feedback. Your evaluation is important to us, as it helps us enhance our services, refine our offerings, and better meet your needs.', 'mobix-store' ); ?></p>
                        <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_REVIEW ); ?>" class="mobix-store-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'REVIEWS', 'mobix-store' ); ?>
                            </a>
                    </div>
                    <div class="mobix-store-features-box">
                        <h3><?php esc_html_e( ' INSTRUCTION', 'mobix-store' ); ?></h3>
                        <p><?php esc_html_e( 'If you need help configuring and setting up the theme, our step-by-step tutorial is here to guide you. It’s a quick and easy way to get your theme up and running.', 'mobix-store' ); ?></p>
                        <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_DOC_URL ); ?>" class="mobix-store-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DOCUMENTATION', 'mobix-store' ); ?>
                            </a>
                    </div>
                    <div class="mobix-store-features-box">
                        <h3><?php esc_html_e( '24/7 SUPPORT', 'mobix-store' ); ?></h3>
                        <p><?php esc_html_e( 'If you need any help installing our Lite theme, don’t hesitate to reach out to our support team—we’re here and ready to assist you!', 'mobix-store' ); ?></p>
                        <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_SUPPORT ); ?>" class="mobix-store-button button-secondary-1" target="_blank" rel="noreferrer">
                            <?php esc_html_e( 'SUPPORT', 'mobix-store' ); ?>
                        </a>
                    </div>
                </div>   
            </div>
            <div id="mobix-store-admin-about-page-2">
                <div class="theme-detail">
                   <div class="mobix-store-admin-card-header-1">
                        <div class="mobix-store-header-left-pro"> 
                            <h2><?php esc_html_e( 'Upgrade to the premium version of this theme to unlock advanced features and take your website to the next level.', 'mobix-store' ); ?></h2>
                        </div>
                        <div class="mobix-store-header-right-2">
                            <div class="mobix-store-pro-button">
                                <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_BUY_NOW ); ?>" class="mobix-store-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'GO TO PREMIUM', 'mobix-store' ); ?>
                                </a>
                            </div>
                            <div class="mobix-store-pro-button">
                                <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_LIVE_DEMO ); ?>" class="mobix-store-button button-primary-1 pro-demo" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PREMIUM DEMO', 'mobix-store' ); ?>
                                </a>
                            </div>
                            <div class="mobix-store-pro-button">
                                <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_PREMIUM_DOCUMENTATION ); ?>" class="mobix-store-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PRO DOCUMENTATION', 'mobix-store' ); ?>
                                </a>
                            </div>  
                            <div class="mobix-store-pro-button">
                                <a href="<?php echo esc_url( MOBIX_INFULUENCER_BLOGS_SUPPORT ); ?>" class="mobix-store-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'SUPPORT', 'mobix-store' ); ?>
                                </a>
                            </div>  
                        </div>
                    </div>
                    <div class="mobix-store-admin-card-header-2">
                        <img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $mobix_store_theme->get_screenshot() ); ?>" />
                    </div> 
                </div>    
            </div>
        </div>
    </div>
<?php } ?>