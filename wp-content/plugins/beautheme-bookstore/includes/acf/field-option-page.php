<?php
/**
 * Page Options
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$list_slide = '';
if (function_exists('get_sliders')) {
    $list_slide = get_sliders();
}
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'group_5947960eb1587',
    'title' => 'Beau Page options',
    'fields' => array (
        array (
            'key' => 'field_594796177dca1',
            'label' => 'Header options',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
        ),
        array (
            'key' => 'field_5948ed91e7a70',
            'label' => 'Select style header',
            'name' => 'header_style',
            'type' => 'select',
            'instructions' => 'This options will be replace theme options.',
            'required' => 0,
            'conditional_logic' => array (
                array (
                    array (
                        'field' => '',
                        'operator' => '==',
                    ),
                ),
            ),
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array (
                'default' => 'Header Default',
                'style1' => 'Header Style 1',
                'style2' => 'Header Style 1',
            ),
            'default_value' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
        ),
        array (
            'key' => 'field_5948ef14e7a72',
            'label' => 'Header Background Color',
            'name' => 'header-bg',
            'type' => 'color_picker',
            'instructions' => 'Pick a background color for the Header (default: #fff).',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
        ),
        array (
            'key' => 'field_5948f005e7a78',
            'label' => 'Header shadow',
            'name' => 'header-shadow',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array (
                'yes' => 'Yes',
                'no' => 'No',
            ),
            'allow_null' => 0,
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => '',
            'layout' => 'vertical',
            'return_format' => 'value',
        ),
        array (
            'key' => 'field_5948f091080b3',
            'label' => 'Logo options',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        array (
            'key' => 'field_5948f0e8080b4',
            'label' => 'Default Logo',
            'name' => 'defaut-logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array (
            'key' => 'field_5948f118080b5',
            'label' => 'Sticky Header Logo',
            'name' => 'fixed-logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array (
            'key' => 'field_5948f123080b6',
            'label' => 'Mobile Logo',
            'name' => 'mobile-logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));

endif;