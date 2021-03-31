//lbs 处理
//校区LBS Start
var LBSAPI = "/api/LBS/lbsV2.ashx";
var defaultCity;
var defaultRegion;
//获取校区list
function lbs_getSchools(city, region,callback) {

    $.ajax({
        type: "get",
        url: LBSAPI,
        data: {
            "method": "getdept",
            "city": city,
            "region": region,
            "keyword": ""
        },
        timeout: 20000,
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                callback(data);
                //BindBDMap
                //InitMapMaker(city, "", data);
                //lbs_InitDataList(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(status + textStatus + "；" + errorThrown);
        }
    });
}
//初始化校区列表
function lbs_InitDept(city, region) {

    console.log("我执行了-->",city+","+region)
    lbs_getSchools(city, region, function (data) {
        console.log("我的数据-->",data)
        $(".btmDistrict .box ul").empty();
        $.each(data, function (index, obj) {
           
            $(".btmDistrict .box ul").append("<li><a href='javascript: void (0);' onclick='doyoo.util.openChat();' data-val=\"" + obj.school + "\">" + obj.school + "</a></li>");
           
        });
        //定义了地图
        if (map != undefined) { 
            
            InitMapMaker(city, region, data);
        }


    });
}
//获取城市
function lbs_getCity(callback) {
    $.ajax({
        type: "get",
        url: LBSAPI,
        data: {
            "method": "getcity"
        },
        timeout: 20000,
        dataType: "json",
        success: function (data) {
            console.log(data);

            //执行callback
            if (data.length > 0) {
                callback(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(status + textStatus + "；" + errorThrown);
        }
    });
}
//初始化城市列表
function lbs_initCity(city,region) {
    lbs_getCity(function (data) {
        if ($(".slCity").length > 0) {
            $(".slCity").empty();
            $.each(data, function (index, obj) {
                if (obj.cityname == city) {

                    $(".slCity").append(" <li class=\"cur\"><a data-value=\"" + obj.cityname + "\">" + obj.cityname+"</a></li>");
                    //加载校区
                    if (region == "") {
                       
					    lbs_InitDept(city, "");
                    }
                }
                else {
                    $(".slCity").append(" <li><a  data-value=\"" + obj.cityname + "\">" + obj.cityname + "</a></li>");
                }
               

            });

            //加载城市的区域
            lbs_InitRegion(city, region);
          
        }
    });
    
}
//初始化默认城市
function lbs_InitDefaultCity() {
    defaultCity = getUrlParam("city");
    defaultRegion = getUrlParam("region");
	
    if (defaultCity == "") {
        defaultCity = page_CityName;
    }
    lbs_initCity(defaultCity, defaultRegion);
}
//获取城市区域
function lbs_getCityRegion(city, callback) {
    $.ajax({
        type: "get",
        url: LBSAPI,
        dataType: "json",
        data: {
            "method": "getcityregion",
            "city": city
        },
        timeout: 20000,
        success: function (data) {
            if (data.length > 0) {
                callback(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(status + textStatus + "；" + errorThrown);
        }
    });
}
//初始化城市区域
function lbs_InitRegion(city,region) {
    lbs_getCityRegion(city, function (data) {
        $(".btmDistrict .top").empty();
        $.each(data, function (index, obj) {
            if (region == obj.Region) {
               // $(".slCityRegion").append("<option value=\"" + obj.Region + "\" selected>" + obj.Region + "</option>");
               $(".btmDistrict .top").append("<dd class='cur'><a data-city=\""+city+"\" data-val=\"" + obj.Region + "\">" + obj.Region + "</a></dd>");
                lbs_InitDept(city, region);
            }
            else {
               // $(".slCityRegion").append("<option value=\"" + obj.Region + "\">" + obj.Region + "</option>");
               $(".btmDistrict .top").append("<dd><a data-city=\""+city+"\" data-val=\"" + obj.Region + "\">" + obj.Region + "</a></dd>");
            }
        });   
    });
}


//Baidu Map Start ===

//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return decodeURI(r[2]); return ""; //返回参数值
}

//判定空
function IsNullOrEmpty(str) {
    if (typeof (str) == "undefined") return true;
    if (str == null) return true;
    if (str == "") return true;
    if (str == "0") return true;
    return false;
}
var map;

//初始化地图
function InitMapMaker(city, region, data) {
    //移动中心点
    map.centerAndZoom(city+region, 10);
    //清理所有 marker
    map.clearOverlays();
	map.addEventListener("click", function () {
		var num = $(".marker_colse").attr("data-num")
		if(num == undefined || num==""){
		   $("#map2").animate({"height":$(".map_title").outerHeight(true)},200);
		}

	});
	
	$("#map2 .ul").empty()
	$(".map_title h3 span").text(data.length)
    $.each(data, function (i, item) {
        add_marker(item);
		createHtml(item)
    });
}

//生成列表数
function createHtml(data){
	var html = "<li>" +
            "<div class='libox'>" +
            "<h3 class='h3'>" + data.school + "</h3>" +
            "<div class='txt city'>" + data.city + data.region + "</div>" +
            "<div class='txt'>" + data.address + "</div>" +
			"<div class='add'>距您  <span>2km</span></div>" +
            "</div>" +
            "<div class='btnbox click_doyoo'>" +
            "<a href='javascript:;' onClick='doyoo.util.openChat();' class='btn'>马上预约</a>" +
            "<a href='tel:" + data.tel + "' class='btn_tel'>" + data.tel + "</a>" +
            "</div>" +
            "</li>";	
	$("#map2 .ul").prepend(html)				
}

//标注
function add_marker(objDept) {
    //var sContent = '<div style="width:300px;"><img src="images/logo.jpg"><p style="font-size:16px;font-weight:bold">' + school_name + '</p><p style="font-size:13px;">' + address + '</p><p style="font-size:14px;">400-883-8062</p></div>';
    var point = new BMap.Point(objDept.lng, objDept.lat);  // 创建点坐标
    var myIcon = new BMap.Icon("images/icon.png", new BMap.Size(18, 24));
    var marker = new BMap.Marker(point, { icon: myIcon });
    //var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
    map.addOverlay(marker);
    marker.addEventListener("click", function () {
		var currH = $("#map2").outerHeight()>0?$("#map2").outerHeight():$(".marker_colse").attr("data-num");
        var html = "<li>" +
            "<div class='libox'>" +
            "<h3 class='h3'>" + objDept.school + "</h3>" +
            "<div class='txt city'>" + objDept.city + objDept.region + "</div>" +
            "<div class='txt'>" + objDept.address + "</div>" +
			"<div class='add'>距您  <span>2km</span></div>" +
            "</div>" +
            "<div class='btnbox'>" +
            "<a href='javascript:;' onClick='doyoo.util.openChat();' class='btn '>马上预约</a>" +
            "<a href='tel:" + objDept.tel + "' class='btn_tel'>" + objDept.tel + "</a>" +
            "</div>" +
            "</li>";
        showMarker(html,currH);
    });
}

//显示弹出1
function showMarker(html,currH){
	$("#map1 .mapTxtBoxScll ul.ul").html(html)
    $("#map2").animate({height:0},200)
	$('#map1').slideDown(300).children().children(".marker_colse").attr("data-num",currH)
};

//显示弹出二
function showMarker2(currH){
	$("#map2").animate({height:currH},200)
	$('#map1').slideUp(0).children().children(".marker_colse").attr("data-num","");
};

//获取用户当前坐标信息
function GetUserPostionInfo(callback) {
    //获取坐标
    var cookiePoint = $.cookie('upoint');
    console.log(cookiePoint);
    if (cookiePoint != undefined) {
        var points = cookiePoint.split('|');
        var point = new BMap.Point(points[0], points[1]);
        var geoc = new BMap.Geocoder();
        geoc.getLocation(point, function (rs) {
            var addComp = rs.addressComponents;
            console.log(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
            callback(point, addComp);
        });
    }
    else {
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function (r) {
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                console.log(r.point.lng + "，" + r.point.lat);
                var date = new Date();
                date.setTime(date.getTime() + 120 * 1000);//只能这么写，10表示10秒钟
                $.cookie('upoint', r.point.lng + "|" + r.point.lat, { expires: date, path: '/' });

                //地址解析 获取
                var geoc = new BMap.Geocoder();
                geoc.getLocation(r.point, function (rs) {
                    var addComp = rs.addressComponents;
                    console.log("用户定位成功："+addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
                    callback(r.point, addComp);
                });
            }
            else {
                console.log('获取坐标失败' + this.getStatus());
            }
        });
    }
}

$(function () {

   
    //Init 
    lbs_InitDefaultCity();

    //Init userPostion
    GetUserPostionInfo(function (UserPoint, UserAddress) {
        var UserRegion = UserAddress.district;
       console.log(defaultCity + "---->" + UserRegion);
		lbs_InitDept(defaultCity, UserRegion);
		 //同步界面
        SyncUIRegion(UserRegion);
    });


    $(document).on("click",".slCity li a", function () {
        var city = $(this).attr("data-value");
		$(this).parent().addClass("cur").siblings().removeClass("cur")
        lbs_InitRegion(city);
        lbs_InitDept(city, "");
    });

    $(".slCityRegion").on("click", function () {
        var region = $(this).data("value");
        var city = $(".slCity").val();
        //GetDept
        lbs_InitDept(city, region);
        //同步界面
        SyncUIRegion(region);
    });

    //同步界面区域信息
    function SyncUIRegion( region) {
        $(".btmDistrict .top dd a[data-val='" + region + "']").parent("dd").addClass("cur").siblings().removeClass("cur");
    }
	
	$(document).on("click",".top dd a",function(){
		var city = $(this).attr("data-city");
		$(this).parent().addClass("cur").siblings().removeClass("cur")
		var region = $(this).attr("data-val");
        console.log("我的值是-->>",city)
		lbs_InitDept(city, region);
	})

    $(".btnLbsSearch").on("click", function () {
        var region = $(".slCityRegion").val();
        var city = $(".slCity").val();
        location.href = "lbs.aspx?city=" + city + "&region=" + region;
    });
	
	//关闭弹出层
	$('.marker_colse').click(function () {
        var currH = parseInt($(this).attr("data-num"));
        showMarker2(currH);
	});
	
	//跳转乐语
	$(".click_doyoo").on("click",function(ev){
		var ev = ev || window.event;
		ev.preventDefault();
        doyoo.util.openChat();
	})

});


//校区LBS End




