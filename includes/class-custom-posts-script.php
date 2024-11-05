<?php if ( ! defined( 'ABSPATH' ) ) { die; } // If this file is called directly, abort.

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * 
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Custom_Posts
 * @subpackage Custom_Posts/includes
 */

class Custom_Posts_Script {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    	1.0.0
	 * @package    	Custom_Posts
 	 * @subpackage 	Custom_Posts/includes
 	 * 
	 */
	public function __construct() {
		
	}

	/**
	 * Add Public Scripts/JS Files
	 *
	 * @since    	1.0.0
	 * @package    	Custom_Posts
 	 * @subpackage 	Custom_Posts/includes
 	 * 
	 */
	public function cp_public_scripts() {
		
		wp_register_script( 'cp-public-script', CUSTOM_POSTS_URL . 'public/js/custom-posts-public.js', array('jquery'), CUSTOM_POSTS_VERSION.time() , false );

		wp_localize_script(
            'cp-public-script', 
            'cp_public', 
            array( 
            	"ajaxurl" => admin_url('admin-ajax.php'),
            	"siteurl" => get_site_url(),
            	"is_user_logged_in" => ( is_user_logged_in() ) ? true : false,
            )
        );

		wp_enqueue_script('cp-public-script');
	}


	/**
	 * Add Public Style/CSS Files
	 *
	 * @since    	1.0.0
	 * @package    	Custom_Posts
 	 * @subpackage 	Custom_Posts/includes
 	 * 
	 */
	public function cp_public_styles() {
			
        wp_register_style( 'cp-public-style', CUSTOM_POSTS_URL . 'public/css/custom-posts-public.css', array(), CUSTOM_POSTS_VERSION.time() );
		wp_enqueue_style('cp-public-style');
    }


	/**
	 * Add Actions/Hooks
	 *
	 * @since    	1.0.0
	 * @package    	Custom_Posts
 	 * @subpackage 	Custom_Posts/includes
 	 * 
	 */
	public function add_actions() {

		add_action( 'wp_enqueue_scripts', [$this, 'cp_public_scripts'] );
		
		add_action( 'wp_enqueue_scripts', [$this, 'cp_public_styles'] );
		
	}
	
} // End Of Class

