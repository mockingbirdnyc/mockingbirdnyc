<?php
/**
 * BeauAdmin Dashboard
 * @package BeauAdmin
 * @author BeauThemes
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauAdmin_Dashboard' ) ) {
    /**
     * The main class.
     */

    class BeauAdmin_Dashboard {
        public function __construct(){
            add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );

        }
        /**
         * Adds the news dashboard widget.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function add_dashboard_widget() {
            // Create the widget.
            wp_add_dashboard_widget( 'beauagency_news', apply_filters( 'beauadmin_dashboard_widget_title', esc_attr__( 'BeauTheme News', 'beauadmin' ) ), array( $this, 'display_news_dashboard_widget' ) );

            // Make sure our widget is on top off all others.
            global $wp_meta_boxes;

            // Get the regular dashboard widgets array.
            $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

            // Backup and delete our new dashboard widget from the end of the array.
            $beau_widget_backup = array(
                'beauagency_news' => $normal_dashboard['beauagency_news'],
            );
            unset( $normal_dashboard['beauagency_news'] );

            // Merge the two arrays together so our widget is at the beginning.
            $sorted_dashboard = array_merge( $beau_widget_backup, $normal_dashboard );

            // Save the sorted array back into the original metaboxes.
            $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
        }
        /**
         * Renders the news dashboard widget.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function display_news_dashboard_widget() {

            // Create two feeds, the first being just a leading article with data and summary, the second being a normal news feed.
            $feeds = array(
                'first' => array(
                    'link'         => 'http://blog.beautheme.com/',
                    'url'          => 'http://blog.beautheme.com/feed/',
                    'title'        => esc_attr__( 'Beau News', 'beauadmin' ),
                    'items'        => 1,
                    'show_summary' => 1,
                    'show_author'  => 0,
                    'show_date'    => 1,
                ),
                'news' => array(
                    'link'         => 'http://blog.beautheme.com/',
                    'url'          => 'http://blog.beautheme.com/feed/',
                    'title'        => esc_attr__( 'Beau News', 'beauadmin' ),
                    'items'        => 3,
                    'show_summary' => 0,
                    'show_author'  => 0,
                    'show_date'    => 0,
                ),
            );

            wp_dashboard_primary_output( 'beauagency_news', $feeds );
        }

    }
}