/**
 * Custom js for clearfix
 */
jQuery(document).ready(function () {
    jQuery('[data-id="custom_css"]').each(function () {
        jQuery(this).parent().parent().addClass('custom_css_section');

    });
});
