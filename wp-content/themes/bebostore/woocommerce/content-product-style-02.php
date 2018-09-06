<?php 
	$image_links  	= wp_get_attachment_image_url(get_post_thumbnail_id(),'bebostore-book-thumb');
	$style_product = $margin_top = '';
	$wishlist_setting = $beau_option['enabled-wishlist'];
	$show_price_setting = $beau_option['enabled-show-price'];
	$cart_setting = $beau_option['enabled-add-to-cart'];
	$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
	if($none_book == 'on'){
    	$style_product = 'none-book';
    }
?>
<li <?php post_class(); ?>>
	<div class="book-item-shop">
		<?php if ( $product->is_on_sale() ) : ?>
			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'bebostore' ) . '</span>', $post, $product ); ?>
		<?php endif; ?>
		<div class="book-item <?php print($style_product) ?>" <?php print($margin_top) ?>>


			<div class="book-image">
				<div class="book-image">
					<img src="<?php print($image_links); ?>" alt="img-book"/>
				</div>
			</div>

			<div class="book-actions">
				<div class="list-action">
					<?php 
						if ($cart_setting != '1') {
							do_action( 'woocommerce_after_shop_loop_item' ); 
						}
					?>
					<?php 
                    	if ($wishlist_setting != '1') {
                        	echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); 
                        }
                    ?>

				</div><!--End list-action-->
			</div>
		</div>
		<div class="book-info">
			<?php echo woocommerce_template_loop_rating(); ?>
			<span class="book-name"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></span>
			<span class="book-author">
				<?php _e('by:', 'bebostore'); ?>
                   <?php
                   		$author = get_field('field_book_author');
                   ?>
                    <?php if( $author ): ?>
                    	<?php
                    		if(count($author) == 1){
                    		foreach( $author as $authors ): ?>
                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
                        <?php endforeach;
                        	}
                        else{
                        ?>
                        <?php foreach( $author as $authors ): ?>
                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>,
                        <?php endforeach; ?>
                        <?php } ?>
                    <?php endif; ?>
			</span>
			<?php
				if ($show_price_setting != '1') {
			?>
				<span class="book-price"><?php echo woocommerce_template_loop_price(); ?></span>
			<?php
				 } 
			?>
			
			<div class="book-desc button-action">
				<div class="text-desc"><?php echo the_excerpt(); ?></div>
                <?php  if ($cart_setting != '1') { ?>
                    <a class="btn btn-buyproduct" href="<?php echo do_shortcode('[add_to_cart_url id="'.get_the_ID().'"]'); ?>"><?php echo $product->add_to_cart_text();?></a>
                <?php  }?>
                <?php 
                    if ($wishlist_setting != '1') {
                        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); 
                    }
                ?>
            </div>
            
		</div>
	</div>
</li>