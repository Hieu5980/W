<?php

/**
 * Register all admin notices
 * @since    1.3.0
 */
 
 
 
 
//WPSMS Pro Notice
function wpsmspro_plugin_notice() {
	
	global $current_user;
	
	$user_id = $current_user->ID;
	
	if (!get_user_meta($user_id, 'wpsmspro_plugin_notice_ignore')) {

	if ( wtc_fs()->is_not_paying() ) {
        ?>
	 
	 	<div class="notice  wpsms-message">
			<div class="wpsms-message-inner">
				<div class="wpsms-message-icon">
				</div>
				<div class="wpsms-premium-icon">
				</div>
				<div class="wpsms-message-content">
				<h2 class="wptwilioskin"><?php 
        echo  sprintf( esc_html__( 'WordPress SMS BULK,SMS Newsletter & Awesome Premium Features' ) ) ;
        ?></h2>
					<p><?php 
        echo  __( 'Extend the WPSMS with powerful features.', 'wp-twilio-core' ) ;
        ?> <a href="<?php 
        echo  wtc_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade Now.', 'wp-twilio-core' ) ;
        ?></a></p>
					<p class="wpsms-message-actions">
						<a href="<?php 
        echo  wtc_fs()->get_upgrade_url() ;
        ?>" class="button button-primary"><?php 
        echo  __( 'Upgrade Now', 'wp-twilio-core' ) ;
        ?></a>
				<a href="?wpsms-dismised-notice" class="button button-secondary"><?php 
        echo  __( 'Dismiss', 'wp-twilio-core' ) ;
        ?></a>

					</p>
				</div>
			</div>
	</div>
	 
	 
       <?php 
		}

	}

}

//WPSMS Pro Dismiss notice	
function wpsmspro_plugin_notice_ignore() {
	
	global $current_user;
	
	$user_id = $current_user->ID;
	
	if (isset($_GET['wpsms-dismised-notice'])) {
		
		add_user_meta($user_id, 'wpsmspro_plugin_notice_ignore', 'true', true);
		
	}
	
}
add_action('admin_init', 'wpsmspro_plugin_notice_ignore');






//WPSMS Pro Notice
function wpsmsadforest_plugin_notice() {
	
	global $current_user;
	 $addonws_url = admin_url( 'admin.php?page=twilio-options-addons' );
	$user_id = $current_user->ID;
	
	if (!get_user_meta($user_id, 'wpsmsadforest_plugin_notice_ignore')) {

        ?>
	 
	 	<div class="notice  wpsms-message">
			<div class="wpsms-message-inner">
				<div class="wpsms-message-icon">
				</div>
				<div class="wpsms-adforest-icon">
				</div>
				<div class="wpsms-message-content">
				<h2 class="wptwilioskin"><?php 
        echo  sprintf( esc_html__( 'WP SMS for AdForest Theme' ) ) ;
        ?></h2>
					<p><?php 
        echo  __( 'Using this addon, Your ad sellers will receive SMS as a notification when they are contacted on their listings\' contact forms.', 'wp-twilio-core' ) ;
        ?> <a href="<?php 
         echo  esc_url($addonws_url) ;
        ?>"><?php 
        echo  __( 'Check it out.', 'wp-twilio-core' ) ;
        ?></a></p>
					<p class="wpsms-message-actions">
						<a href="<?php 
        echo  esc_url($addonws_url) ;
        ?>" class="button button-primary"><?php 
        echo  __( 'Awesome,Let me see', 'wp-twilio-core' ) ;
        ?></a>
				<a href="?wpsms-adforest-dismised-notice" class="button button-secondary"><?php 
        echo  __( 'Dismiss', 'wp-twilio-core' ) ;
        ?></a>

					</p>
				</div>
			</div>
	</div>
	 
	 
       <?php 


	}

}



//WPSMS Adforest Dismiss notice	
function wpsmsadforest_plugin_notice_ignore() {
	
	global $current_user;
	
	$user_id = $current_user->ID;
	
	if (isset($_GET['wpsms-adforest-dismised-notice'])) {
		
		add_user_meta($user_id, 'wpsmsadforest_plugin_notice_ignore', 'true', true);
		
	}
	
}
add_action('admin_init', 'wpsmsadforest_plugin_notice_ignore');




//Check if adforest theme is activated, else show WPSMS Pro Notice
$theme = wp_get_theme();
// gets the current theme

if ( 'adforest' == $theme->name || 'adforest' == $theme->parent_theme ) {
    add_action( 'admin_notices', 'wpsmsadforest_plugin_notice' );
} else {
   add_action('admin_notices', 'wpsmspro_plugin_notice');
}