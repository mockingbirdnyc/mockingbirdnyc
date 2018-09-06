<?php
add_filter( 'cmb_meta_boxes', 'beau_theme_metaboxes' );
function beau_theme_metaboxes( array $meta_boxes ) {
    $prefix = '_beautheme_';
    //Header array
    $custom_header = array(
        ''              => 'Default on Theme Option',
        'default'       => 'Header default',
        'menuhumberger' => 'Header only menu humberger',
    );


    //Footer array
    $custom_footer = array(
        ''              => 'Default on Theme Option',
        'default'       => 'Footer default',
        'home5'         => 'Footer home 5',
        'home7'         => 'Footer home 7',
    );

    //Your custom archive layout
     $custom_archive_layout = array(
        'one-column-full'               => 'One column full',
        'one-column-leftsidebar'        => 'One column left sidebar',
        'one-column-rightsidebar'       => 'One column right sidebar',
        'two-columns-leftsidebar'       => 'Two columns left sidebar',
        'two-columns-rightsidebar'      => 'Two columns right sidebar',
        'three-columns-rightsidebar'    => 'Three columns right sidebar',
        'three-columns-masory'          => 'Three columns masory',
        'three-columns-full'            => 'Three columns full',
    );

    //For post type video
    $meta_boxes['testimonial_metabox'] = array(
        'id'         => 'testimonial_metabox',
        'title'      => __( 'Testimonial info', 'bebostore' ),
        'pages'      => array( 'testimonial'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
        'fields'     => array(
            array(
                'name' => __( 'Message', 'bebostore' ),
                'desc' => __( 'Author message for testimonial', 'bebostore' ),
                'id'   => $prefix . 'testimonial_message',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Author job', 'bebostore' ),
                'desc' => __('Enter author job eg: Editor, Writer','bebostore'),
                'id'   => $prefix . 'author_job',
                'type' => 'text',
            ),
            array(
                'name'   => __( 'Author avatar', 'bebostore' ),
                'desc'   => __( 'Upload an image or enter a URL to image.', 'bebostore' ),
                'id'     => $prefix . 'type_image',
                'type'   => 'file',
                'allows' => 'url',
            ),

        ),
    );

    //For page and post options header
    $meta_boxes['header_metabox'] = array(
        'id'         => 'header_metabox',
        'title'      => __( 'Your custom header & footer', 'bebostore' ),
        'pages'      => array( 'page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
        'fields'     => array(
            array(
                'name'    => __('Select header','bebostore'),
                'desc'    => __('Chose your header or default on theme option','bebostore'),
                'id'      => $prefix . 'custom_header',
                'type'    => 'select',
                'options' => $custom_header,
            ),
            array(
                'name'    => __('Select footer','bebostore'),
                'desc'    => __('Chose your footer or default on theme option','bebostore'),
                'id'      => $prefix . 'footer_custom',
                'type'    => 'select',
                'options' => $custom_footer,
            ),
        ),
    );

    //For page and post options header
    $meta_boxes['archive_metabox'] = array(
        'id'         => 'archive_metabox',
        'title'      => __( 'Your custom layout', 'bebostore' ),
        'pages'      => array( 'page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
        'fields'     => array(
            array(
                'name'    => __('Chose your layout','bebostore'),
                'desc'    => __('Chose your layout or default on theme option','bebostore'),
                'id'      => $prefix . 'archive_custom',
                'type'    => 'select',
                'options' => $custom_archive_layout,
            ),
            array(
                'name'  => __( 'Your cover ', 'bebostore' ),
                'desc'  => __( 'Upload an image or enter a URL to image for cover page.', 'bebostore' ),
                'id'    => $prefix . 'archive_custom_cover',
                'type'  => 'file',
                'allows' =>'url'
            ),
        ),
    );

    //Metabox for author
    $meta_boxes['author_metabox'] = array(
        'id'         => 'author_metabox',
        'title'      => __( 'Author infomation', 'bebostore' ),
        'pages'      => array( 'authorbook' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'   => __( 'Author avatar', 'bebostore' ),
                'desc'   => __( 'Upload an image or enter a URL to image.', 'bebostore' ),
                'id'     => $prefix . 'type_image',
                'type'   => 'file',
                'allows' => 'url',
            ),
            array(
                'name' => __( 'Year of Birth', 'bebostore' ),
                'desc' => __( 'Year of Birth of author.', 'bebostore' ),
                'id'   => $prefix . 'year_job',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Prefix name', 'bebostore' ),
                'desc' => __( 'Prefix name for fillter.', 'bebostore' ),
                'id'   => $prefix . 'prefix_name',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Primary job', 'bebostore' ),
                'desc' => __( 'Author job.', 'bebostore' ),
                'id'   => $prefix . 'author_job',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author facebook url', 'bebostore' ),
                'desc' => __( 'Author Facebook link.', 'bebostore' ),
                'id'   => $prefix . 'author_facebook',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author twitter url', 'bebostore' ),
                'desc' => __( 'Author Twitter link.', 'bebostore' ),
                'id'   => $prefix . 'author_twitter',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Google', 'bebostore' ),
                'desc' => __( 'Author google link.', 'bebostore' ),
                'id'   => $prefix . 'author_google',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Instagram', 'bebostore' ),
                'desc' => __( 'Author instagram link.', 'bebostore' ),
                'id'   => $prefix . 'author_instagram',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Pinterest', 'bebostore' ),
                'desc' => __( 'Author pinterest link.', 'bebostore' ),
                'id'   => $prefix . 'author_pinterest',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Behance', 'bebostore' ),
                'desc' => __( 'Author behance link.', 'bebostore' ),
                'id'   => $prefix . 'author_behance',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Youtube', 'bebostore' ),
                'desc' => __( 'Author youtube link.', 'bebostore' ),
                'id'   => $prefix . 'author_youtube',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Linkedin', 'bebostore' ),
                'desc' => __( 'Author linkedin link.', 'bebostore' ),
                'id'   => $prefix . 'author_linkedin',
                'type' => 'text',
            ),
        ),
    );

    //Metabox for publisher
    $meta_boxes['publisher_metabox'] = array(
        'id'         => 'publisher_metabox',
        'title'      => __( 'Publisher infomation', 'bebostore' ),
        'pages'      => array( 'publisher', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'   => __( 'Publisher avatar', 'bebostore' ),
                'desc'   => __( 'Upload an image or enter a URL to image.', 'bebostore' ),
                'id'     => $prefix . 'type_image',
                'type'   => 'file',
                'allows' => 'url',
            ),
            array(
                'name' => __( 'Short description', 'bebostore' ),
                'desc' => __( 'Publisher description.', 'bebostore' ),
                'id'   => $prefix . 'publisher_description',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Address', 'bebostore' ),
                'desc' => __( 'Address description.', 'bebostore' ),
                'id'   => $prefix . 'publisher_address',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Phone number', 'bebostore' ),
                'desc' => __( 'Phone number', 'bebostore' ),
                'id'   => $prefix . 'publisher_phone',
                'type' => 'text',
            ),
            array(
                'name' => __( 'FAX', 'bebostore' ),
                'desc' => __( 'FAX', 'bebostore' ),
                'id'   => $prefix . 'publisher_fax',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Email', 'bebostore' ),
                'desc' => __( 'Email', 'bebostore' ),
                'id'   => $prefix . 'publisher_email',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Publisher facebook url', 'bebostore' ),
                'desc' => __( 'Publisher Facebook link.', 'bebostore' ),
                'id'   => $prefix . 'publisher_facebook',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Publisher twitter url', 'bebostore' ),
                'desc' => __( 'Publisher Twitter link.', 'bebostore' ),
                'id'   => $prefix . 'publisher_twitter',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Publisher rss', 'bebostore' ),
                'desc' => __( 'Publisher rss link.', 'bebostore' ),
                'id'   => $prefix . 'publisher_rss',
                'type' => 'text',
            ),

        ),
    );

    //Metabox for store
    $meta_boxes['store_metabox'] = array(
        'id'           => 'store_metabox',
        'title'        => __( 'Store infomation', 'bebostore' ),
        'pages'        => array( 'store', ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
        'fields'       => array(

            array(
                'name' => __( 'Address', 'bebostore' ),
                'desc' => __( 'Address description.', 'bebostore' ),
                'id'   => $prefix . 'store_address',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Phone number', 'bebostore' ),
                'desc' => __( 'Phone number of this store.', 'bebostore' ),
                'id'   => $prefix . 'store_phone',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Email', 'bebostore' ),
                'desc' => __( 'Email of this store.', 'bebostore' ),
                'id'   => $prefix . 'store_email',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Business hours:', 'bebostore' ),
                'desc' => __( 'Phone number of this store.', 'bebostore' ),
                'id'   => $prefix . 'store_open',
                'type' => 'text',
            ),

        ),
    );

    //Metabox for product
    $meta_boxes['product_metabox'] = array(
        'id'            => 'product_metabox',
        'title'         => __( 'Product type', 'bebostore' ),
        'pages'         => array( 'product', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name'    => __('Chose product type','bebostore'),
                'id'      => $prefix . 'your_custom_product',
                'type'    => 'radio_inline',
                'options' => array(
                    'product_standard'      => __( 'Standard', 'bebostore' ),
                    'product_sound_cloud'   => __( 'Sound cloud', 'bebostore' ),
                    'product_video'         => __( 'Video file', 'bebostore' ),
                    'product_audio'         => __( 'Audio file', 'bebostore' ),
                ),
                'default' => 'product_standard',
            ),
            array(
                'name'    => __('Video file','bebostore'),
                'desc'    => __('Chose video file or pase url <i>( Embed url, Wordpress allow in this <a href="https://codex.wordpress.org/Embeds" target="_blank">link</a>)</i> for your book','bebostore'),
                'id'      => $prefix . 'product_with_video',
                'allows'  => array( 'url', 'attachment' ),
                'type'    => 'file',
            ),
            // array(
            //     'name'    => __('Video embed','bebostore'),
            //     'desc'    => __('Pase your video embed link','bebostore'),
            //     'id'      => $prefix . 'product_with_video_embed',
            //     'type'    => 'oembed',
            // ),
            array(
                'name' => __( 'ISBN code', 'bebostore' ),
                'desc' => __( 'ISBN of this product.', 'bebostore' ),
                'id'   => $prefix . 'product_ISBN',
                'type' => 'text',
            ),
            array(
                'name'    => __('Sound cloud','bebostore'),
                'desc'    => __('Pase your sound cloud link','bebostore'),
                'id'      => $prefix . 'product_with_soudcloud',
                'type'    => 'oembed',
            ),
            array(
                'name' => __( 'Publishing year', 'bebostore' ),
                'desc' => __( 'Publishing year of products.', 'bebostore' ),
                'id'   => $prefix . 'publishing_year',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Page count:', 'bebostore' ),
                'desc' => __( 'Page count of products.', 'bebostore' ),
                'id'   => $prefix . 'page_count',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Editorial Reviews', 'bebostore' ),
                'desc' => __( 'Editorial Reviews text.', 'bebostore' ),
                'id'   => $prefix . 'editorial_reviews',
                'type' => 'textarea',
            ),
        ),
    );

    $meta_boxes['product_none_book'] = array(
        'id'            => 'product_none_book',
        'title'         => __( 'Products no farme?', 'bebostore' ),
        'pages'         => array( 'product', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Show product non-book', 'beautheme' ),
                'desc' => __('If you check it, product will no frame','beautheme'),
                'id'   => $prefix . 'product_none_book',
                'type' => 'checkbox',
            ),
        ),
    );

    //Metabox for team
    $meta_boxes['team_metabox'] = array(
        'id'           => 'team_metabox',
        'title'        => __( 'Team infomation', 'bebostore' ),
        'pages'        => array( 'team', ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
        'fields'       => array(
            array(
                'name' => __( 'Job', 'bebostore' ),
                'desc' => __( 'Job of person.', 'bebostore' ),
                'id'   => $prefix . 'team_job',
                'type' => 'text',
            ),
            array(
                'name'   => __( 'Person avatar', 'bebostore' ),
                'desc'   => __( 'Upload an image or enter a URL to image.', 'bebostore' ),
                'id'     => $prefix . 'type_image',
                'type'   => 'file',
                'allows' => 'url',
            ),
            array(
                'name' => __( 'Person facebook url', 'bebostore' ),
                'desc' => __( 'Person Facebook link.', 'bebostore' ),
                'id'   => $prefix . 'team_facebook',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Person twitter url', 'bebostore' ),
                'desc' => __( 'Person Twitter link.', 'bebostore' ),
                'id'   => $prefix . 'team_twitter',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Person google', 'bebostore' ),
                'desc' => __( 'Person google link.', 'bebostore' ),
                'id'   => $prefix . 'team_google',
                'type' => 'text',
            ),
        ),
    );

    // Add other metaboxes as needed
    return $meta_boxes;
}