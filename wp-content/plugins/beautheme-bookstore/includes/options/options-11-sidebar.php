<?php
/**
 * Options Sidebar
 * @package Beau-Core
 * @subpackage Redux
 */

Redux::setSection( $opt_name, array(
    'title'            => __( 'Sidebar', 'beau-core' ),
    'id'               => 'sidebar',
    'customizer_width' => '200px',
    'icon'             => 'el-icon-share-alt'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Sidebar', 'beau-core' ),
    'id'               => 'Sidebar_option',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
    	array(
		    'id'             => 'sidebar-padding',
		    'type'           => 'spacing',
		    'output'         => array('.site-Sidebar'),
		    'mode'           => 'margin',
		    'units_extended' => 'false',
		    'title'          => esc_html__( 'Sidebar padding','beau-core' ),
		    'subtitle'       => __('Allow your users to choose the spacing or margin they want.', 'beau-core'),
		    'desc'           => __('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'beau-core'),
		    'default'            => array(
		        'margin-top'     => '1px', 
		        'margin-right'   => '2px', 
		        'margin-bottom'  => '3px', 
		        'margin-left'    => '4px',
		        'units'          => 'em', 
		    )
		),
		array(
        	'id'       => 'sidebar-bg',
		    'type'     => 'color',
		    'title'    => __('Sidebar Background Color', 'beau-core'), 
		    'subtitle' => __('Pick a background color for the Sidebar (default: #fff).', 'beau-core'),
		    'default'  => '#FFFFFF',
		    'validate' => 'color',
			'transparent' => false
        ),
        array(
		    'id'          => 'typography-sidebar',
		    'type'        => 'typography',
		    'title'       => __('Typography Sidebar', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.widget-area'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all sidebar text.', 'beau-core'),
		),
        array(
            'id'       => 'widget_Sidebar_init',
		    'type'     => 'switch',
		    'title'    => __('Register Sidebar Widget', 'beau-core'),
		    'subtitle' => __('Turn on to enable Sidebar widget', 'beau-core'),		    
		    'default'  => true,
        ),
    )
) );