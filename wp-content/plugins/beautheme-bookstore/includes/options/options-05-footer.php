<?php
/**
 * Options Footer
 * @package Beau-Core
 * @subpackage Redux
 */
 Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer', 'beau-core' ),
    'id'               => 'footer',
    'customizer_width' => '200px',
    'icon'             => 'el-icon-arrow-down',
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer Content', 'beau-core' ),
    'id'               => 'sub-footer-content',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
         array(
            'id'        => 'footer-type',
            'type'      => 'select',
            'title'     => __( 'Select Option', 'beau-core' ),
            'subtitle'  => __( 'Chose your default type of archive blog page', 'beau-core' ),
            'options'   => array(
                'default'       => 'Default',
                'home7'         => 'Home 7',
            )
        ),
        array(
            'id'       => 'footer-widget-number',
            'type'     => 'select',
            'title'    => __( 'Chose footer columns', 'beau-core' ),
            'subtitle' => __( 'Chose your custom widget number you want to show', 'beau-core' ),
            'options'  => array(
                '1' =>  '1',
                '2' =>  '2',
                '3' =>  '3',
                '4' =>  '4',
                '6' =>  '6',
            )
        ),
        array(
            'id'        => 'enable_back_to_top',
            'type'      => 'button_set',
            'title'     => __( 'Enable back to top', 'beau-core' ),
            'options'   => array(
                '1'     => 'No',
                '2'     => 'Yes',
            ),
            'default'   => '1'
        ),
        array(
            'id'       => 'store-footer-text',
            'type'     => 'editor',
            'title'    => __( 'Custom footer', 'beau-core' ),
            'subtitle' => __( 'Use any of the features of WordPress editor inside your panel!', 'beau-core' ),
            'default'  => 'Custom text for footer.',
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer Styling', 'beau-core' ),
    'id'               => 'sub-footer-styling',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
         array(
            'id'        => 'footer-text',
            'type'      => 'color_alpha',
            'title'     => __( 'Footer Text Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('footer'),
            'output'   => array(
                'footer', 'footer .footer-widget .widget-title',
                'footer .footer-widget .widget-body .menu li a',
                'footer .footer-widget .widget-body',
                '.book-info span.book-name a',
                'footer .footer-widget .widget-body .book-info .book-price',
                '.widget-footer .list-social a'
            ),
            'mode'      => 'color',
        ),
        array(
            'id'        => 'footer-bg',
            'type'      => 'background',
            'title'     => __( 'Footer background Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('footer'),
            'output'   => array( 'footer' ),
            'mode'      => 'background',
            //'validate' => 'colorrgba',
        ),
        array(
            'id'        => 'footer-bottom-bg',
            'type'      => 'color_alpha',
            'title'     => __( 'Footer bottom Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('.bottom-footer'),
            'output'   => array( 'footer .bottom-footer' ),
            'mode'      => 'background',
        ),
         array(
            'id'        => 'footer-bottom-text',
            'type'      => 'color_alpha',
            'title'     => __( 'Footer bottom Text Color', 'beau-core' ),
            'subtitle'  => __( 'Gives you the RGBA color.', 'beau-core' ),
            // 'compiler' => array('.bottom-footer'),
            'output'   => array( 'footer .bottom-footer .copyright' ),
            'mode'      => 'color',
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer Payment', 'beau-core' ),
    'id'               => 'sub-footer-payment',
    'subsection'        => true,
    'customizer_width' => '200px',
    'fields'            => array(
        array(
            'id'        => 'link-payment',
            'type'      => 'select',
            'multi'     => true,
            'title'     => __( 'Shipping & Payment', 'beau-core' ),
            'subtitle'  => __( 'Select your payment for your page', 'beau-core' ),
            'desc'      => __( 'Chose your payment for your footer page.', 'beau-core' ),
            //Must provide key => value pairs for radio options
            'options'   => array(
                'mastercard'        => 'Master card',
                'paypal'            => 'Paypal',
                'visa'              => 'Visa',
                'dhl'               => 'DHL',
                'american-express'  => 'American Express',
                'fedex'             => 'FedEx',
            ),
            'default'  => array()
        ),
        array(
            'id'       => 'store-mastercard',
            'type'     => 'text',
            'title'    => __( 'Your Mastercard page', 'beau-core' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'store-paypal',
            'type'     => 'text',
            'title'    => __( 'Your paypal link', 'beau-core' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'store-visa',
            'type'     => 'text',
            'title'    => __( 'Your visa payment', 'beau-core' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'store-dhl',
            'type'     => 'text',
            'title'    => __( 'Your dhl page', 'beau-core' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'store-american-express',
            'type'     => 'text',
            'title'    => __( 'American Express link', 'beau-core' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'store-fedex',
            'type'     => 'text',
            'title'    => __( 'FedEx link', 'beau-core' ),
            'default'  => '#',
        ),
    )
) );