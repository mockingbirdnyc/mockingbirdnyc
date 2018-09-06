<?php
/**
 * Options Logo
 * @package Beau-Core
 * @subpackage Redux
 */
Redux::setSection( $opt_name, array(
    'title'            => __( 'Logo', 'beau-core' ),
    'id'               => 'logo_option',
    'customizer_width' => '200px',
    'icon'             => 'el el-plus-sign',
    'fields'           => array(
         array(
            'id'       => 'logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__('Logo', 'beau-core'),
            'desc'     => esc_html__('Select an image file for your logo.', 'beau-core'),
            'url' => false
        )
    )
));