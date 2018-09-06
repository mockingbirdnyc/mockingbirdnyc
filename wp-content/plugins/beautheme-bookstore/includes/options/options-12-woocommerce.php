<?php
/**
 * Options Woocommerce
 * @package Beau-Core
 * @subpackage Redux
 */

Redux::setSection( $opt_name, array(
    'title'            => __( 'Woocommerce', 'beau-core' ),
    'id'               => 'sidebar',
    'customizer_width' => '200px',
    'icon'             => 'el el-shopping-cart'
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Archive', 'beau-core' ),
    'id'               => 'archive_shop',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'       => 'style-shop',
            'type'     => 'select',
            'title'    => __( 'Select style Shop', 'bebostore' ),
            'subtitle' => __( 'Chose your style of shop page.</br>(If choose Full Grid please select display 5 column in shop page.)', 'bebostore' ),
            'options'  => array( 'shop-style-1' => 'Full Grid', 'shop-style-2' => 'Shop List'),
            'default'  => 'shop-style-1',
        ),
        array(
            'id'        => 'enabled-cart-header',
            'type'      => 'button_set',
            'title'     => __( 'Show cart on header', 'bebostore' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '2'
        ),
    )
));
Redux::setSection( $opt_name, array(
    'title'            => __( 'Details', 'beau-core' ),
    'id'               => 'Details_shop',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'       => 'style-shop-details',
            'type'     => 'select',
            'title'    => __( 'Select style Shop details', 'bebostore' ),
            'subtitle' => __( 'Chose your style of shop details.</br>(If choose Full Grid please select display 5 column in shop page.)', 'bebostore' ),
            'options'  => array( 'shop-style-1' => 'Full Grid', 'shop-style-2' => 'Shop List', 'shop-style-3' => 'Shop special'),
            'default'  => 'shop-style-1',
        ),
         array(
            'id'       => 'flip-book',
            'type'     => 'button_set',
            'title'    => __( 'Show flip book?', 'bebostore' ),
            'subtitle' => __( 'Do you want to show flip book in details product?', 'bebostore' ),
            'options'  => array(
                'Yes' => 'Yes',
                'No' => 'No'
            ),
        ),

        array(
            'id'        => 'enabled-wishlist',
            'type'      => 'button_set',
            'title'     => __( 'Enabled wishlist', 'bebostore' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '2'
        ),

        array(
            'id'        => 'enabled-show-price',
            'type'      => 'button_set',
            'title'     => __( 'Show price product', 'bebostore' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '2'
        ),

        array(
            'id'        => 'enabled-add-to-cart',
            'type'      => 'button_set',
            'title'     => __( 'Show add to cart', 'bebostore' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '2'
        ),
    )
));