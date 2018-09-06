<?php
/**
 * Import Data
 * @package beauadmin
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore_Import' ) ) {
	/**
	*
	*/
	class BeauCore_Import
	{   /**
         * Instance of the class.
         *
         * @static
         * @access protected
         * @since 1.0.0
         * @var object
         */
        protected static $instance = null;
		/**
		 * Init
		 * @access public
		 */
		public  $init;
		function __construct(){
			$this->init_demos();
			$this->set_plugin_constants();
			$this->init = OCDI\OneClickDemoImport::get_instance();
			add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
            add_filter( 'pt-ocdi/plugin_page_title',function() { return $plugin_title = ''; });
			add_filter( 'pt-ocdi/plugin_intro_text',array($this,'notices_demos'));
			add_filter( 'pt-ocdi/import_files', array($this,'import_files' ));
            add_action( 'pt-ocdi/after_import', array($this,'import_after' ));
            add_action( 'admin_menu', array( $this, 'edit_admin_menus' ), 999 );

		}
         /**
         * Modify the menu.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function edit_admin_menus() {
            global $submenu;
            remove_submenu_page( 'themes.php', 'pt-one-click-demo-import' );

        }
		public function init_demos(){
			// Composer autoloader.
			require_once BEAU_CORE_PATH . '/includes/libs/import/vendor/autoload.php';
		}
        public function notices_demos() {
            ?>
            <div class="beau-important-notice">
                <p class="about-description">
                    <?php esc_html_e('Importing a demo provides pages, posts, images, theme options, widgets, sliders and more. IMPORTANT: The included plugins need to be installed and activated before you install a demo. Please check the "System Status" tab to ensure your server meets all requirements for a successful import.','beaucore');?>
                </p>
            </div>
            <?php
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
        public static function get_url_key($url,$key) {
            // Get the demo details from the remote server.
            $args = array(
                'user-agent' => 'beau-user-agent',

            );
            $remote_config = wp_remote_retrieve_body( wp_remote_get( $url, $args ) );
            $remote_config = json_decode( $remote_config, true );
            if ( ! empty( $remote_config ) && $remote_config && function_exists( 'json_last_error' ) && json_last_error() === JSON_ERROR_NONE ) {
                set_transient($key, $remote_config, 60*60*24 );
            }
        }
		private function set_plugin_constants() {
			// Path/URL to root of this plugin, with trailing slash.
			if ( ! defined( 'PT_OCDI_PATH' ) ) {
				define( 'PT_OCDI_PATH', BEAU_CORE_PATH . '/includes/libs/import/');
			}
			if ( ! defined( 'PT_OCDI_URL' ) ) {
				define( 'PT_OCDI_URL', BEAU_CORE_URL . '/includes/libs/import/' );
			}
			if ( ! defined( 'PT_OCDI_VERSION' ) ) {
				define( 'PT_OCDI_VERSION', '2.3.0');
			}
		}
		function import_files() {
            $path = 'http://updates.beautheme.com/demo/bookstore/';
            $args = array('Classic','Library','Store');
            $demos = array();
            foreach ($args as $key => $val) {
                $demos[$key]['import_file_name'] = $val;
                $demos[$key]['categories'] = array('BEBO Store');
                $demos[$key]['import_file_url'] = $path.$val.'/content.xml';
                $demos[$key]['import_widget_file_url'] = $path.$val.'/widgets.json';
                $demos[$key]['import_redux'][0]['file_url'] = $path.$val.'/redux.json';
                $demos[$key]['import_redux'][0]['option_name'] = 'beau_option';
                $demos[$key]['import_preview_image_url'] = $path.$val.'/screen-image.png';
                $demos[$key]['import_notice'] = 'After you import this demo, you will have to setup the slider separately';
            }
			return $demos;

		}
        public function import_after(){
            $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            set_theme_mod( 'nav_menu_locations', array(
                    'main-menu' => $main_menu->term_id,
                    'sticker-menu' => $main_menu->term_id,
                )
            );
            $front_page_id = get_page_by_title( 'Home' );
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $front_page_id->ID );
        }
	}
}