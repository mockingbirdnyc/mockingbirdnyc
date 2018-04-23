// Force the product page to show the price right before the "Add to Cart" form
(function() {
  var $ = $ || jQuery;
  var $price = $('div.product p.price span.woocommerce-Price-amount').parent();
  var $cart = $('div.product form.cart');
  if (!$cart.length) {
    return;
  }

  $price.remove();
  $price.css({ padding: '0px', margin: '0px' });
  $price.insertBefore($cart);
  $('<!-- Hey Developer! -->').insertBefore($price);
  $('<!-- ^^^ This p element has been moved by a custom js script in the theme -->').insertAfter($price);
})();