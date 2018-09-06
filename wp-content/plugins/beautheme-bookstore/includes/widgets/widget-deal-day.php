<?php
class beau_day_deal_Widget extends WP_Widget {

	/**
	 * Setup widget: Name, base ID
	 */
	function __construct() {
		$tpwidget_options = array(
			'classname' => 'beau_day_deal_widget', //ID của widget
			'description' => __('This show list deal of day','bebostore')
		);
		parent::__construct('beau_day_deal_widget', 'List deal of day', $tpwidget_options);
	}

	/**
	 * Create option for widget
	 */
	function form( $instance ) {

		$default = array(
			'title' => __('Title','bebostore'),
		);

		$instance = wp_parse_args( (array) $instance, $default);

		$title = esc_attr( $instance['title'] );


		//Show options for admin panel
		echo "<p>".__("Title", 'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";

	}

	/**
	 * save widget form
	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	/**
	 * Show widget
	 */

	function widget( $args, $instance ) {

		extract( $args );
		$title 	 = apply_filters( 'widget_title', $instance['title'] );

		if (function_exists('get_woocommerce_currency_symbol')) {
			$currency = get_woocommerce_currency_symbol();
		}else{
			$currency = "$";
		}
		printf('%s', $before_widget);
		printf('%s%s%s', $before_title,$title,$after_title) ;
		$args = array(
		    'post_type'      => 'product',
		    'order'          => 'ASC',
		    'posts_per_page'   => 4,
		    'meta_query'     => array(
		        array(
		            'key'           => '_sale_price',
		            'value'         => 0,
		            'compare'       => '>',
		            'type'          => 'numeric'
		        ),
		    )
		);

         $loop = new WP_Query( $args );
         global $product;
		$div = '<div class="content-widget">
				<ul class="list-deal-day">';
				while ( $loop->have_posts() ) : $loop->the_post();
					$author = get_field('field_book_author',$loop->post->ID);
					$price_r = get_post_meta( $loop->post->ID, '_regular_price', TRUE);
					$none_book = get_post_meta( $loop->post->ID,'_beautheme_product_none_book', TRUE);
					$style_product = '';
			        if($none_book == 'on'){
			        	$style_product = 'none-book';
			        }
					$div.= '<li>
						<div class="book-best-right">
							<div class="book-item '.$style_product.'">
								<div class="book-image">
									'.get_the_post_thumbnail($loop->post->ID).'
								</div>
							</div>
							<div class="name-best">

								<p class="b-name"><a href="'.get_permalink($loop->post->ID).'" title="'.esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID).'">'.get_the_title().'</a></p>

								<div class="b-author">
									<span>'.__('by: ','bebostore').'</span>';

				                    foreach( $author as $authors ){
										$div.= '<p class="book-auth"><a href="'.get_permalink($authors->ID).'"> ';

											$div.= get_the_title( $authors->ID );

										$div.= '</a></p>';
									}
				                    $div.= '</div>
								<p class="b-price"><span class="amount">'.wc_price($price_r).'</span></p>
							</div>
						</div>
					</li>';
				endwhile;
				wp_reset_postdata();
			$div.='</ul></div>';
		// echo $div;
		printf('%s%s', $div, $after_widget);
	}
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'beau_day_deal_widget' );
function beau_day_deal_widget() {
	register_widget('beau_day_deal_Widget');
}