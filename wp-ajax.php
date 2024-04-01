<?php
/**
 * Plugin Name: WP AJAX
 * Plugin URI: https://github.com/chintalp0910
 * Description: How to work with wordpress AJAX
 * Version: 1.0.0
 * Author: ChintalP
 * Author URI: https://github.com/chintalp0910
 * Text Domain: wp-ajax
 * Domain Path: languages
 * 
 * @package WP AJAX
 * @category Core
 * @author ChintalP
 */

/**
 * Basic plugin definitions 
 * 
 * @package WP AJAX
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic Plugin Definitions 
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
if( !defined( 'WP_AJAX_VERSION' ) ) {
	define( 'WP_AJAX_VERSION', '1.0.0' ); //version of plugin
}
if( !defined( 'WP_AJAX_DIR' ) ) {
	define( 'WP_AJAX_DIR', dirname( __FILE__ ) ); // plugin dir
}
if( !defined( 'WP_AJAX_ADMIN' ) ) {
	define( 'WP_AJAX_ADMIN', WP_AJAX_DIR . '/includes/admin' ); // plugin admin dir
}
if( !defined( 'WP_AJAX_URL' ) ) {
	define( 'WP_AJAX_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if( !defined( 'WP_AJAX_IMG_URL' ) ) {
	define( 'WP_AJAX_IMG_URL', WP_AJAX_URL . 'includes/images' ); // plugin image url
}
if( !defined( 'WP_AJAX_TEXT_DOMAIN' ) ) {
	define( 'WP_AJAX_TEXT_DOMAIN', 'wp-ajax' ); // text domain for doing language translation
}
//metabox prefix
if( !defined( 'WP_AJAX_META_PREFIX' )) {
	define( 'WP_AJAX_META_PREFIX', '_wp_ajax_' );
}
if( !defined( 'WP_AJAX_PLUGIN_BASENAME' ) ) {
	define( 'WP_AJAX_PLUGIN_BASENAME', basename( WP_AJAX_DIR ) ); //Plugin base name
}
/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
function wp_ajax_load_textdomain() {
	
 // Set filter for plugin's languages directory
	$wp_ajax_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_ajax_lang_dir	= apply_filters( 'wp_ajax_languages_directory', $wp_ajax_lang_dir );
	
	// Traditional WordPress plugin locale filter
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wp-ajax' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wp-ajax', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $wp_ajax_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . WP_AJAX_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/wp-ajax folder
		load_textdomain( 'wp-ajax', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { // Look in local /wp-content/plugins/wp-ajax/languages/ folder
		load_textdomain( 'wp-ajax', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'wp-ajax', false, $wp_ajax_lang_dir );
	}
}

/**
 * Activation hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_ajax_install' );

/**
 * Deactivation hook
 *
 * Register plugin deactivation hook.
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_ajax_uninstall' );

/**
 * Plugin Setup Activation hook call back 
 *
 * Initial setup of the plugin setting default options 
 * and database tables creations.
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
function wp_ajax_install() {
	
	global $wpdb;
}

/**
 * Plugin Setup (On Deactivation)
 *
 * Does the drop tables in the database and
 * delete  plugin options.
 *
 * @package WP AJAX
 * @since 1.0.0
 */
function wp_ajax_uninstall() {
	
	global $wpdb;
}

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
function wp_ajax_plugin_loaded() {
 
	// load first plugin text domain
	wp_ajax_load_textdomain();
}

//add action to load plugin
add_action( 'plugins_loaded', 'wp_ajax_plugin_loaded' );

/**
 * Initialize all global variables
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
global $wp_ajax_scripts,$wp_ajax_renderer,$wp_ajax_public;

/**
 * Includes
 *
 * Includes all the needed files for plugin
 *
 * @package WP AJAX
 * @since 1.0.0
 */
require_once( WP_AJAX_DIR . '/includes/class-wp-ajax-scripts.php');
$wp_ajax_scripts = new Wp_Ajax_Scripts();
$wp_ajax_scripts->add_hooks();

require_once( WP_AJAX_DIR . '/includes/class-wp-ajax-renderer.php');
$wp_ajax_renderer = new Wp_Ajax_Renderer();

//Public Pages Class for handling front side functionalities
require_once( WP_AJAX_DIR . '/includes/class-wp-ajax-public-pages.php' );
$wp_ajax_public = new Wp_Ajax_Public_Pages();
$wp_ajax_public->add_hooks();