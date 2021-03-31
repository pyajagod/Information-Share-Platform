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

    <!-- Baidu Map-->
    <!--State Code-->


    <!--腾讯PC统计-->


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
                    <li class="course-category course-category-more"  id="current"  ><a class="course-category-link" href="help.php">课程设计<i></i></a><span class="num"></span></li>
                    <li class="course-category course-category-more"  ><a class="course-category-link" href="commonq.php">资源使用<i></i></a><span class="num"></span></li>
                    <li class="course-category course-category-more"  ><a class="course-category-link" href="studyq.php">百度网盘<i></i></a><span class="num"></span></li>
                </ul>
                <div class="dot-sidebar-curr" style="top:0px"></div>
            </div>      </div>
        <div class="course-content">
            <div class="course-tools">
                <h2>            课程设计           </h2>
                <ul class="ccrumb">
                    <li><a href="intro.php">首页</a></li>

                    <li><span>&gt;</span><a href="help.php">问题</a></li>

                    <li><span>&gt;</span><a href="help.php">课程设计</a></li>
                </ul>
            </div>
            <div class="course-newslist">
                <div class="newsadd clearfix">
                    <ul class="clearfix">
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">1、诚聪同步课程学习服务的目标、宗旨</a></div>
                            <span><a>通过诚聪的学习服务，让你更快捷理解、掌握相应知识点考点，短期内提高学习成绩，长期内，让你养成自主学习习惯，提升你的自主学习管理能力。</a></span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">2、诚聪同步课程服务的特色是什么？</a></div>
                            <span><a >爱的教育：物美价廉，性价比超高。让普通家庭也能享受优质的教育资源服务。
①突出学习主体性。以你的个性学习为依据，设计爱学习和会学习的服务内容。
②强调服务同步性。“同步学”与你的学校课程版本相同，学习完全同步。
③倡导学习高效性。优质资源高度整合，一站搞定，无需东奔西走，更无需跨平台操作。</a></span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">3、诚聪课程服务内容是什么？</a></div>
                            <span><a >诚聪课程服务内容模块共分五大块：预习领先、复习巩固、拓展提优、学科专题、复习测试。通过预习领先、复习巩固、拓展提优等学习服务活动，帮助你高效理解、掌握同步课程的学习重点、难点，养成良好的学习习惯。</a></span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">4、预习的目的、方法、作用？</a></div>
                            <span><a >预习即课前自学，是对老师即将讲授分析的问题或任务提前了解，激发兴趣，做好准备。预习的过程通常包括阅读—摘记—质疑—求解四步。预习能熟悉背景知识，掌握基础知识，了解课程重难点在哪，明白听课的重点。预习也有利于养成良好的学习习惯，提升自主学习的能力。</a></span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">5、诚聪同步学习中预习领先模块的内容？</a></div>
                            <span>根据诚聪高效学习法（SKST法），诚聪同步学习服务中的预习领先模块设计内容为：背景知识介绍，预备知识复习；本课的基础知识、思维导图（知识梳理）；老师指导下的简单预习；预习试题等，文件格式包括word文档，PPT课件，以及各种音视频等。帮你做好听课前的充分准备。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">6、复习的目的、方法、作用？</a></div>
                            <span> 复习是课后学生把课上学习的内容再学习下。复习过程包括尝试回想—再读课本—整理笔记—错题巩固四个环节，形成以下的复习效果：明晰重难点，修正易错点，构建知识网络，识记、理解并迁移运用所学知识到相似任务或问题情景中，起到理解、巩固知识的效果。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">7、诚聪同步学习中复习巩固模块的内容？</a></div>
                            <span>根据诚聪高效学习法（SKST法），诚聪同步学习服务中的复习巩固模块设计内容为：课文朗读、精讲；知识结构图；典例错题分析；学案；教学课件；试题课件；基础知识复习等，文件格式包括word文档，PPT课件，以及各种音视频等。帮你理解巩固所学知识。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">8、知识拓展的目的、内容？</a></div>
                            <span>知识拓展是围绕某个知识点向外拓展知识外延，向内拓展知识内涵。课堂知识内容是有限的，只能是抛砖引玉，更多的相关知识需要你通过操练、阅读、观看、体验等活动去扩充。知识拓展过程是知识外延和内涵同步拓展，是知识结构的逐步完善，具体包括明晰现有知识的基础--掌握现有知识—拓展现有知识—完善现有知识结构。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">9、诚聪同步学习中拓展提优模块的内容？</a></div>
                            <span>根据诚聪高效学习法（SKST法），诚聪同步学习服务中的拓展提优模块设计内容为：课程视频精细提优讲解，相关知识拓展延伸，相关知识系统结构图，难题突破等，文件格式包括word文档，PPT课件，以及各种音视频等。帮你加深理解现有知识体系的基础上提优拔高。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">10、知识专题的目的、作用？</a></div>
                            <span>    知识专题是某一知识领域中相对独立完整的知识模块。这些知识由于相对独立完整，有自己特有的解决方法规律，所以专门研究解决方案非常必要。不同学科专题是不一样的，不同的分类目的，也影响专题的分类。</span>

                        </li>
                        <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">11、诚聪同步学习中学科专题模块的内容？</a></div>
                            <span>根据诚聪高效学习法（SKST法），诚聪同步学习服务中的学科专题模块设计内容为：语文各年级专题包括：基础知识，阅读训练，看图写话，写作金点，国学古诗文，故事博览，科技百科等；数学各年级专题包括数的认识，数的运算，数与式，图形位置与变化，统计与可能性，数学动画，奥数，应用题，知识梳理，典例错题等。英语各年级专题包括单词的记忆，阅读理解，听力与口语，语法知识，写作翻译，主题拓展等；物理包括实验操作，热学，电学，力学，光学，知识梳理，典例错题等；化学包括实验操作，物质，化学变化，知识梳理，典例错题等。文件格式包括word文档，PPT课件，以及各种音视频等。帮你加深对相应知识的理解，拓宽和完善你的知识结构。</span>

                        </li>  <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">12、测评的目的、作用？</a></div>
                            <span>测评是对学习内容的考核，分为诊断性测评、形成性测评和终结性测评。诊断性测评是开始学习时的预测评价，是为了了解学生的知识基础和准备状况，如课前测等；形成性评价是学习过程中的评价，是为了及时发现教和学中的问题而进行的评价，如小测验，默写等；终结性评价是学习结束后的评价，对学生知识掌握的完整评价，如单元测试、期中测试、期末测试等。</span>

                        </li>  <li class="clearfix">
                            <div class="newsaddtitle"><a href="#">13、诚聪同步学习中复习测试模块的内容？</a></div>
                            <span>根据诚聪高效学习法（SKST法），诚聪同步学习服务中的复习测试模块设计内容为：期中测试和期末测试。单元测试放到平时的单元学习中了，在这里不单独列出。具体包括期中测试卷和期末测试卷，以及典型试卷讲评，典型例题错题复习，知识结构复习，专项复习等。文件格式包括word文档，PPT课件，以及各种音视频等。帮你复习迎考，让你获得比较满意的考试成绩。</span>

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
<script>
    function zhuan() {
        window.location.href="discount.php";
    }
</script>
</body>
</html>