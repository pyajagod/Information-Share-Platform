$(function(){
	/*全站头部*/
	/*导航下拉菜单*/	
	$('.nav li').hover(function(){
		$(this).addClass('on').children('dl').show();
	},function(){
		$(this).removeClass('on').children('dl').hide();
	});
	/*城市选择*/
	$('.curCity span').click(function(){
		$(this).siblings('ul').fadeToggle('fast');
	});
	/*全站头部*/
	/*全站底部*/
	$('.btmCityList ul li').eq(0).addClass('cur');
	$('.btmDistrict').eq(0).show();
	$('.btmCityList ul li a').click(function(){
		$(this).parent().addClass('cur').siblings().removeClass('cur');
		var _btmCity = $(this).parent().index();
		$('.btmDistrict').eq(_btmCity).fadeIn('fast').siblings().hide();
	});
	$('.btmDistrict').each(function(){
		$(this).find('dd').eq(0).addClass('cur');
		$(this).find('ul').eq(0).show();
	});
	$('.btmDistrict dd a').click(function(){
		$(this).parent().addClass('cur').siblings().removeClass('cur');
		var _district = $(this).parent().index();
		$(this).parents('dl').siblings('.box').children('ul').eq(_district).fadeIn('fast').siblings().hide();
	});

	$('.btmSocial .wx a').click(function(){
		$(this).siblings('.qrcode').toggleClass('show');
	});
	/*全站底部*/	
});
function isScrolledIntoView(el) {
 	var elemTop = el.getBoundingClientRect().top;
  	var elemBottom = el.getBoundingClientRect().bottom - 345;
  	var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
  	return isVisible;
}



function getParam(paramName) { 
    paramValue = "", isFound = !1; 
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
    } 
    return paramValue == "" && (paramValue = null), paramValue 
} 