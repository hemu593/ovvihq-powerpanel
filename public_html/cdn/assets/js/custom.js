/* Loader S */
$(window).on('load', function() {
    $('.ac-loader').addClass('ac-loader__up');
    insertPageHits();
});
/* Loader E */

$(window).on('load', function() {
    $('#wrapper').css('opacity', '1');
    
});

/* Browser Upgrade Font API S */
    var ie = /MSIE (\d+)/.exec(navigator.userAgent);
    ie = ie? ie[1] : null;
    if(ie && ie <= 9) {
        var script = document.createElement( 'script' );script.type = 'text/javascript';
        script.src = 'assets/js/html5.min.js';$("head").append("<style type='text/css'>.buorg{display:block}</style>");
    }
    if(ie && ie == 8) {  
        $('head').append("<style type='text/css'>.buorg{display:block}</style>");
    }
    else if(ie && ie == 7) {
        $('head').append("<style type='text/css'>.buorg{display:block;}</style>");
    }
/* Browser Upgrade Font API E */

/* Back to Top Scroll S */
$(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#back-top').fadeIn();
    } else {
        $('#back-top').fadeOut();
        $('body').removeClass("back-top-scroll")
    }
});
$("#back-top").click(function () {
    $('body').addClass("back-top-scroll")
    $("html, body").animate({scrollTop: 0}, 1000);
});
/* Back to Top Scroll E */

/* Common Js Function S */
/*jQuery.browser S*/
(function() {
        (jQuery.browser = jQuery.browser || {}).mobile = (/android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent.toLowerCase()));
    }
    (navigator.userAgent || navigator.vendor || window.opera));
/*jQuery.browser E*/

/* Table div Wrap S */
$(document).ready(function() {
    $('.cms table').wrap('<div class="table-responsive"></div>');
});
/* Table div Wrap E */
/* Common Js Function E */


/* Thumbnail Container Thumb Generator S */
function dataThum(e) {
    $(e).each(function() {
        var dataThum = $(this).attr("data-thumb");
        $(this).css("padding-bottom", dataThum);
    });
}
dataThum(".ac-webp, .thumbnail-container");
/* Thumbnail Container Thumb Generator E */


$(document).ready(function() {
    $(".cms li").wrapInner("<span></span>");
    $('a.scroll_down').click(function() {
        $root.animate({ scrollTop: $($(this).attr('href')).offset().top - 0 }, 2000);
        return false;
    });
});


/* Filter Open Function S */
function openNav1() {
    document.getElementById("menu1").style.right = "0";
    $('#menu__open1').attr('onclick', 'closeNav1()');
    $("#menu__open1.short-menu").addClass('short-menu1');
    $(".inner-page-gap").css("z-index", "2");
    $("body").addClass('menu_overlap1');
}
/* Filter Open Function E */

/* Filter Close Function S */
function closeNav1() {
    document.getElementById("menu1").style.right = "-320px";
    $('#menu__open1').attr('onclick', 'openNav1()');
    $("#menu__open1.short-menu").removeClass('short-menu1');
    $(".inner-page-gap").css("z-index", "");
    $("body").removeClass('menu_overlap1');
}
/* Filter Close Function E */

/* Raw Html Embed Div Remove S */
$(document).ready(function() {
    var segArr = JSON.parse(segments.replace(/&quot;/g, '"'));
    if (segArr[0] != 'survey') {
        $(".raw-html-embed").each(function() {
            var rawHtmlEmbed = $(this).html();
            $(this).replaceWith(rawHtmlEmbed);
        });
    }
});
/* Raw Html Embed Div Remove E */

$(document).ready(function() {
    var activeElement = $("#accordianMenu").find('li a.active');
    $(activeElement).parent('li').parents('ul').collapse();
    $(activeElement).parent('li').parents('ul').parent('li').children('a').addClass('active');

    var accordianMenu = $("#full-menu-clone").find('li.active');
    if (accordianMenu.length > 0) {
        $(accordianMenu).each(function(key, value) {
            $(value).parent('ul').prev('span').addClass('is-close');
        });
    }

    var hedaerActiveElement = $("#headerMenu").find('li.active');
    if (hedaerActiveElement.length > 0) {
        $(hedaerActiveElement).each(function(key, value) {
            $(value).parents('ul').prev('span').addClass('is-close');
        });
    }
    $(hedaerActiveElement).parents('ul').parent('li').addClass('active');


    var navigationMenuActiveElement = $(".navigationMenu").find('li.active');
    $(navigationMenuActiveElement).parent('ul').collapse();
    $(navigationMenuActiveElement).parents('ul').parent('li').addClass('active');

});


function insertPageHits() {
    if (segments.length > 0) {
        segments = JSON.parse(segments.replace(/&quot;/g, '"'));
    }
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: site_url + '/insert-page-hits',
        data: {
            'segments': segments
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log('Oops!!! Something went wrong');
        }
    });

}

$(document).ready(function() {
    $('#cookie_policy').click(function() {
        $.ajax({
            url: site_url + "/accept-privacy",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('.ac-cookies').css('display', 'none');
            }
        });
    });
});


/* AOS */
$(window).on('load refresh resize', function() {
    AOS.init();
    AOS.refresh();
    setTimeout(AOS.refreshHard, 150);
});
$(document).ready(function() {
    AOS.init({
        once: true,
        duration: 900,
        disable: 'mobile',
        offset: 90,
        startEvent: 'DOMContentLoaded',
        delay: 0,
    });
    $(window).on('load', function() {
        AOS.refresh();
    });
    $(window).on("blur", function() {
        AOS.refresh();
    });
});
/* AOS End */  