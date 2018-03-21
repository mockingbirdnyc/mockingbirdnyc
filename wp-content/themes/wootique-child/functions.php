<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/custom.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/default.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/shorcodes.css' );

}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/
add_action ('init', 'change_columns');
function change_columns() {
    add_filter( 'loop_shop_columns', 'custom_loop_columns' );
    
    function custom_loop_columns() {
        return 4;
    }
}
add_filter( 'loop_shop_per_page', function ( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    return 36;
}, 20 );

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>
