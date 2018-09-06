<?php
/**
 * Options Advanced
 * @package Beau-Core
 * @subpackage Redux
 */
// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
 Redux::setSection( $opt_name, array(
    'title'            => __( 'Custom CSS', 'beau-core' ),
    'id'               => 'custom-css',
    'customizer_width' => '200px',
    'icon'             => 'el el-css',
    'fields'            => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __('CSS Code', 'redux-framework-demo'),
            'subtitle' => __('Enter your CSS code in the field below. Do not include any tags or HTML in the field. Custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed. Don\'t URL encode image or svg paths. Contents of this field will be auto encoded.', 'beau-core'),
            'mode'     => 'css',
            'theme'    => 'chrome',
            'desc'     => '',
            'default'  => ""
        ),
    )
) );