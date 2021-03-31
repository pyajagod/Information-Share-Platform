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
        })();
    </script>

    <link rel="stylesheet" href="../../staticPoj/res/mcss/editor.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/owl.carousel.min.css" media="screen" />
    <script type="text/javascript" src="../../staticPoj/assets/cssm/swiper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/assets/cssm/swiper.min.css?vs333" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/css_whir.css?vs333" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/index.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/indexa.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/animation.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/swiper.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../staticPoj/res/mcss/ckin.css" media="screen" />
    <link rel="stylesheet" href="../../staticPoj/bootstrap/css/bootstrap.min.css" />

    <!-- <script type="text/javascript" src="../../staticPoj/res/js/layer.js"></script> -->
    <script type="text/javascript" src="../../staticPoj/res/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../staticPoj/res/js/js-whir.js"></script>

    <style type="text/css">
        .swiper-container {
            width: 100%;
            height: 200px;
        }
    </style>

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
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">充值优惠</div>-->
        </div>
    </div>
    <div class="header">
        <div class="inner1">
            <div class="logo">
                <a href="/upload/mobilePage/intro.php">
                    <img src="../../staticPoj/res/uploadfiles/2018/11/20181109092612365.jpg?bG9nby5qcGc=" />
                </a>
            </div>
            <!--<div class="topNav" onclick="zhuan()">充值优惠</div>-->
            <nav class="nav" style="margin-top: 1.8%">
                <ul>
                    <li id="nav"><a href="/upload/mobilePage/discount.php">充值中心</a></li>
                        <dl>
                        </dl>
                    </li>
                    <?php
                    if($mhavelogin==1) {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
<!--                        <li id="nav"><a onclick="zhuan()">充值中心</a></li>-->
                        <li id="nav"><a href="/upload/mobilePage/selfinfo.php" style="color: #0000FF"><?=$myusername?></a></li>

                        <li id="nav"><a style="color: #0000FF" href="/upload/phome?phome=exit">退出</a></li>
                        <!--                        </ul>-->
                        <?php
                    }else {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
                        <li id="nav"><a href="/upload/mobilePage/login.php"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                        <!--                        </ul>-->
                        <?php
                    }
                    ?>
                </ul>
                <div class="topTel" style="line-height:26px;height:24px;">025-84483929 </div>
            </nav>
            <script type="text/javascript">
                $('#nav' + navID).addClass('cur');
                $("body").addClass("yc_body")
                $("body").width($(window).width())
                $("header").width($(window).width())
                $(".header").width($(window).width())
            </script>
            <div class="clear"></div>
        </div>
    </div>
</header>
<!--Body-->

<main>
    <!--TA热力图代码-->
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=66170070" charset="UTF-8"></script>

    <!--轮播图-->
    <!--banner-->
    <div class="swiper-container">
        <ul id="hmSlidess" class="ul swiper-wrapper">

            <li id="BannerImg_70" class="swiper-slide" style="background-image: url('../../staticPoj/imgs/m1.jpg');background-size:cover; cursor: pointer;"></li>

            <li id="BannerImg_23" class="swiper-slide" style="background-image: url('../../staticPoj/imgs/m2.jpg');background-size:cover; cursor: pointer;"></li>

            <li id="BannerImg_58" class="swiper-slide" style="background-image: url('../../staticPoj/imgs/m3.jpg');background-size:cover; cursor: pointer;"></li>

            <li id="BannerImg_69" class="swiper-slide" style="background-image: url('../../staticPoj/imgs/m4.jpg');background-size:cover; cursor: pointer;"></li>

        </ul>
        <div class="swiper-pagination"></div>
    </div>

    <div class="HomeF1">
      <div class="w750">
          <ul class="ul">
              <li>
                  <div class="left">手机号</div>
                  <div class="right">
                      <input id="mobile" type="tel" name="" placeholder="请输入您的手机号">
                  </div>
                  <div class="clear"></div>
              </li>
          </ul>
          <p class="p tip">*扫微信加微信，并注册，免费赠送30 诚聪币</p>
          <a href="javascript:;" class="fromBtn BtnSubmit"><span>预约免费学科测评</span> </a>
          <div class="safe"><span>诚聪承诺您的信息不会被泄露</span> </div>
        </div>
      </div>

    <!--倒计时板块-->
    <div class="xue-grade-box">
      <img src="../../staticPoj/imgs/grade_title.png?20190901" class="grade-title">
      <ul class="grade-list">
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="24">小班</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="25">中班</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="1">大班</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="2">一年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="3">二年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="4">三年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="5">四年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="6">五年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="7">六年级</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="8">初一</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="9">初二</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="10">初三</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="11">高一</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="12">高二</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="13">高三</button></li>
      </ul>
    </div>
    <script>
      function gotoMain(){
        <?php
          if($mhavelogin==1) {
        ?>
            window.location.href="/upload/mobilePage/mainPage.php";
        <?php
        }else {
        ?>
            alert("请先登录");
            window.location.href="/upload/mobilePage/login.php";
        <?php
        }
        ?>
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

<section id="hmBox6" class="hmBox6" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg1.jpg?aG1Cb3g2XzAxLmpwZw==)">
<div class="hmData">
    <div class="inner">
        <hgroup class="title">
            <h2 class="aTitle">更多家庭的选择<span>诚聪 · 同步课程</span></h2>
        </hgroup>
        <ul>

            <li class="li3">
                <div class="top"><span class="num" data-from="0" data-to="6000" data-speed="1111">6000</span> </div>
                <div class="btm">学霸导师6000+</div>
            </li>
            <li class="li4">
                <div class="top"><span class="num" data-from="0" data-to="10000000" data-speed="1111">10000000</span> </div>
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
    if ($('#hmSlidess').length > 0) {
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: {//自动切换
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            pagination: {//分页器
                el: '.swiper-pagination',
                clickable :true,
            },
            loop : true,//循环
        })
    }
    function tixin() {
        alert("请先登录");
        window.location.href="/upload/mobilePage/login.php";
    }
    function zhuan() {
        window.location.href="/upload/mobilePage/discount.php";
    }
</script>
</body>
</html>
