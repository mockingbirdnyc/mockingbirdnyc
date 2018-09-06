<?php
$themeInfo            =  wp_get_theme();
$themeName            = trim($themeInfo['Title']);
$themeAuthor          = trim($themeInfo['Author']);
$themeAuthor_URI      = trim($themeInfo['Author URI']);
$themeVersion         = trim($themeInfo['Version']);
$textDomain           = 'bebostore';

define('BEAU_BASE_URL', get_template_directory_uri());
define('BEAU_BASE', get_template_directory());
define('BEAU_THEME_NAME', $themeName);
define('BEAU_TEXT_DOMAIN', $textDomain);
define('BEAU_THEME_AUTHOR', $themeAuthor);
define('BEAU_THEME_AUTHOR_URI', $themeAuthor_URI);
define('BEAU_THEME_VERSION', $themeVersion);
define('BEAU_IMAGES', BEAU_BASE_URL . '/asset/images');
define('BEAU_JS', BEAU_BASE_URL . '/asset/js');
define('BEAU_CSS', BEAU_BASE_URL . '/asset/css');
define('PLUGINS_PATH', 'http://plugins.beautheme.com');
define('PLUGINS_PATH_REQUIRE', BEAU_BASE.'/includes/');
define('PLUGINS_PATH_LIBS', BEAU_BASE.'/libs/');
define('BEAU_THEME_DOMAIN','bebostore');


//For multiple language
$language_folder = BEAU_BASE .'/languages';
load_theme_textdomain( $textDomain, $language_folder );

if (!class_exists('bebostore_ThemeFunction')) {
    class bebostore_ThemeFunction {

        public function __construct(){
            //Get all file php in include folder
            $this -> bebostore_Get_files();
        }
        //Include php
        public function bebostore_Get_files(){
            $files = scandir(get_template_directory().'/includes/');
            foreach ($files as $key => $file) {
                if (preg_match("/\.(php)$/", $file)) {
                    require_once(get_template_directory().'/includes/'.$file);
                }
            }
        }
    }
    new bebostore_ThemeFunction;
}
require get_parent_theme_file_path( '/beauadmin/beauadmin.php' );
if ( ! isset( $content_width ) ) $content_width = 900;
///Beautheme support


// Add theme support for this theme
function bebostore_theme_support() {

    add_theme_support( "excerpt", array( "post" ) );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( 'title-tag' );
    add_theme_support( "custom-header", array());
    add_theme_support( "custom-background", array()) ;
    add_editor_style();

    // For thumbnai and size image

    add_image_size('bebostore-main-thumbnail','345','520', true);
    add_image_size('bebostore-blog-thumbnail', '525', '340', TRUE );
    add_image_size('bebostore-banner-thumbnail', '1368', '400', TRUE );
    add_image_size('bebostore-thumbnail', '800', '400', TRUE );
    add_image_size('bebostore-book-thumb', '325', '500');


    // Theme support with nav menu
    add_theme_support( "nav-menus" );
    $nav_menus['main-menu'] = esc_html__( 'Main menu', 'bebostore');
    register_nav_menus( $nav_menus );
}
add_action( 'after_setup_theme', 'bebostore_theme_support' );

