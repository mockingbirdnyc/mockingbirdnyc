(function($) {
	"use strict";
	//Combobox drop down style
	$(".custom-dropdown, .orderby, .per_page").selectbox({
		effect: "slide"
	});
	$('.subcategories-list').click(function(event) {
		$('#product-sidebar').toggleClass('active');
	});
	$('#icon-grid').click(function(event) {
		if (!$(this).hasClass('active')) {
			$(this).addClass('active');
		};
	});
	$('#icon-list').click(function(event) {
		if (!$(this).hasClass('active')) {
			$(this).addClass('active');
		};
	});

	$('.humberger-button button').click(function(event) {
        $('#menu-humberger').toggleClass('active-menu');
        $('section').toggleClass('active-menu');
        $('header').toggleClass('active-menu');
        $('footer').toggleClass('active-menu');
        $('body').toggleClass('active-menu');
        $('.mobile-menu').toggleClass('mobile-show');
        $('.menu-fix-all').toggleClass('active-menu');
        $('.with-widget').toggleClass('active-menu');
    });

	$('#menu-mb').click(function(event) {
		$('.mobile-menu').toggleClass('mobile-show');
		$('body').toggleClass('active-menu');
	});

	//stick menu home 7
    var home07 = $(".left-full");
    var checkpos07 = home07.position();

    var checkbottom = $('#bottom-scroll').position();
    if(checkpos07!=undefined){
    	var pos07 = checkpos07.top;
    	if(checkbottom!=undefined){
    	var bottom = checkbottom.top;
    	}
        $(window).scroll(function() {
            var windowpos = $(window).scrollTop();
            if (windowpos >= (pos07)) {
                $("#list-cat-scroll").addClass("stick-list-cat-scroll");
            }
            else {
                $("#list-cat-scroll").removeClass("stick-list-cat-scroll");
                $("#list-cat-scroll").removeClass("stick-list-cat-scroll-after");
            }
            if (windowpos < bottom) {
            	$("#list-cat-scroll").removeClass("stick-list-cat-scroll-after");
            }
            if (windowpos >= (bottom)) {
            	// $("#list-cat-scroll").removeClass("stick-list-cat-scroll");
            	//console.log(windowpos)
            	if (!$("#list-cat-scroll").hasClass('stick-list-cat-scroll-after')) {

            		$("#list-cat-scroll").css({
            			'margin-top': parseInt(windowpos-600)+'px',

            		});
            	};
            }
            if(windowpos<1){
                $("#list-cat-scroll").removeClass("stick-list-cat-scroll");

            }
        });
    }


    //For center modal
	function centerModal() {
        $(this).css('display', 'block');
        var $dialog = $(this).find(".modal-content");
        var offset = ($(window).height() - $dialog.height()) / 2;
        // Center modal vertically in window
        $dialog.css("margin-top", offset);
    }
    $('.modal').on('show.bs.modal', centerModal);

	 //Adtocart number increase
    $('.add_to_cart_button').click(function(event) {
       var currentNumber = $('.icon-cart-ajax').html();
       $('.icon-cart-ajax').html(parseInt(currentNumber)+1);
    });
    //Addto cart number descre
    $('.festi-cart-remove-product').click(function(event) {
       var currentNumber = $('.icon-cart-ajax').html();
       $('.icon-cart-ajax').html(parseInt(currentNumber)-1);
    });
    $( ".woocommerce div.product .cart .button" ).hover(function() {
        $('.affiliate-farm').show('300');
        $('.hidden-button').show('300');
        $(this).addClass('active');
        return false;
    });
    $( ".hidden-button a" ).click(function() {
        $('.affiliate-farm').hide('300');
        $('.hidden-button').hide('300');
        $('.woocommerce div.product .cart .button').removeClass('active');
        return false;
    });


    // Author page
    $('body').on("click", ".avatar-author", function(e){
        e.preventDefault();
        var titleAut    = $(this).attr('title');
        var urlAuth     = $(this).attr('href');
        var detail      = '';
        var parentItem  = $(this).closest('.author-item');
        var authID = $(this).attr('data-authorID');
        bebostore_changePageUrl(titleAut, urlAuth, authID);
        $('.detail-author').remove();
        $('.author-item').removeClass('expand');
        detail +='<div class="detail-author loading"><div class="container" id="filldata">';
        detail +='<div class="on-close"></div>';
        detail +='</div></div>';
        $('.hidden-alphabeta').addClass('textwhite');
        if ($(parentItem).hasClass('expand')) {
            $(parentItem).removeClass('expand');
        }else{
            $(parentItem).addClass('expand').append(detail);
        }
        $("html, body").animate({ scrollTop: $(parentItem).offset().top+80 },350);

        //Close this expland
        $('body').on('click', '.on-close', function(event) {
            $(parentItem).removeClass('expand');
            $('.detail-author').remove();
            $('.hidden-alphabeta').removeClass('textwhite');

            $('#wp-admin-bar-edit a').attr('href', newUrlEdit);
            var urlEdit     = $('#wp-admin-bar-edit a').attr('href');
            var posID       = '';
            var newUrlEdit  ='';
            if (urlEdit!=undefined) {
                posID = urlEdit.indexOf("post=");
            }
            if (urlEdit!=undefined) {
                newUrlEdit = urlEdit.substr(0, parseInt(posID+5))+authID+'&action=edit';
            }
            $('#wp-admin-bar-edit a').attr('href', newUrlEdit);
        });
        //Data for get ajax theme
        var data={
            'auth-id': authID,
            'action' : 'bookstore_get_detail_author'
        };
        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data : data,
            success: function(result) {
                $('.detail-author').removeClass('loading');
                $('#filldata').append(result);
            }
        });
    });

    /**
     * Change page author when using ajax load data
     * @param   string $title main title page
     * @param   string $url detail author url when accesss or reload on page
     * @param   number $authorID author id from page id
     * @return  multiple html attribule
     * @package bookstore
     * @since   1.0.0
     * @author Binjuhor <binjuhor@gmail.com>
     */
    function bebostore_changePageUrl($title, $url, $authorID){
        var titlepage   = $title+' | '+blogname;
        var urlEdit     = $('#wp-admin-bar-edit a').attr('href');
        window.history.pushState('', '', $url);
        $(document).prop('title', titlepage);
        if (urlEdit != undefined) {
            var posID       = urlEdit.indexOf("post=");
            var newUrlEdit  = urlEdit.substr(0, parseInt(posID+5))+$authorID+'&action=edit';
            $('#wp-admin-bar-edit a').attr('href', newUrlEdit);
        }
    }


    //Ajax alphabet fillter
    $('.item-authfillter a').click(function(event) {
        event.preventDefault();
        var thisParent  = this.closest('.item-authfillter');
        var textFillter = $(thisParent).attr('data-fillter');
        $('.item-authfillter').removeClass('active');
        $('#result-author').addClass('loading');
        $('#page-loading').addClass('active');
        $('.item-authfillter[data-fillter="'+textFillter+'"]').addClass('active');
        $('.hidden-alphabeta').removeClass('textwhite');
        $("html, body").animate({ scrollTop: $('.list-author-name').offset().top-80 },350);
        var data = {
            'author-prefix': textFillter,
            'action'       : 'bookstore_filltertext'
        };
        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data: data,
            success: function(result) {
                $('#result-author').removeClass('loading');
                $('#result-author').html(result);
                $('#page-loading').removeClass('active');
            }
        });
    });


    //Show hide alpha right
    $(window).scroll(function() {
        var cgecjO      = $('.fillter-alphabeta').position();
        var endAuthorP  = $('.end-authorview').position();
        var anphaHeight = $('.hidden-alphabeta').height();
        if (cgecjO != undefined && endAuthorP != undefined) {
            var windowpos = $(window).scrollTop();
            if ($(window).width() > 780) {
                if (windowpos > cgecjO.top && windowpos < endAuthorP.top - parseInt(anphaHeight+170)) {
                    $(".hidden-alphabeta").show();
                }else{
                    $(".hidden-alphabeta").hide();
                }
            }
        }
    })


    //Back to top
    var offset = 220;
    var duration = 500;

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);

        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })

})(jQuery);