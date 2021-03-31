$(function(){
	$('.course-sidebar-type li').hover(function(){
		$(this).addClass('hover');
		$(this).children('.course-category-sort').show();
	},function(){
		$(this).children('.course-category-sort').hide();
		$(this).removeClass('hover');
	})
	$(window).scroll(function () {
		if ($(window).scrollTop() > 120) {
			$(".course-tools").addClass('fixed');
		} else {
			$(".course-tools").removeClass('fixed')
		}
		if($(window).scrollTop() > 200){
			$('.elevator-top').show();
		}else{
			$('.elevator-top').hide();
		}
	});
	$('.course-filter').hover(function(){
		$(this).children('.course-sidebar-filter').show();
	},function(){
		$(this).children('.course-sidebar-filter').hide();
	})
	$('.search-area').focusin(function(){
		$('.search-area').addClass('focus');
	})
	$('.search-area').focusout(function(){
		$('.search-area').removeClass('focus');
	})

	$('#backTop').click(function (e) {
		e.preventDefault();
		$('html,body').animate({ scrollTop:0});
	});

})