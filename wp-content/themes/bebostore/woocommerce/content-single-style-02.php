<?php
	global $beau_option;
	if (isset($beau_option['disable_3d'])) {
		$disable_3d = $beau_option['disable_3d'];
	}
	$image_links  	= wp_get_attachment_image_url(get_post_thumbnail_id(),'bebostore-book-thumb');

	$wishlist_setting = $beau_option['enabled-wishlist'];
	$show_price_setting = $beau_option['enabled-show-price'];
	$cart_setting = $beau_option['enabled-add-to-cart'];
	$disable_add_to_cart = get_field('disable_add_to_cart');
	$enable_affiliate = get_field('enable_affiliate');

	$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
	$style_product = '';
    if($none_book == 'on'){
    	$style_product = 'none-book';
    }
    $wishlist_left = '';
    if ($cart_setting == false) {
    	$wishlist_left = 'left-style';
    }
?>
<div itemscope  id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section>
		<div class="detail-book">
			<div class="container">
				<div class="book-detail book-full-view col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-5 col-sm-5 col-sm-12">
						<div class="book-details-item">
							<?php if ($none_book != 'on'){ ?>
								<?php if ($disable_3d == 2): ?>
									<img src="<?php print($image_links); ?>" alt="img-book"/>
									<span class="disk"></span>
								<?php endif ?>

								<?php if ($disable_3d != 2): ?>
								<ul id="bk-list" class="bk-list clearfix">
									<li>
										<div class="bk-book book-2 bk-bookdefault">
											<div class="bk-front">
												<div class="bk-cover">
													<img src="<?php print($image_links); ?>" alt="img-book"/>
												</div>
											</div>
											<div class="bk-back">
												<?php if (class_exists('MultiPostThumbnails')) :
												    MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'book-back-image', NULL,  'bebostore-book-thumb');
												endif; ?>
											</div>
											<div class="bk-left">
												<h2>
													<span>
														<?php
															$book_spine = get_field('book_spine');
									                   		$author = get_field('field_book_author');
									                   ?>
									                    <?php
									                    if($book_spine != '') {
									                    	echo esc_attr($book_spine);
									                    } else {
														if( $author ): ?>
									                    	<?php
									                    		if(count($author) == 1){
									                    		foreach( $author as $authors ): ?>

									                            <?php echo get_the_title( $authors->ID ); ?>
									                        <?php endforeach;
									                        	}
									                        else{
									                        ?>
									                        <?php foreach( $author as $authors ): ?>
									                            <?php echo get_the_title( $authors->ID ); ?>,
									                        <?php endforeach; ?>
									                        <?php } ?>
									                    <?php endif; ?>
									                    <?php } ?>
													</span>
												</h2>
											</div>
										</div>
										<div class="bk-info detail-book-action">
										<?php
											if($beau_option['flip-book'] == 'Yes') {
										?>
										<div class="flip-book">
										<button class="bk-bookback"><?php _e('Flip to back', 'bebostore');?></button>
										</div>
										<?php
											}
										?>

										</div>
									</li>
								</ul>
								<?php endif ?>
								<?php do_action( 'woocommerce_product_thumbnails' ); ?>
							<?php }
								else{
									?>
								<img src="<?php print($image_links); ?>" alt="img-book"/>
								<?php
								}
							?>
						</div>
						<?php if ( $product->is_on_sale() ) : ?>
							<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'bebostore' ) . '</span>', $post, $product ); ?>
						<?php endif; ?>

					</div>

					<div class="book-item-detail col-md-7 col-sm-7 col-xs-12">

						<?php
							$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );
							if ($ISBN != '') {
						?>
						<span class="sku_wrapper"><?php _e('ISBN: ', 'bebostore'); ?><span class="sku" itemprop="sku"><?php print($ISBN); ?></span></span>
						<?php
						}
							/**
							 * woocommerce_single_product_summary hook
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 */
							echo woocommerce_template_single_meta();
							echo woocommerce_template_single_title();

						?>
						<span class="by-book">
			                   <?php
			                   		$author = get_field('field_book_author');
			                   ?>
			                    <?php if( $author ): ?>
			                    	<?php _e('by:', 'bebostore'); ?>
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
							//All details product
							$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

							echo woocommerce_template_single_rating();
						?>
						<span class="book-desc">
							<?php echo the_excerpt(); ?>
						</span>
						<?php if( $enable_affiliate == true ): ?>
							<div class="affiliate">
								<?php
									if ($show_price_setting != '1') {
										echo woocommerce_template_single_price();
									}
									if ($cart_setting != '1') {

										if($disable_add_to_cart != true){
											echo woocommerce_template_single_add_to_cart();
										}
										else {
										?>
											<div class="cart">
												<button class="button active"><?php esc_html_e('Add to cart','bebostore')?></button>
											</div>
										<?php
										}
									}
									if ($wishlist_setting == '2') {
									?>
										<div class="<?php print($wishlist_left) ?>">
											<?php
												echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
											?>
										</div>
									<?php
			                        }
								?>

								<ul class="affiliate-farm">
									<?php
					                  $retailers  = get_field('field_retailers');
					                  $count = count($retailers);
					                  if ($count > 0) {
						                  for ($i=0; $i < $count; $i++) {
							                  $item = $retailers[$i];
							                  $text_link_buy_retailer = $item['text_link_buy_retailer'];
							                  $product_url = $item['product_url'];
							                  $product_price = $item['product_price'];
							                  $name_url = explode('.', domain($product_url));
							                  $type_retailers = $item['type_retailers'];
							                  ?>
							                  <?php
												$args = array(
													'post_type'=> 'retailers',
													'p' => $type_retailers
												);
												$loop = new WP_Query( $args);

											?>
											<?php while ( $loop->have_posts() ) : $loop->the_post();?>
												<?php
													$icon_retailer = get_field('icon_retailer');
												?>
											<?php
												endwhile;
												wp_reset_postdata();
											?>
							                  	<li class="item-affiliate">
							                  		<div class="icon">
							                  			<a href="<?php echo esc_attr($product_url) ?>">
							                  			<?php
							                  				if ($icon_retailer == '') {
							                  					echo esc_attr($name_url[0]);
							                  				}
							                  				else{
							                  				?>
							                  					<img src="<?php print($icon_retailer['url']); ?>" alt="img-retailer"/>
							                  				<?php
							                  				}
							                  			?>
							                  			</a>
							                  		</div>
													<span class="button-affiliate">
														<?php
															echo get_woocommerce_currency_symbol();
															echo esc_attr($product_price) ;
														?>
													</span>
												</li>
							                  <?php
						                  }
					                  }
					                ?>
								</ul>
								<span class="hidden-button"><a href="#"><?php esc_html_e('Hidden','bebostore')?></a></span>
							</div>
						<?php endif; ?>

						<?php if( $enable_affiliate != true ): ?>
							<?php
								if ($show_price_setting != '1') {
									echo woocommerce_template_single_price();
								}
								if ($cart_setting != '1') {

									if($disable_add_to_cart != true){
										echo woocommerce_template_single_add_to_cart();
									}
									else {
									?>
									<div class="cart">
										<button class="button active"><?php esc_html_e('Add to cart','bebostore')?></button>
									</div>
									<?php
									}
								}
								if ($wishlist_setting == '2') {
								?>
									<div class="<?php print($wishlist_left) ?>">
										<?php
											echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
										?>
									</div>
								<?php
		                        }
							?>
						<?php endif; ?>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<?php
									$product_tag = wc_get_product_tag_list(get_the_ID(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'bebostore' ) . ' ', '</span>' );
									print($product_tag);
									$pinImage = $image_links;
								?>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<div class="beau-tags social-share">
									<ul class="social">
										<li class="title-social"><?php _e('Share:', 'bebostore'); ?></li>
										<li class="pinterest-cresta-share" id="pinterest-cresta"><a rel="nofollow" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(get_permalink( $post->ID )) ?>&amp;media=<?php echo esc_attr($pinImage)?>&amp;description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')?>" title="<?php _e('Share to Pinterest','bebostore')?>" onclick="window.open(this.href, 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-pinterest"></i></a><span class="cresta-the-count" id="pinterest-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="twitter-cresta-share" id="twitter-cresta"><a rel="nofollow" href="http://twitter.com/share?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(the_title_attribute( 'echo=0' ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>&amp;url=<?php echo  urlencode(get_permalink( $post->ID )) ?>" title="<?php _e('Share to Twitter','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-twitter"></i></a><span class="cresta-the-count" id="twitter-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="facebook-cresta-share" id="facebook-cresta"><a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink( $post->ID )) ?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>" title="<?php _e('Share to Facebook','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-facebook"></i></a><span class="cresta-the-count" id="facebook-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="googleplus-cresta-share" id="googleplus-cresta"><a rel="nofollow" href="https://plus.google.com/share?url=<?php echo  urlencode(get_permalink( $post->ID )) ?>" title="<?php _e('Share to Google Plus','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-google-plus"></i></a><span class="cresta-the-count" id="googleplus-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
									</ul>
								</div>
							</div>
						</div>
                        <div class="clearfix"></div>
                        <?php
                        	$play_text = '';
                            if ($product_type =="product_audio"){
                                $play_text = __("Play audio","bebostore");
                            }
                            if ($product_type =="product_video"){
                                $play_text = __("Play Video","bebostore");
                            }
                        ?>
                        <?php if ($product_type =="product_audio" || $product_type = "product_video") {?>
                        	<?php if ($play_text !="") {?>
	                          <div class="audio-iconplay"  data-toggle="modal" data-target="#preview-modal"><i class="fa fa-play"></i><a href="javascript:;" onclick="return false;"><?php echo esc_html($play_text); ?></a></div>
	                          <?php }?>
                        <?php }?>

                        <?php
                          // This get media in with product using produc
                            global  $wp_embed;
                            $soundCloud_Url     = get_post_meta($post->ID, '_beautheme_product_with_soudcloud', TRUE);
                            $video_EMbed        = get_post_meta($post->ID, '_beautheme_product_with_video', TRUE);
                            $mp3Files           = get_field('field_files_mp3');
                            if($soundCloud_Url) $mediaPlay      = $wp_embed->run_shortcode('[embed id="soundcloud-play" width="360" height="320"]'.$soundCloud_Url.'[/embed]');
                            if($video_EMbed) $video_EMbed_play  = $wp_embed->run_shortcode('[embed width="780" height="440"]'.$video_EMbed.'[/embed]');
                            if (function_exists('bebostore_findExtension')) {
                                if (bebostore_findExtension($video_EMbed) == 'mp4') {
                                    $video_EMbed_play  = do_shortcode('[video width="780" height="440" mp4="'.$video_EMbed.'"] [/video]');
                                }
                            }
                        ?>
                        <?php if($soundCloud_Url) printf('%s', $mediaPlay); ?>
                        <?php
                            if ($product_type =="product_audio" && $mp3Files) {
                                $i=1;
                        ?>

                        <script type="text/javascript">
                            //<![CDATA[
                            (function($){
                                "use strict"
                                $(document).ready(function($){

                                    jQuery("#singlebook_player").bind(jQuery.jPlayer.event.play, function (event)
                                    {
                                        var current = beauPlaylist.current, playlist = beauPlaylist.playlist;
                                        jQuery.each(playlist, function (index, obj){
                                            if (index == current){
                                                $('#jp-song-name').html(obj.title);
                                                $('#jp-article-name').html(obj.artist);
                                            }
                                        });
                                    });
                                    //Setup and defined a playlist
                                    var beauPlaylist = new jPlayerPlaylist({
                                        jPlayer: "#singlebook_player",
                                        cssSelectorAncestor: "#jp_container_2",

                                    }, [
                                        <?php if($mp3Files){
                                            foreach ($mp3Files as $key => $value) {
                                        ?>
                                        {
                                            title:"<?php print($value['file_mp3_name']); ?>",
                                            mp3:"<?php print($value['file_mp3']) ?>",
                                        },
                                        <?php }
                                            }
                                        ?>
                                    ], {
                                        supplied: "oga, mp3",
                                        wmode: "window",
                                        useStateClassSkin: true,
                                        autoBlur: false,
                                        smoothPlayBar: true,
                                        keyEnabled: true
                                    });


                                    // Play list custom
                                    $('.item-play').click(function() {
                                        var songI = $(this).attr('data-song');
                                        $('.item-play').removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play');
                                        if (!$(this).hasClass('active')) {
                                            $(this).find('i').removeClass('fa-play').addClass('fa-pause');
                                            $(this).addClass('active');
                                        }else{
                                             $(this).removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play');
                                        }
                                        beauPlaylist.play(songI);
                                    });

                                    $('.jp-play').click(function(event) {
                                         // beauPlaylist.play();
                                         $('.list-playlist .item-play:first-child()').click();
                                    });

                                });
                            })(jQuery)
                            //]]>
                            </script>
                            <div id="inspection"></div>
                            <ul class="list-playlist">
                            <?php
                                foreach ($mp3Files as $key => $value) {
                                    $activeClass = "";
                                    if ($i ==1) {
                                        $songName  = $value['file_mp3_name'];
                                    }
                                ?>
                                <li class="item-play <?php print ($activeClass); ?>" data-song="<?php echo esc_html($i-1);?>">
                                    <span class="list-play seed-play-<?php echo esc_html($i);?>">
                                        <span class="item-bar"></span>
                                    </span>
                                    <div class="clearfix"></div>
                                    <p class="audio-time"><i class="fa fa-play"></i><?php echo esc_html($value['file_mp3_time']);?></p>
                                    <p class="audio-name"><?php print($value['file_mp3_name']); ?></p>
                                </li>
                            <?php $i++;} ?>
                            </ul>
                        <?php } ?>
					</div><!-- .summary -->
				</div>
			</div>
		</div>
	</section>
	<?php if( $author ):
        $rand_id = rand(1000, 9999);
        $idauth  = "author_book_".$rand_id;

    ?>
	<section id="<?php echo esc_attr($idauth)?>">
		<div class="detail-author-book">
			<div class="container">
			<?php
				$category_name_item = strip_tags(wc_get_product_category_list(get_the_ID($product)));
            ?>

                <?php foreach( $author as $authors ): ?>
                	<?php
                		$id_author        = $authors->ID;
                		$year_author      = get_post_meta( $id_author, '_beautheme_year_job', true );
                		$url_ava          = get_post_meta( $id_author, '_beautheme_type_image', true );
                		$authorAvatar_ID  = beau_get_attachment_id_from_url($url_ava);
						$author_avatar    = wp_get_attachment_image( $authorAvatar_ID,'bebostore-main-thumbnail');
                		$url_fb           = get_post_meta( $id_author, '_beautheme_author_facebook', true );
                		$url_tt           = get_post_meta( $id_author, '_beautheme_author_twitter', true );
                		$url_google          = get_post_meta( $id_author, '_beautheme_author_google', true );
                        $rand_id = rand(1000, 9999);
                        $idauth  = "author_book_".$rand_id;
                	?>
				<div class="box-author-book full-author-book col-md-12 col-sm-12 col-xs-12">
					<div class="author-book-title title-box"><span><?php _e('Books of ','bebostore'); ?><?php echo get_the_title($id_author); ?></span></div>
					<div class="clearfix"></div>
					<div id="<?php echo esc_attr($idauth);?>" class="swiper-container author-book-slider slider-with-scroll swiper-free-mode swiper-free-mode">
						    <!-- Additional required wrapper -->
							<div class="swiper-scrollbar author-book-scrollbar"></div>
							<?php
					          $args = array(
					          	'post_type' 	=> 'product',
					          	'order' 		=> 'DESC',
								'meta_key'	 	=> 'book_author',
								'meta_value'	=> $id_author,
								'meta_compare'	=> 'LIKE',
					          );
					          $loop = new WP_Query( $args );
					          $count_item = $loop->post_count;
					          $width_scroll = $count_item*130;
					          $style = 'style="width:'.$width_scroll.'px"';
				            ?>

						    <div class="swiper-wrapper" style="height: 202px;">
						        <!-- Slides -->
						        	<?php while ( $loop->have_posts() ) : $loop->the_post();?>
						        	<?php
					        	 		$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
								        $style_product_item = '';
										if($none_book == 'on'){
										    $style_product_item = 'none-book';
										}
					        	 	?>
						        	<div class="swiper-slide swiper-slide-visible swiper-slide-active">
										<div class="book-item-slide">
											<div class="book-item <?php echo esc_attr($style_product_item) ?>" datalink="<?php echo get_permalink();?>">
												<div class="book-image">
													<?php
														$id_product = $loop->post->ID;
														$publishing_year = get_post_meta( $id_product, '_beautheme_publishing_year', true );
													?>
													<?php if (has_post_thumbnail( $id_product )){?>
														<?php  echo get_the_post_thumbnail($id_product); ?>
													<?php }
													else{
														echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="100px" height="150px" />';
													}
													?>
												</div>
												<div class="book-actions">
													<div class="list-action">
														<?php
															if ($cart_setting != '1') {
																do_action( 'woocommerce_after_shop_loop_item' );
															}
									                    	if ($wishlist_setting != '1') {
									                        	echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
									                        }
									                    ?>
													</div><!--End list-action-->
												</div>
											</div><!--End book-item-->
											<div class="book-info">
												<span class="book-name"><a href="<?php echo get_permalink();?>"><?php print(get_the_title($id_product)); ?></a></span>
												<span class="book-author"><?php print($publishing_year); ?></span>
											</div><!--End book-info-->
										</div><!--End .book-item-slide-->
						        </div><!--End swiper-slide-->
						        	<?php endwhile; ?>
  								<?php wp_reset_postdata(); ?>
						    </div><!--End swiper-wrapper-->

						</div><!--End .book-slider-feature-->
						<script>
							(function($) {
                                "use strict";
                                var bookAuthor_<?php echo esc_js($rand_id); ?> = new Swiper('#<?php echo esc_js($idauth);?>', {
                                    slidesPerView: 8,
									grabCursor:true,
									auto:true,
                                  });
                            })(jQuery);
						</script>
				</div>

				<?php endforeach; ?>

			</div>
		</div>
	</section>
	<?php endif; ?>
	<section>
		<div class="about-this-book">
			<div class="container">
				<div class="left-detail col-md-3 col-sm-3 col-xs-12">
					<div id="fixed-menu">
						<div class="title-box title-detail"><span><?php _e('About This Book', 'bebostore'); ?></span></div>
						<div class="list-menu">
							<ul class="list-menu" id="list-menu-page">
							<?php
				           		$author = get_field('field_book_author');
				           		$editorial = get_post_meta( get_the_ID(), '_beautheme_editorial_reviews', true );
				           		$author = get_field('field_book_author');
				           		$publisher = get_field('field_book_publisher');
				           		$overview = get_the_content();
				            ?>
				           		<?php if( $overview ): ?>
								<li class="over-view"><a href="#over-view"><?php _e('Overview', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<?php if( $publisher ): ?>
								<li class="desc-detail"><a href="#desc-detail"><?php _e('Details', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<?php if($product->is_type('variable') ): ?>
								<li class="attributes"><a href="#attributes"><?php _e('Attributes', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<?php if( $author ): ?>
								<li class="meet-author"><a href="#meet-author"><?php _e('Meet the Author', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<li class="beboo-reviews"><a href="#beboo-reviews"><?php _e('Reviews', 'bebostore'); ?>(<?php print ($product->get_review_count()); ?>)</a></li>
							</ul>
						</div>
					</div><!--End #fixed-menu-->
				</div><!--End left-detail-->
				<div class="right-detail shop-detail1 pull-right col-md-8 col-sm-8 col-xs-12">
					<?php if( $overview ): ?>
					<div id="over-view" class="book-desc-detail">
						<span class="title-detail"><?php _e('Overview', 'bebostore'); ?></span>
						<span class="detail-desc box-detail-desc">
							<?php echo the_content(); ?>
						</span>
					</div>
					<?php endif; ?>

					<?php if( $publisher ): ?>
					<div id="desc-detail" class="book-desc-detail">
			            	<span class="title-detail"><?php _e('Details', 'bebostore'); ?></span>
			                <?php foreach( $publisher as $publisher ): ?>
			                	<?php
			                		$id_publisher = $publisher->ID;
			                		$publishing_year_item = get_post_meta( get_the_ID(), '_beautheme_publishing_year', true );
			                		$publishing_page = get_post_meta( get_the_ID(), '_beautheme_page_count', true );
			                		$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );

			                	?>
								<span class="detail-desc box-detail-desc">
									<p>
										<?php if ($ISBN != '') { ?>
											<strong>ISBN</strong>: <?php print $ISBN; ?><br>
										<?php } ?>
										<?php if ($product->get_sku()!='') { ?>
											<strong>SKU</strong>: <?php print ($product->get_sku());?><br>
										<?php } ?>
										<strong><?php _e('Publisher', 'bebostore'); ?></strong>: <?php echo get_the_title($id_publisher) ;?><br>
										<strong><?php _e('Publish Date', 'bebostore'); ?></strong>: <?php print($publishing_year_item) ?><br>
										<strong><?php _e('Page Count', 'bebostore'); ?></strong>: <?php print($publishing_page) ?>
									</p>
								</span>
							<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php if( $product->is_type('variable') ): ?>
					<div id="attributes" class="book-desc-detail">
						<span class="title-detail"><?php _e('Attributes', 'bebostore'); ?></span>
						<span class="detail-desc box-detail-desc">
                           <?php wc_display_product_attributes($product); ?>
						</span>
					</div>
					<?php endif; ?>

		           <?php if( $author ): ?>
		           		<div id="meet-author" class="book-desc-detail">
							<div class="box-meet-author box-detail-desc col-md-12 col-sm-12 col-xs-12">
								<div class="title-detail"><span><?php _e('Meet the Author','bebostore'); ?></span></div>
				                <?php foreach( $author as $authors ): ?>
				                	<?php
				                		$id_author 		= $authors->ID;
				                		$year_author 	= get_post_meta( $id_author, '_beautheme_year_job', true );
				                		$url_ava 		= get_post_meta( $id_author, '_beautheme_type_image', true );
				                		$url_fb = get_post_meta( $id_author, '_beautheme_author_facebook', true );
				                		$url_tt = get_post_meta( $id_author, '_beautheme_author_twitter', true );
				                		$url_google = get_post_meta( $id_author, '_beautheme_author_google', true );
				                		$url_instagram = get_post_meta( $id_author, '_beautheme_author_instagram', true );
				                		$url_pinterest = get_post_meta( $id_author, '_beautheme_author_pinterest', true );
				                		$url_behance = get_post_meta( $id_author, '_beautheme_author_behance', true );
				                		$url_youtube = get_post_meta( $id_author, '_beautheme_author_youtube', true );
				                		$url_linkedin = get_post_meta( $id_author, '_beautheme_author_linkedin', true );
				                	?>
									<div class="author-info">
										<div class="img-social">
											<img src="<?php print($url_ava) ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="avatar-author">
											<div class="clearfix"></div>
											<ul>
												<?php if( $url_fb ): ?>
													<li><a href="<?php echo esc_url($url_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
												<?php endif; ?>

												<?php if( $url_tt ): ?>
												<li><a href="<?php echo esc_url($url_tt); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
												<?php endif; ?>

												<?php if( $url_google ): ?>
												<li><a href="<?php echo esc_url($url_google); ?>" target="_blank"><i class="fa fa-google"></i></a></li>
												<?php endif; ?>

												<?php if( $url_instagram ): ?>
												<li><a href="<?php echo esc_url($url_instagram); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
												<?php endif; ?>

												<?php if( $url_pinterest ): ?>
												<li><a href="<?php echo esc_url($url_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
												<?php endif; ?>

												<?php if( $url_behance ): ?>
												<li><a href="<?php echo esc_url($url_behance); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
												<?php endif; ?>

												<?php if( $url_youtube ): ?>
												<li><a href="<?php echo esc_url($url_youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
												<?php endif; ?>

												<?php if( $url_linkedin ): ?>
												<li><a href="<?php echo esc_url($url_linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
												<?php endif; ?>
											</ul>
										</div>
										<div class="desc-name">
											<div class="name-author">
												 <a href="<?php echo get_permalink( $id_author ); ?>" target="blank"><?php echo get_the_title( $id_author ); ?></a>
											</div>
											<div class="year-author">
												<?php printf($year_author) ; ?>
											</div>
											<div class="desc-author"><?php echo get_post_field('post_content', $id_author); ?></div>
										</div>
									</div>
                                    <div class="clearfix"></div>
								<?php endforeach; ?>
							</div><!--End box author-->
						</div>
			        <?php endif; ?>
					<div id="beboo-reviews" class="book-desc-detail">
                        <div id="editorial_review_custom">
                            <?php echo wp_kses_post( $editorial); ?>
                        </div>
						<?php echo woocommerce_output_product_data_tabs(); ?>
					</div>
					<div class="clearfix" id="clear-scroll"></div>
					<script>
                        (function($){
                            "use strict";
                            $('#list-menu-page li a').click(function(event) {
                                var idScrollTo = $(this).attr('href');
                                var divOffset  = $(idScrollTo).offset().top;
                                $('#list-menu-page li').removeClass('task-active')
                                $(this).parent('li').addClass('task-active');
                                // Scoll to top
                                $("html, body").animate({ scrollTop: divOffset-138 },500);

                                return false;
                            });

                            //Scroll and fix
                            var MQL = 400;
                            if(jQuery(window).width() > MQL) {
                            var elementFix  = $('#fixed-menu');
                            var clearFix    = $('#clear-scroll');
                            var fixWidth    = elementFix.width();
                            var fixHeight   = elementFix.height();
                            var clearTr     = $('.book-desc-detail').last().height() - 80;
                            var menuOfset   = elementFix.offset().top - 120;
                            var clearTop    = clearFix.offset().top - clearTr;
                            jQuery(window).on('scroll',
                            {
                                  previousTop: 0
                              },
                                  function () {
                                    var currentTop = parseInt($(window).scrollTop());

                                    <?php if( $overview ): ?>
                                        if (currentTop > parseInt($('#over-view').offset().top - 140)) {
                                            checkActiveObject('.over-view', '#list-menu-page')
                                        }
                                    <?php endif; ?>

                                    <?php if( $publisher ): ?>
                                        if (currentTop > parseInt($('#desc-detail').offset().top - 170)) {
                                            checkActiveObject('.desc-detail', '#list-menu-page')
                                        }
                                    <?php endif; ?>

                                    <?php if( $author ): ?>
                                        if (currentTop > parseInt($('#meet-author').offset().top - 170)) {
                                            checkActiveObject('.meet-author', '#list-menu-page')
                                        }
                                    <?php endif; ?>

                                    if (currentTop > parseInt($('#editionnal-reviews').offset().top - 170)) {
                                        checkActiveObject('.editionnal-reviews', '#list-menu-page')
                                    }

                                    if (currentTop > parseInt($('#beboo-reviews').offset().top - 170)) {
                                        checkActiveObject('.beboo-reviews', '#list-menu-page')
                                    }

                                    //Check scroll up and down
                                    if (currentTop < this.previousTop) {
                                      //if scrolling up...
                                      if (currentTop > menuOfset && elementFix.hasClass('is-fixed')) {

                                      } else {
                                        elementFix.removeClass('is-fixed').removeAttr('style');
                                        $('.over-view').removeClass('task-active');
                                      }
                                      if (currentTop < clearTop) elementFix.show();
                                    } else {
                                      //if scrolling down...
                                      if( currentTop > menuOfset && !elementFix.hasClass('is-fixed')){
                                            elementFix.css({'width':fixWidth+'px','top':'140px'}).addClass('is-fixed');
                                            $('.over-view').addClass('task-active');
                                      }
                                      if (currentTop > clearTop - 200) elementFix.hide();
                                    }
                                    this.previousTop = currentTop;
                                });
                            }
                            function checkActiveObject(obj, cin){
                                jQuery(cin+' li').removeClass('task-active')
                                jQuery(cin+' li'+obj).addClass('task-active')
                                if (obj == '.meet-author') {
                                    jQuery('.meet-author').addClass('whatthehell')
                                }else{
                                    jQuery('.meet-author').addClass('whatthehell')
                                }
                            }

                        })(jQuery);
                    </script>

				</div><!--End right-detail-->
			</div>
		</div><!--End about-this-book-->
	</section>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		echo woocommerce_output_related_products();
	?>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->
