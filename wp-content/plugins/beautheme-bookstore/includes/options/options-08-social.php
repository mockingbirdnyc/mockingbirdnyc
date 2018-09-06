<?php
/**
 * Options social
 * @package Beau-Core
 * @subpackage Redux
 */
 Redux::setSection( $opt_name, array(
    'title'            => __( 'Social', 'beau-core' ),
    'id'               => 'social',
    'customizer_width' => '200px',
    'icon'             => 'el-icon-share-alt'
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social link','danlet' ),
    'id'               => 'social-link',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'beau-facebook',
            'type'     => 'text',
            'title'    => esc_html__( 'Your facebook url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-twitter',
            'type'     => 'text',
            'title'    => esc_html__( 'Your twitter url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-linkedin',
            'type'     => 'text',
            'title'    => esc_html__( 'Your linkedin url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-youtube',
            'type'     => 'text',
            'title'    => esc_html__( 'Your youtube url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-google-plus',
            'type'     => 'text',
            'title'    => esc_html__( 'Your google plus url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-pinterest',
            'type'     => 'text',
            'title'    => esc_html__( 'Your pinterest url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-linkedin',
            'type'     => 'text',
            'title'    => esc_html__( 'Your linkedin url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-instagram',
            'type'     => 'text',
            'title'    => esc_html__( 'Your instagram url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-github',
            'type'     => 'text',
            'title'    => esc_html__( 'Your github url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-behance',
            'type'     => 'text',
            'title'    => esc_html__( 'Your behance url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-tumblr',
            'type'     => 'text',
            'title'    => esc_html__( 'Your tumblr url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-soundcloud',
            'type'     => 'text',
            'title'    => esc_html__( 'Your soundcloud url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-dribbble',
            'type'     => 'text',
            'title'    => esc_html__( 'Your dribbble url', 'danlet' ),
        ),
        array(
            'id'       => 'beau-rss',
            'type'     => 'text',
            'title'    => esc_html__( 'Your rss url', 'danlet' ),
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social to show','danlet' ),
    'id'               => 'social-link-show',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'show-social-link',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__( 'Social to show','danlet' ),
            'subtitle' => esc_html__( 'Select your social link you want to show','danlet' ),
            'desc'     => esc_html__( 'Chose your social you want to show in your website.','danlet' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                'facebook'      => 'Facebook',
                'twitter'       => 'Twitter',
                'google-plus'   => 'Google Plus',
                'pinterest'     => 'Pinterest',
                'linkedin'      => 'Linked in',
                'instagram'     => 'Instagram',
                'github'        => 'GitHub',
                'behance'       => 'Behance',
                'tumblr'        => 'Tumblr',
                'soundcloud'    => 'Sound cloud',
                'dribbble'      => 'Dribbble',
                'rss'           => 'Rss',
            ),
            'default'  => array( 'facebook', 'twitter','google-plus' )
        ),

    )
) );