<?php
/*
Plugin Name: nemo Frame
Plugin URI: 
Description: The nemo Frame WordPress Plugin is easily expand your service area.
Version:     1.0.5
Author:      Nemolade Inc.
Author URI:  http://www.nemolade.com
*/

/*
 * This plugin was built on top of WordPress-Plugin-Skeleton by Ian Dunn.
 * See https://github.com/iandunn/WordPress-Plugin-Skeleton for details.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'NEMOFRAME_NAME',                 'nemo Frame' );
define( 'NEMOFRAME_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'NEMOFRAME_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function nemoframe_requirements_met() {
	global $wp_version;
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );		// to get is_plugin_active() early

/*
	if ( version_compare( PHP_VERSION, NEMOFRAME_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, NEMOFRAME_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	if ( ! is_plugin_active( 'plugin-directory/plugin-file.php' ) ) {
		return false;
	}
	*/

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function nemoframe_requirements_error() {
	global $wp_version;

	require_once( dirname( __FILE__ ) . '/views/requirements-error.php' );
}

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. Otherwise older PHP installations could crash when trying to parse it.
 */
if ( nemoframe_requirements_met() ) {
	require_once( dirname(__FILE__) . '/classes/nemoframe-module.php' );
	require_once( dirname(__FILE__) . '/classes/nemoframe.php' );
	require_once( dirname(__FILE__) . '/includes/admin-notice-helper/admin-notice-helper.php' );
	require_once( dirname(__FILE__) . '/classes/nemoframe-settings.php' );
	require_once( dirname(__FILE__) . '/classes/nemoframe-instance-class.php' );

	if ( class_exists( 'Nemoframe' ) ) {
		$GLOBALS['nemoframe'] = Nemoframe::get_instance();
		register_activation_hook(   __FILE__, array( $GLOBALS['nemoframe'], 'activate' ) );
		register_deactivation_hook( __FILE__, array( $GLOBALS['nemoframe'], 'deactivate' ) );
	}
} else {
	add_action( 'admin_notices', 'nemoframe_requirements_error' );
}
