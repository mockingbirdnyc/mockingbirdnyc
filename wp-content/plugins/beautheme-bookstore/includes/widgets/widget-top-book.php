<?php
class beau_top_book_Widget extends WP_Widget {

	/**
	 * Setup widget: Name, base ID
	 */
	function __construct() {
		$tpwidget_options = array(
			'classname' => 'beau_top_book_widget', //ID của widget
			'description' => __('This show list of top book','bebostore')
		);
		parent::__construct('beau_top_book_widget', 'Top book', $tpwidget_options);
	}

	/**
	 * Create option for widget
	 */
	function form( $instance ) {

		$default = array(
			'title' => __('Title','bebostore'),
			'booknumber' => '',
		);

		$instance = wp_parse_args( (array) $instance, $default);

		$title = esc_attr( $instance['title'] );
		$booknumber = intval( $instance['booknumber'] );

		//Show options for admin panel
		echo "<p>".__("Title", 'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
		echo "<p>".__("Number of products to show",'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('booknumber')."' value='".$booknumber."'></p>";
	}

	/**
	 * save widget form
	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['booknumber'] = strip_tags($new_instance['booknumber']);
		return $instance;
	}

	/**
	 * Show widget
	 */

	function widget( $args, $instance ) {

		extract( $args );
		$title 	 = apply_filters( 'widget_title', $instance['title'] );
		$booknumber = $instance['booknumber'];
		if (function_exists('get_woocommerce_currency_symbol')) {
			$currency = get_woocommerce_currency_symbol();
		}else{
			$currency = "$";
		}
		printf('%s', $before_widget);
		printf('%s%s%s', $before_title,$title,$after_title) ;
		$args = array(
              'post_type' => 'product',
              'posts_per_page' => $booknumber,
              'order' => 'DESC' ,
              'meta_key' => 'total_sales',
			  'orderby' => 'meta_value_num',
			  'meta_query' => WC()->query->get_meta_query()
        );
         $loop = new WP_Query( $args );
         global $product;
		$div = '<div class="content-widget">
				<ol class="list-top-book">';
				while ( $loop->have_posts() ) : $loop->the_post();
					$author = get_field('field_book_author',$loop->post->ID);
					$div.= '<li>
						<div class="book-item-widget-best">

							<p class="book-name"><a href="'.get_permalink($loop->post->ID).'">'.get_the_title().'</a></p>';
							if ($author !='') {
								foreach( $author as $authors ){
								$div.= '<p class="book-auth"><a href="'.get_permalink($authors->ID).'">';

									$div.= get_the_title( $authors->ID );

								$div.= '</a></p>';
								}
							}
						$div.= '</div>
					</li>';
				endwhile;
				wp_reset_postdata();
			$div.='</ol></div>';
		// echo $div;
		printf('%s%s', $div, $after_widget);
	}
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'beau_top_book_widget' );
function beau_top_book_widget() {
	register_widget('beau_top_book_Widget');
}
