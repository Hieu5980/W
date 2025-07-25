<?php
/**
 * Display the General settings tab
 * @return void
 */
function twl_display_tab_general( $tab, $page_url ) {
	if( $tab != 'general' ) {
		return;
	} 
	
	$options = get_option( TWL_CORE_OPTION );
	if($options)
	{
		$options = wp_parse_args($options,twl_get_defaults());
	}
	else
	{
		$options = twl_get_defaults();
	}
	$options['url_shorten_bitly'] = !isset( $options['url_shorten_bitly'] ) ? 0 : $options['url_shorten_bitly'];
	$options['url_shorten_bitly_token'] = !isset( $options['url_shorten_bitly_token'] ) ? '' : $options['url_shorten_bitly_token'];
	?>
		
	<form method="post" action="options.php">
		<table class="form-table">
		
	
			
		
			<tr valign="top">
				<th scope="row"><?php _e( 'Account SID', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;"><?php _e( 'Available from within your Twilio account', 'wp-twilio-core' ); ?></span></th>
				<td>
					<input size="50" type="text" name="<?php echo esc_html (TWL_CORE_OPTION); ?>[account_sid]" placeholder="<?php _e( 'Enter Account SID', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['account_sid'] ); ?>" class="regular-text" />
					<br />
					<small><?php _e( 'To view API credentials visit <a href="https://www.twilio.com/user/account/voice-sms-mms" target="_blank">https://www.twilio.com/user/account/voice-sms-mms</a>', 'wp-twilio-core' ); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Auth Token', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;"><?php _e( 'Available from within your Twilio account', 'wp-twilio-core' ); ?></span></th>
				<td>
					<input size="50" type="text" name="<?php echo esc_html (TWL_CORE_OPTION); ?>[auth_token]" placeholder="<?php _e( 'Enter Auth Token', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['auth_token'] ); ?>" class="regular-text" />
					<br />
					<small><?php _e( 'To view API credentials visit <a href="https://www.twilio.com/user/account/voice-sms-mms" target="_blank">https://www.twilio.com/user/account/voice-sms-mms</a>', 'wp-twilio-core' ); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Service ID', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;"><?php _e( "Available from within your Twilio account It's require for bulk SMS.", 'wp-twilio-core' ); ?></span></th>
				<td>
					<input size="50" type="text" name="<?php echo esc_html (TWL_CORE_OPTION); ?>[service_id]" placeholder="<?php _e( 'Enter Notify Service ID', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['service_id'] ); ?>" class="regular-text" />
					<br />
					<small><?php _e( 'To view or create Notify Service ID visit <a href="https://www.twilio.com/console/notify/services" target="_blank">https://www.twilio.com/console/notify/services</a>', 'wp-twilio-core' ); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Twilio Number', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;"><?php _e( 'Must be a valid number associated with your Twilio account', 'wp-twilio-core' ); ?></span></th>
				<td>
					<input size="50" type="text" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[number_from]" placeholder="+16175551212" value="<?php echo esc_html( $options['number_from'] ); ?>" class="regular-text" />
					<br />
					<small><?php _e( 'Country code + 10-digit Twilio phone number (i.e. +16175551212)', 'wp-twilio-core' ); ?></small>
				</td>
			</tr>
			
			
			<tr valign="top">
				<th scope="row"><?php _e( 'Advanced &amp; Debug Options', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;"><?php _e( 'With great power, comes great responsiblity.', 'wp-twilio-core' ); ?></span></th>
				<td>
					<label><input class="cm-toggle" type="checkbox" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[logging]" value="1" <?php checked( $options['logging'], '1', true ); ?> /> <?php _e( 'Enable Logging', 'wp-twilio-core' ); ?></label><br />
					<small><?php _e( 'Enable or Disable Logging', 'wp-twilio-core' ); ?></small><br /><br />
					<label><input class="cm-toggle"  type="checkbox" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[mobile_field]" value="1" <?php checked( $options['mobile_field'], '1', true ); ?> /> <?php _e( 'Add Mobile Number Field to User Profiles', 'wp-twilio-core' ); ?></label><br />
					<small><?php _e( 'Adds a new field "Mobile Number" under Contact Info on all user profile forms.', 'wp-twilio-core' ); ?></small><br /><br />
					<label><input class="cm-toggle"  type="checkbox" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[url_shorten_bitly]" value="1" class="url-shorten-bitly-checkbox" <?php checked( $options['url_shorten_bitly'], '1', true ); ?> /> <?php _e( 'Shorten URLs using Bit.ly', 'wp-twilio-core' ); ?></label><br />
					<input size="50" type="text" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[url_shorten_bitly_token]" placeholder="<?php _e( 'Enter Bit.ly Access Token', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['url_shorten_bitly_token'] ); ?>" class="regular-text url-shorten-bitly-key-text" style="display:block;" />
					<small><?php _e( 'Shorten all URLs in the message using the <a href="https://dev.bitly.com/v4_documentation.html" target="_blank">Bit.ly URL Shortener API</a>. Checking will display the access token field.', 'wp-twilio-core' ); ?></small><br /><br />
					<label><input class="cm-toggle"  type="checkbox" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[url_shorten]" value="1" class="url-shorten-checkbox" <?php checked( $options['url_shorten'], '1', true ); ?> /> <?php _e( 'Shorten URLs using Google (Deprecated)', 'wp-twilio-core' ); ?></label><br />
					<input size="50" type="text" name="<?php echo  esc_html (TWL_CORE_OPTION); ?>[url_shorten_api_key]" placeholder="<?php _e( 'Enter Google Project API key', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['url_shorten_api_key'] ); ?>" class="regular-text url-shorten-key-text" style="display:block;" />
					<small><?php _e( 'Shorten all URLs in the message using the <a href="https://code.google.com/apis/console/" target="_blank">Google URL Shortener API</a>. Checking will display the API key field.', 'wp-twilio-core' ); ?></small><br />
				</td>
			</tr>
		</table>
		<?php settings_fields( TWL_CORE_SETTING ); ?>
		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wp-twilio-core' ) ?>" />
	</form>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			twl_toggle_fields($);
			$('input.url-shorten-checkbox, input.url-shorten-bitly-checkbox').click(function() {
				twl_toggle_fields($);
			});
		});
		function twl_toggle_fields($) {
			if($('input.url-shorten-checkbox').is(':checked')) {
				$('input.url-shorten-key-text').show();
			} else {
				$('input.url-shorten-key-text').hide();
			}
			if($('input.url-shorten-bitly-checkbox').is(':checked')) {
				$('input.url-shorten-bitly-key-text').show();
			} else {
				$('input.url-shorten-bitly-key-text').hide();
			}
		}
	</script>
	<?php
}
add_action( 'twl_display_tab', 'twl_display_tab_general', 10, 2 );

