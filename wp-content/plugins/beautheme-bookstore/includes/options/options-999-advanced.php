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
    'title'            => __( 'Advanced', 'beau-core' ),
    'id'               => 'advanced',
    'customizer_width' => '200px',
    'icon'             => 'el el-puzzle',
    'fields'            => array(

    )
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'API Key', 'beau-core' ),
    'id'               => 'advanced_api',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'       => 'mailchimp-api',
            'type'     => 'text',
            'title'    => __( 'Your mailchimp API','bebostore' ),
            'subtitle' => __( 'Grab an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">here</a>.','bebostore' ),
        ),

         array(
            'id'        => 'mailchimp-groupid',
            'type'      => 'text',
            'title'     => __( 'Your group id','bebostore' ),
            'subtitle'  => __( 'Grab your List\'s Unique Id by going <a href="http://admin.mailchimp.com/lists/" target="_blank">here</a>.<br> Click the "settings" link for the list - the Unique Id is at the bottom of that page.','bebostore' ),
        ),
    )
));
Redux::setSection( $opt_name, array(
    'title'            => __( 'Theme Features', 'beau-core' ),
    'id'               => 'advanced_theme_features',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'        => 'enable_author_ajax',
            'type'      => 'button_set',
            'title'     => __( 'Enable Author Ajax', 'beau-core' ),
            'options'   => array(
                '2'     => 'No',
                '1'     => 'Yes',
            ),
            'default'   => '1',
            'subtitle'    => __( 'Default using ajax for quick view detail author, if no it will show detail as a static page', 'beau-core' ),
        ),
        array(
            'id'        => 'disable_search',
            'type'      => 'button_set',
            'title'     => __( 'Disable Search', 'beau-core' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '1'
        ),
        array(
            'id'        => 'disable_3d',
            'type'      => 'button_set',
            'title'     => __( 'Disable 3D Flip Book', 'beau-core' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '1'
        ),
    )
));