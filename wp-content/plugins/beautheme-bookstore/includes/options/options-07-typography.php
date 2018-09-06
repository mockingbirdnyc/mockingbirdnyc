<?php
/**
 * Options typography
 * @package Beau-Core
 * @subpackage Redux
 */
 Redux::setSection( $opt_name, array(
    'title'            => __( 'Typography', 'beau-core' ),
    'id'               => 'typography',
    'customizer_width' => '200px',
    'icon'             => 'el-icon-fontsize'
) );


Redux::setSection( $opt_name, array(
    'title'            => __( 'Heading Typography', 'beau-core' ),
    'id'               => 'typography_heading',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
    	array(
		    'id'          => 'typography-h1',
		    'type'        => 'typography',
		    'title'       => __('H1 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h1','h1','.class-h1'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
		array(
		    'id'          => 'typography-h2',
		    'type'        => 'typography',
		    'title'       => __('H2 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h2','h2','.class-h2'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
		array(
		    'id'          => 'typography-h3',
		    'type'        => 'typography',
		    'title'       => __('H3 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h3','h3','.class-h3'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
		array(
		    'id'          => 'typography-h4',
		    'type'        => 'typography',
		    'title'       => __('H4 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h4','h4','.class-h4'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
		array(
		    'id'          => 'typography-h5',
		    'type'        => 'typography',
		    'title'       => __('H5 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h5','h5','.class-h5'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
		array(
		    'id'          => 'typography-h6',
		    'type'        => 'typography',
		    'title'       => __('H6 Typography', 'beau-core'),
		    'google'      => true,
		    'font-backup' => true,
		    'output'      => array('.h6','h6','.class-h6'),
		    'units'       =>'px',
		    'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
		),
    )
) );


Redux::setSection( $opt_name, array(
    'title'            => __( 'Body Typography', 'beau-core' ),
    'id'               => 'typography_body',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'          => 'typography-body',
            'type'        => 'typography',
            'title'       => __('Body Typography', 'beau-core'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('body'),
            'units'       =>'px',
            'subtitle'    => __('These settings control the typography for all body text.', 'beau-core'),
        ),
        array(
            'id'          => 'typography-blockquote',
            'type'        => 'typography',
            'title'       => __('Blockquote Typography', 'beau-core'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('blockquote'),
            'units'       =>'px',
            'subtitle'    => __('These settings control the typography for blockquote text.', 'beau-core'),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Button', 'beau-core' ),
    'id'               => 'button_style',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'          => 'button-style',
            'type'        => 'button_set',
            'title'       => __('Button style', 'beau-core'),
            'options'  => array(
                '1' => 'Orange',
                '2' => 'White',
            ),
            'default'  => '1',
        ),
        array(
            'id'       => 'text-button',
            'type'     => 'typography',
            'title'    => __( 'Text button style','beau-core' ),
            // 'compiler' => array('button *'),
            'output'   => array('button,.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a'),
            'subtitle' => __( 'Specify the button font properties.','beau-core' ),
            'google'   => true,
            'required' => array('button-style','!=' ,'2')

        ),
        array(
            'id'       => 'background-button',
            'type'     => 'color_alpha',
            'title'    => __( 'Background button color','beau-core' ),
            // 'compiler' => array('button *'),
            'output'   => array('background-color' => 'button,.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a'),
            'important' => true,
            'transparent' => false,
            'required' => array('button-style','!=' ,'2')

        ),
        array(
            'id'       => 'background-button-hover',
            'type'     => 'color_alpha',
            'title'    => __( 'Background button color hover','beau-core' ),
            // 'compiler' => array('button *'),
            'output'   => array('background-color' => 'button:hover,.woocommerce div.product form.cart .button:hover,header.header-two .search-navigation-full .search form button:hover,.shopping-cart .shop_table tfoot .checkout-button:hover,.shopping-cart #payment #place_order:hover,.shopping-cart .shop_table tbody tr td.product-add-to-cart a:hover'),
            'important' => true,
            'transparent' => false,
            'required' => array('button-style','!=' ,'2')
        ),
        array(
            'id'       => 'header-border',
            'type'     => 'border',
            'title'    => __('Border button', 'beau-core'),
            'subtitle' => __('Only color validation can be done on this field type', 'redux-framework-demo'),
            'output'   => array('button,.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a'),
            'desc'     => __('This is the description field, again good for additional info.', 'beau-core'),
            'required' => array('button-style','!=' ,'2')
        ),
        array(
                'id'       => 'text-button-white',
                'type'     => 'typography',
                'title'    => __( 'Text button style','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'subtitle' => __( 'Specify the button font properties.','beautheme' ),
                'google'   => true,
                'required' => array('button-style','!=' ,'1')
            ),
            array(
                'id'       => 'background-button-white',
                'type'     => 'color_alpha',
                'title'    => __( 'Background button color','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => '.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'important' => true,
                'transparent' => false,
                'required' => array('button-style','!=' ,'1')
            ),
            array(
                'id'       => 'background-button-hover-white',
                'type'     => 'color_alpha',
                'title'    => __( 'Background button color hover','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => '.form-subcribe .subcribe-form-view .book-button:hover,.book-comment-form .comment-form .form-submit .submit:hover,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit:hover,.book-button-active:hover'),
                'important' => true,
                'transparent' => false,
                'required' => array('button-style','!=' ,'1')
            ),
            array(
                'id'       => 'header-border-white',
                'type'     => 'border',
                'title'    => __('Border button', 'redux-framework-demo'),
                'subtitle' => __('Only color validation can be done on this field type', 'redux-framework-demo'),
                'output'   => array('.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
                'required' => array('button-style','!=' ,'1')
            ),
    )
) );