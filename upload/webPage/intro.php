<?php
@include("../class/connect.php");
if(!defined('InEmpireDown'))
{
    exit();
}
$myuserid=(int)getcvar('memberuserid');
$mhavelogin=0;
if($myuserid)
{
    @include("../data/cache/public.php");
    @include("../class/db_sql.php");
    @include("../class/user.php");
    @include("../data/cache/MemberLevel.php");
    $link=db_connect();
    $empire=new mysqlquery();
    $mhavelogin=1;
    //数据
    $myusername=RepPostVar(getcvar('memberusername'));
    $myrnd=RepPostVar(getcvar('memberrnd'));
    $r=$empire->fetch1("select ".$user_userid.",".$user_username.",".$user_group.",".$user_downfen.",".$user_downdate.",".$user_checked.",".$user_zgroup." from ".$user_tablename." where ".$user_userid."='$myuserid' and ".$user_rnd."='$myrnd' limit 1");
    if(empty($r[$user_userid])||$r[$user_checked]==0)
    {
        EmptyEdownCookie();
        $mhavelogin=0;
    }
    //会员等级
    if(empty($r[$user_group]))
    {$groupid=$user_groupid;}
    else
    {$groupid=$r[$user_group];}
    $groupname=$level_r[$groupid]['groupname'];
    //点数
    $downfen=$r[$user_downfen];
    //天数
    $downdate=0;
    if($r[$user_downdate])
    {
        $downdate=$r[$user_downdate]-time();
        if($downdate<=0)
        {$downdate=0;}
        else
        {$downdate=round($downdate/(24*3600));}
    }
    //$myusername=$r[$user_username];
    db_close();
    $empire=null;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="applicable-device" content="mobile" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Language" content="zh-CN" />

    <title>诚聪教育</title>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement('script');
            hm.src = '//hm.baidu.com/hm.js?aa9214fb2bb2feef65ae3c647bf3bfcf';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(hm, s);
            var sUserAgent = navigator.userAgent.toLowerCase();
            var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
            var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
            var bIsMidp = sUserAgent.match(/midp/i) == "midp";
            var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
            var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
            var bIsAndroid = sUserAgent.match(/android/i) == "android";
            var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
            var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
            if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
                //跳转移动端页面
                window.location.href = "/upload/mobilePage/intro.php";
            }
        })();
    </script>

    <link rel="stylesheet" href="../../staticPoj/res/css/editor.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/owl.carousel.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/css_whir.css?vs333" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/index.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/indexa.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/animation.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/swiper.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/ckin.css" media="screen" />
    <link rel="stylesheet" href="../../staticPoj/bootstrap/css/bootstrap.min.css" />

    <script type="text/javascript" src="../../staticPoj/res/js/layer.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/js-whir.js"></script>

    <script>
        var navID = 0;
        var page_CityID = "8";
        var page_CityName = "南京";
        var page_Tel = "400-883-8052";
        var page_From = "BAIDU";
    </script>

    <!-- Baidu Map-->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=lxv12hQmbE0dNkQultYWOcGb"></script>
    <script src="../../staticPoj/res/js/lbs.js?v20190221002"></script>
    <!--State Code-->

    <script>
        //luyu windows
        (new Image).src='http://hm.baidu.com/hm.gif?ep=%7Bid%3Adoyoo_mon_accept%2CeventType%3Aclick%7D&et=1&nv=0&si=aa9214fb2bb2feef65ae3c647bf3bfcf&st=4&v=pixel-1.0&rnd=' + Math.floor(Math.random() * Math.pow(2, 31));
        (new Image).src='http://hm.baidu.com/hm.gif?ep=%7Bid%3Adoyoo_mon_refuse%2CeventType%3Aclick%7D&et=1&nv=0&si=aa9214fb2bb2feef65ae3c647bf3bfcf&st=4&v=pixel-1.0&rnd=' + Math.floor(Math.random() * Math.pow(2, 31));
    </script>
    <!--腾讯PC统计-->
    <script type='text/javascript' src='http://tajs.qq.com/stats?sId=66109434' charset='UTF-8'></script>

    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b5183ad2f434d604715cf26b22655d41";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</head>
<body>
<!--top-->

