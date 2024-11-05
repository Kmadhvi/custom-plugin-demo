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
class Custom_Posts_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


		// Define the page title, content with shortcode, and slug
	    $page_title = 'Pixlogix';
	    $page_content = '[pixlogix_show_posts]';  // shortcode 
	    $page_slug = 'pixlogix';

	    $page_exists = get_page_by_path($page_slug);
	    if (!$page_exists) {
	        $new_page_id = wp_insert_post(array(
	            'post_title'   => $page_title,
	            'post_content' => $page_content,
	            'post_status'  => 'publish',
	            'post_type'    => 'page',
	            'post_name'    => $page_slug,
	        ));
	    }


        // Store the page ID in an option to easily retrieve it on deactivation
        if ($new_page_id && !is_wp_error($new_page_id)) {
            update_option(CUSTOM_POSTS_META_PREFIX.'pixlogix_page_id', $new_page_id);
        }
		
	}

} // End Of Class
