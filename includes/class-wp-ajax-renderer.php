<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Renderer Class
 *
 * Handles to show small HTML for front side
 *
 * @package WP AJAX
 * @since 1.0.0
 */
class Wp_Ajax_Renderer {

	public function __construct() {
		
	}
	
	/**
	 * Show saved data which are saved in database
	 *
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_show_saved_data() {
		
		global $post;
		
		$prefix = WP_AJAX_META_PREFIX;
		
		$customcontent = '';
		
		//get value for name from post meta
		$name = get_post_meta($post->ID,$prefix.'name',true);
		$name = isset($name) ? $name : '';
		
		//get value for email from post meta
		$email = get_post_meta($post->ID,$prefix.'email',true);
		$email = isset($email) ? $email : '';
		
		//get value for comment from post meta
		$comment = get_post_meta($post->ID,$prefix.'comment',true);
		$comment = isset($comment) ? $comment : '';
		
		if(!empty($name) || !empty($email) || !empty($comment)) { //check anyone option is enter then show data
			
			$customcontent .= '<table class="wp-ajax-table-view">
									<tbody>';
			
			$customcontent .= '			<tr>
											<td colspan="2"><strong>'.esc_html__('Entered Comment :','wp-ajax').'</strong></td>
										</tr>';
			
			$customcontent .= '			<tr>
											<th scope="row">'.esc_html__('Name :','wp-ajax').'</th>
											<td>'.$name.'</td>
										</tr>';
			
			$customcontent .= '			<tr>
											<th scope="row">'.esc_html__('E-Mail :','wp-ajax').'</th>
											<td>'.$email.'</td>
										</tr>';
			
			$customcontent .= '			<tr>
											<th scope="row">'.esc_html__('Your Comment :','wp-ajax').'</th>
											<td>'.$comment.'</td>
										</tr>';
			
		 	$customcontent .= '		</tbody>
								</table>';
		} //end if
		
		return $customcontent;
	}
	
	/**
	 * Show saving data form HTML
	 *
	 * @package WP AJAX
 	 * @since 1.0.0
	 */
	public function wp_ajax_show_markup() {
		
		global  $post;
		
		$customcontent = '';
		
		$customcontent .= '<table class="wp-ajax-table">
								<tbody>';
		
		$customcontent .= '			<tr>
										<td colspan="2"><strong>'.esc_html__('Enter Your Comment :','wp-ajax').'</strong></td>
									</tr>';
		
		$customcontent .= '			<tr>
										<th scope="row">'.esc_html__('Your Name :','wp-ajax').'</th>
										<td><input type="text" id="wp_ajax_name" name="wp_ajax_name"></td>
									</tr>';
		
		$customcontent .= '			<tr>
										<th scope="row">'.esc_html__('E-Mail :','wp-ajax').'</th>
										<td><input type="text" id="wp_ajax_email" name="wp_ajax_email"></td>
									</tr>';
		
		$customcontent .= '			<tr>
										<th scope="row">'.esc_html__('Your Comment :','wp-ajax').'</th>
										<td><textarea id="wp_ajax_comment" name="wp_ajax_comment" rows="3" cols="15"></textarea></td>
									</tr>';
		
		$customcontent .= '			<tr>
										<td colspan="2">
											<input type="button" id="wp_ajax_post_data" name="wp_ajax_post_data" value="'.esc_html__('Post Comment','wp-ajax').'" />
											<input type="hidden" id="wp_ajax_post_id" name="wp_ajax_post_id" value="'.$post->ID.'" />
											<img src="'.esc_url( WP_AJAX_IMG_URL ).'/wp-ajax-loader.gif" id="wp_ajax_loader"/>
										</td>
									</tr>';
		
	 	$customcontent .= '		</tbody>
							</table>';
	 	
	 	return $customcontent;
	}
}