<header>
    <div class="topBar">
        <div class="inner">
            <div class="topNav"><span>中小学同步辅导</span> <span class="a"><a href="1v1.php">1对1</a></span> <span>/</span> <span class="a"><a href="1v3.php">同步学</a></span> </div>
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">充值优惠</div>-->
        </div>
    </div>
    <div class="header">
        <div class="inner">
            <div class="logo"><a href="/upload/webPage/intro.php">
                    <img src="../../staticPoj/res/uploadfiles/2018/11/20181109092612365.jpg?bG9nby5qcGc=" />
                </a></div>
            <div class="topNav"><span>中小学同步辅导</span> <span class="a"><a href="/upload/webPage/1v1.php">1对1</a></span> <span>/</span> <span class="a"><a href="/upload/webPage/1v3.php">同步学</a></span> </div>
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">充值优惠</div>-->
            <nav class="nav" style="margin-top: 0.3%">
                <ul>
                    <li id="nav1"><a href="/upload/webPage/intro.php">首 页</a></li>
                    <li id="nav3"><a href="/upload/webPage/idea.php">优势体系</a>
                        <dl>
                            <dd><a href="/upload/webPage/idea.php">服务管理</a></dd>
                            <dd><a href="/upload/webPage/teachers.php">师资力量</a></dd>
                            <dd><a href="/upload/webPage/serviceManage.html">在线学习</a></dd>
                        </dl>
                    </li>
                    <li id="nav6"><a href="/upload/webPage/1v1.php">课程体系</a>
                        <dl>
                            <dd><a href="/upload/webPage/1v1.php">1对1课程</a></dd>
                            <dd><a href="/upload/webPage/1v3.php">同步学习</a></dd>
                        </dl>
                    </li>
                    <li id="nav8"><a href="/upload/webPage/event.php">走进诚聪</a>
                        <dl>
                            <dd><a href="/upload/webPage/event.php">诚聪大事记</a></dd>
                            <dd><a href="/upload/webPage/saying.php">教育理念</a></dd>
                        </dl>
                    </li>
                    <li id="nav4"><a href="/upload/webPage/help.php">答疑中心</a>
                    <li id="nav"><a href="/upload/webPage/discount.php">充值中心</a></li>
                        <dl>
                        </dl>
                    </li>
                    <?php
                    if($mhavelogin==1) {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
<!--                        <li id="nav"><a onclick="zhuan()">充值中心</a></li>-->
                        <li id="nav"><a href="/upload/webPage/selfinfo.php" style="color: #0000FF"><strong>Hello</strong>,<?=$myusername?></a></li>

                        <li id="nav"><a style="color: #0000FF" href="/upload/phome?phome=exit">退出</a></li>
                        <!--                        </ul>-->
                        <?php
                    }else {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
                        <li id="nav"><a href="/upload/webPage/login.php"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                        <!--                        </ul>-->
                        <?php
                    }
                    ?>
                </ul>

            </nav>
            <script type="text/javascript">
                $('#nav' + navID).addClass('cur');
                $(window).on('scroll', function () {
                    var scrollTop = $(document).scrollTop();
                    if (scrollTop > 100) {
                        $("body").addClass("yc_body")
                    } else {
                        $("body").removeClass("yc_body")
                    }
                })
            </script>
            <div class="clear"></div>
        </div>
    </div>
</header>
<!--Body-->

<main>
    <!--TA热力图代码-->
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=66170070" charset="UTF-8"></script>
    <!--左侧菜单-->
    <div class="navMenu">
        <div class="navMeaubar">
<!--            --><?php
//            if($mhavelogin==1) {
//                ?>
                <dl>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank" class="remai">热卖课程</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank" style="font-weight: bold;color: #e12d30;">暑期班 |</a>
                        <a href="/upload/webPage/mainPage.php" target="_blank" style="font-weight: bold;color: #e12d30;">开学收心
                        </a>

                    </dd>

                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">小学同步服务</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">语文</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">数学</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">英语</a>
                    </dd>

                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">中考</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">高考</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">小升初</a>
                    </dd>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">初中同步服务</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">语文</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">数学</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">英语</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">物理</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">化学</a><br/>
                        <a href="/upload/webPage/mainPage.php" target="_blank">地理</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">历史</a>
                    </dd>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">高中同步服务</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">语文</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">数学</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">英语</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">物理</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">化学</a><br/>
                        <a href="/upload/webPage/mainPage.php" target="_blank">地理</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">历史</a>
                    </dd>

                </dl>
<!--                --><?php
//            }else {
//                ?>
<!--                <dl>-->
<!--                    <dt><a onclick="tixin()" target="_blank" class="remai">热卖课程</a></dt>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank" style="font-weight: bold;color: #e12d30;">暑期班 |</a>-->
<!--                        <a onclick="tixin()" target="_blank" style="font-weight: bold;color: #e12d30;">开学收心-->
<!--                        </a>-->
<!---->
<!--                    </dd>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">中考</a> |-->
<!--                        <a onclick="tixin()" target="_blank">高考</a> |-->
<!--                        <a onclick="tixin()" target="_blank">小升初</a>-->
<!--                    </dd>-->
<!--                    <dt><a onclick="tixin()" target="_blank">小学同步服务</a></dt>-->
<!--                    <dd>-->
<!---->
<!--                        <a onclick="tixin()" target="_blank">语文</a> |-->
<!--                        <a onclick="tixin()" target="_blank">数学</a> |-->
<!--                        <a onclick="tixin()" target="_blank">英语</a>-->
<!--                    </dd>-->
<!---->
<!--                    <dt><a onclick="tixin()" target="_blank">初中同步服务</a></dt>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">语文</a> |-->
<!--                        <a onclick="tixin()" target="_blank">数学</a> |-->
<!--                        <a onclick="tixin()" target="_blank">英语</a> |-->
<!--                        <a onclick="tixin()" target="_blank">物理</a> |-->
<!--                        <a onclick="tixin()" target="_blank">化学</a><br/>-->
<!--                        <a onclick="tixin()" target="_blank">地理</a> |-->
<!--                        <a onclick="tixin()" target="_blank">历史</a>-->
<!--                    </dd>-->
<!--                    <dt><a onclick="tixin()" target="_blank">高中同步服务</a></dt>-->
<!---->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">语文</a> |-->
<!--                        <a onclick="tixin()" target="_blank">数学</a> |-->
<!--                        <a onclick="tixin()" target="_blank">英语</a> |-->
<!--                        <a onclick="tixin()" target="_blank">物理</a> |-->
<!--                        <a onclick="tixin()" target="_blank">化学</a><br/>-->
<!--                        <a onclick="tixin()" target="_blank">地理</a> |-->
<!--                        <a onclick="tixin()" target="_blank">历史</a>-->
<!--                    </dd>-->
<!---->
<!--                </dl>-->
<!--                --><?php
//            }
//            ?>

        </div>
    </div>