/**
 * Display the Test SMS tab
 * @return void
 */
function twl_display_tab_test( $tab, $page_url ) {
	if( $tab != 'test' ) {
		return;
	} 
	
	$number_to = $message = '';
	if( isset( $_POST['submit'] ) ) {
		check_admin_referer( 'twl-test' );
		$number_to = sanitize_text_field( $_POST['number_to'] );
		$message = sanitize_text_field( wp_unslash( $_POST['message'] ) );
		if( !$number_to || !$message ) {
			printf( '<div class="error"> <p> %s </p> </div>', esc_html__( 'Some details are missing. Please fill all the fields below and try again.', 'wp-twilio-core' ) );
		} else {
			$response = twl_send_sms( array( 'number_to' => $number_to, 'message' => $message ) );
			if( is_wp_error( $response ) ) {
				printf( '<div class="error"> <p> %s </p> </div>', esc_html( $response->get_error_message() ) );
			} else {
				printf( '<div class="updated settings-error notice is-dismissible"> <p> Successfully Sent! Message SID: <strong>%s</strong> </p> </div>', esc_html( $response->sid ) );
				$number_to = $message = '';
			}
		}
	}
	?>
	<h3><?php _e( 'Send a Message', 'wp-twilio-core' ); ?></h3>
	<p><?php _e( 'If you are sending messages while in trial mode, the recipient phone number must be verified with Twilio.', 'wp-twilio-core' ); ?></p>
	<form method="post" action="<?php echo esc_url( add_query_arg( array( 'tab' => $tab ), $page_url ) ); ?>">
	
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Recipient Number', 'wp-twilio-core' ); ?></th>
				<td>
					<input size="50" type="text" name="number_to" placeholder="+16175551212" value="<?php echo esc_html($number_to); ?>" class="regular-text" />
					<br />
					<small><?php _e( 'The destination phone number. Format with a \'+\' and country code e.g., +16175551212 ', 'wp-twilio-core' ); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Message Body', 'wp-twilio-core' ); ?><br /><span style="font-size: x-small;">
				<td>
					<textarea name="message" maxlength="1600" class="large-text" rows="7"><?php echo esc_html($message); ?></textarea>
					<small><?php _e( 'The text of the message you want to send, limited to 1600 characters.', 'wp-twilio-core' ); ?></small><br />
				</td>
			</tr>
		</table>
		<?php wp_nonce_field( 'twl-test' ); ?>
		<input name="submit" type="submit" class="button-primary" value="<?php _e( 'Send Message', 'wp-twilio-core' ) ?>" />
	</form>
	<?php 
}
add_action( 'twl_display_tab', 'twl_display_tab_test', 10, 2 );

