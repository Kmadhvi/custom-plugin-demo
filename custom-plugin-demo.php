<?php

/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://example.com/
 * @since             1.0.0
 * @package           Custom_Posts
 * 
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Posts Plugin
 * Plugin URI:        https://example.com/
 * Description:       The plugin handles the post display using shortcode
 * Version:           1.0.0
 * Author:            Madhvi Koshti
 * Author URI:        https://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) || ! defined( 'ABSPATH' ) ) {
    die;
}

global  $wpdb;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CUSTOM_POSTS_VERSION', '1.0.0' );

/**
 * Currently plugin URL.
 */
if( !defined( 'CUSTOM_POSTS_URL' ) ) {
    define( 'CUSTOM_POSTS_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Currently plugin directory.
 */
if( !defined( 'CUSTOM_POSTS_DIR' ) ) {
    define( 'CUSTOM_POSTS_DIR', dirname( __FILE__ ) );
}

/**
 * Currently plugin admin directory.
 */
if( !defined( 'CUSTOM_POSTS_ADMIN_DIR' ) ) {
    define( 'CUSTOM_POSTS_ADMIN_DIR', CUSTOM_POSTS_DIR . '/admin' );
}

/**
 * Currently plugin public directory.
 */
if( !defined( 'CUSTOM_POSTS_PUBLIC_DIR' ) ) {
    define( 'CUSTOM_POSTS_PUBLIC_DIR', CUSTOM_POSTS_DIR . '/public' );
}

/**
 * Currently plugin meta prefix.
 */
if( !defined( 'CUSTOM_POSTS_META_PREFIX' )) {
    define( 'CUSTOM_POSTS_META_PREFIX', 'cp_' );
}

/**
 * Currently plugin basename.
 */
if( !defined( 'CUSTOM_POSTS_PLUGIN_BASENAME' ) ) {
    define( 'CUSTOM_POSTS_PLUGIN_BASENAME', basename( CUSTOM_POSTS_DIR ) );
}


/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @since      1.0.0
 * @package    Custom_Posts
 * @author     Madhvi Koshti
 * 
 */
function custom_posts_load_textdomain() {
    $esusi_lang_dir   = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $esusi_lang_dir   = apply_filters( 'esusi_languages_directory', $esusi_lang_dir );
    
    $locale = apply_filters( 'plugin_locale',  get_locale(), 'custom-posts' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'custom-posts', $locale );
    
    $mofile_local   = $esusi_lang_dir . $mofile;
    $mofile_global  = WP_LANG_DIR . '/' . CUSTOM_POSTS_PLUGIN_BASENAME . '/' . $mofile;
    
    if ( file_exists( $mofile_global ) ) { 
        load_textdomain( 'custom-posts', $mofile_global );
    } elseif ( file_exists( $mofile_local ) ) { 
        load_textdomain( 'custom-posts', $mofile_local );
    } else { // Load the default language files
        load_plugin_textdomain( 'custom-posts', false, $esusi_lang_dir );
    }
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-posts-activator.php
 */
function activate_custom_posts() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-posts-activator.php';
    Custom_Posts_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_custom_posts' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-posts-deactivator.php
 */
function deactivate_custom_posts() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-posts-deactivator.php';
    Custom_Posts_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_custom_posts' );

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @since      1.0.0
 * @package    Custom_Posts
 * @author     Madhvi Koshti
 * 
 */
function custom_posts_plugin_loaded() {
 
    // load first plugin text domain
    custom_posts_load_textdomain();
 
}
//add action to load plugin
add_action( 'plugins_loaded', 'custom_posts_plugin_loaded' );


/**
 * Global Variable Declaration
 * 
 * @since      1.0.0
 * @package    Custom_Posts
 * @author     Madhvi Koshti
 */
global $CP_Script, $CP_Public, $CP_Admin;

//Include script/JS/CSS/ class file
require_once ( CUSTOM_POSTS_DIR . '/includes/class-custom-posts-script.php' );
$CP_Script = new Custom_Posts_Script();
$CP_Script->add_actions();


// Include public class file
require_once ( CUSTOM_POSTS_PUBLIC_DIR . '/class-custom-posts-public.php' );
$CP_Public = new Custom_Posts_Public();
$CP_Public->add_actions();

// Include admin class file
require_once ( CUSTOM_POSTS_ADMIN_DIR . '/class-custom-posts-admin.php' );
$CP_Admin = new Custom_Posts_Admin();
$CP_Admin->add_actions();