function bebostore_scripts(){
    // Lib jquery
    if (!is_admin()) {
        global $beau_option;
        if (!is_404()) {
            wp_enqueue_script('jquery-idangerous', BEAU_JS .'/idangerous.swiper.min.js', array('jquery'), '2.7.0', FALSE);
            wp_enqueue_script('jquery-idangerous-scrollbar', BEAU_JS .'/idangerous.swiper.scrollbar-2.1.js', array('jquery'), '2.7.0', FALSE);
            wp_enqueue_script('jquery-isotope', BEAU_JS .'/isotope.pkgd.min.js', array('jquery'), '1.2.7', TRUE);
            wp_enqueue_script('jquery-layout-mode', BEAU_JS .'/layout-mode.js', array('jquery'), '1.2.7', TRUE);
            wp_enqueue_script('jquery-layout-modes-masonry', BEAU_JS .'/layout-modes/masonry.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-layout-modes-fit-rows', BEAU_JS .'/layout-modes/fit-rows.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-layout-modes-vertical', BEAU_JS .'/layout-modes/vertical.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-wow', BEAU_JS .'/wow.min.js', array('jquery'), '1.0.3', TRUE);
            wp_enqueue_script('jquery-selectbox', BEAU_JS .'/jquery.selectbox.js', array('jquery'), '1.0.0', TRUE);

            //Js flipbook
            wp_enqueue_script('jquery-flipbook', BEAU_JS .'/books.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('jquery-flipbook-main', BEAU_JS .'/modernizr.custom.js', array('jquery'), '1.0.1', TRUE);
            //get background image color
            wp_enqueue_script('jquery-get-color', BEAU_JS .'/jquery.adaptive-backgrounds.js', array('jquery'), '1.0.1', FALSE);
            wp_enqueue_script('bootstrap',  BEAU_JS .'/bootstrap.min.js', array('jquery'), '3.3.1', FALSE);

            //check menu fix
            if (isset($beau_option['header-fixed'])) {
                wp_enqueue_script('jquery-menufix',  BEAU_JS .'/sticker-menu.js', array('jquery'), '1.0.0', TRUE);
            }

            //js scroll
            wp_enqueue_script('jquery-TweenMax', BEAU_JS .'/TweenMax.min.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('jquery-ScrollToPlugin', BEAU_JS .'/ScrollToPlugin.min.js', array('jquery'), '1.0.0', TRUE);

            //js site
            // wp_enqueue_script('jquery-author-app', BEAU_JS .'/grid.js', array('jquery'), '1.0.1', TRUE);
            wp_enqueue_script('jquery-book-app', BEAU_JS .'/bebostore.js', array('jquery'), '1.0.1', TRUE);

            // Js for playlist
            if (is_single()) {
                wp_enqueue_script('jquery-player', BEAU_JS .'/jquery.jplayer.js', array('jquery'), '2.9.2', FALSE);
                wp_enqueue_script('jquery-playlist', BEAU_JS .'/jplayer.playlist.min.js', array('jquery'), '2.9.2', FALSE);

            }
        }
        if (!is_404()) {
            wp_enqueue_style('font-awesome', BEAU_CSS .'/font-awesome.min.css', array(), '4.3.0');
            wp_enqueue_style('animate', BEAU_CSS .'/animate.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('selectbox', BEAU_CSS .'/jquery.selectbox.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('idangerous', BEAU_CSS .'/idangerous.swiper.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('style-woo', BEAU_CSS .'/bebostore_woo.css', array(), '1.0.0');
            wp_enqueue_style('flipbook', BEAU_CSS .'/css-flipbook.css', array(), '1.0.0');
        }
        wp_enqueue_style('bootstrap', BEAU_CSS .'/bootstrap.css', array(), '3.3.1');
        wp_enqueue_style('bootstrap', BEAU_CSS .'/animate.css', array(), '3.3.1');
        wp_enqueue_style('font-Merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,300italic,700italic,300,700', array(), BEAU_THEME_VERSION);
        wp_enqueue_style('font-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900', array(), BEAU_THEME_VERSION);
        wp_enqueue_style('store-style', BEAU_BASE_URL .'/style.css', array(), BEAU_THEME_VERSION);
        wp_enqueue_style('default-style', BEAU_CSS .'/bebostore.css', array(), BEAU_THEME_VERSION);
        wp_enqueue_style('default-style20', BEAU_CSS .'/bebostore20.css', array(), BEAU_THEME_VERSION);
    }
    if (is_admin()) {
        wp_enqueue_style('admin-style', BEAU_CSS .'/bebostore_admin.css', array(), BEAU_THEME_VERSION);
    }
}
add_action( 'wp_enqueue_scripts', 'bebostore_scripts' );

//Theme menu
register_nav_menus(array(
    'main-menu'     => esc_html__('Main menu', 'bebostore'),
    'sticker-menu'     => esc_html__('Sticker menu', 'bebostore'),
    'small-menu'    => esc_html__('Small menu', 'bebostore'),
    'mobile-menu'    => esc_html__('Mobile Menu', 'bebostore'),
));


// Numbered Pagination
if ( !function_exists( 'bebostore_pagination' ) ) {
    function bebostore_pagination($loop='', $range = 4) {
        global $wp_query;
        if ($loop=="") {
            $loop = $wp_query;
        }
        $big = 999999999; // need an unlikely integer
        $pages = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $loop->max_num_pages,
            'prev_next' => false,
            'type'      => 'array',
            'prev_next' => TRUE,
            'prev_text' => esc_html__('PREV','bebostore'),
            'next_text' => esc_html__('NEXT','bebostore'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="pagging"><ul>';
            foreach ( $pages as $page ) {
                echo "<li>$page</li>";
            }
           echo '</ul></div>';
        }
    }
}


function bebostore_getprefixauth(){
    global $wpdb, $table_prefix;
    $arrayPrefix = array();
    $results = $wpdb->get_results( 'SELECT DISTINCT(meta_value) FROM '.$table_prefix.'postmeta WHERE meta_key = "_beautheme_prefix_name" ORDER BY meta_value ASC', ARRAY_N );
    foreach ($results as $key => $value) {
        $arrayPrefix[$key] = $value[0];
    }
    return $arrayPrefix;
}




/* REGISTER WIDGETS ------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Product','bebostore'),
        'id'            => 'sidebar-product',
        'description'   => esc_html__('Sidebar product widget position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget col-md-3 col-sm-3 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => esc_html__('Sidebar Home 07','bebostore'),
        'id'            => 'sidebar-home-07',
        'description'   => esc_html__('Sidebar home 07 position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget widget-home-07 col-md-12 col-sm-12 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="name-widget">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar Home 06','bebostore'),
        'id'   => 'sidebar-home-06',
        'description'   => esc_html__('Sidebar home 06 position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget widget-home-3 col-md-3 col-sm-3 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="name-widget">',
        'after_title'   => '</h2>'
    ));

}

/*
Register footer sidebar
*/

////Register widget for page
function bebostore_register_sidebar() {
    global $beau_option;

    $col = $sidebarWidgets = "";

    //Register sidebar for sidebar widget
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar widget', 'bebostore' ),
            'id' => 'sidebar-widget',
            'before_widget' => '<div class="sidebar-widget">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="title-box title-sidebar-widget"><span>',
            'after_title' => '</span></div><div class="sidebar-content-widget">'
        )
    );

    //Register to show sidebar on footer
    if (isset($beau_option['footer-widget-number'])) {
        $col    = intval($beau_option['footer-widget-number']);
    }
    if($col==0){
        $col  = 4;
    }
    $columns = intval(12/$col);
    if($columns==1){
        register_sidebar(
            array(  // 1
                'name' => esc_html__( 'Footer sidebar', 'bebostore' ),
                'description' => esc_html__( 'This is footer sidebar ', 'bebostore' ),
                'id' => 'sidebar-footer-1',
                'before_widget' => '<div class="footer-column col-md-12 col-sm-12 col-xs-12"><div class="footer-widget">',
                'after_widget' => '</div></div></div>',
                'before_title' => '<div class="title-box widget-title"><span>',
                'after_title' => '</span></div><div class="widget-body">'
            )
        );
    }else{
        for ($i=1; $i <= $col; $i++) {
            register_sidebar(
                array(
                    'name' => 'Footer sidebar '.$i,
                    'id' => 'sidebar-footer-'.$i,
                    'before_widget' => '<div class="footer-column col-md-'.$columns.' col-sm-'.$columns.' col-xs-12"><div class="footer-widget">',
                    'after_widget' => '</div></div></div>',
                    'before_title' => '<div class="title-box widget-title"><span>',
                    'after_title' => '</span></div><div class="widget-body">'
                )
            );
        }
    }

}
add_action( 'widgets_init', 'bebostore_register_sidebar' );

function bebostore_get_category_product(){
    $terms = get_terms('product_cat');
    $category_product['Select...'] = 'Select';
    $category_product['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_product[$term->name] = $term->name;
        }
    }
    return $category_product;
}

function bebostore_get_category_blog(){
    $terms = get_terms('category');
    $category_blog['Select...'] = 'Select';
    $category_blog['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_blog[$term->name] = $term->name;
        }
    }
    return $category_blog;
}
//Get option page
function bebostore_option($string){
    global $beau_option;
    if (isset($beau_option[$string]) && $beau_option[$string] !=='') {
        return $beau_option[$string];
    }
    return;
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_filter('the_excerpt', 'do_shortcode');
// remove cross-sells from their normal place
remove_action( 'woocommerce_cart_collaterals',
'woocommerce_cross_sell_display' );
// add them back in further up the page
add_action ('woocommerce_after_cart', 'woocommerce_cross_sell_display' );

add_filter('the_excerpt', 'do_shortcode');
function bebostore_get_list_taxonomy_by_name($taxonomy){
    if($taxonomy != NULL ) {
        $terms = get_terms($taxonomy, array('hide_empty' => true,'orderby' => 'date','order' => 'DESC'));
        $taxonomy_list = array();
        if(empty($terms)) {
            return false;
        } else {
            foreach ($terms as $term) {
                if(is_object($term)) {
                    $taxonomy_list[] = array(
                        'value' => $term->term_id,
                        'label' => $term->name,
                    );
                }
            }
        }

    return $taxonomy_list;
    }
    else return false;

}
/**
 * Get Single Post by Post Type
 * @param  string $post_type
 * @return  array
 */
function bebostore_get_single_post( $post_type = '' ) {
      $posts = get_posts( array(
        'posts_per_page'  => -1,
        'post_type'     => $post_type,
      ));
      $result = array();
      foreach ( $posts as $post ) {
        $result[] = array(
          'value' => $post->ID,
          'label' => $post->post_title,
        );
    }

    return $result;
}
add_filter( 'woocommerce_product_tabs', 'bebostore_remove_product_tabs', 98 );

function bebostore_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}