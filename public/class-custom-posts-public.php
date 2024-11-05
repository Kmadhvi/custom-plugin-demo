<?php if ( ! defined( 'ABSPATH' ) ) { die; } // If this file is called directly, abort.

/**
 * 
 * The public-facing functionality of the plugin.
 * 
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Custom_Posts
 * @subpackage Custom_Posts/public
 */
class Custom_Posts_Public {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 	1.0.0
	 */
	public function __construct() {

	}

	/**
	 * Shortcode Callback function
	 *
	 * @since 	1.0.0
	 */
	public function cp_blog_listing_cb() {

		ob_start();

	    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
	    $args = [
	        'post_type' => 'post',
	        'posts_per_page' => 6,
	        'paged' => $paged,
	    ];
	    $wp_query = new WP_Query($args);

	    if ($wp_query->have_posts()) {
	        echo '<div class="cp-blog-grid">';

	        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	            <div class="cp-blog-item">
	                <?php if (has_post_thumbnail()) : ?>
	                    <div class="cp-blog-image">
	                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
	                    </div>
	                <?php endif; ?>
	                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                <div class="cp-blog-excerpt"><?php the_excerpt(); ?></div>
	            </div>
	        <?php endwhile;

	        echo '</div>'; 

	        echo '<div class="cp-pagination">';
	        echo paginate_links([
	            'total' => $wp_query->max_num_pages,
	            'current' => $paged,
	            'format' => '?paged=%#%',
	            'show_all' => false,
	            'end_size' => 1,
	            'mid_size' => 2,
	            'prev_text' => '&larr; Previous',
	            'next_text' => 'Next &rarr;',
	        ]);
	        echo '</div>';
	    } else {
	        echo '<p>No posts found.</p>';
	    }

	    wp_reset_postdata();

        return ob_get_clean();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 	1.0.0
	 * @param 	id|int
	 * @return 	id|string
	 */
	public function add_actions() {
		// Blog Listing Shortcode
		add_shortcode( 'pixlogix_show_posts', array($this, 'cp_blog_listing_cb') );

	}

} // End Of Class
