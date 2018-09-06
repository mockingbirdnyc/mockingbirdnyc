<?php
/**
 * Plugin
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore' ) ) {
    /**
     * The main  class.
     */
    final class BeauCore {

        /**
         * Plugin version, used for cache-busting of style and script file references.
         *
         * @since   1.0.0
         * @var  string
         */
        const VERSION = '2.0.0';

        /**
         * Instance of the class.
         *
         * @static
         * @access protected
         * @since 1.0.0
         * @var object
         */
        protected static $instance = null;

        /**
         * JS folder URL.
         *
         * @static
         * @access public
         * @since 1.0.0
         * @var string
         */
        public static $js_folder_url;

        /**
         * JS folder path.
         *
         * @static
         * @access public
         * @since 1.0.0
         * @var string
         */
        public static $js_folder_path;
        /**
         * Initialize the plugin by setting localization and loading public scripts
         * and styles.
         *
         * @access private
         * @since 1.0.0
         */
        private function __construct() {
            self::$js_folder_url = BEAU_CORE_URL . 'assets/js';
            self::$js_folder_path = BEAU_CORE_PATH . 'assets/js';
            add_action( 'after_setup_theme', array( $this, 'load_beau_core_text_domain' ) );
            add_action( 'after_setup_theme', array( $this, 'add_image_size' ) );
            $this->includes_libs();
            $this->posttype = new BeauCore_PostType();
            if (!class_exists('Beau_Update\\Redux')) {
                require_once wp_normalize_path(__DIR__ . '/Redux.php');
                $this->options_theme = new Beau_Update\Redux('beau_option');
            }
//            $this->options_theme = new BeauCore_Options_Theme();
            $this->widget = new BeauCore_Widget();
            $this->deprecated = new BeauCore_Deprecated();
            $this->import = new BeauCore_Import();
            // Load scripts & styles.
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles_frontend' ] );
            add_action( 'wp_footer', [ $this, 'enqueue_dynamic_css' ] );

            //Register plugin meta
            add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 2 );

        }

        /**
         * Register the plugin text domain.
         *
         * @access public
         * @return void
         */
        public function load_beau_core_text_domain() {
            load_plugin_textdomain( 'beau-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /**
         * Register plugin meta
         * @access public
         * @return array
         */
        public function plugin_row_meta( $plugin_meta, $plugin_file ) {
            if ( BEAU_CORE_PLUGIN_BASE === $plugin_file ) {
                $row_meta = [
                    'docs' => '<a href="https://docs.beautheme.com/" title="' . esc_attr( __( 'View Beau Core Documentation', 'beau-core' ) ) . '" target="_blank">' . __( 'Docs & FAQs', 'beau-core' ) . '</a>',

                ];

                $plugin_meta = array_merge( $plugin_meta, $row_meta );
            }

            return $plugin_meta;
        }
        /**
         * Return an instance of this class.
         *
         * @static
         * @access public
         * @since 1.0.0
         * @return object  A single instance of the class.
         */
        public static function get_instance() {

            // If the single instance hasn't been set yet, set it now.
            if ( null === self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;

        }

        /**
         * Add image sizes.
         *
         * @access  public
         */
        public function add_image_size() {
            add_image_size( 'image-content', 530, 340, true ); //(cropped)


        }

        /**
         * Enqueues scripts.
         *
         * @access public
         */
        public function enqueue_styles() {

            wp_enqueue_style( 'beau-core-style', BEAU_CORE_URL.'assets/css/style.min.css',array(),filemtime(BEAU_CORE_PATH.'assets/css/style.min.css'));
            wp_enqueue_script( 'beau-core-js', BEAU_CORE_URL . 'assets/js/custom.js', array('jquery'), '2.0.0', true );
            wp_enqueue_script( 'beau-core-js', BEAU_CORE_URL . 'assets/js/custom-jquery.js', array('jquery'), '2.0.0', true );
            wp_enqueue_script( 'beau-core-js', BEAU_CORE_URL . 'assets/js/product-attribute.js', array('jquery'), '2.0.0', true );
        }

         /**
         * Enqueues scripts.
         *
         * @access public
         */
        public function enqueue_styles_frontend() {

        }
        /**
         * Enqueues Dynamic CSS
         *
         * @access public
         */
        public function enqueue_dynamic_css() {
            global $beau_option;
            $data  = $beau_option['custom_css'];
            if(!$data) return false;
            wp_enqueue_style( 'beau-core-dynamic', BEAU_CORE_URL.'assets/css/dynamic.css',array());
            wp_add_inline_style('beau-core-dynamic', $data );

        }
        /**
         * Include Libs
         *
         */
        public function includes_libs(){
            if ( file_exists( BEAU_CORE_PATH.'/includes/libs/beau-core-libs.php' ) ) {
                require_once wp_normalize_path( BEAU_CORE_PATH.'/includes/libs/beau-core-libs.php' );
            }
        }
    }
} // End if().

if (file_exists(BEAU_CORE_PATH.'/includes/deprecated.php')) {
    include_once wp_normalize_path( BEAU_CORE_PATH.'/includes/deprecated.php');
}
