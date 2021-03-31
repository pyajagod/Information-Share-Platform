$(function() {
    /*首页焦点图*/
    if ($('#hmSlides').length > 0) {
        var bannerSwiper = $('#hmSlides').owlCarousel({
            items: 1,
            loop: true,
            mouseDrag: false,
            autoplay: true,
            nav: false,
            dots: true,
            autoplayTimeout: 8000,
            // playOnHover:true
            // pagination:true
        });
        $('.owl-dot').hover(function() {
            $(this).click()
        }, function() {
            bannerSwiper.autoplay.start()
        })
    }
    /*首页板块三*/
    $('.hmSubject li').eq(0).addClass('cur');
    $('.hmBox3 .box').eq(0).show();
    $('.hmGrade').each(function() {
        $(this).find('li').eq(0).addClass('cur');
    });
    $('.hmCourse').each(function() {
        $(this).children('ul').eq(0).show();
    });
    $('.hmSubject li').click(function() {
        $(this).addClass('cur').siblings('li').removeClass('cur');
        var _hmBox = $(this).index();
        $('.hmBox3 .box').eq(_hmBox).fadeIn('fast').siblings('.box').hide();
    });
    $('.hmGrade li').mouseover(function() {
        $(this).addClass('cur').siblings().removeClass('cur');
        var _hmGrade = $(this).index();
        $(this).parents('.hmGrade').siblings('.hmCourse').children('ul').eq(_hmGrade).stop().fadeIn('fast').siblings('ul').hide();;
    });
    /*首页板块五*/
    if ($('#hmTeacher').length > 0) {
        $('#hmTeacher').owlCarousel({
            items: 2,
            loop: true,
            margin: 25,
            mouseDrag: true,
            autoplay: true,
            nav: true,
            dots: false,
        });
    }
    /*首页板块六*/
    $(window).on('scroll', function() {
        if (isScrolledIntoView(document.getElementById('hmBox6'))) {
            $('.hmData .num').countTo();
            // Unbind scroll event
            $(window).off('scroll');
        }
    });
    /*首页板块七*/
    $('.hmNews .list').mouseover(function() {
        var _index = $(this).index();
        $('.hmNewsTop a').eq(_index).show().siblings().hide();
    });
    /*首页板块八*/
    if ($('#hmHonor').length > 0) {
        $('#hmHonor').owlCarousel({
            items: 4,
            loop: false,
            margin: 43,
            mouseDrag: true,
            autoplay: true,
            nav: true,
            dots: false,
        });
    }
});