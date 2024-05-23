<?php

/**
 * Plugin Name: Pexels API for WordPress
 * Plugin URI: https://github.com/bdkoder/
 * Description: Generate Image by Pexels API for WordPress
 * Version: 0.0.1
 * Author: bdkoder
 * Author URI: https://github.com/bdkoder/
 * Text Domain: pexels-api-wordpress
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PAPIWP_VERSION', '1.0.0' );

define( 'PAPIWP__FILE__', __FILE__ );
define( 'PAPIWP_PATH', plugin_dir_path( PAPIWP__FILE__ ) );
define( 'PAPIWP_INCLUDES', PAPIWP_PATH . 'includes/' );
define( 'PAPIWP_URL', plugins_url( '/', PAPIWP__FILE__ ) );
define( 'PAPIWP_ASSETS', PAPIWP_URL . '/assets/' );
define( 'PAPIWP_PATH_NAME', basename( dirname( PAPIWP__FILE__ ) ) );
define( 'PAPIWP_INC_PATH', PAPIWP_PATH . 'includes/' );


require_once PAPIWP_PATH . 'pexels/init.php';


// menu page for plugin
add_action( 'admin_menu', 'papiwp_menu_page' );
function papiwp_menu_page() {
    add_menu_page(
        'Pexels API',
        'Pexels API',
        'manage_options',
        'papiwp',
        'papiwp_menu_page_callback',
        'dashicons-format-image',
        6
    );
}

function papiwp_menu_page_callback() {
    echo 'This is the menu page for Pexels API';
}