<!--    轮播图-->
    <!--banner-->
    <div class="hmSlides">
        <div id="hmSlides" class="owl-carousel">

            <div id="BannerImg_70" class="item" style="background-image: url('../../staticPoj/imgs/ban1.jpg'); cursor: pointer;"><a href="/upload/webPage/1v3.php" target="_blank"></a></div>

            <div id="BannerImg_23" class="item" style="background-image: url('../../staticPoj/imgs/ban2.jpg'); cursor: pointer;"><a href="/upload/webPage/serviceManage.html" target="_blank"></a></div>

            <div id="BannerImg_58" class="item" style="background-image: url('../../staticPoj/imgs/ban3.jpg'); cursor: pointer;"><a href="/upload/webPage/teachers.php" target="_blank"></a></div>

            <div id="BannerImg_69" class="item" style="background-image: url('../../staticPoj/imgs/ban4.jpg'); cursor: pointer;"><a href="/upload/webPage/discount.php" target="_blank"></a></div>



        </div>
    </div>

    <!--倒计时板块-->
    <div class="timeDown">
        <div class="item1">
            <div class="item1-zk">
                中考倒计时
                <span id="day-zk">00</span>天
                <span id="hours-zk">00</span>时
                <span id="minutes-zk">00</span>分
                <span id="seconds-zk">00</span>秒
            </div>
            <img src="../../staticPoj/res/images/and_03.png" alt="">
            <div class="item1-gk">
                高考倒计时
                <span id="day-gk">00</span>天
                <span id="hours-gk">00</span>时
                <span id="minutes-gk">00</span>分
                <span id="seconds-gk">00</span>秒
            </div>
        </div>
        <?php
        if ($mhavelogin==1) {
            ?>
            <ul class="item2">
                <li>
                    <img src="../../staticPoj/res/images/tIcon5_03.png" alt="">
                    <h1>暑期班</h1>
                    <p>低至8折</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon2_03.png" alt="">
                    <h1>小升初</h1>
                    <p>升学规划</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon3_03.png" alt="">
                    <h1>中 考</h1>
                    <p>目标院校定向</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon4_03.png" alt="">
                    <h1>高 考</h1>
                    <p>全真志愿填报</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon1_03.png" alt="">
                    <h1>开学收心
                    </h1>
                    <p>低至50元</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">了解详情 ></a>
                </li>
            </ul>
            <?php
        }else{
            ?>
            <ul class="item2">
                <li>
                    <img src="../../staticPoj/res/images/tIcon5_03.png" alt="">
                    <h1>暑期班</h1>
                    <p>低至8折</p>
                    <a onclick="tixin()" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon2_03.png" alt="">
                    <h1>小升初</h1>
                    <p>升学规划</p>
                    <a onclick="tixin()" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon3_03.png" alt="">
                    <h1>中 考</h1>
                    <p>目标院校定向</p>
                    <a onclick="tixin()" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon4_03.png" alt="">
                    <h1>高 考</h1>
                    <p>全真志愿填报</p>
                    <a onclick="tixin()" target="_blank">了解详情 ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon1_03.png" alt="">
                    <h1>开学收心
                    </h1>
                    <p>低至50元</p>
                    <a onclick="tixin()" target="_blank">了解详情 ></a>
                </li>
            </ul>
        <?php
        }
        ?>

    </div>
    <script>
        // 中考倒计时
        {
            var countDownTime = {
                init: function(a, b, c, d, e) {
                    this.t = a, this.d = b, this.h = c, this.m = d, this.s = e
                },
                start: function() {
                    var a = this;
                    setInterval(a.timer, 1e3);
                },
                timer: function(a) {
                    var b, c, d, e, f, g, h;
                    a = this.countDownTime, b = new Date, c = new Date(a.t), d = c.getTime() - b.getTime(), e = Math.floor(a.formatTime(d, "day")), f = Math.floor(a.formatTime(d, "hours")), g = Math.floor(a.formatTime(d, "minutes")), h = Math.floor(a.formatTime(d, "seconds")), a.d && (a.d.innerText = a.formatNumber(e)), a.h && (a.h.innerText = a.formatNumber(f)), a.m && (a.m.innerText = a.formatNumber(g)), a.s && (a.s.innerText = a.formatNumber(h))
                },
                formatNumber: function(a) {
                    if(a<=0){a=0}
                    return a = a.toString(), a[1] ? a : "0" + a
                },
                formatTime: function(a, b) {
                    switch (b) {
                        case "day":
                            return a / 1e3 / 60 / 60 / 24;
                        case "hours":
                            return a / 1e3 / 60 / 60 % 24;
                        case "minutes":
                            return a / 1e3 / 60 % 60;
                        case "seconds":
                            return a / 1e3 % 60
                    }
                }
            };

            var	dayZk= document.getElementById('day-zk');
            var	hoursZk = document.getElementById('hours-zk');
            var	minutesZk = document.getElementById('minutes-zk');
            var secondsZk = document.getElementById('seconds-zk');
            // 声明结束时间
            countDownTime.init('2020/6/16 00:00:00', dayZk, hoursZk, minutesZk, secondsZk);
            countDownTime.start();
        }

        // 高考倒计时
        {
            var countDownTime2 = {
                init: function(a, b, c, d, e) {
                    this.t = a, this.d = b, this.h = c, this.m = d, this.s = e
                },
                start: function() {
                    var a = this;
                    setInterval(a.timer, 1e3);
                },
                timer: function(a) {
                    var b, c, d, e, f, g, h;
                    a = this.countDownTime2, b = new Date, c = new Date(a.t), d = c.getTime() - b.getTime(), e = Math.floor(a.formatTime(d, "day")), f = Math.floor(a.formatTime(d, "hours")), g = Math.floor(a.formatTime(d, "minutes")), h = Math.floor(a.formatTime(d, "seconds")), a.d && (a.d.innerText = a.formatNumber(e)), a.h && (a.h.innerText = a.formatNumber(f)), a.m && (a.m.innerText = a.formatNumber(g)), a.s && (a.s.innerText = a.formatNumber(h))
                },
                formatNumber: function(a) {
                    if(a<=0){a=0}
                    return a = a.toString(), a[1] ? a : "0" + a
                },
                formatTime: function(a, b) {
                    switch (b) {
                        case "day":
                            return a / 1e3 / 60 / 60 / 24;
                        case "hours":
                            return a / 1e3 / 60 / 60 % 24;
                        case "minutes":
                            return a / 1e3 / 60 % 60;
                        case "seconds":
                            return a / 1e3 % 60
                    }
                }
            };
            var	dayGk = document.getElementById('day-gk');
            var	hoursGk = document.getElementById('hours-gk');
            var	minutesGk = document.getElementById('minutes-gk');
            var secondsGk = document.getElementById('seconds-gk');
            // 声明结束时间
            countDownTime2.init('2020/6/7 00:00:00', dayGk, hoursGk, minutesGk, secondsGk);
            countDownTime2.start();
        }
    </script>
    <div class="liu_div">

        <h2 class="una_h2">选择诚聪=选择未来 </h2>

        <p class="una_p">优质服务让学习更高效</p>

        <ul class="liu_ul2 liu_ul">

            <li>

                <a href="javascript:;">

                    <span class="liu_left">教务服务</span>

                    <div class="liu_right">

                        <p>诚聪拥有实力雄厚的教务体系，贯穿到学生学习的课前、课中、课后三个场景，全方位地提升孩子的学习效率和学习成绩。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">增值服务</span>

                    <div class="liu_right">

                        <p>自主招生、在线同步辅导、直播大班课多元化增值服务，关注每一个不同孩子成长的每一个细节。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">项目服务</span>

                    <div class="liu_right">

                        <p>精心研发一对一辅导、自主招生、精品小班课、艺考特训、同步课程学习:预习、复习、拓展等多元化教育产品。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">学习服务</span>

                    <div class="liu_right">

                        <p>1位学习规划师、1位精英学科教师、1位专职班主任、1套个性化学习方案，为每个孩子提供360°全方位学习服务。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">师资服务</span>

                    <div class="liu_right">

                        <p>严格筛选至少拥有5年学科教学经验的教师，3%的面试通过率，历经五层考核严把师资质量，真正万里挑一。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">服务理念</span>

                    <div class="liu_right">

                        <p>我们始终坚信每个孩子都是不一样的烟火，我们将教育根植于爱，专注做好教育的每一件事，让成长对孩子更有价值。</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <div style="clear: both;"></div>

        </ul>

