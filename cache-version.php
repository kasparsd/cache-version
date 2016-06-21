<?php
/*
	Plugin Name: Cache Version
	Description: Uses timestamp as cache version number.
	Version: 0.3.0
	Plugin URI: https://github.com/kasparsd/cache-version
	GitHub URI: https://github.com/kasparsd/cache-version
	Author: Kaspars Dambis
	Author URI: https://kaspars.net
*/

Preseto_Cache_Version::instance();

class Preseto_Cache_Version {

	protected __construct() {

		add_action( 'plugins_loaded', array( $this, 'cache_bump_register' ) );

		add_action( 'send_headers', array( $this, 'set_last_modified' ) );

	}

	public static function instance() {
		static $instance;

		if ( ! isset( $instance ) ) {
			$instance = new self;
		}

		return $instance;
	}

	public function cache_bump_register() {

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
			add_action( $action, array( $this, 'cache_bump' ) );
		}

	}

	public function cache_bump() {

		set_transient( 'last-modified-timestamp', time() );

	}


	public function set_last_modified() {

		$version = get_transient( 'last-modified-timestamp' );

		if ( empty( $version ) )
			return;

		header( sprintf( 'Last-Modified: %s GMT', gmdate( 'D, d M Y H:i:s', $version ) ) );

	}

}
