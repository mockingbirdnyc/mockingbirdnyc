<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

<?php
	if (is_product_category()){

	global $wp_query;
	// get the query object
	$cat = $wp_query->get_queried_object();
	// get the thumbnail id user the term_id
	$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	if (function_exists('z_taxonomy_image_url')){
		$image = z_taxonomy_image_url($cat->term_id, NULL, TRUE);
	}
	// print the IMG HTML
	$term = get_term( $cat->term_id, 'product_cat' );
	$count_product = $term->count;
	?>

	<section class="header-page header-shop" style="background: url(<?php print ($image); ?>) no-repeat center center;background-size: cover;">
		<div class="container">
			<div class="title-page"><?php print($term->name); ?> <span>(<?php print ($count_product); ?>)</span></div>
		</div>

	</section>
	<?php }
	else{
		if( is_shop() ) {
	    $shop = get_option( 'woocommerce_shop_page_id' );
	    $post_thumbnail_id = get_post_thumbnail_id($shop);
		$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		$page = get_post($shop);
	    if( has_post_thumbnail( $shop ) ) {
	?>
	<section class="header-page header-shop" style="background: url(<?php echo ($post_thumbnail_url); ?>) no-repeat center center;background-size: cover;">
		<div class="container">
			<div class="title-page">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<?php woocommerce_page_title(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
	    }
	  }
	?>
<?php }?>
<?php if (is_search() && !have_posts()): ?>
	<div class="container">
		<h4><?php _e('No products were found matching your selection.','bebostore'); ?></h4>
	</div>
<?php endif ?>
<?php
global $beau_option;
if (isset($beau_option['style-shop'])) {
    $options = $beau_option['style-shop'];
}else{
    $options = 'shop-style-1';
}
if($options == 'shop-style-1') {?>


		<?php
			/**
			 * woocommerce_archive_description hook
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>
			<section id="grid-list" class="side-bar">
				<div class="breadthums-navigation grid">
					<div class="container">
						<div class="navigation-listcat pull-left">
							<div class="title-subcat">
								<span class="subcategories-list"><i class="fa fa-bars"></i> <?php _e('All subject','bebostore'); ?></span>
							</div>
						</div>
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					</div>
				</div>
				<div id="product-sidebar">
					<div class="sidebar-widget">
						<div class="container">
						<?php
				            if ( is_active_sidebar( 'sidebar-product' ) ){
				                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-product') ) ;
				            }
				        ?>
				        </div>
					</div>
				</div>
			</section>

			<section>
				<div class="shop-left-bar">
					<div class="container">
						<div class="book-grid-full col-md-12 col-sm-12 col-xs-12">
							<div class="shop-list-book">
								<div class="shop-list col-md-12-col-sm-12 col-xs-12">
									<ul class="products grid book-grid-full col-md-12-col-sm-12 col-xs-12">
										<?php woocommerce_product_subcategories(); ?>

										<?php while ( have_posts() ) : the_post(); ?>

											<?php wc_get_template_part( 'content', 'product' ); ?>

										<?php endwhile; // end of the loop. ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php } ?>
<?php if($options == 'shop-style-2') {?>
<section>
	<div class="container">
		<?php
			/**
			 * woocommerce_archive_description hook
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<section>
				<div class="breadthums-navigation">
					<div class="container">
						<div class="breadthums pull-left">

							<?php
								/**
								 * woocommerce_before_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								 * @hooked woocommerce_breadcrumb - 20
								 */
								echo woocommerce_breadcrumb();
							?>
						</div>
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					</div>
				</div>
			</section>

			<section id="list">
				<div class="shop-left-bar">
					<div class="container">
						<div class="right-sidebar pull-left left-bar col-md-2 col-sm-4 col-xs-5">
							<div class="sidebar-widget">
								<?php
						            if ( is_active_sidebar( 'sidebar-product' ) ){
						                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-product') ) ;
						            }
						        ?>
							</div>
						</div>
						<div class="pull-right col-md-10 col-sm-8 col-xs-7">
							<div class="shop-list-book">
								<div class="shop-list col-md-12-col-sm-12 col-xs-12">
									<ul class="products book-grid col-md-12-col-sm-12 col-xs-12">
										<?php woocommerce_product_subcategories(); ?>

										<?php while ( have_posts() ) : the_post(); ?>

											<?php wc_get_template_part( 'content', 'product' ); ?>

										<?php endwhile; // end of the loop. ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
    </div>
</section>
<?php } ?>
<?php get_footer( 'shop' ); ?>
