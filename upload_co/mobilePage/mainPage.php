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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>主页</title>
    <link rel="stylesheet" href="../../staticPoj/bootstrap/css/bootstrap.min.css" />
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
    <nav class="navbar navbar-default" role="navigation" style="font-size:28px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#example-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="font-size:28px;" href="intro.php">诚聪教育</a>
            </div>
            <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="intro.php">首页</a></li>
                            <?php
                            if ($mhavelogin == 1) {
                                ?>
                                <li><a href="courseList_eight.php?grade_log=first_one&sub_log=chinese" target="manList">课程</a>
                                </li>
                                <?php
                            }else {
                                ?>
                                <li id="logFirst"><a onclick="tixin()">课程</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
<!--                        <ul class="nav navbar-nav navbar-right">-->
<!--                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>-->
<!--                        </ul>-->
                <?php
                if($mhavelogin==1) {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><strong>Hello</strong>,<?=$myusername?></a></li>
                        <li><a href="selfinfo.php">个人中心</a></li>
                        <li><a href="/ccxm/upload/phome?phome=exit">退出</a></li>
                    </ul>
                    <?php
                }else {
                    ?>
                                            <ul class="nav navbar-nav navbar-right">
                                                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                                            </ul>
                    <?php
                }
                ?>

            </div>

        </div>
    </nav>
    <iframe src="courseList_eight.php?grade_log=first_one&sub_log=chinese" width="100%"  frameborder="0" name="manList" scrolling="yes"></iframe>
    <script src="../../staticPoj/jquery.min.js"></script>
    <script src="../../staticPoj/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("iframe").height($(window).height()-52);
        function tixin() {
            alert("请先登录");
            window.location.href="login.php";
        }
    </script>
</body>
</html>