jQuery(document).ready(function() {
  // hide author divs if there is no author
  jQuery('.book-author:not(:has(a))').css('display', 'none');
  jQuery('.by-author').filter(function () {
    return jQuery(this).text().trim() === 'by:';
  }).css('display', 'none');

  jQuery('.book-item').click(function() {
    let href = jQuery(this).siblings('.book-info').find('.book-name a').attr('href');
    if (href) {
      window.location = href;
    }
  })
});