/**
 * Display the Logs tab
 * @return void
 */
function twl_display_logs( $tab, $page_url ) {
	if( $tab != 'logs' ) {
		return;
	} 
	if ( isset( $_GET['clear_logs'] ) && $_GET['clear_logs'] == '1' ) {
		check_admin_referer( 'clear_logs' );
		update_option( TWL_LOGS_OPTION, '' );
		$logs_cleared = true;
	}

	if ( isset( $logs_cleared ) && $logs_cleared ) { ?>
		<div id="setting-error-settings_updated" class="updated settings-error"><p><strong><?php _e( 'Logs Cleared', 'wp-twilio-core' ); ?></strong></p></div>
	<?php
	}

	$options = twl_get_options();
	if ( !$options['logging'] ) {
		printf( '<div class="error"> <p> %s </p> </div>', esc_html__( 'Logging currently disabled.', 'wp-twilio-core' ) );
	}
	$clear_log_url = esc_url( wp_nonce_url( add_query_arg( array( 'tab' => $tab, 'clear_logs' => 1 ), $page_url ), 'clear_logs' ) );
	?>
	<p><a class="button gray" href="<?php echo esc_html($clear_log_url); ?>"><?php _e( 'Clear Logs', 'wp-twilio-core' ); ?></a></p>
	<h3><?php _e( 'Logs', 'wp-twilio-core' ); ?></h3>
<pre>
<?php echo esc_html(get_option( TWL_LOGS_OPTION )); ?>
</pre>
	<?php
}
add_action( 'twl_display_tab', 'twl_display_logs', 10, 2 );

