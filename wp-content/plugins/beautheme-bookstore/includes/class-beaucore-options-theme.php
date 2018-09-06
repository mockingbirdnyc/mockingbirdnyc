<?php
/**
 * Theme Options
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'Redux' ) ) {
    return;
}
if ( ! class_exists( 'BeauCore_Options_Theme' ) ) {
    /**
     * The main beau-core class.
     */
    class BeauCore_Options_Theme {
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
         * Option Name
         *
         * @static
         * @access public
         * @since 1.0.0
         * @var string
         */
        public static $opt_name = 'beau_option';
        /**
         * Option Name
         *
         * @static
         * @access public
         * @since 1.0.0
         * @var string
         */
        public $field_types;

        public function __construct() {
            $this->init();
            $this->field_types = array(
                'color_alpha',
            );

            add_action('redux/extensions/'.self::$opt_name.'/before', array( $this, 'extension_loader' ), 0);

            foreach ( $this->field_types as $field_type ) {
                add_action( 'redux/'.self::$opt_name.'/field/class/' . $field_type, array( $this, 'register_' . $field_type ) );
            }

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
        public function extension_loader($ReduxFramework) {
	        $path    = BEAU_CORE_PATH.'/includes/libs/redux/extensions/';
			$folders = scandir( $path, 1 );
			foreach($folders as $folder) {
				if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
					continue;
				}
				$extension_class = 'ReduxFramework_Extension_' . $folder;
				if( !class_exists( $extension_class ) ) {
					// In case you wanted override your override, hah.
					$class_file = $path . $folder . '/extension_' . $folder . '.php';
					$class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
					if( $class_file ) {
						require_once( $class_file );
						$extension = new $extension_class( $ReduxFramework );
					}
				}
			}
	    }

        public function register_color_alpha() {
            return BEAU_CORE_PATH.'/includes/libs/redux/custom-fields/color_alpha/field_color_alpha.php';
        }

        private function init(){
        	$opt_name = self::$opt_name;
    	 	if (file_exists(BEAU_CORE_PATH.'/includes/options/default.php')) {
                include_once wp_normalize_path( BEAU_CORE_PATH.'/includes/options/default.php');
            }
            foreach ( glob( BEAU_CORE_PATH . 'includes/options/options-*.php', GLOB_NOSORT ) as $filename ) {
				include wp_normalize_path( $filename );
			}
        }
    }
    //Load
}
