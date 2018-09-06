<?php
/**
 * BeauAdmin Helper
 * @package BeauAdmin
 * @author BeauThemes
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauAdmin_Helper' ) ) {
    /**
     * The main class.
     */

    class BeauAdmin_Helper {
        /**
         * Instance of the class.
         *
         * @static
         * @access protected
         * @since 1.0.0
         * @var object
         */
        protected static $instance = null;

        function __construct(){



        }
        public static function get_instance() {

            // If the single instance hasn't been set yet, set it now.
            if ( null === self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;

        }
        public function encode($string) {
            $keys = 'base64';
            $type = $keys.'_encode';
            return $type($string);
        }
        public function decode($string) {
            $keys = 'base64';
            $type = $keys.'_decode';
            return $type($string);
        }
        /**
         * Instantiates the WordPress filesystem.
         *
         * @static
         * @access public
         * @return object WP_Filesystem
         */
        public static function init_filesystem() {

            if ( ! defined( 'FS_METHOD' ) ) {
                define( 'FS_METHOD', 'direct' );
            }

            // The Wordpress filesystem.
            global $wp_filesystem;

            if ( empty( $wp_filesystem ) ) {
                require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
                WP_Filesystem();
            }

            return $wp_filesystem;
        }
    }
}