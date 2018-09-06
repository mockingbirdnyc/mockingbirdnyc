<?php
/**
 * Options Extra
 * @package classictheme
 * @subpackage Redux
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
Redux::setSection( $opt_name, array(
    'title'            => __( 'Extra', 'beau-core' ),
    'id'               => 'extra',
    'customizer_width' => '200px',
    'icon'             => 'el el-cogs',
    'fields'           => array(
        array(
                'id'       => 'admin-email',
                'type'     => 'text',
                'title'    => __( 'Admin email', 'beau-core' ),
                'placeholder'=>'support@beautheme.com'
            ),
            array(
                'id'       => 'hotline',
                'type'     => 'text',
                'title'    => __( 'Hotline', 'beau-core' ),
                'placeholder'=>''
            ),

            array(
                'id'      => 'author-page',
                'type'    => 'select',
                'title'   => __( 'Your author page', 'bebostore' ),
                'desc'    => __( 'Chose your author page for author fillter.', 'bebostore' ),
                'data'  => 'pages',
                'args'  => array(
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                )
            ),

        ),
) );
