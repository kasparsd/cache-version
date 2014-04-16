<?php
/*
	Plugin Name: Cache Version
*/


add_action( 'admin_init', 'enable_cache_version_update' );

function enable_cache_version_update() {

	$purge_actions = array(
		'clean_post_cache',
		'publish_post',
		'comment_post',
		'delete_comment',
		'edit_comment',
		'delete_post',
		'edit_post',
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
