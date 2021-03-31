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
    //����
    $myusername=RepPostVar(getcvar('memberusername'));
    $myrnd=RepPostVar(getcvar('memberrnd'));
    $r=$empire->fetch1("select ".$user_userid.",".$user_username.",".$user_group.",".$user_downfen.",".$user_downdate.",".$user_checked.",".$user_zgroup." from ".$user_tablename." where ".$user_userid."='$myuserid' and ".$user_rnd."='$myrnd' limit 1");
    if(empty($r[$user_userid])||$r[$user_checked]==0)
    {
        EmptyEdownCookie();
        $mhavelogin=0;
    }
    //��Ա�ȼ�
    if(empty($r[$user_group]))
    {$groupid=$user_groupid;}
    else
    {$groupid=$r[$user_group];}
    $groupname=$level_r[$groupid]['groupname'];
    //����
    $downfen=$r[$user_downfen];
    //����
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

    <title>�ϴϽ���</title>
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
                //��ת�ƶ���ҳ��
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
        var page_CityName = "�Ͼ�";
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
    <!--��ѶPCͳ��-->
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
            <div class="topNav"><span>��Сѧͬ������</span> <span class="a"><a href="1v1.php">1��1</a></span> <span>/</span> <span class="a"><a href="1v3.php">ͬ��ѧ</a></span> </div>
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">��ֵ�Ż�</div>-->
        </div>
    </div>
    <div class="header">
        <div class="inner">
            <div class="logo"><a href="/upload/webPage/intro.php">
                    <img src="../../staticPoj/res/uploadfiles/2018/11/20181109092612365.jpg?bG9nby5qcGc=" />
                </a></div>
            <div class="topNav"><span>��Сѧͬ������</span> <span class="a"><a href="/upload/webPage/1v1.php">1��1</a></span> <span>/</span> <span class="a"><a href="/upload/webPage/1v3.php">ͬ��ѧ</a></span> </div>
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">��ֵ�Ż�</div>-->
            <nav class="nav" style="margin-top: 0.3%">
                <ul>
                    <li id="nav1"><a href="/upload/webPage/intro.php">�� ҳ</a></li>
                    <li id="nav3"><a href="/upload/webPage/idea.php">������ϵ</a>
                        <dl>
                            <dd><a href="/upload/webPage/idea.php">�������</a></dd>
                            <dd><a href="/upload/webPage/teachers.php">ʦ������</a></dd>
                            <dd><a href="/upload/webPage/serviceManage.html">����ѧϰ</a></dd>
                        </dl>
                    </li>
                    <li id="nav6"><a href="/upload/webPage/1v1.php">�γ���ϵ</a>
                        <dl>
                            <dd><a href="/upload/webPage/1v1.php">1��1�γ�</a></dd>
                            <dd><a href="/upload/webPage/1v3.php">ͬ��ѧϰ</a></dd>
                        </dl>
                    </li>
                    <li id="nav8"><a href="/upload/webPage/event.php">�߽��ϴ�</a>
                        <dl>
                            <dd><a href="/upload/webPage/event.php">�ϴϴ��¼�</a></dd>
                            <dd><a href="/upload/webPage/saying.php">��������</a></dd>
                        </dl>
                    </li>
                    <li id="nav4"><a href="/upload/webPage/help.php">��������</a>
                    <li id="nav"><a href="/upload/webPage/discount.php">��ֵ����</a></li>
                        <dl>
                        </dl>
                    </li>
                    <?php
                    if($mhavelogin==1) {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
<!--                        <li id="nav"><a onclick="zhuan()">��ֵ����</a></li>-->
                        <li id="nav"><a href="/upload/webPage/selfinfo.php" style="color: #0000FF"><strong>Hello</strong>,<?=$myusername?></a></li>

                        <li id="nav"><a style="color: #0000FF" href="/upload/phome?phome=exit">�˳�</a></li>
                        <!--                        </ul>-->
                        <?php
                    }else {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
                        <li id="nav"><a href="/upload/webPage/login.php"><span class="glyphicon glyphicon-log-in"></span> ��¼</a></li>
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
    <!--TA����ͼ����-->
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=66170070" charset="UTF-8"></script>
    <!--���˵�-->
    <div class="navMenu">
        <div class="navMeaubar">
<!--            --><?php
//            if($mhavelogin==1) {
//                ?>
                <dl>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank" class="remai">�����γ�</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank" style="font-weight: bold;color: #e12d30;">���ڰ� |</a>
                        <a href="/upload/webPage/mainPage.php" target="_blank" style="font-weight: bold;color: #e12d30;">��ѧ����
                        </a>

                    </dd>

                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">Сѧͬ������</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ѧ</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">Ӣ��</a>
                    </dd>

                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">�п�</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">�߿�</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">С����</a>
                    </dd>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">����ͬ������</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ѧ</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">Ӣ��</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ѧ</a><br/>
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ʷ</a>
                    </dd>
                    <dt><a href="/upload/webPage/mainPage.php" target="_blank">����ͬ������</a></dt>
                    <dd>
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ѧ</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">Ӣ��</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ѧ</a><br/>
                        <a href="/upload/webPage/mainPage.php" target="_blank">����</a> |
                        <a href="/upload/webPage/mainPage.php" target="_blank">��ʷ</a>
                    </dd>

                </dl>
<!--                --><?php
//            }else {
//                ?>
<!--                <dl>-->
<!--                    <dt><a onclick="tixin()" target="_blank" class="remai">�����γ�</a></dt>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank" style="font-weight: bold;color: #e12d30;">���ڰ� |</a>-->
<!--                        <a onclick="tixin()" target="_blank" style="font-weight: bold;color: #e12d30;">��ѧ����-->
<!--                        </a>-->
<!---->
<!--                    </dd>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">�п�</a> |-->
<!--                        <a onclick="tixin()" target="_blank">�߿�</a> |-->
<!--                        <a onclick="tixin()" target="_blank">С����</a>-->
<!--                    </dd>-->
<!--                    <dt><a onclick="tixin()" target="_blank">Сѧͬ������</a></dt>-->
<!--                    <dd>-->
<!---->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ѧ</a> |-->
<!--                        <a onclick="tixin()" target="_blank">Ӣ��</a>-->
<!--                    </dd>-->
<!---->
<!--                    <dt><a onclick="tixin()" target="_blank">����ͬ������</a></dt>-->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ѧ</a> |-->
<!--                        <a onclick="tixin()" target="_blank">Ӣ��</a> |-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ѧ</a><br/>-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ʷ</a>-->
<!--                    </dd>-->
<!--                    <dt><a onclick="tixin()" target="_blank">����ͬ������</a></dt>-->
<!---->
<!--                    <dd>-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ѧ</a> |-->
<!--                        <a onclick="tixin()" target="_blank">Ӣ��</a> |-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ѧ</a><br/>-->
<!--                        <a onclick="tixin()" target="_blank">����</a> |-->
<!--                        <a onclick="tixin()" target="_blank">��ʷ</a>-->
<!--                    </dd>-->
<!---->
<!--                </dl>-->
<!--                --><?php
//            }
//            ?>

        </div>
    </div>

<!--    �ֲ�ͼ-->
    <!--banner-->
    <div class="hmSlides">
        <div id="hmSlides" class="owl-carousel">

            <div id="BannerImg_70" class="item" style="background-image: url('../../staticPoj/imgs/ban1.jpg'); cursor: pointer;"><a href="/upload/webPage/1v3.php" target="_blank"></a></div>

            <div id="BannerImg_23" class="item" style="background-image: url('../../staticPoj/imgs/ban2.jpg'); cursor: pointer;"><a href="/upload/webPage/serviceManage.html" target="_blank"></a></div>

            <div id="BannerImg_58" class="item" style="background-image: url('../../staticPoj/imgs/ban3.jpg'); cursor: pointer;"><a href="/upload/webPage/teachers.php" target="_blank"></a></div>

            <div id="BannerImg_69" class="item" style="background-image: url('../../staticPoj/imgs/ban4.jpg'); cursor: pointer;"><a href="/upload/webPage/discount.php" target="_blank"></a></div>



        </div>
    </div>

    <!--����ʱ���-->
    <div class="timeDown">
        <div class="item1">
            <div class="item1-zk">
                �п�����ʱ
                <span id="day-zk">00</span>��
                <span id="hours-zk">00</span>ʱ
                <span id="minutes-zk">00</span>��
                <span id="seconds-zk">00</span>��
            </div>
            <img src="../../staticPoj/res/images/and_03.png" alt="">
            <div class="item1-gk">
                �߿�����ʱ
                <span id="day-gk">00</span>��
                <span id="hours-gk">00</span>ʱ
                <span id="minutes-gk">00</span>��
                <span id="seconds-gk">00</span>��
            </div>
        </div>
        <?php
        if ($mhavelogin==1) {
            ?>
            <ul class="item2">
                <li>
                    <img src="../../staticPoj/res/images/tIcon5_03.png" alt="">
                    <h1>���ڰ�</h1>
                    <p>����8��</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon2_03.png" alt="">
                    <h1>С����</h1>
                    <p>��ѧ�滮</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon3_03.png" alt="">
                    <h1>�� ��</h1>
                    <p>Ŀ��ԺУ����</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon4_03.png" alt="">
                    <h1>�� ��</h1>
                    <p>ȫ��־Ը�</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon1_03.png" alt="">
                    <h1>��ѧ����
                    </h1>
                    <p>����50Ԫ</p>
                    <a href="/upload/webPage/mainPage.php" target="_blank">�˽����� ></a>
                </li>
            </ul>
            <?php
        }else{
            ?>
            <ul class="item2">
                <li>
                    <img src="../../staticPoj/res/images/tIcon5_03.png" alt="">
                    <h1>���ڰ�</h1>
                    <p>����8��</p>
                    <a onclick="tixin()" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon2_03.png" alt="">
                    <h1>С����</h1>
                    <p>��ѧ�滮</p>
                    <a onclick="tixin()" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon3_03.png" alt="">
                    <h1>�� ��</h1>
                    <p>Ŀ��ԺУ����</p>
                    <a onclick="tixin()" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon4_03.png" alt="">
                    <h1>�� ��</h1>
                    <p>ȫ��־Ը�</p>
                    <a onclick="tixin()" target="_blank">�˽����� ></a>
                </li>
                <li>
                    <img src="../../staticPoj/res/images/tIcon1_03.png" alt="">
                    <h1>��ѧ����
                    </h1>
                    <p>����50Ԫ</p>
                    <a onclick="tixin()" target="_blank">�˽����� ></a>
                </li>
            </ul>
        <?php
        }
        ?>

    </div>
    <script>
        // �п�����ʱ
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
            // ��������ʱ��
            countDownTime.init('2020/6/16 00:00:00', dayZk, hoursZk, minutesZk, secondsZk);
            countDownTime.start();
        }

        // �߿�����ʱ
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
            // ��������ʱ��
            countDownTime2.init('2020/6/7 00:00:00', dayGk, hoursGk, minutesGk, secondsGk);
            countDownTime2.start();
        }
    </script>
    <div class="liu_div">

        <h2 class="una_h2">ѡ��ϴ�=ѡ��δ�� </h2>

        <p class="una_p">���ʷ�����ѧϰ����Ч</p>

        <ul class="liu_ul2 liu_ul">

            <li>

                <a href="javascript:;">

                    <span class="liu_left">�������</span>

                    <div class="liu_right">

                        <p>�ϴ�ӵ��ʵ���ۺ�Ľ�����ϵ���ᴩ��ѧ��ѧϰ�Ŀ�ǰ�����С��κ�����������ȫ��λ���������ӵ�ѧϰЧ�ʺ�ѧϰ�ɼ���</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">��ֵ����</span>

                    <div class="liu_right">

                        <p>��������������ͬ��������ֱ�����ζ�Ԫ����ֵ���񣬹�עÿһ����ͬ���ӳɳ���ÿһ��ϸ�ڡ�</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">��Ŀ����</span>

                    <div class="liu_right">

                        <p>�����з�һ��һ������������������ƷС��Ρ��տ���ѵ��ͬ���γ�ѧϰ:Ԥϰ����ϰ����չ�ȶ�Ԫ��������Ʒ��</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">ѧϰ����</span>

                    <div class="liu_right">

                        <p>1λѧϰ�滮ʦ��1λ��Ӣѧ�ƽ�ʦ��1λרְ�����Ρ�1�׸��Ի�ѧϰ������Ϊÿ�������ṩ360��ȫ��λѧϰ����</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">ʦ�ʷ���</span>

                    <div class="liu_right">

                        <p>�ϸ�ɸѡ����ӵ��5��ѧ�ƽ�ѧ����Ľ�ʦ��3%������ͨ���ʣ�������㿼���ϰ�ʦ������������������һ��</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <span class="liu_left">��������</span>

                    <div class="liu_right">

                        <p>����ʼ�ռ���ÿ�����Ӷ��ǲ�һ�����̻����ǽ�������ֲ�ڰ���רע���ý�����ÿһ���£��óɳ��Ժ��Ӹ��м�ֵ��</p>

                    </div>

                    <div style="clear: both;"></div>

                </a>

            </li>

            <div style="clear: both;"></div>

        </ul>

