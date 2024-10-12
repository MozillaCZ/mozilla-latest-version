<?php
/*
Plugin Name:		Mozilla Latest Version
Plugin URI:		https://github.com/MozillaCZ/mozilla-latest-version
Update URI:		https://api.github.com/repos/MozillaCZ/mozilla-latest-version/releases/latest
Description:		Mozilla Latest Version WordPress plugin automatically checks the Mozilla application JSONs so you can always have the latest download link and version number on your website.
Version:		4.2.1
Author:			Mozilla.cz
Author URI:		https://www.mozilla.cz/
License:		GPL2
*/

defined( 'ABSPATH' ) or die();

define( 'MOZLV_PLUGIN_FILE', __FILE__ );
define( 'MOZLV_PLUGIN_DIR', trailingslashit( plugin_dir_path( MOZLV_PLUGIN_FILE ) ) );
define( 'MOZLV_DATA_LOAD_TIMEOUT', 2 );
define( 'MOZLV_CACHE_FILES_DIR', trailingslashit(WP_CONTENT_DIR).'mozlv-cache/' );

spl_autoload_register( 'mozlv_autoload' );

/**
 * Handles plugin classes autoloading (all should be prefixed by 'Mozlv_').
 * 
 * @param string $class_name
 * @return true if the class has been loaded successfully
 */
function mozlv_autoload( $class_name ) {
	if ( substr( $class_name, 0, strlen('Mozlv_') ) === 'Mozlv_' ) {
		$class_path = MOZLV_PLUGIN_DIR . 'classes/' . str_replace( "\\", '/', $class_name ) . '.php';
		if ( file_exists( $class_path ) ) {
			require $class_path;
			return true;
		}
	}
	return false;
}

// Plugin installation and admin options
register_activation_hook( MOZLV_PLUGIN_FILE, array(Mozlv_Options::getInstance(), 'install') );
if ( is_admin() ){
	add_action( 'admin_init', array(Mozlv_Options::getInstance(), 'register_settings') );
	add_action( 'admin_menu', array(Mozlv_Options::getInstance(), 'add_menu') );
}

// Mozilla Latest Version shortcodes
add_shortcode( 'mozilla-latest-version', array('Mozlv_Shortcode', 'get_latest_version') );
add_shortcode( 'mozilla-latest-download-url', array('Mozlv_Shortcode', 'get_latest_download_URL') );
add_shortcode( 'mozilla-latest-langpack-url', array('Mozlv_Shortcode', 'get_latest_langpack_URL') );
add_shortcode( 'mozilla-latest-changelog-url', array('Mozlv_Shortcode', 'get_latest_changelog_URL') );
add_shortcode( 'mozilla-latest-requirements-url', array('Mozlv_Shortcode', 'get_latest_requirements_URL') );
