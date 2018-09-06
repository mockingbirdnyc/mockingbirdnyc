jQuery(document).ready(function () {
    jQuery('[data-video="beau-welcome"]').each(function () {
        var uri = jQuery(this).attr('data-uri');
        var width = jQuery(this).attr('width');
        var height = jQuery(this).attr('height');
        if(!uri) return false;
        jQuery(this).html('<iframe src="'+uri+'?modestbranding=1&autohide=1&showinfo=0&controls=0&rel=0" width="'+width+'" height="'+height+'" id="beau-welcome"></iframe>');
    });

});