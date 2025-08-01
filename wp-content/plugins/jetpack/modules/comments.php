<?php
/**
 * Module Name: Comments
 * Module Description: Replace the default comment form with a modern, feature‑rich alternative.
 * First Introduced: 1.4
 * Sort Order: 20
 * Requires Connection: Yes
 * Auto Activate: No
 * Module Tags: Social
 * Feature: Engagement
 * Additional Search Queries: comments, comment, facebook, social
 *
 * @package automattic/jetpack
 */

use Automattic\Jetpack\Assets;

Assets::add_resource_hint(
	array(
		'//jetpack.wordpress.com',
		'//s0.wp.com',
		'//public-api.wordpress.com',
		'//0.gravatar.com',
		'//1.gravatar.com',
		'//2.gravatar.com',
	),
	'dns-prefetch'
);

/*
 * Add the main commenting system.
 */
require __DIR__ . '/comments/comments.php';
require __DIR__ . '/comments/subscription-modal-on-comment/class-jetpack-subscription-modal-on-comment.php';

if ( is_admin() ) {
	/**
	 * Add the admin functionality.
	 */
	require __DIR__ . '/comments/admin.php';
}

/**
 * Module loader.
 */
function jetpack_comments_load() {
	Jetpack::enable_module_configurable( __FILE__ );
}

add_action( 'jetpack_modules_loaded', 'jetpack_comments_load' );