<!--        <a class="liu_yue" href="javascript:;" onclick="but_meiqia();">ԤԼ����</a>-->

    </div>
    <!--�����Ŀγ���ϵ������ʽ������ʼ-->
    <section class="section2">
        <div class="content_box section2_box">
            <h1>����+������ʦֱ����ѧ</h1>
            <div class="border_red"></div>
            <h3>׷�ٸ������ڣ��ѹ�ѧϰЧ��</h3>
            <div class="section2_contentbox">
                <div class="section2_contentCon">
                    <img src="../../staticPoj/res/images/section2_1.png" class="section2_img">
                    <p class="section2_contentCon-title">����ֱ���ڿ�</p>
                    <p class="section2_contentCon-cont">��ͨ���ӽ���˼·��һͨ��ͨ</p>
                </div>
                <div class="section2_contentCon">
                    <img src="../../staticPoj/res/images/section2_2.png" class="section2_img">
                    <p class="section2_contentCon-title">������ʦ1��1����</p>
                    <p class="section2_contentCon-cont">��������ʱ���ѧ��Ϊֹ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section3">
        <div class="content_box section3_box">
            <h1>������ʵ����</h1>
            <div class="border_red" style="margin: 16px auto 60px;"></div>
            <h3 class="section3_h3"><span class="h3_title-num">01</span>Ȥζ���ã�����ѧϰ��Ȥ��ѧ���ɾ͸�</h3>
            <div class="section3_contentbox">
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_2.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">�����μ�</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_1.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">С��PK</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_4.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">��ҽ���</div>
                    </div>
                </div>
            </div>
            <h3 class="section3_h3"><span class="h3_title-num">02</span>ѧ���ϣ�ʵʱ���ѧϰЧ������������</h3>
            <div class="section3_contentbox">
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_5.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">���⻥����</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_6.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">���ò���</div>
                    </div>
                </div>
                <div class="section3_continer-block">
                    <img width="380" height="200" src="../../staticPoj/res/images/section3_8.jpg">
                    <div class="section3_continer-bg">
                        <div class="border_red-left"></div>
                        <div class="section3_continer-text">ѧϰ����</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section5">
        <div class="content_box section5_box">
            <h1>ǿ�ҽ������¼��ຢ��ѧϰ</h1>
            <div class="border_red"></div>
            <div class="section5_contentbox">
                <div class="section5_cont-left">
                    <div class="section5_conleft-one">
                        <p>ƫ����ѧ</p>
                        <div class="section5-cont-title">һ��ͻ��������ƽƽ���Ŀƻ����ͻ������һ���������һ�ƽ�������������ǿ�����ڳɼ���Ŀ�Ŀ�����ִ���ѧ����ѧ����ȥ�����������־塣</div>
                    </div>
                    <div class="section5_conleft-two">
                        <p>��ѧ��Ч</p>
                        <div class="section5-cont-title">����һֱŬ��ѧϰ��Ч�����ǲ����ԣ���Ч��ѧϰ�е�һ�����ϴ��ѡ����⡣�ܶ�ѧ���Ѵ���ʱ�仨��ѧϰ�ϣ���ѧϰЧ��ȴ���ѣ��ƺ�ѧϰ��Ŭ���̶���ѧϰЧ�����������ȡ�</div>
                    </div>
                </div>
                <img width="550" height="420" src="../../staticPoj/res/images/section5.png">
                <div class="section5_cont-right">
                    <div class="section5_conright-one">
                        <p>����θ���չ</p>
                        <div class="section5-cont-title">����ѧϰ�����ɣ��߱���ǿ�ķ�����������������ϣ����չ֪ʶ��ѧϰ����������������������</div>
                    </div>
                    <div class="section5_conrights-two">
                        <p>äĿѧϰ</p>
                        <div class="section5-cont-title">�����ϲ�֪��Ҫ��ʲô��ֻ�����˱�����ѧϰ����ʦ�и�ʲô�͸�ʲô��û��������ʶ��û����ȷ��Ŀ�ģ�û�мƻ������������ѧϰ����</div>
                    </div>
                    <div class="section5_conrights-thire">
                        <p>�۸��ֵ�</p>
                        <div class="section5-cont-title">�о�һ���ͻᣬ����һ���ʹ����Գɼ����Լ����Ƶķ������ܴ󣬲�֪���������ˣ������޹ʵض��֡�©�֡�</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="una_div">

        <div class="una_cen">

            <h2 class="una_h2">�����Ŀγ���ϵ������ʽ����</h2>

            <p class="una_p">����ÿ�����ӵ�ѧϰ�츳����ѧϰ����</p>

            <!--PC��-->

            <ul class="una_ul1 una_ul">

                <li class="una_li1 wow a-fadeinB animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeinB;">

                    <b>��ʵ����</b>

                    <div class="una_con">

                        <h3>��ȱ��© ���̻���</h3>

                        <p>�������ӽ�������ϵĻ������͡��������֪ʶ��������ɢ��ȱ��֪ʶ���硢���ܽ������õ����⡣</p>

                    </div>

                </li>

                <li class="una_li2 wow a-fadeinB animated" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeinB;">

                    <b>���̰θ�</b>

                    <div class="una_con">

                        <h3>�Ȳ����� ���̰θ�</h3>

                        <p>����˼��������־���ͽ�����Ѽ���������������ѧ���Ծ����ѶȽϴ��������Ŀ������ѧ�����㡢�����Ķ������������</p>

                    </div>

                </li>

                <li class="una_li3 wow a-fadeinB animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeinB;">

                    <b>��Ӣ����</b>

                    <div class="una_con">

                        <h3>��ϰΪ�� ǿ��ѧϰ</h3>

                        <p>����ѧ��˼ά�������������������������е��Ѷȵ����ͽ��е㲦�����֪ʶ����������ϵ��ת����</p>

                    </div>

                </li>

                <li class="una_li4 wow a-fadeinB animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeinB;">

                    <b>����ͻ��</b>

                    <div class="una_con">

                        <h3>��ɢ˼ά ר��ѵ��</h3>

                        <p>��ѧ���߱��˳��ᢡ���Σ���ҵ��������ʣ����ü��ɺͷ���ȡ������ɼ�������������Ͻ������󣬴Ӷ���������˼·������ʹ����˼·������չ����չΪ��Ƕ�˼ά�ռ䡣</p>

                    </div>

                </li>

                <li class="una_li5 wow a-fadeinB animated" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeinB;">

                    <b>�������</b>

                    <div class="una_con">

                        <h3>�μ����� �������</h3>

                        <p>��֪ʶ�����������չ����֪ʶ�����ȺͿ���Ͻ��аμ⡣ҲҪ��ѧ����������е��ڣ�����һ�½��ŵ�����Ϳ�ǰ�־�֢��Ϊ��Ҫ��</p>

                    </div>

                </li>

