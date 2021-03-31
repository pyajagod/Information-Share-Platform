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
        })();
    </script>

    <link href="../../staticPoj/res/css/editor.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/owl.carousel.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/css/css_whir.css?vs333" media="screen" />
    <link rel="stylesheet" href="../../staticPoj/themes/w/css/css.css" type="text/css" />

    <script src="../../staticPoj/res/js/jquery-2.1.1.min.js"></script>
    <script src="../../staticPoj/res/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/js-whir.js"></script>
    <!--<script src="res/js/whir-scroll-postion.js"></script>-->

    <!--[if lt IE 9]>
    <script type="text/javascript" src="../../staticPoj/res/js/html5shiv.v3.72.min.js"></script>
    <![endif]-->

    <script>
        var navID = 0;
        var page_CityID = "8";
        var page_CityName = "南京";
        var page_Tel = "400-883-8062";
        var page_From = "";
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
                    <li id="nav4"><a href="/upload/webPage/help.php">QA中心</a>
                    <li id="nav4"><a href="/upload/webPage/discount.php">充值中心</a>
                        <dl>
                        </dl>
                    </li>

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
<main>
    <div id="main" style="margin-top: 20%">
        <div class="container clearfix">
            <div class="course-sidebar">
                <div class="course-sidebar-type">
                    <ul>
                        <li class="course-category curr"><a class="course-category-link" href="help.php" data-id="0">帮助中心分类</a></li>
                        <li class="course-category course-category-more"  ><a class="course-category-link" href="help.php">课程设计<i></i></a><span class="num"></span></li>
                        <li class="course-category course-category-more"   ><a class="course-category-link" href="commonq.php">资源使用<i></i></a><span class="num"></span></li>
                        <li class="course-category course-category-more" id="current"  ><a class="course-category-link" href="studyq.php">百度网盘<i></i></a><span class="num"></span></li>
                    </ul>
                    <div class="dot-sidebar-curr" style="top:0px"></div>
                </div>      </div>
            <div class="course-content">
                <div class="course-tools">
                    <h2>          百度网盘         </h2>
                    <ul class="ccrumb">
                        <li><a href="intro.php">首页</a></li>

                        <li><span>&gt;</span><a href="help.php">帮助中心</a></li>

                        <li><span>&gt;</span><a href="studyq.php">百度网盘</a></li>
                    </ul>
                </div>
                <div class="course-newslist">
                    <div class="newsadd clearfix">
                        <ul class="clearfix">
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">1、百度搜索“百度网盘”，即可看到以下页面，点击官方网站进入首页。</a></div>
                                <span><a><img style="width: 300px;height: 200px;" src="../../staticPoj/imgs/help1.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">2、点击客户端下载。</a></div>
                                <span><a><img style="width: 300px;height: 200px;" src="../../staticPoj/imgs/help2.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">3、点击“下载PC版”下载并安装即可。</a></div>
                                <span><a><img style="width: 300px;height: 200px;"  src="../../staticPoj/imgs/help3.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">4、注册百度账号。</a></div>
                                <span><a><img src="../../staticPoj/imgs/help4.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">5、您注册的百度账号既可以登录电脑上的百度网盘</a></div>
                                <span><a >，也可以登录手机上的百度网盘。诚聪学习资源当前版本只适用电脑下载，手机版还在设计中，但手机可以观看网盘中的资源。Pad等终端都是可以登录网盘观看的。</a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">6、百度网盘新注册用户可免费享有5G的容量，若有更多需求可以升级，容量更大哟！体验更优哦！</a></div>
                                <span><a></a></span>

                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>>

</main>
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
<script type="text/javascript" src="../../staticPoj/themes/w/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../staticPoj/themes/w/js/functions.js"></script>
</body>
</html>