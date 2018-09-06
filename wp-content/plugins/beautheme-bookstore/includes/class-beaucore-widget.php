<?php
/**
 * Settings Widgets
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore_Widget' ) ) {
	/**
     *
     */
	class BeauCore_Widget {
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
         * Widget Init
         *
         * @static
         * @access public
         * @since 1.0.0
         * @var string
         */
        public $wdget_lists;

    	public function __construct() {

    		$this->init();

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
        private function init(){
        	foreach ( glob( BEAU_CORE_PATH . 'includes/widgets/widget-*.php', GLOB_NOSORT ) as $filename ) {
				include wp_normalize_path( $filename );
			}
        }
	}
	//Load
}