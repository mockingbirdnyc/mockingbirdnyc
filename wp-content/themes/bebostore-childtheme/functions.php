<?php

/* Load child theme stylesheet */
function bebochild_theme_style() {
	wp_enqueue_style( 'beboparent-theme-style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'bebochild-childtheme-style', get_stylesheet_uri(), array('bebochild-theme-style') );
}
add_action( 'wp_enqueue_scripts', 'bebochild_theme_style' );


/* Insert custom functions below */
function photo_swipe_scripts() {
	wp_enqueue_style( 'photoswipe-style', get_stylesheet_directory_uri() . '/photoswipe/photoswipe.css' );
	wp_enqueue_style( 'photoswipe-default-skin', get_stylesheet_directory_uri() . '/photoswipe/default-skin/default-skin.css' );
	wp_enqueue_script( 'photoswipe-ui-default-script', get_stylesheet_directory_uri() . '/photoswipe/photoswipe-ui-default.js' );
	wp_enqueue_script( 'photoswipe-ui-default-min-script', get_stylesheet_directory_uri() . '/photoswipe/photoswipe-ui-default.min.js' );
	wp_enqueue_script( 'photoswipe-script', get_stylesheet_directory_uri() . '/photoswipe/photoswipe.js' );
	wp_enqueue_script( 'photoswipe-min-script', get_stylesheet_directory_uri() . '/photoswipe/photoswipe.min.js' );
	wp_enqueue_script( 'photoswipe-main-script', get_stylesheet_directory_uri() . '/photoswipe/main.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'photo_swipe_scripts' );
