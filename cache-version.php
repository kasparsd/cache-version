<?php
/*
	Plugin Name: Cache Version
	Description: Uses timestamp as cache version number.
	Version: 0.1
	Plugin URI: https://github.com/kasparsd/cache-version
	GitHub URI: https://github.com/kasparsd/cache-version
	Author: Kaspars Dambis
	Author URI: http://kaspars.net
*/


add_action( 'admin_init', 'enable_cache_version_update' );

function enable_cache_version_update() {

	// Bump the version number during these action calls
	$purge_actions = array(
		'clean_post_cache',
		'edit_term',
		'publish_post',
		'comment_post',
		'delete_comment',
		'edit_comment',
		'delete_post',
		'edit_post',
		'wp_update_nav_menu',
		'activated_plugin',
		'deactivated_plugin',
		'wp_maybe_auto_update'
	);

	foreach ( $purge_actions as $action ) {
		add_action( $action, 'set_new_cache_version' );
	}

}


function set_new_cache_version() {

	wp_cache_set( 'cache-version', time() );

}


add_action( 'init', 'add_cache_version_header' );

function add_cache_version_header() {

	$version = wp_cache_get( 'cache-version' );

	if ( empty( $version ) )
		return;

	header( sprintf( 'Last-Modified: %s GMT', gmdate( 'D, d M Y H:i:s', $version ) ) );

}