<!--                <div style="clear: both;"></div>-->

            </ul>

            <!--�ֻ���-->

            <div class="Sek-div swiper-container swiper-container-horizontal">

                <div class="swiper-wrapper" style="transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>��ʵ����</b>

                            <div class="una_con">

                                <h3>��ȱ��© ���̻���</h3>

                                <p>�������ӽ�������ϰ������ϵĻ������͡��������֪ʶ��������ɢ��ȱ��֪ʶ���硢���ܽ������õ����⡣</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>���̰θ�</b>

                            <div class="una_con">

                                <h3>�Ȳ����� ���̰θ�</h3>

                                <p>����˼��������־���ͽ��������������������ѧ���Ծ����ѶȽϴ��������Ŀ������ѧ�����㡢�����Ķ������������</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>��Ӣ����</b>

                            <div class="una_con">

                                <h3>��ϰΪ�� ǿ��ѧϰ</h3>

                                <p>����ѧ��˼ά�������������������������е��Ѷȵ����ͽ��е㲦�����֪ʶ����������ϵ��ת����</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>����ͻ��</b>

                            <div class="una_con">

                                <h3>��ɢ˼ά ����ѵ��</h3>

                                <p>��ѧ���߱��˳��ᢡ���Σ���ҵ��������ʣ����ü��ɺͷ���ȡ������ɼ�������������Ͻ������󣬴Ӷ���������˼·������ʹ����˼·������չ����չΪ��Ƕ�˼ά�ռ䡣</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>�������</b>

                            <div class="una_con">

                                <h3>�μ����� �������</h3>

                                <p>��֪ʶ�����������չ����֪ʶ�����ȺͿ���ϰμ⡣ҲҪ��ѧ����������е��ڣ�����һ�½��ŵ�����Ϳ�ǰ�־�֢��Ϊ��Ҫ��</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>��ʵ����</b>

                            <div class="una_con">

                                <h3>��ȱ��© ���̻���</h3>

                                <p>�������ӽ�������ϰ������ϵĻ������͡��������֪ʶ��������ɢ��ȱ��֪ʶ���硢���ܽ������õ����⡣</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>���̰θ�</b>

                            <div class="una_con">

                                <h3>�Ȳ����� ���̰θ�</h3>

                                <p>����˼��������־���ͽ��������������������ѧ���Ծ����ѶȽϴ��������Ŀ������ѧ�����㡢�����Ķ������������</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>��Ӣ����</b>

                            <div class="una_con">

                                <h3>��ϰΪ�� ǿ��ѧϰ</h3>

                                <p>����ѧ��˼ά�������������������������е��Ѷȵ����ͽ��е㲦�����֪ʶ����������ϵ��ת����</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>����ͻ��</b>

                            <div class="una_con">

                                <h3>��ɢ˼ά ����ѵ��</h3>

                                <p>��ѧ���߱��˳��ᢡ���Σ���ҵ��������ʣ����ü��ɺͷ���ȡ������ɼ�������������Ͻ������󣬴Ӷ���������˼·������ʹ����˼·������չ����չΪ��Ƕ�˼ά�ռ䡣</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>�������</b>

                            <div class="una_con">

                                <h3>�μ����� �������</h3>

                                <p>��֪ʶ�����������չ����֪ʶ�����ȺͿ���ϰμ⡣ҲҪ��ѧ����������е��ڣ�����һ�½��ŵ�����Ϳ�ǰ�־�֢��Ϊ��Ҫ��</p>

                            </div>

                        </div>

                    </div>

                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0">

                        <div class="una_li1">

                            <b>��ʵ����</b>

                            <div class="una_con">

                                <h3>��ȱ��© ���̻���</h3>

                                <p>�������ӽ�������ϰ������ϵĻ������͡��������֪ʶ��������ɢ��ȱ��֪ʶ���硢���ܽ������õ����⡣</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1">

                        <div class="una_li2">

                            <b>���̰θ�</b>

                            <div class="una_con">

                                <h3>�Ȳ����� ���̰θ�</h3>

                                <p>����˼��������־���ͽ��������������������ѧ���Ծ����ѶȽϴ��������Ŀ������ѧ�����㡢�����Ķ������������</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2">

                        <div class="una_li3">

                            <b>��Ӣ����</b>

                            <div class="una_con">

                                <h3>��ϰΪ�� ǿ��ѧϰ</h3>

                                <p>����ѧ��˼ά�������������������������е��Ѷȵ����ͽ��е㲦�����֪ʶ����������ϵ��ת����</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3">

                        <div class="una_li4">

                            <b>����ͻ��</b>

                            <div class="una_con">

                                <h3>��ɢ˼ά ����ѵ��</h3>

                                <p>��ѧ���߱��˳��ᢡ���Σ���ҵ��������ʣ����ü��ɺͷ���ȡ������ɼ�������������Ͻ������󣬴Ӷ���������˼·������ʹ����˼·������չ����չΪ��Ƕ�˼ά�ռ䡣</p>

                            </div>

                        </div>

                    </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4">

                        <div class="una_li5">

                            <b>�������</b>

                            <div class="una_con">

                                <h3>�μ����� �������</h3>

                                <p>��֪ʶ�����������չ����֪ʶ�����ȺͿ���ϰμ⡣ҲҪ��ѧ����������е��ڣ�����һ�½��ŵ�����Ϳ�ǰ�־�֢��Ϊ��Ҫ��</p>

                            </div>

                        </div>

                    </div></div>

                <!-- Add Pagination -->

                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>

                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        </div>

    </div>

    <!--�����-->
    <section class="hmBox4">
        <div class="hmBan" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg.jpg?aG1Cb3g0X2Jhbm5lci5qcGc=);">
            <h2 class="aTitle">˽�˶��Ƶ�<span>ѧϰ����</span> </h2>
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
                            <h3>�������</h3>
                            <div class="text">����Ϻ��ϿΣ��ҵ�ѧ��֢���ǹؼ� </div>
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
                            <h3>�滮Ŀ��</h3>
                            <div class="text">��ϲ����������������ƶ��׶�������Ŀ�� </div>
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
                            <h3>���Ʒ���</h3>
                            <div class="text">��������Ŀ�꣬ѧ�������ƶ�ר��ѧϰ���� </div>
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
                            <h3>ƥ��ʦ��</h3>
                            <div class="text">����ѧԱ���ƥ��ɸѡ�����ʺϺ��ӵ���ʦ </div>
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
                            <h3>���ٸ���</h3>
                            <div class="text">��ǰ�̰�����,<br />���в�©��ȱ,<br />�κ�������� </div>
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
                            <h3>ʵʱ����</h3>
                            <div class="text">�׶���ѧϰ�������ϴϰ����ҳ�ʵϰ������ </div>
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
                            <h3>ִ�з���</h3>
                            <div class="text">���ݷ�����Ϣ�����ɷ�����ִ���·��� </div>
                            <div class="btm"><i></i></div>
                        </div>
                    </a>
                </section>
            </div>
        </div>
    </section>
    <div class="ope_div">

        <div class="ope_cen">

            <h2 class="una_h2">����1��1ר������</h2>

            <p class="una_p">ֻ���5�У������⡢���̰塢��ƿ��</p>

            <ul class="ope_bot">

                <li class="ope_li1">

                    <a href="javascript:;">

                        <b>�������֢��ҩ</b>

                        <p>���Ի�����ϵͳ����ѧ������ȫ��λ������ϣ�������״���ҳ����⣬��׼�ƶ�����������</p>

                    </a>

                </li>

                <li class="ope_li2">

                    <a href="javascript:;">

                        <b>������</b>

                        <p>��Ի���������֪ʶ��Ƿȱ��ѧ�����ص㸨������֪ʶ���γ�ϵͳ�ι̵�֪ʶ��ϵ������ѧϰ�������š�</p>

                    </a>

                </li>

                <li class="ope_li3">

                    <a href="javascript:;">

                        <b>���ص�</b>

                        <p>ͬ��ѧУ�γ̽��ȣ������ۺ���������ѧ������γ���©���⣬�ܾ�֪ʶä�㡣</p>

                    </a>

                </li>

                <li class="ope_li4">

                    <a href="javascript:;">

                        <b>���ѵ�</b>

                        <p>�����������ѧϰ������ѵ㣬�Կα�Ϊ����֪ʶ���һ��ǿ�������ѵ���ɣ�����©���ܽᣬ�ھ�Ǳ����ͻ��ƿ����</p>

                    </a>

                </li>

                <li class="ope_li5">

                    <a href="javascript:;">

                        <b>�ڷ���</b>

                        <p>�������㲻���������棬����֪ʶ��ͬʱ��ע������ѧ����ѧϰϰ�ߺ���̬���ɣ����ڿ����������õ�ѧϰ������</p>

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
    <!--�����-->

    <section class="section7">
        <div class="content_box section7_box">
            <h1>���ǵĳ�ŵ</h1>
            <div class="border_red"></div>
            <div class="section7_contbox">
                <div class="section7-cont">
                    <img class="section7-cont-img" width="94" height="67" src="../../staticPoj/res/images/section7_1.jpg">
                    <p class="section7-cont-title">��������������ٱ���</p>
                    <p class="section7-cont-cont">0Ԫ��ȡ��Ʒ�Σ�ѧ���꼶��ѡ�����������ٱ���</p>
                </div>
                <div class="section7-cont">
                    <img class="section7-cont-img" width="81" height="68" src="../../staticPoj/res/images/section7_2.jpg">
                    <p class="section7-cont-title">��ʱ������/�ڿ���ʦ</p>
                    <p class="section7-cont-cont">�������ڰ��Ͳ����ʣ���ʦ�ڿη��ϲ��������ʱ����</p>
                </div>
                <div class="section7-cont">
                    <img class="section7-cont-img" width="65" height="67" src="../../staticPoj/res/images/section7_3.jpg">
                    <p class="section7-cont-title">ûЧ���������</p>
                    <p class="section7-cont-cont">���ڿγ̲����⣬֧���˿�˿��۳����Ͽ�ʱ�Ѻͽ��幤����</p>
                </div>
            </div>
        </div>
    </section>

    <section id="hmBox6" class="hmBox6" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg1.jpg?aG1Cb3g2XzAxLmpwZw==)">
        <div class="hmData">
            <div class="inner">
                <hgroup class="title">
                    <h2 class="aTitle">�����ͥ��ѡ��<span>�ϴ� �� ͬ���γ�</span></h2>
                </hgroup>
                <ul style="margin-left: 20%">

                    <li class="li3">
                        <div class="top"><span class="num" data-from="0" data-to='6000' data-speed="1111">0</span> </div>
                        <div class="btm">ѧ�Ե�ʦ6000+</div>
                    </li>
                    <li class="li4">
                        <div class="top"><span class="num" data-from="0" data-to='10000000' data-speed="1111">0</span> </div>
                        <div class="btm">����ѧԱ��ͥ1,0000000+</div>
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
                            <p>רע��Чѧϰ </p>
                            <p style="color: #ccc;">�������Ӹ��Ի�ѧϰ���� </p>
                        </div>
                    </li>
                    <li class="li2">
                        <div class="icon" style="background-image: url(../../staticPoj/res/uploadfiles/images/hmBox6_icon02.png?aG1Cb3g2X2ljb24wMi5wbmc=);"></div>
                        <div class="text">
                            <p>רע����ѧϰ���������� </p>
                            <p style="color: #ccc;">�������ӵ�ѧϰ״�� </p>
                        </div>
                    </li>
                    <li class="li3">
                        <div class="icon" style="background-image: url(../../staticPoj/res/uploadfiles/images/hmBox6_icon03.png?aG1Cb3g2X2ljb24wMy5wbmc=);"></div>
                        <div class="text">
                            <p>רעѧϰϰ�ߵ�����</p>
                            <p style="color: #ccc;">�������ӵ�ѧϰ���� </p>
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

        //��ȡ�꼶
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


        //��ȡ��Ŀ
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

        //��ȡ������
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

            getGrade("���꼶-���꼶","����")

            $(document).on("click",".hmGrade li",function(){
                var title = $(this).attr("data-title")
                var subject = "����"
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
                            <li><a href="/upload/webPage/idea.php">������ϵ</a></li>
                            <li><a href="/upload/webPage/1v1.php">�γ���ϵ</a></li>
                            <li><a href="/upload/webPage/event.php">�߽��ϴ�</a></li>
                            <li><a href="/upload/webPage/help.php">��������</a></li>
                        </ul>
                    </div>
                    <div class="copyright">
                        <p>Copyright @2019 �Ͼ��ϴϽ�����ѯ���޹�˾.</p>
                        <p>��ַ���Ͼ�������������·70�������ۡA��720</p>
                        <p>
                            <a href="http://www.beian.miit.gov.cn/" target="_blank">��ICP��19053069��.</a>
                        </p>
                    </div>
                </div>
                <div class="btmRight">
                    <div class="btmContact">
                        <div class="btmTel">
                            <p>���߹���</p>
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
                        <p>΢�Ź��ں�</p>
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
        alert("���ȵ�¼");
        window.location.href="/upload/webPage/login.php";
    }
    function zhuan() {
        window.location.href="/upload/webPage/discount.php";
    }
</script>
</body>
</html>
