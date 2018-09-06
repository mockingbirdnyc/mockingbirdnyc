<?php
/*
Plugin Name: BeBo Store CPT
Plugin URI: http://beautheme.com
Description: This Plugin will create a Custom Post Type for BEBO Store WordPress Theme.
Version: 2.0.1
Author: BeauTheme
Author URI: http://beautheme.com
Copyright: BeauTheme
 *
 * @package Beau-Core
 * @subpackage Core
 */
// Plugin Folder Path.
if ( ! defined( 'BEAU_CORE_PATH' ) ) {
    define( 'BEAU_CORE_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'BEAU_CORE_PLUGIN_BASE' ) ) {
    define( 'BEAU_CORE_PLUGIN_BASE', plugin_basename( __FILE__ ) );
}
// Plugin Folder URL.
if ( ! defined( 'BEAU_CORE_URL' ) ) {
    define( 'BEAU_CORE_URL', plugin_dir_url( __FILE__ ) );
}

//Set theme will support
//Set theme will support
$theme_textdomain = 'bebostore';
$theme_info =  wp_get_theme(get_template());
if($theme_info->get('TextDomain') != $theme_textdomain ){
    add_action( 'admin_notices', 'beaucore_fail_theme' );
    if(!function_exists('beaucore_fail_theme')) {
        function beaucore_fail_theme() {
            global $theme_info,$beau_theme;
            $message = sprintf(esc_html__('Beau Core does not support the theme you are actived but only supports theme %s , plugin is currently NOT ACTIVE.','beau-core'),$theme_info->get('Name'));
            $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
            echo wp_kses_post( $html_message );
        }
    }
    return;
}
if ( ! version_compare( PHP_VERSION, '5.4', '>=' ) ) {
    add_action( 'admin_notices', 'beaucore_fail_php_version' );
} else {

    /**
     * Include the main GetypoCore class.
     */
    include_once wp_normalize_path( BEAU_CORE_PATH. '/includes/class-beaucore.php' );
    /**
     * Include the autoloader.
     */
    include_once wp_normalize_path( BEAU_CORE_PATH.'/includes/class-beaucore-autoload.php' );
    /**
     * Instantiate the autoloader.
     */
    new BeauCore_Autoload();
    /**
     * Instantiates the BeauCore class.
     * Make sure the class is properly set-up.
     * The BeauCore class is a singleton
     * so we can directly access the one true BeauCore object using this function.
     *
     * @return object BeauCore
     */
    // @codingStandardsIgnoreLine
    function BeauCore() {
        return BeauCore::get_instance();
    }
    new BeauCore_Extend();
    add_action( 'plugins_loaded', array( 'BeauCore', 'get_instance' ) );
}
if (!function_exists('beaucore_fail_php_version')) {
	function beaucore_fail_php_version() {
	    $message = esc_html__( 'Beau Core requires PHP version 5.4+, plugin is currently NOT ACTIVE.', 'beau-core' );
	    $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	    echo wp_kses_post( $html_message );
	}
}
