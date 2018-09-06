jQuery( document ).ready( function( $ ) {
    'use strict';
    $('input[data-type="beau_patcher"]').click(function() {
        var patch_id = $(this).attr('data-patch-id');
        var type = $(this).attr('data-patch');
        var patch_path = $('[data-patch-id="'+patch_id+'"]').attr('data-patch-path');
        var security = $('[data-patch-id="'+patch_id+'"]').attr('data-patch-ser');
        $(this).parent().html('<a class="install-now button updating-message">Applying...</a>');
        var data = {
            action: 'patcher_apply',
            type : type,
            security: security,
            patch_id: patch_id,
            patch_path : patch_path
        };
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post( ajaxurl, data, function( response)  {
            setTimeout(function() { location.reload();}, 5000);
        });
    });
});