// new tab for notifications
function twl_display_tab_notifications( $tab, $page_url ) {
    if( $tab != 'notifications' ) {
        return;
    }

	$options = get_option( TWL_CORE_NOTIFICATION_OPTION );
	
	$options = wp_parse_args($options,twl_get_notification_defaults());
	
	?>
	
	<form method="post" action="options.php">
	
	<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Notification Number:', 'wp-twilio-core' ); ?></th>
				<td>
					<input size="50" type="text" name="<?php echo TWL_CORE_NOTIFICATION_OPTION; ?>[notification_number]" placeholder="<?php _e( 'Enter Notification Number', 'wp-twilio-core' ); ?>" value="<?php echo esc_html( $options['notification_number'] ); ?>" class="regular-text" />
					<p><?php _e( 'Set the number to receive SMS.', 'wp-twilio-core' ); ?></p>
					<p><?php _e( 'Leave empty if you want to receive sms on the main settings number.', 'wp-twilio-core' ); ?></p>
				</td>
			</tr>
	</table>
	<hr />
	<h3><?php _e( 'New Post Published', 'wp-twilio-core' ); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Activate:', 'wp-twilio-core' ); ?></th>
				<td>
					<input class="cm-toggle"  type="checkbox" name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_post_published_cb]" value="1" <?php checked( $options['new_post_published_cb'], 1, true ); ?> />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Message:', 'wp-twilio-core' ); ?></th>
				<td>
					<textarea name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_post_published_message]" class="regular-text" style="display:block;"><?php echo esc_html($options['new_post_published_message']); ?></textarea>
					<p><?php _e( 'Enter the content of the sms message', 'wp-twilio-core' ); ?></p>
					<p><?php _e( 'Post title: %post_title%, Post content: %post_content%, Post url: %post_url%, Post date: %post_date%', 'wp-twilio-core' ); ?></p>

				</td>
			</tr>
		</table>
		<hr />
		<h3><?php _e( 'New User Registered', 'wp-twilio-core' ); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Activate:', 'wp-twilio-core' ); ?></th>
				<td>
					<input class="cm-toggle"  type="checkbox" name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_user_registered_cb]" value="1" <?php checked( $options['new_user_registered_cb'], 1, true ); ?> />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Message:', 'wp-twilio-core' ); ?></th>
				<td>
					<textarea name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_user_registered_message]" class="regular-text" style="display:block;"><?php echo esc_html($options['new_user_registered_message']); ?></textarea>
					<p><?php _e( 'Enter the content of the sms message', 'wp-twilio-core' ); ?></p>
					<p><?php _e( 'User Login: %user_login%, User email: %user_email%, Register date: %date_register%', 'wp-twilio-core' ); ?></p>

				</td>
			</tr>
		</table>
		<hr />
		<h3><?php _e( 'New Comment', 'wp-twilio-core' ); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Activate:', 'wp-twilio-core' ); ?></th>
				<td>
					<input class="cm-toggle"  type="checkbox" name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_comment_cb]" value="1" <?php checked( $options['new_comment_cb'], 1, true ); ?> />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Message:', 'wp-twilio-core' ); ?></th>
				<td>
					<textarea name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_comment_message]" class="regular-text" style="display:block;"><?php echo esc_html($options['new_comment_message']); ?></textarea>
					<p><?php _e( 'Enter the content of the sms message', 'wp-twilio-core' ); ?></p>
					<p><?php _e( 'Comment Author: %comment_author%, Author email: %comment_author_email%, Author url: %comment_author_url%, Author IP: %comment_author_IP%, Comment date: %comment_date%, Comment content: %comment_content%', 'wp-twilio-core' ); ?></p>

				</td>
			</tr>
		</table>
		<hr />
		<h3><?php _e( 'New Login', 'wp-twilio-core' ); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Activate:', 'wp-twilio-core' ); ?></th>
				<td>
					<input class="cm-toggle"  type="checkbox" name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_login_cb]" value="1" <?php checked( $options['new_login_cb'], 1, true ); ?> />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e( 'Message:', 'wp-twilio-core' ); ?></th>
				<td>
					<textarea name="<?php echo TWL_CORE_NOTIFICATION_OPTION;?>[new_login_message]" class="regular-text" style="display:block;"><?php echo esc_html($options['new_login_message']); ?></textarea>
					<p><?php _e( 'Enter the content of the sms message', 'wp-twilio-core' ); ?></p>
					<p><?php _e( 'Username: %username_login%, Nickname: %display_name%', 'wp-twilio-core' ); ?></p>

				</td>
			</tr>
		</table>
		
		<?php settings_fields( TWL_CORE_NOTIFICATION_SETTING ); ?>
		<input name="submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wp-twilio-core' ) ?>" />
	</form>

	<?php
}

add_action( 'twl_display_tab', 'twl_display_tab_notifications', 10, 4 );
