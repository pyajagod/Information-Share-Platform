 document.write('<script type="text/javascript" src="/pc/common/js/tanchu.js"></script>');


  ; (function(window, $) {
    var sourceArr = {
        bd: "4008-118-116",
		bdmob: "4008-118-112",
		bdwm: "400-898-1207",
		feed: "400-898-1210",
		bdpp: "4008-100-989",
        qh: "4008-116-115",
        sg: "4008-880-005",
        jtw: "400-898-1202",
        qhmob: "400-898-1205",
        sgmob: "400-898-1206",
        sma: "400-898-1215",
	    dsp: "400-898-1203",		
        tt: "4008-775-665"
    };
     var sourceName = getQueryString("utm_source");
     // 默认电话
    var defaultTel  = '4008-118-116';

    $(function() {
        // 当在index.html主页的时候没有utm_source的时候默认显示电话
       var urlStr = window.location.href;
       
        $("img").lazyload();
        var telList = $(".zk_tel_change"); 
        if(telList.length > 0){
            if(!sourceName){
                var num = getCookie("telNum");
                telList.html(num?num:defaultTel);
            }
            for (var item in sourceArr) {
                if (item == sourceName) {
                    setCookie("telNum", sourceArr[item], 24 * 7);
                    $(".zk_tel_change").html(sourceArr[item]);
                }
            }
        }

        $("#dibu").load('/pc/common/html/xes_footer.html',function(){
            var tel = getCookie("telNum");
           $(".zk_tel_change").each(function(index,item){
                var $this = $(this);
                if(!$.trim($this.text())){
                    $(this).html(tel?tel:defaultTel);
                }
                
           });
        });
        $.getScript("/pc/common/js/meiqia.js");
    });
    
    // 获取url的参数
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
    
    function setCookie(cookiename, cookievalue, hours) {
        var date = new Date();
        date.setTime(date.getTime() + Number(hours) * 3600 * 1000);
        document.cookie = cookiename + "=" + cookievalue + "; path=/;expires = " + date.toGMTString();
    }

    function getCookie(cookieName) {
        var cookieString = document.cookie;
        var start = cookieString.indexOf(cookieName + '=');
        // 加上等号的原因是避免在某些 Cookie 的值里有
        // 与 cookieName 一样的字符串。
        if (start == -1) // 找不到
        return null;
        start += cookieName.length + 1;
        var end = cookieString.indexOf(';', start);
        if (end == -1) return unescape(cookieString.substring(start));
        return unescape(cookieString.substring(start, end));
    }
    window.Common = {};
    // 顶部的head html
    window.Common.topHeadHtml = function(){

      return '<div class="xes-head-box wdbox">'+
  '<div class="xes-head wd1200">'+
    '<div class="xes-head-en fl">学而思爱智康专注中小学个性化教育</div>'+
    '<div class="xes-head-nav fr">'+
      '<ul>'+
            
      '</ul>'+
    '</div>'+
  '</div>'+
'</div>'+
'<div class="xes-top-box wdbox">'+
'<div class="xes-top-box wd1200">'+
  '<div class="logo fl"><img src="../../img_xes/logo.png"></a></div>'+
  '<div class="xes-nav fl">'+
    '<ul>'+
        '<li><a href="/pc/zz/index.html">首页</a></li>'+
        '<li><a href="/pc/xiaoxue/index.html" target="_blank">小学辅导</a></li>'+
		'<li><a href="/pc/chuzhong/index.html" target="_blank">初中辅导</a></li>'+
		'<li><a href="/pc/gaozhong/index.html" target="_blank">高中辅导</a></li>'+
        '<li><a href="/pc/zz/kecheng.html" target="_blank">课程体系</a></li>'+
		'<li><a href="/pc/zz/laoshi.html" target="_blank">教师团队</a></li>'+
		'<li class="xes-price"><a onclick="_MEIQIA._SHOWPANEL()">咨询价格<i></i></a></li>'+
    '</ul>'+
  '</div>'+
  '<div class="xes-tel fr"><span class="zk_tel_change"></span></div>'+
  '</div>'+
'</div>';		
    }
    window.Common.leftAndRightHtml = function(){

       var comment = '<div class="float-contact-left" id="float-contact-left">'+
  '<div class="xes-container">'+
   //  '<div class="xes-cons">'+
      // '<h3 class="xes-cons-title"></h3>'+
      // '<ul class="xes-cons-btn">'+
       // '<li><a href="/pc/gkzt/index.html">高考复习课</a></li>'+
		//'<li><a href="/pc/zkzt/index.html">中考辅导课</a></li>'+
       // '<li><a href="/pc/8rb/index.html">0元体验课</a></li>'+
		//'<li><a href="/pc/xxysy/index.html">小学专项课</a></li>'+
		
     //  '</ul>'+
	  //  '<div class="xes-cons-tel"><span class="zk_tel_change"></span></div>'+
    '</div>'+
 '</div>'+
'</div>'+
'<div class="float-contact-mini-left" id="float-contact-mini-left"> <a href="javascript:void(0);" onclick="show1()" id="float-contact-mini-left"></a> </div>'+
	   '<div class="float-contact" id="float-contact">'+
                         '<div class="xes-container">'+
                             '<div class="xes-cons">'+
                               '<h3 class="xes-cons-title"><a onclick="_MEIQIA._SHOWPANEL()"><img src="../../img_xes/girl.png"/><i>Hi,欢迎来咨询</i></a></h3>'+
                               '<ul class="xes-cons-btn">'+
                                 '<li class="zx-jg"><a onclick="_MEIQIA._SHOWPANEL()"><i></i>价格<br>咨询</a></li>'+
                                 '<li class="zx-kf"><a onclick="_MEIQIA._SHOWPANEL()"><i></i>在线<br>咨询</a></li>'+
                                 '<li class="zx-kc"><a onclick="_MEIQIA._SHOWPANEL()"><i></i>课程<br>预约</a></li>'+
                                 '<li class="zx-dh"><a onclick="_MEIQIA._SHOWPANEL()"><i></i>电话<br>咨询<em><span class="zk_tel_change"></em></a></li>'+
                               
                                 '</ul>'+
                              '</div>'+
                           '</div>'+
                         '</div>'+
                        '<div class="float-contact-mini" id="float-contact-mini">'+
                         '<a href="javascript:void(0);" onclick="show()" id="float-contact-mini"></a>'+
                        '</div>';
                return comment;
    }
    window.Common.invitingBoxHtml = function(){
        return '<div id="invitingBox" class="gif-img" style="display:none;">'+
          '<div class="gif-div">'+

            '<div><a href="javascript:void(0);" onClick="inviteLater(30000); return false" class="BTN-OTHER"></a>'+
                 '<a href="javascript:void(0);" onClick="inviteAccept(); return false;" class="BTN-OTHER1" id="gtcstj"></a>'+
            '</div>'+
          '</div>'+
          '<span class="gif-div"><img src="../../img_xes/tanchu.png" alt="接待框"/></span>'+
        '</div>'; 
    }


})(window, $);

document.write('<script type="text/javascript" src="../js/global.js"></script>');
document.write('<script type="text/javascript" src="../js/city-tab.js"></script>');
document.write(' <script src="../js/baidu.js"></script> ');
document.write('<div style="display:none;"><script src="http://www6.dianji007.com/bls/srv/s?uid=20110526703&sty=4"></script></div>');
