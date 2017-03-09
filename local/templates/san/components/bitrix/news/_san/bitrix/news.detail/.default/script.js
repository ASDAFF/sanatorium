$(function () {
    // The slider being synced must be initialized first
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 110,
        itemMargin: 5,
        asNavFor: '#slider'
    });
    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        smoothHeight: true,
    });

    $('.various').on('click', function (e) {
        e.preventDefault();
        var el = $($(this).attr('href'));

        if($(this).attr('href') != '#bron')
        {
            el.find('.flexslider.popup').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: '#' + el.find('.flexslider.carousel').attr('id'),
            });
            el.find('.flexslider.carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: true,
                itemWidth: 100,
                itemHeight: 50,
                itemMargin: 5,
                asNavFor: '#' + el.find('.flexslider.popup').attr('id'),
            });
        }

        $.fancybox({
            content: el,
            maxWidth: 800,
            maxHeight: $(window).height() - 100,
            fitToView: false,
            width: '700',
            height: '600',
            autoSize: true,
            closeClick: false,
        })
        return false;
    });

    $('.preview-text a').on('click', function(e) {
        e.preventDefault();
        $.fancybox({
            content: $(this).parent().parent().find('.detail-text'),
            maxWidth: $(window).width() - 200,
            maxHeight: $(window).height() - 100,
            fitToView: false,
            width: '700',
            height: '600',
            autoSize: true,
            closeClick: false,
        })
    })
});

/*
$(window).load(function () {
    //fix images height
    var minHeight = $('#carousel .slides li img')[0].clientHeight;
    $('#carousel .slides li').each(function () {
        var img = $(this).find('img').get(0);
        if (minHeight > img.clientHeight)
            minHeight = img.clientHeight;
    });
    $('#carousel .flex-viewport').css('height', minHeight);
});*/
