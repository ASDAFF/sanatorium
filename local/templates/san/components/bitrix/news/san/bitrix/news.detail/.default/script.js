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
