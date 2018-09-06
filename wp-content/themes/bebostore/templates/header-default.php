<?php
    global $beau_option;
    $disable_search = $beau_option['disable_search'];
    $enabled_cart = $beau_option['enabled-cart-header'];
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>
<div class="menu-fix-all">
    <div class="container">
        <span class="humberger-button">
            <button>
                <i></i>
                <i></i>
                <i></i>
            </button>
        </span>
        <div class="beau-logo">
            <?php
                if (isset($beau_option['logo'])) {
                    $store_logo = $beau_option['logo']['url'];
                }else{
                    $store_logo = get_template_directory_uri().'/asset/images/logo.png';
                }
            ?>
            <a href="<?php echo esc_url(home_url( '/' ));?>"><img src="<?php echo esc_url($store_logo);?>" alt="Logo"></a>
        </div><!--End .logo-->
        <div class="menu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'sticker-menu',
                    'menu_class'    => 'col-md-12 col-sm-12 hidden-xs',
                    'menu_id'       => 'main-navigation',
                    'container'     => '',
                ));
            ?>
        </div>
       <?php get_template_part('templates/stick','search') ?>
    </div>
</div>
<header class="menu-stick header-one">
    <div class="container">
        <span class="humberger-button">
            <button>
                <i></i>
                <i></i>
                <i></i>
            </button>
        </span>
        <div class="header-top">
            <?php if ($disable_search != '2'): ?>
                <div class="pull-left form-search">
                    <form action="<?php echo esc_url(home_url( '/' ));?>" method="get" class="book-search-head">
                        <i class="fa fa-search"></i>
                        <input type="text" name="s" value="" placeholder="<?php esc_html_e('Search by title book...', 'bebostore'); ?>">
                        <input type="hidden" name="post_type" value="product" />
                        <select name="product_cat" class="custom-dropdown">
                            <option value="" selected><?php esc_html_e('All product','bebostore'); ?></option>
                            <?php
                             if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                                $args = array(
                                    'orderby'   => 'title',
                                    'order'     => 'ASC',
                                    'hide_empty'          => FALSE,
                                );
                                $product_categories = get_terms( 'product_cat', $args );
                                $count = count($product_categories);
                                if (class_exists('WC()')) {
                                    # code...
                                }
                                if ( $count > 0 ){
                                    foreach ( $product_categories as $product_category ) {
                                        echo '<option value="' .  $product_category->slug . '">' . $product_category->name . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </form>
                </div><!--Left .pull-left-->
            <?php endif ?>
            <div class="beau-logo">
                <?php
                    if (isset($beau_option['logo'])) {
                        $store_logo = $beau_option['logo']['url'];
                    }else{
                        $store_logo = get_template_directory_uri().'/asset/images/logo.png';
                    }
                ?>
                <a href="<?php echo esc_url(home_url( '/' ));?>"><img src="<?php echo esc_url($store_logo);?>" alt="Logo"></a>
            </div><!--End .logo-->

            <div class="pull-right">

                 <?php if (has_nav_menu('small-menu')): ?>
                    <div id="menu-top" class="right-nav">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'small-menu',
                                'menu_class'    => 'small-nav hidden-xs',
                                'menu_id'       => 'main-navigation',
                                'container'     => '',
                            ));
                        ?>
                    </div>
                <?php endif ?>
            </div><!--End .pull-right-->
        </div><!--End header-top-->

        <div class="clearfix"></div>
        <div class="header-bottom">
            <div id="main-nav">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'menu_class'    => 'col-md-12 col-sm-12 hidden-xs',
                        'menu_id'       => 'main-navigation',
                        'container'     => '',
                    ));
                ?>

                <?php
                    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                if ($enabled_cart != '1') {
                ?>
                <div class="woocomerce-cart">
                    <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"><i class="be be-bag"></i></a>
                    <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="icon-cart-ajax"><?php  printf(esc_html__('%s','bebostore' ), WC()->cart->cart_contents_count); ?></a>
                </div>
                <?php
                    }
                   }
                ?>

            </div>
        </div>

    </div><!--End container-->
</header>
