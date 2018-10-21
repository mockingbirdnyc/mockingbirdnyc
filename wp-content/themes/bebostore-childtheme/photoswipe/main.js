window.onload = function () {
  // need to add the photoswipe element to the site
  jQuery(`
  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>
      <div class="pswp__ui pswp__ui--hidden">
        <div class="pswp__top-bar">
          <div class="pswp__counter"></div>
          <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
          <button class="pswp__button pswp__button--share" title="Share"></button>
          <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
          <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
          <div class="pswp__preloader">
            <div class="pswp__preloader__icn">
              <div class="pswp__preloader__cut">
                <div class="pswp__preloader__donut"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
          <div class="pswp__share-tooltip"></div>
        </div>
        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
        <div class="pswp__caption">
          <div class="pswp__caption__center"></div>
        </div>
      </div>
    </div>
  </div>
  `).appendTo(document.body);

  pswpElement = document.querySelectorAll('.pswp')[0];

  var $imgs = jQuery('.book-detail .woocommerce-product-gallery__image img');
  var items = $imgs.map(function() {
    var $el = jQuery(this);
    return {
      src: $el.data('src'),
      w: $el.data('large_image_width'),
      h: $el.data('large_image_height')
    }
  });

  var $viewButton = jQuery(`
    <button class="mbird-look-inside-button button active">Look inside</button>
  `);
  jQuery('.book-detail > div:first-child > img:first-child').after($viewButton)

  var options = { index: 0 };

  // Initializes and opens PhotoSwipe

  $viewButton.on('click', function(e) {
   (new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options)).init();
  });
};
