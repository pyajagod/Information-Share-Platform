$(function(){
    // 弹窗
    var tc = $('#tc');
    var show = $('.showTc');
    var hide = $('#hideForm');
    show.click(function() {
        tc.css('display', 'block');
    });
    hide.click(function() {
        tc.css('display', 'none');
    });

    //鼠标经过时变色
    $( ".ydy-con .icon" ).mouseover(function() {
        $(this).next('.text').css({
            color: '#e24943',
            fontSize: '20px'
        });;
    });
    $( ".ydy-con .icon" ).mouseout(function() {
        $(this).next('.text').css({
            color: '',
            fontSize: ''
        });;
    });
});