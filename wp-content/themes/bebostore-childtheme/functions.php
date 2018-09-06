<?php

/* Load child theme stylesheet */
function bebochild_theme_style() {
	wp_enqueue_style( 'beboparent-theme-style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'bebochild-childtheme-style', get_stylesheet_uri(), array('bebochild-theme-style') );
}
add_action( 'wp_enqueue_scripts', 'bebochild_theme_style' );


/* Insert custom functions below */