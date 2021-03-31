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
            <div class="topNav" onclick="zhuan()">充值优惠</div>
        </div>
    </div>
    <div class="header">
        <div class="inner">
            <div class="logo"><a href="#">
                    <img src="../../staticPoj/res/uploadfiles/2018/11/20181109092612365.jpg?bG9nby5qcGc=" />
                </a></div>
            <div class="topNav"><span>中小学同步辅导</span> <span class="a"><a href="1v1.php">1对1</a></span> <span>/</span> <span class="a"><a href="1v3.php">同步学</a></span> </div>
            <div class="topTel">025-84483929 </div>
            <div class="topNav" onclick="zhuan()">充值优惠</div>
            <nav class="nav">
                <ul>
                    <li id="nav1"><a href="intro.php">首 页</a></li>
                    <li id="nav3"><a href="idea.php">优势体系</a>
                        <dl>
                            <dd><a href="idea.php">服务管理</a></dd>
                            <dd><a href="teachers.php">师资力量</a></dd>
                            <dd><a href="serviceManage.html">在线学习</a></dd>
                        </dl>
                    </li>
                    <li id="nav6"><a href="1v1.php">课程体系</a>
                        <dl>
                            <dd><a href="1v1.php">1对1课程</a></dd>
                            <dd><a href="1v3.php">同步学习</a></dd>
                        </dl>
                    </li>
                    <li id="nav8"><a href="event.php">走进诚聪</a>
                        <dl>
                            <dd><a href="event.php">诚聪大事记</a></dd>
                            <dd><a href="saying.php">教育理念</a></dd>
                        </dl>
                    </li>
                    <li id="nav4"><a href="help.php">答疑中心</a>
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
                        <li class="course-category course-category-more"  ><a class="course-category-link" href="help.php">课程设计</i></a><span class="num"></span></li>
                        <li class="course-category course-category-more" id="current"  ><a class="course-category-link" href="commonq.php">资源使用<i></i></a><span class="num"</span></li>
                        <li class="course-category course-category-more"   ><a class="course-category-link" href="studyq.php">百度网盘<i></i></a><span class="num"></span></li>
                    </ul>
                    <div class="dot-sidebar-curr" style="top:0px"></div>
                </div>      </div>
            <div class="course-content">
                <div class="course-tools">
                    <h2>          资源使用         </h2>
                    <ul class="ccrumb">
                        <li><a href="intro.php">首页</a></li>

                        <li><span>&gt;</span><a href="help.php">帮助中心</a></li>

                        <li><span>&gt;</span><a href="commonq.php">资源使用</a></li>
                    </ul>
                </div>
                <div class="course-newslist">
                    <div class="newsadd clearfix">
                        <ul class="clearfix">
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">1、输入网址http://www.cck12.cn/即可到达诚聪教育网站。（最好使用360浏览器哟！）</a></div>
                                <span><a> <img  src="../../staticPoj/imgs/c1.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">2、点击网站右上角的“登录”，新用户需要注册一下才能看到我们的相关课程.</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c2.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">3、扫码加微信并验证微信号：chengcongjiaoyu（一定要注意不能加错哟☺）。</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c3.jpg"></a></span>
                                <span><a>诚聪币免费获取方式：</a></span>
                                <span><a>a、注册加微信后转发以下文字及图片到微信朋友圈，30分钟后截图并微信客服，即可获得30点（可以下载2课的全部内容哟），在微信中让客服人员给您的充值账号直接加点（不要忘了( ⊙ o ⊙ )！）。
                                最近发现了一个很不错的网站——诚聪教育，我家小孩试用了，效果特别好，推荐给大家。电脑输入网址：http://www.cck12.cn/，也可以加诚聪教育微信，了解更多哟！</a></span>

                                <span><a>b、介绍一位新人加微信，客服人员验证过后则赠送15点。</a></span>
                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">4、登录之后在首页选择您所需的课程服务。</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c4.jpg"></a></span>
                                <span><a>（以“小学同步服务”为例，即可看到以下页面）</a></span>
                                <span><a><img  src="../../staticPoj/imgs/c5.jpg"></a></span>
                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">5、在左侧的目录中选择对应的年级、学期、科目、单元。（以“四年级”为例，点击四年级、四年级（上）、第一单元，即可看到以下页面）</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c6.jpg"></a></span>

                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">6、进入课文（以“2、走月亮”为例，即可看到以下页面）</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c7.jpg"></a></span>

                            </li>

                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">7、点击下面的黄色按钮，即可看到与上面相对应的课程简介。（以观潮的“预习领先”为例，即可看到以下页面）</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c8.jpg"></a></span>
                                <span><a>此页面只有充值后或者免费获取点数之后才能看到哟，如果您想要下载资源，请前往网站首页的菜单：充值中心。（有许多优惠滴！充值越多，优惠越多！）</a></span>
                            </li>
                            <li class="clearfix">
                                <div class="newsaddtitle"><a href="#">8、下载之后，您可以获得下载地址和提取码。</a></div>
                                <span><a><img  src="../../staticPoj/imgs/c9.jpg"></a></span>
                                <span><a>点击链接地址，输入“提取码”即可提取文件。</a></span>
                                <span><a><img  src="../../staticPoj/imgs/c10.jpg"></a></span>
                            </li>





















                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>>

</main>
<footer>
    <div class="footer">
        <div class="inner">
            <div class="btmMain">
                <div class="btmLeft">
                    <div class="pagesList">
                        <ul>
                            <li><a href="idea.php">优势体系</a></li>
                            <li><a href="1v1.php">课程体系</a></li>
                            <li><a href="event.php">走进诚聪</a></li>
                            <li><a href="help.php">答疑中心</a></li>
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