jQuery( document ).ready( function( $ ) {
    'use strict';
    $("#registration-form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get some values from elements on the page: */
        var     security = $(this).find('input[name="_wpnonce"]').val();
        var     buyer = $(this).find('input[name="_buyer"]').val();
        var     purchase = $(this).find('input[name="_purchase"]').val();
        if(!buyer)
            return false;

        if(!purchase)
            return false;
        $(this).find('input[name="_buyer"]').attr('disabled');
        $(this).find('input[name="_purchase"]').attr('disabled');
        $(this).find('p.submit').html('<a class="install-now button updating-message">Registering...</a>');
        var data = {
            action: 'register_add',
            security: security,
            buyer: buyer,
            purchase : purchase
        };
        $.post( ajaxurl, data, function( response)  {
            setTimeout(function() { location.reload();}, 5000);

        });
    });
    $("#deactive-form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get some values from elements on the page: */
        var     security = $(this).find('input[name="_wpnonce_deactive"]').val();
        $(this).find('p.submit').html('<a class="install-now button updating-message">Deactiveing...</a>');
        var data = {
            action: 'register_deactive',
            security: security,
        };
        $.post( ajaxurl, data, function( response)  {
            setTimeout(function() { location.reload();}, 5000);

        });
    });
});