<!--        <a class="liu_yue" href="javascript:;" onclick="but_meiqia();">预约试听</a>-->

    </div>
    <!--完整的课程体系，阶梯式提升开始-->
    <section class="section2">
        <div class="content_box section2_box">
            <h1>主讲+辅导老师直播教学</h1>
            <div class="border_red"></div>
            <h3>追踪各个环节，把关学习效果</h3>
            <div class="section2_contentbox">
                <div class="section2_contentCon">
                    <img src="../../staticPoj/res/images/section2_1.png" class="section2_img">
                    <p class="section2_contentCon-title">主讲直播授课</p>
                    <p class="section2_contentCon-cont">打通孩子解题思路，一通百通</p>
                </div>
                <div class="section2_contentCon">
                    <img src="../../staticPoj/res/images/section2_2.png" class="section2_img">
                    <p class="section2_contentCon-title">辅导老师1对1答疑</p>
                    <p class="section2_contentCon-cont">有问题随时解答学会为止</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section3">
        <div class="content_box section3_box">
            <h1>课堂真实体验</h1>
            <div class="border_red" style="margin: 16px auto 60px;"></div>
            <h3 class="section3_h3"><span class="h3_title-num">01</span>趣味课堂，激发学习兴趣，学出成就感</h3>
            <div class="section3_contentbox">
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_2.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">动画课件</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_1.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">小组PK</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_4.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">金币奖励</div>
                    </div>
                </div>
            </div>
            <h3 class="section3_h3"><span class="h3_title-num">02</span>学测结合，实时检测学习效果，快速提升</h3>
            <div class="section3_contentbox">
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_5.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">课题互动题</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_6.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">随堂测试</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_8.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">学习报告</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section5">
        <div class="content_box section5_box">
            <h1>强烈建议以下几类孩子学习</h1>
            <div class="border_red"></div>
            <div class="section5_contentbox">
                <div class="section5_cont-left">
                    <div class="section5_conleft-one">
                        <p>偏科厌学</p>
                        <div class="section5-cont-title">一科突出，其他平平，文科或理科突出，另一方面较弱，一科较弱，其他都较强。对于成绩差的科目产生抵触厌学心理，学不进去，甚至产生恐惧。</div>
                    </div>
                    <div class="section5_conleft-two">
                        <p>苦学无效</p>
                        <div class="section5-cont-title">孩子一直努力学习但效果就是不明显，无效是学习中的一个“老大难”问题。很多学生把大量时间花在学习上，但学习效果却不佳，似乎学习的努力程度与学习效果并不成正比。</div>
                    </div>
                </div>
                <img width="550" height="420" src="../../staticPoj/res/images/section5.png">
                <div class="section5_cont-right">
                    <div class="section5_conright-one">
                        <p>课外拔高拓展</p>
                        <div class="section5-cont-title">课内学习很轻松，具备较强的分析解决问题的能力，希望拓展知识，学习解决复杂问题难题的能力。</div>
                    </div>
                    <div class="section5_conrights-two">
                        <p>盲目学习</p>
                        <div class="section5-cont-title">课堂上不知道要干什么，只是随了别人在学习，老师叫干什么就干什么，没有自主意识，没有明确的目的，没有计划，很少能完成学习任务。</div>
                    </div>
                    <div class="section5_conrights-thire">
                        <p>眼高手低</p>
                        <div class="section5-cont-title">感觉一看就会，做题一做就错，考试成绩与自己估计的分数相差很大，不知道错在哪了，经常无故地丢分、漏分。</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="una_div">

        <div class="una_cen">

            <h2 class="una_h2">完整的课程体系，阶梯式提升</h2>

            <p class="una_p">尊重每个孩子的学习天赋，让学习更简单</p>

            <!--PC端-->

            <ul class="una_ul1 una_ul">

                <li class="una_li1 wow a-fadeinB animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeinB;">

                    <b>夯实基础</b>

                    <div class="una_con">

                        <h3>查缺补漏 巩固基础</h3>

                        <p>帮助孩子解决考卷上的基础题型。解决基础知识薄弱、零散、缺乏知识脉络、不能交叉运用等问题。</p>

                    </div>

                </li>

                <li class="una_li2 wow a-fadeinB animated" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeinB;">

                    <b>巩固拔高</b>

                    <div class="una_con">

                        <h3>稳步提升 巩固拔高</h3>

                        <p>提升思辨力、意志力和解决困难及问题的能力。解决学生试卷上难度较大的少量题目，锻炼学生计算、推理、阅读和理解能力。</p>

                    </div>

                </li>

                <li class="una_li3 wow a-fadeinB animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeinB;">

                    <b>精英培优</b>

                    <div class="una_con">

                        <h3>复习为主 强化学习</h3>

                        <p>提升学生思维能力及解题能力，对少量的中等难度的题型进行点拨，深化各知识点间的内在联系及转化。</p>

                    </div>

                </li>

                <li class="una_li4 wow a-fadeinB animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeinB;">

                    <b>技巧突破</b>

                    <div class="una_con">

                        <h3>发散思维 专项训练</h3>

                        <p>让学生具备运筹帷幄、临危不乱的心理素质，运用技巧和方法取得优异成绩。在这个基础上进行想象，从而产生多条思路，并且使多条思路向外扩展，扩展为多角度思维空间。</p>

                    </div>

                </li>

                <li class="una_li5 wow a-fadeinB animated" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeinB;">

                    <b>心理调整</b>

                    <div class="una_con">

                        <h3>拔尖培优 心理调整</h3>

                        <p>对知识进行延伸和拓展，在知识点的深度和宽度上进行拔尖。也要对学生的心理进行调节，缓解一下紧张的心情和考前恐惧症尤为重要。</p>

                    </div>

                </li>

