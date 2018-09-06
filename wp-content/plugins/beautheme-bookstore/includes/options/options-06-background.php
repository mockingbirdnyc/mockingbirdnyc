<?php
/**
 * Options background
 * @package Beau-Core
 * @subpackage Redux
 */
 Redux::setSection( $opt_name, array(
    'title'            => __( 'Background', 'beau-core' ),
    'id'               => 'background',
    'customizer_width' => '200px',
    'icon'             => 'el-icon-photo'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Background', 'beau-core' ),
    'id'               => 'background_option',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
    	array(         
		    'id'       => 'Body-background',
		    'type'     => 'background',
		    'title'    => __('Body Background', 'beau-core'),
		    'subtitle' => __('Body background with image, color, etc.', 'beau-core'),
		    'desc'     => __('This is the description field, again good for additional info.', 'beau-core'),
		    'output'    => array(
		        'background-color' => 'Body',
		        'background-image' => 'Body', 
		        'background-repeat' => 'Body', 
		        'background-position' => 'Body', 
		        'background-size' => 'Body', 
		        'background-attachment' => 'Body', 
		    )
		),
    )
) );