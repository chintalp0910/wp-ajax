<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package WP AJAX
 * @since 1.0.0
 */
class Wp_Ajax_Scripts {
	
	function __construct() {
		
		
	}
	
	/**
	 * Enqueue Scripts
	 * 
	 * Handles to enqueue scripts for front
	 * 
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_public_scripts() {
		
		// Register & Enqueue ajax script
		wp_register_script( 'wp-ajax-script', WP_AJAX_URL . 'includes/js/wp-ajax-public.js', array('jquery'), WP_AJAX_VERSION , true );
		wp_enqueue_script( 'wp-ajax-script' );

		//localize script to pass some variable to javascript file from php file
		//pass ajax url to access wordpress ajax file at front side
		wp_localize_script( 'wp-ajax-script','Wp_Ajax',array('ajaxurl' => admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) )));
	}
	/**
	 * Enqueue Styles
	 * 
	 * Handles to enqueue styles for front
	 * 
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_public_styles() {
		
		// Register & Enqueue ajax style
		wp_register_style( 'wp-ajax-style', WP_AJAX_URL . 'includes/css/wp-ajax-public.css', array(), WP_AJAX_VERSION );
		wp_enqueue_style( 'wp-ajax-style' );
		
	}
	
	/**
	 * Adding Hooks
	 *
	 * Adding hooks for the styles and scripts.
	 *
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//add public scripts
		add_action('wp_enqueue_scripts',array($this, 'wp_ajax_public_scripts'));
		
		//add public styles
		add_action('wp_enqueue_scripts',array($this, 'wp_ajax_public_styles'));
		
	}
}