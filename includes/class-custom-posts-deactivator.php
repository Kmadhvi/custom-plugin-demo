<?php

/**
 * Fired during plugin activation
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Custom_Posts
 * @subpackage Custom_Posts/includes
 */
class Custom_Posts_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

	    $page_id = get_option(CUSTOM_POSTS_META_PREFIX.'pixlogix_page_id');
	    if ($page_id) {
	        wp_delete_post($page_id, true); 
	        delete_option(CUSTOM_POSTS_META_PREFIX.'pixlogix_page_id'); 
	    }
    }
} // End Of Class
