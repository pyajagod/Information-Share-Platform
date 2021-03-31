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
            <div class="topTel">025-84483929 </div>
            <!--<div class="topNav" onclick="zhuan()">��ֵ�Ż�</div>-->
        </div>
    </div>
    <div class="header">
        <div class="inner1">
            <div class="logo">
                <a href="/upload/mobilePage/intro.php">
                    <img src="../../staticPoj/res/uploadfiles/2018/11/20181109092612365.jpg?bG9nby5qcGc=" />
                </a>
            </div>
            <!--<div class="topNav" onclick="zhuan()">��ֵ�Ż�</div>-->
            <nav class="nav" style="margin-top: 1.8%">
                <ul>
                    <li id="nav"><a href="/upload/mobilePage/discount.php">��ֵ����</a></li>
                        <dl>
                        </dl>
                    </li>
                    <?php
                    if($mhavelogin==1) {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
<!--                        <li id="nav"><a onclick="zhuan()">��ֵ����</a></li>-->
                        <li id="nav"><a href="/upload/mobilePage/selfinfo.php" style="color: #0000FF"><?=$myusername?></a></li>

                        <li id="nav"><a style="color: #0000FF" href="/upload/phome?phome=exit">�˳�</a></li>
                        <!--                        </ul>-->
                        <?php
                    }else {
                        ?>
                        <!--                        <ul class="nav navbar-nav navbar-right">-->
                        <li id="nav"><a href="/upload/mobilePage/login.php"><span class="glyphicon glyphicon-log-in"></span> ��¼</a></li>
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
    <!--TA����ͼ����-->
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=66170070" charset="UTF-8"></script>

    <!--�ֲ�ͼ-->
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
                  <div class="left">�ֻ���</div>
                  <div class="right">
                      <input id="mobile" type="tel" name="" placeholder="�����������ֻ���">
                  </div>
                  <div class="clear"></div>
              </li>
          </ul>
          <p class="p tip">*ɨ΢�ż�΢�ţ���ע�ᣬ�������30 �ϴϱ�</p>
          <a href="javascript:;" class="fromBtn BtnSubmit"><span>ԤԼ���ѧ�Ʋ���</span> </a>
          <div class="safe"><span>�ϴϳ�ŵ������Ϣ���ᱻй¶</span> </div>
        </div>
      </div>

    <!--����ʱ���-->
    <div class="xue-grade-box">
      <img src="../../staticPoj/imgs/grade_title.png?20190901" class="grade-title">
      <ul class="grade-list">
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="24">С��</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="25">�а�</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="1">���</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="2">һ�꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="3">���꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="4">���꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="5">���꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="6">���꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="7">���꼶</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="8">��һ</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="9">����</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="10">����</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="11">��һ</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="12">�߶�</button></li>
        <li><button type="button" style="color:#fe3636;" onclick="gotoMain()" value="13">����</button></li>
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
            alert("���ȵ�¼");
            window.location.href="/upload/mobilePage/login.php";
        <?php
        }
        ?>
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

<section id="hmBox6" class="hmBox6" style="background-image: url(../../staticPoj/res/uploadfiles/images/timg1.jpg?aG1Cb3g2XzAxLmpwZw==)">
<div class="hmData">
    <div class="inner">
        <hgroup class="title">
            <h2 class="aTitle">�����ͥ��ѡ��<span>�ϴ� �� ͬ���γ�</span></h2>
        </hgroup>
        <ul>

            <li class="li3">
                <div class="top"><span class="num" data-from="0" data-to="6000" data-speed="1111">6000</span> </div>
                <div class="btm">ѧ�Ե�ʦ6000+</div>
            </li>
            <li class="li4">
                <div class="top"><span class="num" data-from="0" data-to="10000000" data-speed="1111">10000000</span> </div>
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
    if ($('#hmSlidess').length > 0) {
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: {//�Զ��л�
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            pagination: {//��ҳ��
                el: '.swiper-pagination',
                clickable :true,
            },
            loop : true,//ѭ��
        })
    }
    function tixin() {
        alert("���ȵ�¼");
        window.location.href="/upload/mobilePage/login.php";
    }
    function zhuan() {
        window.location.href="/upload/mobilePage/discount.php";
    }
</script>
</body>
</html>
