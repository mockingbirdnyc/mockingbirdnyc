<?php
/**
 * Deprecated Field
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if( function_exists('register_field_group') ):
     register_field_group(array (
        'id' => 'acf_books-category',
        'title' => __('Book\'s Category','beau-core'),
        'fields' => array (
            array (
                'key' => 'field_books_category',
                'label' => __('Show on product\'s category','beau-core'),
                'name' => 'books_category',
                'type' => 'taxonomy',
                'taxonomy' => 'product_cat',
                'field_type' => 'multi_select',
                'allow_null' => 0,
                'load_save_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
                'wrapper' => array (
                    'class' => 'acf_none'
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    //More Infor mation
    register_field_group(array (
        'id' => 'acf_more-information',
        'title' => 'More information',
        'fields' => array (
            array (
                'key' => 'field_book_author',
                'label' => __('Book\'s author','bebostore'),
                'name' => 'book_author',
                'type' => 'relationship',
                'instructions' => __('You can chose multimple author for this book. If you forget create the author <a href="/wp-admin/post-new.php?post_type=authorbook" target="_blank">Click here</a> to create it','bebostore'),
                'return_format' => 'object',
                'post_type' => array (
                    0 => 'authorbook',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_title',
                ),
                'max' => '',
            ),
            array (
                'key' => 'field_book_publisher',
                'label' => __('Book\'s publisher','bebostore'),
                'name' => 'book_publisher',
                'type' => 'relationship',
                'instructions' => __('You can chose multimple publisher for this book. If you forget create the publisher <a href="/wp-admin/post-new.php?post_type=publisher" target="_blank">Click here</a> to create it','bebostore'),
                'return_format' => 'object',
                'post_type' => array (
                    0 => 'publisher',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_title',
                ),
                'max' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    //Product type
    register_field_group(array (
        'id' => 'acf_media-list',
        'title' => 'Your mp3 list files',
        'fields' => array (
            array (
                'key' => 'field_files_mp3',
                'label' => 'List files MP3',
                'name' => 'list_files_mp3',
                'type' => 'repeater',
                'instructions' => 'Your list file MP3 to run',
                'sub_fields' => array (
                    array (
                        'key' => 'field_file_name',
                        'label' => 'File name mp3',
                        'name' => 'file_mp3_name',
                        'type' => 'text',
                        'column_width' => 60,
                    ),
                    array (
                        'key' => 'field_file_mp3',
                        'label' => 'File',
                        'name' => 'file_mp3',
                        'type' => 'file',
                        'column_width' => 30,
                        'save_format' => 'url',
                        'library' => 'all',
                    ),
                    array (
                        'key' => 'field_file_time',
                        'label' => 'Time',
                        'name' => 'file_mp3_time',
                        'type' => 'text',
                        'column_width' => 10,
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
                'wrapper' => array (
                    'class' => 'acf_none'
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'key' => 'affiliate_book',
        'title' => 'Affiliate book',
        'fields' => array (
            array (
                'key' => 'field_enable_affiliate',
                'label' => 'Enable Affiliate',
                'name' => 'enable_affiliate',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_disable_add_to_cart',
                'label' => 'Disable add to cart',
                'name' => 'disable_add_to_cart',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_retailers',
                'label' => 'Retailers',
                'name' => 'retailers',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_enable_affiliate',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => '',
                'max' => '',
                'layout' => 'row',
                'button_label' => 'Add Row',
                'sub_fields' => array (
                    array (
                        'key' => 'field_product_url',
                        'label' => 'Product URL',
                        'name' => 'product_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                    array (
                        'key' => 'field_product_price',
                        'label' => 'Product price',
                        'name' => 'product_price',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_enable_affiliate',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_type_retailers',
                        'label' => 'Type retailers',
                        'name' => 'type_retailers',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array (
                            0 => 'retailers',
                        ),
                        'taxonomy' => array (
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'return_format' => 'id',
                        'ui' => 1,
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

    register_field_group(array (
        'key' => 'retailer_infor',
        'title' => 'Retailer infor',
        'fields' => array (
            array (
                'key' => 'field_icon_retailer',
                'label' => 'Icon Retailer',
                'name' => 'icon_retailer',
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
                    'value' => 'retailers',
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