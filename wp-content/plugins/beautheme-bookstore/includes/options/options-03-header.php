<?php
/**
 * Options Header
 * @package classictheme
 * @subpackage Redux
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
Redux::setSection( $opt_name, array(
    'title'            => __( 'Header', 'beau-core' ),
    'id'               => 'header',
    'customizer_width' => '200px',
    'icon'             => 'el el-arrow-up',
    'fields'            => array(
        array(
            'id'       => 'header-type',
            'type'     => 'select',
            'title'    => __( 'Chose your header type', 'beau-core' ),
            'subtitle' => __( 'Chose your header want to show', 'beau-core' ),
            'options'  => array(
                'default' => 'Default Menu on Top',
                'menuhumberger' => 'Only Menu Humberger',
            )
        ),
        array(
            'id'        => 'header-text-color',
            'type'      => 'color_alpha',
            'title'     => __( 'Header Text Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('.header'),
            'output' => array(
                'header','header.header-one',
                'header.header-two'
            ),
            'mode'      => 'color',
            //'validate' => 'colorrgba',
        ),
        array(
            'id'        => 'header-bg',
            'type'      => 'background',
            'title'     => __( 'Header background Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('.header'),
            'output' => array(
                'header',
                'header.header-one',
                'header.header-two',
            ),
            'mode'      => 'background',
            //'validate' => 'colorrgba',
        ),
        array(
            'id'        => 'header-dropdown-color',
            'type'      => 'color_alpha',
            'title'     => __( 'Header dropdown BG Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
            'output' => array(
                '#main-navigation .menu-item .sub-menu .menu-item',
                '#main-navigation .menu-item .sub-menu .menu-item:hover',
                '#main-navigation .menu-item .sub-menu.current-menu-item'
            ),
            'mode'      => 'background',
            //'validate' => 'colorrgba',
        ),
        array(
            'id'        => 'header-fixed',
            'type'      => 'button_set',
            'title'     => __( 'Header fixed', 'beau-core' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '2'
        ),
    )
) );
