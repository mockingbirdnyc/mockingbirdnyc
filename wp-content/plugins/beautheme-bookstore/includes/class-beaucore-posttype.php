<?php
/**
 * Settings Custom Post Type
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore_PostType' ) ) {
    /**
     * The main beau-core class.
     */
    class BeauCore_PostType {
		/**
         * Instance of the class.
         *
         * @static
         * @access protected
         * @since 1.0.0
         * @var object
         */
        protected static $instance = null;


    	public function __construct() {

            // Register custom post-types and taxonomies.
            add_action( 'init', array( $this, 'register_post_types' ) );
            add_filter( 'comment_form_default_fields',array( $this, 'remove_comment_fields'));


            // Add custom class next prev nav detail
            add_filter('next_post_link', array( $this, 'beau_link_attributes_next'));
            add_filter('previous_post_link', array( $this, 'beau_link_attributes'));
            //Register field afc.
            $this->init_acf();
            add_action( 'init', array($this,'cmb_initialize_cmb_meta_boxes'), 9999 );
            add_action( 'init', array($this,'add_post_type_support'), 9999 );
            $this->init_cmb2();

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
		 * Register field afc.
		 *
		 * @access public
		 * @since 1.0.0
		 */
		public function init_acf() {
			foreach ( glob( BEAU_CORE_PATH . 'includes/acf/field-*.php', GLOB_NOSORT ) as $filename ) {
				include wp_normalize_path( $filename );
			}
		}
        public function init_cmb2(){
            if (file_exists(BEAU_CORE_PATH.'/includes/cmb2/init.php')) {
                include_once wp_normalize_path( BEAU_CORE_PATH.'/includes/cmb2/init.php');
            }
        }
        public function cmb_initialize_cmb_meta_boxes() {
            if ( ! class_exists( 'cmb_Meta_Box' ) ){
                if (file_exists(BEAU_CORE_PATH .'/includes/libs/metaboxes/init.php')) {
                    require_once(BEAU_CORE_PATH .'/includes/libs/metaboxes/init.php');
                }
            }

        }
        public function remove_comment_fields($fields) {
            unset($fields['url']);
            return $fields;
        }
        public function beau_link_attributes($output) {
            $injection = 'class="next-back prev-post"';
            return str_replace('<a href=', '<a '.$injection.' href=', $output);
        }
        public function beau_link_attributes_next($output) {
            $injection = 'class="next-back next-post"';
            return str_replace('<a href=', '<a '.$injection.' href=', $output);
        }
		/**
		 * Register custom post types.
		 *
		 * @access public
		 * @since 1.0.0
		 */
		public function register_post_types() {
            //Author Book
            register_post_type(
                'authorbook',
                array(
                    'labels' => array(
                        'name'          => _x( 'Author Book', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Author Book', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Author Book ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Author Book', 'beau-core' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-id-alt',
                    'query_var' => true,
                    'show_ui' => true,
                    'menu_position' => 5,
                    'hierarchical' => false,
                    'show_in_nav_menus' => false,
                    'rewrite' => array(
                        'slug' => 'author-book',
                        'with_front' => false,
                    ),
                    'supports' => array( 'title', 'editor', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            //Publisher
            register_post_type(
                'publisher',
                array(
                    'labels' => array(
                        'name'          => _x( 'Publishers', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Publisher', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Publisher ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Publisher', 'beau-core' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-category',
                    'query_var' => true,
                    'show_ui' => true,
                    'hierarchical' => false,
                    'menu_position' => 5,
                    'show_in_nav_menus' => false,
                    'rewrite' => array(
                        'slug' => 'publisher',
                        'with_front' => false,
                    ),
                    'supports' => array( 'title', 'editor', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            //Testimonial
            register_post_type(
                'testimonial',
                array(
                    'labels' => array(
                        'name'          => _x( 'Testimonials', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Testimonial', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Testimonial ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Testimonial', 'beau-core' ),
                    ),
                    'public' => false,
                    'menu_icon' => 'dashicons-testimonial',
                    'query_var' => true,
                    'show_ui' => true,
                    'hierarchical' => false,
                    'menu_position' => 5,
                    'show_in_nav_menus' => false,
                    'supports' => array( 'title', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            //Store
            register_post_type(
                'store',
                array(
                    'labels' => array(
                        'name'          => _x( 'Stores', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Store', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Store ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Store', 'beau-core' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-store',
                    'query_var' => true,
                    'show_ui' => true,
                    'hierarchical' => false,
                    'menu_position' => 5,
                    'show_in_nav_menus' => false,
                    'rewrite' => array(
                        'slug' => 'store',
                        'with_front' => false,
                    ),
                    'supports' => array( 'title', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            //Store
            register_post_type(
                'team',
                array(
                    'labels' => array(
                        'name'          => _x( 'Teams', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Team', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Team ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Team', 'beau-core' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-image-filter',
                    'query_var' => true,
                    'show_ui' => true,
                    'hierarchical' => false,
                    'menu_position' => 5,
                    'show_in_nav_menus' => false,
                    'rewrite' => array(
                        'slug' => 'team',
                        'with_front' => false,
                    ),
                    'supports' => array( 'title', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            //Retailers
            register_post_type(
                'retailers',
                array(
                    'labels' => array(
                        'name'          => _x( 'Retailers', 'Post Type General Name', 'beau-core' ),
                        'singular_name' => _x( 'Retailers', 'Post Type Singular Name', 'beau-core' ),
                        'add_new_item'  => _x( 'Add New Retailers ', 'beau-core' ),
                        'edit_item'  => _x( 'Edit Retailers', 'beau-core' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-image-filter',
                    'query_var' => true,
                    'show_ui' => true,
                    'hierarchical' => false,
                    'menu_position' => 5,
                    'show_in_nav_menus' => false,
                    'rewrite' => array(
                        'slug' => 'retailers',
                        'with_front' => false,
                    ),
                    'supports' => array( 'title', 'revisions','page-attributes'),
                    'can_export' => true,
                )
            );
            register_taxonomy_for_object_type( 'category', 'attachment' );
		}
        public function add_post_type_support(){
            post_type_supports( 'authorbook','custom-fields');
        }
    }
   //Load
}
