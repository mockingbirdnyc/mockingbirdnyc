<?php
/**
 * Options Blog
 * @package classictheme
 * @subpackage Redux
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog options', 'beau-core' ),
    'id'               => 'blog',
    'customizer_width' => '200px',
    'icon'             => 'el el-arrow-up',
    'fields'           => array(
         array(
            'id'       => 'archive-type',
            'type'     => 'select',
            'title'    => __( 'Select Option', 'bebostore' ),
            'subtitle' => __( 'Chose your default type of archive blog page', 'bebostore' ),
            // 'desc'     => __( 'We have ? blog archive type', 'bebostore' ),
            //Must provide ke array(
            'options'  => array(
                'default'                       => 'Default',
                'one-column-full'               => 'One column full',
                'one-column-leftsidebar'        => 'One column left sidebar',
                'one-column-rightsidebar'       => 'One column right sidebar',
                'two-columns-leftsidebar'       => 'Two columns left sidebar',
                'two-columns-rightsidebar'      => 'Two columns right sidebar',
                'three-columns-rightsidebar'    => 'Three columns right sidebar',
                'three-columns-masory'          => 'Three columns masory',
                'three-columns-full'            => 'Three columns full',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'single-page',
            'type'     => 'select',
            'title'    => __( 'Chose single type', 'bebostore' ),
            'subtitle' => __( 'Chose your custom single', 'bebostore' ),
            // 'desc'     => __( 'We have ? blog archive type', 'bebostore' ),
            //Must provide key => value pairs for select options
            'options'  => array('detail' => 'Default none sidebar', 'detailsidebar' =>'Content with sidebar'),
        ),
    )
) );

