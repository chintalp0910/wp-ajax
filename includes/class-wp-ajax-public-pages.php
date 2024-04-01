<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Public Pages Class
 *
 * Handles all the different features and functions
 * for the front end pages.
 *
 * @package WP AJAX
 * @since 1.0.0
 */

class Wp_Ajax_Public_Pages	{
	
	public $render;
	
	public function __construct() {
		
		global $wp_ajax_renderer;
		$this->render = $wp_ajax_renderer;
	}
	
	/**
	 * AJAX Call
	 * 
	 * Handles ajax functionalites 
	 * 
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_call() {
		
		$prefix = WP_AJAX_META_PREFIX;
		
		$postid = isset($_POST['post_id']) ? $_POST['post_id'] : '';
		
		//get the name of user from $_POST
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		
		//get the email of user from $_POST
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		
		//get the email of user from $_POST
		$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
		
		update_post_meta($postid, $prefix.'name', $name);
		update_post_meta($postid, $prefix.'email', $email);
		update_post_meta($postid, $prefix.'comment', $comment);
		
		echo '1';
		
		//Must write exit to return proper result in ajax
		exit;
		
	}
	
	/**
	 * Custom Content append to post & page
	 * 
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_custom_content($content){
		
		$customcontent = '';
		
		$customcontent .= $this->render->wp_ajax_show_saved_data();
		
		$customcontent .= $this->render->wp_ajax_show_markup();
		
		$customcontent .= $content;
		
		return $customcontent;
	}
	/**
	 * Adding Hooks
	 *
	 * Adding proper hooks for the public pages.
	 *
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//add action to call ajax
		add_action( 'wp_ajax_wp_ajax_call', array($this, 'wp_ajax_call'));
		add_action( 'wp_ajax_nopriv_wp_ajax_call', array($this, 'wp_ajax_call'));
		
		//add filter to append the content with custom markup
		add_filter('the_content', array($this, 'wp_ajax_custom_content'));
		
	}
}