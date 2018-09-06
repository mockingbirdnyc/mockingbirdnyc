<?php
class beau_hosted_Book_Widget extends WP_Widget {

	/**
	 * Setup widget: Name, base ID
	 */
	function __construct() {
		$tpwidget_options = array(
			'classname' => 'beau_hosted_Book_widget', //ID của widget
			'description' => __('This show a book in hosted','bebostore')
		);
		parent::__construct('beau_hosted_Book_widget', 'Hosted book', $tpwidget_options);
	}

	/**
	 * Create option for widget
	 */
	function form( $instance ) {

		$default = array(
			'title' => __('Title','bebostore'),
			'bookid' => '',
		);

		$instance = wp_parse_args( (array) $instance, $default);

		$title = esc_attr( $instance['title'] );
		$bookid = intval( $instance['bookid'] );

		//Show options for admin panel
		echo "<p>".__("Title", 'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
		echo "<p>".__("Book ID",'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('bookid')."' value='".$bookid."'></p>";
	}

	/**
	 * save widget form
	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['bookid'] = strip_tags($new_instance['bookid']);
		return $instance;
	}

	/**
	 * Show widget
	 */

	function widget( $args, $instance ) {

		extract( $args );
		$title 	 = apply_filters( 'widget_title', $instance['title'] );
		$bookid = $instance['bookid'];
		if (function_exists('get_woocommerce_currency_symbol')) {
			$currency = get_woocommerce_currency_symbol();
		}else{
			$currency = "$";
		}
		global $beau_option;
		$wishlist_setting = $beau_option['enabled-wishlist'];
		$cart_setting = $beau_option['enabled-add-to-cart'];
		$show_price_setting = $beau_option['enabled-show-price'];
		$wishlist = '';
		$cart = '';
		if ($wishlist_setting != '1') {
			$wishlist = '';//do_shortcode( '[yith_wcwl_add_to_wishlist product_id="'.$bookid.'"]' );
		}
		printf('%s', $before_widget);
		printf('%s%s%s', $before_title,$title,$after_title) ;
		echo '</span>
		<div class="book-item '.$style_product.'">
			<div class="book-image">'.get_the_post_thumbnail( $bookid).'</div>

			<div class="book-actions">
		    <div class="list-action">
		    	<span class="book-addtocart">
		        <a href="/?add-to-cart='.$bookid.'" rel="nofollow" data-product_id="'.$bookid.'" class="button add_to_cart_button product_type_simple added"></a>
		      </span>

		      '.$wishlist.'
		    </div><!--End list-action-->
		  </div>
		</div><!--End book-item-->
		<div class="book-info">
			<span class="book-name"><a href="'.get_permalink($bookid).'">'.get_the_title($bookid).'</a></span>
			<span class="book-rate woocommerce">
          		<span class="star-rating">
					<span style="width:'.$width.'%">
						<strong class="rating">'.esc_html( $average ).'</strong> '.printf( '<span>', '</span>' ).'
						'.('<span class="rating">' . $rating_count . '</span>' ).'
					</span>
				</span>
			</span>
			<span class="book-price"><b>'.$currency.'&nbsp;'.$price_r.'</b></span>
		</div><!--End book-info-->';
		printf('%s', $after_widget);
	}
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'beau_hosted_book_widget' );
function beau_hosted_book_widget() {
	register_widget('beau_hosted_Book_Widget');
}
