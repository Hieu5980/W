<?php
/**
 * Plugin Name: WP SMS for WordPress
 * Description: Wordpress SMS Plugin - Send SMS Messages ,OTP & SMS notifications to users using Twilio API. Pro version, Addons and Bulk SMS available. 
 * Version: 1.5.9
 * Author: WP SMS Team
 * Author URI: https://wpsms.io
 * Text Domain: wp-twilio-core
 * Domain Path: /languages/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
define( 'TWL_CORE_VERSION', '1.5.9' );
define( 'TWL_CORE_OPTION', 'twl_option' );
define( 'TWL_CORE_OPTION_PAGE', 'twilio-options' );
define( 'TWL_CORE_SETTING', 'twilio-options' );
define( 'TWL_LOGS_OPTION', 'twl_logs' );
define( 'TWL_CORE_NOTIFICATION_OPTION', 'twl_notification_option' );
define( 'TWL_CORE_NOTIFICATION_SETTING', 'twilio-notification-options' );
define( 'TWL_CORE_NEWSLETTER_OPTION', 'twl_newsletter_option' );
define( 'TWL_CORE_NEWSLETTER_SETTING', 'twilio-newsletter-options' );

/**
 * Load Plugin Defines
*/
 
if ( !defined( 'TWL_PATH' ) ) {
    define( 'TWL_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! function_exists( 'wtc_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wtc_fs() {
        global $wtc_fs;

        if ( ! isset( $wtc_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $wtc_fs = fs_dynamic_init( array(
                'id'                  => '2894',
                'slug'                => 'wp-twilio-core',
                'type'                => 'plugin',
                'public_key'          => 'pk_41d58e132e8e380880894f44eb5ca',
                'is_premium'          => false,
                'premium_suffix'      => '',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => true,
                'has_paid_plans'      => true,
                'has_affiliation'     => 'all',
                'menu'                => array(
                    'slug'           => 'twilio-options',
                    'first-path'     => 'admin.php?page=twilio-options',
                    'support'        => false,
                ),
            ) );
        }

        return $wtc_fs;
    }

    // Init Freemius.
    wtc_fs();
    // Signal that SDK was initiated.
    do_action( 'wtc_fs_loaded' );
}
require_once TWL_PATH . 'twilio-php/src/Twilio/autoload.php';
require_once TWL_PATH . 'helpers.php';
require_once TWL_PATH . 'url-shorten.php';




//admin notices
require_once TWL_PATH . 'inc/admin-notices.php';

//Admin Options
if ( is_admin() ) {
    require_once TWL_PATH . 'admin-pages.php';
    require_once TWL_PATH . 'apps-integrations.php';
}

require_once TWL_PATH . 'hooks.php';

if ( wtc_fs()->is__premium_only() ) {
    require_once TWL_PATH . 'inc/features.php';
}

if ( wtc_fs()->is__premium_only() ) {
    require_once TWL_PATH . 'inc/features.php';
}

//Class Class
class WP_Twilio_Core
{
    private static  $instance ;
    private  $page_url ;
    private function __construct()
    {
        $this->set_page_url();
        // Init Freemius.
        wtc_fs();
        // Signal that SDK was initiated.
        do_action( 'wtc_fs_loaded' );
    }
    
    public function init()
    {
        $options = $this->get_options();
		
        // Load text domain
        add_action('init', array($this, 'load_textdomain'));
		
        if ( is_admin() ) {
            /** Settings Pages **/
            add_action( 'admin_init', array( $this, 'register_settings' ), 1000 );
            add_action( 'admin_menu', array( $this, 'admin_menu' ), 1000 );
        }
        
        /** User Profile Settings **/
        if ( isset( $options['mobile_field'] ) && $options['mobile_field'] ) {
            add_filter( 'user_contactmethods', 'twl_add_contact_item', 10 );
        }
    }
    
	
	/**
     * Load plugin textdomain.
     *
     * @since 1.0.0
     */
    public function load_textdomain()
    {
        // Compatibility with WordPress < 4.6
        if (function_exists('determine_locale')) {

            $locale = apply_filters('plugin_locale', determine_locale(), 'wp-twilio-core');

            unload_textdomain('wp-twilio-core');
            load_textdomain('wp-twilio-core', WP_LANG_DIR . '/twilio-core-' . $locale . '.mo');
        }

        load_plugin_textdomain('wp-twilio-core', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
	
	
	
    /**
     * Add the Twilio item to the Settings menu
     * @return void
     * @access public
     */
    public function admin_menu()
    {
        add_menu_page(
            __( 'WPSMS', 'wp-twilio-core' ),
            __( 'WPSMS', 'wp-twilio-core' ),
            'administrator',
            TWL_CORE_OPTION_PAGE,
            array( $this, 'display_tabs' ),
            'dashicons-email-alt',
            91
        );
		if ( wtc_fs()->is__premium_only() ) {
            add_submenu_page(
                TWL_CORE_OPTION_PAGE,
                'Newsletter',
                'Newsletter',
                'edit_posts',
                'admin.php?page=twilio-options&tab=newsletter_options',
                false,
                92
            );
            add_submenu_page(
                TWL_CORE_OPTION_PAGE,
                'Send Newsletter',
                'Send Newsletter',
                'edit_posts',
                'admin.php?page=twilio-options&tab=send_sms_newsletter',
                false,
                93
            );
            add_submenu_page(
                TWL_CORE_OPTION_PAGE,
                'Subscribers',
                'Subscribers',
                'edit_posts',
                'edit.php?post_type=twl_subscriber',
                false,
                94
            );
            add_submenu_page(
                TWL_CORE_OPTION_PAGE,
                'Groups',
                'Groups',
                'edit_posts',
                'edit-tags.php?taxonomy=twl_groups&post_type=twl_subscriber',
                false,
                95
            );
        }
    }
    
    /**
     * Determines what tab is being displayed, and executes the display of that tab
     * @return void
     * @access public
     */
    public function display_tabs()
    {
        $options = $this->get_options();
        $tabs = $this->get_tabs();
        $current = ( !isset( $_GET['tab'] ) ? sanitize_text_field( current( array_keys( $tabs ) ) ) : sanitize_text_field( $_GET['tab'] ) );
        ?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div><h2><?php 
        _e( 'WP SMS Settings', 'wp-twilio-core' );
        ?></h2>
			<h2 class="nav-tab-wrapper"><?php 
        foreach ( $tabs as $tab => $name ) {
            $classes = array( 'nav-tab', $tab );
            if ( $tab == $current ) {
                $classes[] = 'nav-tab-active';
            }
            //url escaped already
            $href = esc_url( add_query_arg( 'tab', $tab, $this->page_url ) );
            $class = implode( ' ', $classes );
            $html_tab = sprintf(
                '<a class="%s wpsmstab" href="%s"> %s </a>',
                $class,
                $href,
                esc_html( $name )
            );
            echo  wp_kses_post( $html_tab ) ;
        }
        ?>
			</h2>
			
			<div class="tabcontent">
			<?php  
				$current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
				if ( $current_tab !== 'addons' ) { ?>
			<div class="column first-column">
			<?php  
				}else { ?>
					<div class="column first-columns">
				<?php } ?>
				
				<?php 
				do_action( 'twl_display_tab', $current, $this->page_url );
				?>
			</div>
				<?php  
				if ( wtc_fs()->is_not_paying() && $current_tab !== 'addons' ) { ?>
			<div class="column promos second-column">
        
		
	<div class="wraped">
    <h1><strong><?php echo esc_html__( 'WordPress SMS Pro Features', 'wp-twilio-core' ); ?></strong></h1>
    <p><?php echo wp_kses_post( sprintf( __( 'Do you want to increase customer engagement and streamline communications for your WordPress and WooCommerce stores? Do you want to ensure your customers never miss an important update? Then you should upgrade to the Pro version of our WP SMS Plugin to unlock powerful features and enhance your messaging capabilities.', 'wp-twilio-core' ) ) ); ?></p>
    <p></p> <!-- Placeholder for additional content -->
    <h3> <span class="dashicons dashicons-sos"></span> <strong><?php echo esc_html__( 'License', 'wp-twilio-core' ); ?></strong>: <?php echo esc_html__( 'Free Version', 'wp-twilio-core' ); ?></h3>
    <p><?php echo wp_kses_post( sprintf( __( 'You are using our %1$sFREE%2$s version of WP SMS. Here are the features you will get access to if you upgrade to the %1$sPRO%2$s version for only %1$s$29%2$s :', 'wp-twilio-core' ), '<strong>', '</strong>' ) ); ?></p>
    <ol>
         <li><strong><?php _e( 'Bulk Messaging:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Send SMS to multiple recipients at once, saving time and effort.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'Automated Notifications:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Set up automatic SMS alerts for key events like new orders or user registrations.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'Customizable Templates:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Create and use personalized SMS templates for different occasions.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'WooCommerce Integration:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Seamlessly integrate with WooCommerce to enhance your store\'s communication capabilities.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'Priority Support:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Access our premium support team for faster resolutions and dedicated assistance.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'Enforce SMS Marketing:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Empower your marketing efforts with targeted SMS campaigns.', 'wp-twilio-core' ); ?></li>
        <li><strong><?php _e( 'SMS Newsletter Widget:', 'wp-twilio-core' ); ?></strong> <?php _e( 'Easily add an SMS subscription widget to engage users directly through SMS.', 'wp-twilio-core' ); ?></li>
    </ol>
    <?php $upgrade_label = esc_html__( 'Upgrade to PRO!', 'wp-twilio-core' );?>

        <a class="button button-primary greeno" href="<?php echo esc_url( wtc_fs()->get_upgrade_url() ); ?>">
            <span class="dashicons dashicons-cart"></span>
            <strong><?php echo esc_html( $upgrade_label ); ?></strong> 
        </a>
		<span class="button button-primary circlo"> Or </span>
        <a class="button blueo" target="blank"  href="https://wpsms.io/bundle-package/" title="<?php echo esc_attr__( 'Reserved Only for Pro users', 'wp-twilio-core' ); ?>">
            <?php echo esc_html__( 'Get All for Only $49', 'wp-twilio-core' ); ?>
        </a>
		</div>

			</div>
				<?php }  ?>
		</div>
			
		</div>
		<?php 
    }
    
    /**
     * Saves the URL of the plugin settings page into the class property
     * @return void
     * @access public
     */
    public function set_page_url()
    {
        $base = admin_url( 'admin.php' );
        $this->page_url = add_query_arg( 'page', TWL_CORE_OPTION_PAGE, $base );
    }
    
    /**
     * Returns an array of settings tabs, extensible via a filter
     * @return void
     * @access public
     */
    public function get_tabs()
    {
        $default_tabs = array(
            'general'       => __( 'Settings', 'wp-twilio-core' ),
            'logs'          => __( 'Logs', 'wp-twilio-core' ),
            'test'          => __( 'Test', 'wp-twilio-core' ),
            'notifications' => __( 'Notifications', 'wp-twilio-core' ),
            'addons'        => __( 'Apps & Integrations', 'wp-twilio-core' ),
        );
        return apply_filters( 'twl_settings_tabs', $default_tabs );
    }
    
    /**
     * Register/Whitelist our settings on the settings page, allow extensions and other plugins to hook into this
     * @return void
     * @access public
     */
    public function register_settings()
    {
        register_setting( TWL_CORE_SETTING, TWL_CORE_OPTION, 'twl_sanitize_option' );
        do_action( 'twl_register_additional_settings' );
        register_setting( TWL_CORE_NOTIFICATION_SETTING, TWL_CORE_NOTIFICATION_OPTION, 'twl_sanitize_option' );
        register_setting( TWL_CORE_NEWSLETTER_SETTING, TWL_CORE_NEWSLETTER_OPTION, 'twl_sanitize_option' );
        do_action( 'twl_register_additional_settings' );
    }
    
    /**
     * Original get_options unifier
     * @return array List of options
     * @access public
     */
    public function get_options()
    {
        return twl_get_options();
    }
    
    /**
     * Get the singleton instance of our plugin
     * @return class The Instance
     * @access public
     */
    public static function get_instance()
    {
        if ( !self::$instance ) {
            self::$instance = new WP_Twilio_Core();
        }
        return self::$instance;
    }
    
    /**
     * Adds the options to the options table
     * @return void
     * @access public
     */
    public static function plugin_activated()
    {
        add_option( TWL_CORE_OPTION, twl_get_defaults() );
        add_option( TWL_LOGS_OPTION, '' );
        add_option( TWL_CORE_NOTIFICATION_OPTION, twl_get_notification_defaults() );
		if ( wtc_fs()->is__premium_only() ) {
            add_option( TWL_CORE_NEWSLETTER_OPTION, twl_get_newsletter_defaults() );
        }
    }
    
    /**
     * Deletes the options to the options table
     * @return void
     * @access public
     */
    public static function plugin_uninstalled()
    {
        delete_option( TWL_CORE_OPTION );
        delete_option( TWL_LOGS_OPTION );
        delete_option( TWL_CORE_NOTIFICATION_OPTION );
    }

}
$twl_instance = WP_Twilio_Core::get_instance();
add_action( 'plugins_loaded', array( $twl_instance, 'init' ) );
register_activation_hook( __FILE__, array( 'WP_Twilio_Core', 'plugin_activated' ) );
wtc_fs()->add_action( 'after_uninstall', array( 'WP_Twilio_Core', 'plugin_uninstalled' ) );
// Admin notices
// Load notice css
add_action( 'admin_enqueue_scripts', 'notice_admin_css' );
function notice_admin_css()
{
    wp_enqueue_style( 'admin_css', plugins_url( 'assets/css/admin.css', __FILE__ ) );
}