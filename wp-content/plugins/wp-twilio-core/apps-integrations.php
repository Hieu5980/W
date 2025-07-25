<?php
/**
 * Display the Apps & Integarations
 * @return void
 */




// Adding form to new tab
function apps_tab_content( $tab, $page_url ) {
    if( $tab != 'addons' ) {
        return;
    }
	?>


		<h3 class="apps"><?php _e( 'WPSMS Addons & Integrations', 'wp-twilio-core' ); ?></h3>
		<?php if ( wtc_fs()->is_not_paying() ) {
        ?>
		<a href="<?php 
        echo  wtc_fs()->get_upgrade_url() ;
        ?>" class="button-primary wpsms" ><?php _e( 'Upgrade to WP SMS Pro', 'wp-twilio-core' ); ?></a>
		<?php _e( 'Or', 'wp-twilio-core' ); ?>
		<?php }
        ?>
		<a href="https://checkout.freemius.com/?mode=dialog&plugin_id=6291&plan_id=10264&public_key=pk_704158bd6c7b5ee3c81af36e1829d&name=WP+SMS+BUNDLE&licenses=1&trial=0billing_cycle=annual#!#https:%2F%2Fwww.wpsms%2Fpricing%2F" class="button-primary wpsms bundle" target="_blank"><?php _e( 'Get Everything bellow for $49 Only!', 'wp-twilio-core' ); ?></a>
	
		
		
		<div class="clear"></div>
		
		<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS for WooCommerce</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmswc" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-product-10.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send notifications by SMS as per the orders statuses and customize the SMS for the admin and the customer.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmswc" target="_blank" class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
		<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS SMS Marketing Solution</h3>
		<a href="https://wpsms.io/sms-plugin/wordpress-sms-marketing-plugin/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsmarketing" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-marketing.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Full WordPress SMS Marketing Solution with SMS Newsletter Widget and Bulk SMS Integration.</p>
		<a href="https://wpsms.io/sms-plugin/wordpress-sms-marketing-plugin/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsmarketing" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS for Contact Form 7</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-contact-form-7/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmscf7" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-contactform7.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send notifications to the admin when someone send a message through the website forms.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-contact-form-7/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmscf7" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
		<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS for WooCommerce Simple Auctions</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce-simple-auctions/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmssimpleauctions" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-auctions.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send SMS to the admin phone number and to the bidders when they place a bid using Simple Auctions Plugin.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce-simple-auctions/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmssimpleauctions" target="_blank" class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS Bulk SMS</h3>
		<a href="https://wpsms.io/sms-plugin/bulk-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsbulk" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-bulk.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Select the list of users and send Bulk SMS to them,Extend Twilio integration with Bulk Services.</p>
		<a href="https://wpsms.io/sms-plugin/bulk-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsbulk" target="_blank" class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
		<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS for WooCommerce Bookings</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce-bookings/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsbookings" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-bookings.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Integrate WP SMS with WooCommerce Bookings plugin, Send SMS when there is a new booking.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-woocommerce-bookings/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsbookings" target="_blank" class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS For WP Job Manager</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-job-manager/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsjobmanager" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-wpjobamanager.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send SMS to the admin phone number and to the employers when they add a new Job.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-job-manager/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsjobmanager" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
			
		
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS For WP Give</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-givewp/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsgive" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-givewp.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send SMS to admin and the donor everytime there is a new donation.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-for-givewp/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpgive" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS For AdForest</h3>
		<a href="https://wpsms.io/sms-plugin/adforest-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsadforest" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-adforest-1.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send instant SMS to your sellers when they are contacted via their listings contact form.</p>
		<a href="https://wpsms.io/sms-plugin/adforest-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsadforest" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS Download Link</h3>
		<a href="https://wpsms.io/sms-plugin/wp-sms-download-link-2/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsdownloadlink" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-downloadlink.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send SMS with a crypted download Link to form subscribers,Collect Data and target them easily.</p>
		<a href="https://wpsms.io/sms-plugin/wp-sms-download-link-2/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsdownloadlink" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS For Vantage</h3>
		<a href="https://wpsms.io/sms-plugin/vantage-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsvantage" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-vantage.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send instant SMS to your sellers when they are contacted via their listings or events.</p>
		<a href="https://wpsms.io/sms-plugin/vantage-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsvantage" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS For Classipress</h3>
		<a href="https://wpsms.io/sms-plugin/classipress-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsclassipress" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-classipress.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send instant SMS to your sellers when they are contacted via their listings contact form.</p>
		<a href="https://wpsms.io/sms-plugin/classipress-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmsclassipress" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">Event Espresso SMS Reminder</h3>
		<a href="https://wpsms.io/sms-plugin/event-espresso-sms-reminder/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmseventespresso" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-eesms.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send instant SMS to your event attendees when there the event is coming soon.</p>
		<a href="https://wpsms.io/sms-plugin/event-espresso-sms-reminder/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmseventespresso" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
			<div class="addons-container">
		<div class="wpsms-addon">
		<h3 class="addon-title">WPSMS for Easy Digital Downloads</h3>
		<a href="https://wpsms.io/sms-plugin/easy-digital-downloads-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmseed" target="_blank" >
		<img src="<?php echo plugins_url( 'assets/images/wpsms-edd.png', __FILE__ ) ; ?>" class="attachment-download-grid-thumb size-download-grid-thumb wp-post-image" width="1200" height="600"></a>
		<p>Send notifications to admin and customer as per the orders statuses.</p>
		<a href="https://wpsms.io/sms-plugin/easy-digital-downloads-sms/?utm_source=plugin-addons-page&amp;utm_medium=plugin&amp;utm_campaign=wpsmsIntegrationsPage&amp;utm_content=wpsmseed" target="_blank"  class="button-secondary">Get this Extension</a>
		</div>
		</div>
		
		
		<div class="clear"></div>
		
	<?php
}
add_action( 'twl_display_tab', 'apps_tab_content', 10, 2 );