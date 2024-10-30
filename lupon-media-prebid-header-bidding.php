<?php
/*
Plugin Name: Lupon Media Prebid - Header bidding
Description: Allows to embed Lupon Media ads in your website
Version:     1.1.0
Author:      Torricelli
Author URI:  https://www.fiverr.com/torricelli
Text Domain: lupon-media-wpp
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die;

define( 'LUPON_MEDIA_WPP_FILE', __FILE__ );
define( 'LUPON_MEDIA_WPP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'LUPON_MEDIA_WPP_CLASS_PATH', LUPON_MEDIA_WPP_PLUGIN_PATH . 'class/' );
define( 'LUPON_MEDIA_WPP_INC_PATH', LUPON_MEDIA_WPP_PLUGIN_PATH . 'inc/' );
define( 'LUPON_MEDIA_WPP_OPTSGROUP_NAME', 'lupon_media_wpp_optsgroup' );
define( 'LUPON_MEDIA_WPP_OPTIONS_NAME', 'lupon_media_wpp_options' );
define( 'LUPON_MEDIA_WPP_VER', '1.1.0' );

add_action( 'init', 'lupon_media_wpp_init' );
function lupon_media_wpp_init() {
	load_plugin_textdomain( 'lupon-media-wpp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

require_once LUPON_MEDIA_WPP_CLASS_PATH . 'class-main.php';
Lupon_Media_WPP_Main::get_instance();