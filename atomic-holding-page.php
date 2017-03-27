<?php
/*
 * Plugin Name: Logsmith - Veneer
 * Plugin URI: https://www.atomicsmash.com
 * Description: Show a holding page for logged out users
 * Version: 0.1
 * Author: Atomicsmash
 * Author URI: https://www.atomicsmash.com
 * License: GPL2
*/

function logsmith_veneer() {
	global $pagenow;

	if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
		header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
		if ( file_exists( get_template_directory() . '/tpl.holding-page.php' ) ) {
			require_once( get_template_directory() . '/tpl.holding-page.php' );
		}else{
			require_once( plugin_dir_path( __FILE__ ) . 'tpl.holding-page.php' );
		}
		die();
	}
}

add_action( 'wp_loaded', 'logsmith_veneer' );