<!--                <div style="clear: both;"></div>-->

            </ul>

            <!--手机端-->

            <div class="Sek-div swiper-container swiper-container-horizontal">

                <div class="swiper-wrapper" style="transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>夯实基础</b>

                            <div class="una_con">

                                <h3>查缺补漏 巩固基础</h3>

                                <p>帮助孩子解决考卷上半数以上的基础题型。解决基础知识薄弱、零散、缺乏知识网络、不能交叉运用等问题。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>巩固拔高</b>

                            <div class="una_con">

                                <h3>稳步提升 巩固拔高</h3>

                                <p>提升思辨力、意志力和解决困难问题的能力。解决学生试卷上难度较大的少量题目，锻炼学生计算、推理、阅读和理解能力。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>精英培优</b>

                            <div class="una_con">

                                <h3>复习为主 强化学习</h3>

                                <p>提升学生思维能力及解题能力，对少量的中等难度的题型进行点拨，深化各知识点间的内在联系及转化。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>技巧突破</b>

                            <div class="una_con">

                                <h3>发散思维 技巧训练</h3>

                                <p>让学生具备运筹帷幄、临危不乱的心理素质，运用技巧和方法取得优异成绩。在这个基础上进行想象，从而产生多条思路，并且使多条思路向外扩展，扩展为多角度思维空间。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>心理调整</b>

                            <div class="una_con">

                                <h3>拔尖培优 心理调整</h3>

                                <p>对知识进行延伸和拓展，在知识点的深度和宽度上拔尖。也要对学生的心理进行调节，缓解一下紧张的心情和考前恐惧症尤为重要。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>夯实基础</b>

                            <div class="una_con">

                                <h3>查缺补漏 巩固基础</h3>

                                <p>帮助孩子解决考卷上半数以上的基础题型。解决基础知识薄弱、零散、缺乏知识网络、不能交叉运用等问题。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>巩固拔高</b>

                            <div class="una_con">

                                <h3>稳步提升 巩固拔高</h3>

                                <p>提升思辨力、意志力和解决困难问题的能力。解决学生试卷上难度较大的少量题目，锻炼学生计算、推理、阅读和理解能力。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>精英培优</b>

                            <div class="una_con">

                                <h3>复习为主 强化学习</h3>

                                <p>提升学生思维能力及解题能力，对少量的中等难度的题型进行点拨，深化各知识点间的内在联系及转化。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>技巧突破</b>

                            <div class="una_con">

                                <h3>发散思维 技巧训练</h3>

                                <p>让学生具备运筹帷幄、临危不乱的心理素质，运用技巧和方法取得优异成绩。在这个基础上进行想象，从而产生多条思路，并且使多条思路向外扩展，扩展为多角度思维空间。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>心理调整</b>

                            <div class="una_con">

                                <h3>拔尖培优 心理调整</h3>

                                <p>对知识进行延伸和拓展，在知识点的深度和宽度上拔尖。也要对学生的心理进行调节，缓解一下紧张的心情和考前恐惧症尤为重要。</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>夯实基础</b>

                            <div class="una_con">

                                <h3>查缺补漏 巩固基础</h3>

                                <p>帮助孩子解决考卷上半数以上的基础题型。解决基础知识薄弱、零散、缺乏知识网络、不能交叉运用等问题。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>巩固拔高</b>

                            <div class="una_con">

                                <h3>稳步提升 巩固拔高</h3>

                                <p>提升思辨力、意志力和解决困难问题的能力。解决学生试卷上难度较大的少量题目，锻炼学生计算、推理、阅读和理解能力。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>精英培优</b>

                            <div class="una_con">

                                <h3>复习为主 强化学习</h3>

                                <p>提升学生思维能力及解题能力，对少量的中等难度的题型进行点拨，深化各知识点间的内在联系及转化。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>技巧突破</b>

                            <div class="una_con">

                                <h3>发散思维 技巧训练</h3>

                                <p>让学生具备运筹帷幄、临危不乱的心理素质，运用技巧和方法取得优异成绩。在这个基础上进行想象，从而产生多条思路，并且使多条思路向外扩展，扩展为多角度思维空间。</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>心理调整</b>

                            <div class="una_con">

                                <h3>拔尖培优 心理调整</h3>

                                <p>对知识进行延伸和拓展，在知识点的深度和宽度上拔尖。也要对学生的心理进行调节，缓解一下紧张的心情和考前恐惧症尤为重要。</p>

                            </div>

                        </div>

                    </div></div>

                <!-- Add Pagination -->

                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>

                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        </div>

    </div>

    <!--板块四-->
    <section class="hmBox4">
        <div class="hmBan" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg.jpg?aG1Cb3g0X2Jhbm5lci5qcGc=);">
            <h2 class="aTitle">私人定制的<span>学习体验</span> </h2>
        </div>
        <div class="boxMain" id="yc_boxMain">
            <div class="inner">
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon01.png?aG1ib3g0X2ljb24wMS5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>诊断问题</h3>
                            <div class="text">先诊断后上课，找到学科症结是关键 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon02.png?aG1ib3g0X2ljb24wMi5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>规划目标</h3>
                            <div class="text">结合测评结果，分数差距制定阶段性提升目标 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon03.png?aG1ib3g0X2ljb24wMy5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>定制方案</h3>
                            <div class="text">根据提升目标，学科弱项制定专属学习方案 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon04.png?aG1ib3g0X2ljb24wNC5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>匹配师资</h3>
                            <div class="text">根据学员情况匹配筛选出更适合孩子的老师 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon05.png?aG1ib3g0X2ljb24wNS5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>跟踪辅导</h3>
                            <div class="text">课前教案调整,<br />课中查漏补缺,<br />课后陪读答疑 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                    <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon06.png?aG1ib3g0X2ljb24wNi5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>实时反馈</h3>
                            <div class="text">阶段性学习反馈，诚聪帮助家长实习检测跟踪 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
                <section class="item">
                    <a href=''>
                        <div class="icon">
                                <span>
                                        <img src="../../staticPoj/res/uploadfiles/images/hmbox4_icon01.png?aG1ib3g0X2ljb24wNi5wbmc=" /></span>
                        </div>
                        <div class="info">
                            <h3>执行方案</h3>
                            <div class="text">根据反馈信息调整旧方案，执行新方案 </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
            </div>
        </div>
    </section>
    <div class="ope_div">

        <div class="ope_cen">

            <h2 class="una_h2">开启1对1专属服务</h2>

            <p class="una_p">只需出5招，找问题、补短板、破瓶颈</p>

            <ul class="ope_bot">

                <li class="ope_li1">

                    <a href="javascript:;">

                        <b>找问题对症下药</b>

                        <p>个性化测评系统，对学生进行全方位测评诊断，分析现状，找出问题，精准制定辅导方案。</p>

                    </a>

                </li>

                <li class="ope_li2">

                    <a href="javascript:;">

                        <b>补基础</b>

                        <p>针对基础薄弱、知识点欠缺的学生，重点辅导基础知识，形成系统牢固的知识体系，让其学习充满自信。</p>

                    </a>

                </li>

                <li class="ope_li3">

                    <a href="javascript:;">

                        <b>讲重点</b>

                        <p>同步学校课程进度，进行综合梳理，帮助学生解决课程遗漏问题，拒绝知识盲点。</p>

                    </a>

                </li>

                <li class="ope_li4">

                    <a href="javascript:;">

                        <b>攻难点</b>

                        <p>引导孩子深度学习，解决难点，以课本为主，知识点进一步强化，重难点归纳，错题漏题总结，挖掘潜力，突破瓶颈。</p>

                    </a>

                </li>

                <li class="ope_li5">

                    <a href="javascript:;">

                        <b>授方法</b>

                        <p>授人以鱼不如授人以渔，掌握知识的同时，注重培养学生的学习习惯和心态养成，传授可以终身受用的学习方法。</p>

                    </a>

                </li>

                <div style="clear: both;"></div>

            </ul>

        </div>

    </div>
    <script type="text/javascript">
        $(function () {
            $(window).on('scroll', function () {
                if (isScrolledIntoView(document.getElementById('yc_boxMain'))) {
                    var _this = $('#yc_boxMain .item');
                    var _length = _this.length;
                    var i = 0;
                    setInterval(function () {
                        _this.eq(i > _length - 1 ? i = 0 : i++).fadeIn(200);
                    }, 400);
                }
            });
        });
    </script>
    <!--板块四-->

    <section class="section7">
        <div class="content_box section7_box">
            <h1>我们的承诺</h1>
            <div class="border_red"></div>
            <div class="section7_contbox">
                <div class="section7-cont">
                    <img class="section7-cont-img" width="94" height="67" src="../../staticPoj/res/images/section7_1.jpg">
                    <p class="section7-cont-title">免费试听，满意再报名</p>
                    <p class="section7-cont-cont">0元领取精品课，学科年级任选，体验满意再报名</p>
                </div>
                <div class="section7-cont">
                    <img class="section7-cont-img" width="81" height="68" src="../../staticPoj/res/images/section7_2.jpg">
                    <p class="section7-cont-title">随时换班型/授课老师</p>
                    <p class="section7-cont-cont">孩子所在班型不合适，老师授课风格不喜欢，可随时更换</p>
                </div>
                <div class="section7-cont">
                    <img class="section7-cont-img" width="65" height="67" src="../../staticPoj/res/images/section7_3.jpg">
                    <p class="section7-cont-title">没效果，退余额</p>
                    <p class="section7-cont-cont">对于课程不满意，支持退款，退款会扣除已上课时费和讲义工本费</p>
                </div>
            </div>
        </div>
    </section>

    <section id="hmBox6" class="hmBox6" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg1.jpg?aG1Cb3g2XzAxLmpwZw==)">
        <div class="hmData">
            <div class="inner">
                <hgroup class="title">
                    <h2 class="aTitle">更多家庭的选择<span>诚聪 · 同步课程</span></h2>
                </hgroup>
                <ul style="margin-left: 20%">

                    <li class="li3">
                        <div class="top"><span class="num" data-from="0" data-to='6000' data-speed="1111">0</span> </div>
                        <div class="btm">学霸导师6000+</div>
                    </li>
                    <li class="li4">
                        <div class="top"><span class="num" data-from="0" data-to='10000000' data-speed="1111">0</span> </div>
                        <div class="btm">服务学员家庭1,0000000+</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hmQa">
            <div class="inner">
                <ul>
                    <li class="li1">
                        <div class="icon" style="background-image: url(../../staticPoj/res/uploadfiles/images/hmBox6_icon01.png?aG1Cb3g2X2ljb24wMS5wbmc=);"></div>
                        <div class="text">
                            <p>专注高效学习 </p>
                            <p style="color: #ccc;">更懂孩子个性化学习需求 </p>
                        </div>
                    </li>
                    <li class="li2">
                        <div class="icon" style="background-image: url(../../staticPoj/res/uploadfiles/images/hmBox6_icon02.png?aG1Cb3g2X2ljb24wMi5wbmc=);"></div>
                        <div class="text">
                            <p>专注自主学习能力的提升 </p>
                            <p style="color: #ccc;">更懂孩子的学习状况 </p>
                        </div>
                    </li>
                    <li class="li3">
                        <div class="icon" style="background-image: url(../../staticPoj/res/uploadfiles/images/hmBox6_icon03.png?aG1Cb3g2X2ljb24wMy5wbmc=);"></div>
                        <div class="text">
                            <p>专注学习习惯的养成</p>
                            <p style="color: #ccc;">更懂孩子的学习心理 </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="../../staticPoj/res/js/jquery.countTo.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/index.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/laytpl.js"></script>


    <script>
        var GradeInfoURL = "/newpc/api/GradeInfo.ashx";

        //获取年级
        function getGrade(grade,subject){
            $.ajax({
                type: "get",
                url: GradeInfoURL,
                data: {
                    "method":"getgrade"
                },
                timeout: 20000,
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        var getTpl = demo.innerHTML
                            ,view = document.getElementById('grade');
                        laytpl(getTpl).render(data, function(html){
                            view.innerHTML = html
                        });
                        getGradeSubject(grade,subject)
                        getGradeSubjectItem(grade,subject)
                        $(".hmGrade ul li[data-title='"+grade+"']").addClass("cur").siblings().removeClass("cur");
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(status + textStatus + ";" + errorThrown)
                }
            });

        }


        //获取科目
        function getGradeSubject(grade,subject){
            $.ajax({
                type: "get",
                url: GradeInfoURL,
                data: {
                    "method":"getgradesubject",
                    "grade":grade
                },
                timeout: 20000,
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        var getTpl = demo2.innerHTML
                            ,hmSubject = document.getElementById('hmSubject');
                        laytpl(getTpl).render(data, function(html){
                            hmSubject.innerHTML = html;
                        });
                        $(".hmSubject ul li[data-subject='"+subject+"']").addClass("cur").siblings().removeClass("cur");
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(status + textStatus + ";" + errorThrown)
                }
            });

        }

        //获取各分数
        function getGradeSubjectItem(grade,subject){
            $.ajax({
                type: "get",
                url: GradeInfoURL,
                data: {
                    "method":"getgradesubjectitem",
                    "grade":grade,
                    "subject":subject
                },
                timeout: 20000,
                dataType: "json",
                success: function (data) {

                    if (data.length > 0) {
                        var getTpl = demo3.innerHTML
                            ,hmCourse = document.getElementById('hmCourse');
                        laytpl(getTpl).render(data, function(html){
                            hmCourse.innerHTML = html;
                        });

                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(status + textStatus + ";" + errorThrown)
                }
            });
        }



        $(function(){

            getGrade("三年级-五年级","语文")

            $(document).on("click",".hmGrade li",function(){
                var title = $(this).attr("data-title")
                var subject = "语文"
                $(this).addClass("cur").siblings().removeClass("cur");
                getGradeSubject(title,subject)
                getGradeSubjectItem(title,subject);

            })

            $(document).on("click","#hmSubject li",function(){
                var title = $(".hmGrade ul li.cur").attr("data-title")
                var s = $(this).attr("data-subject")
                $(this).addClass("cur").siblings().removeClass("cur");
                console.log(title,s)

                getGradeSubjectItem(title,s)
            });
        })
    </script>

</main>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=66109434" charset="UTF-8"></script>
<footer>
    <div class="footer" style="background-color: #0C0C0C">
        <div class="inner">
            <div class="btmMain">
                <div class="btmLeft">
                    <div class="pagesList">
                        <ul>
                            <li><a href="/upload/webPage/idea.php">优势体系</a></li>
                            <li><a href="/upload/webPage/1v1.php">课程体系</a></li>
                            <li><a href="/upload/webPage/event.php">走进诚聪</a></li>
                            <li><a href="/upload/webPage/help.php">答疑中心</a></li>
                        </ul>
                    </div>
                    <div class="copyright">
                        <p>Copyright @2019 南京诚聪教育咨询有限公司.</p>
                        <p>地址：南京市玄武区中央路70号万和尊邸A座720</p>
                        <p>
                            <a href="http://www.beian.miit.gov.cn/" target="_blank">苏ICP备19053069号.</a>
                        </p>
                    </div>
                </div>
                <div class="btmRight">
                    <div class="btmContact">
                        <div class="btmTel">
                            <p>在线顾问</p>
                            <p class="num">025-84483929</p>
                            <p class="num">025-84486891</p>
                            <p class="num">18005173892</p>
                        </div>
                        <div class="btmSocial">
                            <ul>
                                <li class="wx"><a href="javascript:void(0);"></a>
                                    <div class="qrcode">
                                        <img src="../../staticPoj/res/uploadfiles/images/qrcode.jpg?cXJjb2RlLmpwZw==" />
                                    </div>
                                </li>
                                <li class="tel"><a rel="nofollow" href="tel:025-84483929" target="_blank"></a></li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="btmQrcode">
                        <p>
                            <img src="../../staticPoj/res/uploadfiles/images/qrcode.jpg?cXJjb2RlLmpwZw==" />
                        </p>
                        <p>微信公众号</p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</footer>

<script>
    function but_meiqia(){
        /*_MEIQIA('showPanel')*/
        openJesongChatByGroup(12719,21113);return false;
    }
    /*setTimeout(function(){
        openJesongChatByGroup(12719,21113);
    },5000)*/
</script>
<script>
    function tixin() {
        alert("请先登录");
        window.location.href="/upload/webPage/login.php";
    }
    function zhuan() {
        window.location.href="/upload/webPage/discount.php";
    }
</script>
</body>
</html>
