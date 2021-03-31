<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//帐号状态
$gr=$empire->fetch1("select groupname from {$dbtbpre}downgroup where groupid='$lur[groupid]'");
//管理员统计
$adminnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downuser");
//错误报告数
$errornum=$empire->gettotal("select count(*) as total from {$dbtbpre}downerror");
//未审核下载总数
$nochecksoftnum=$empire->gettotal("select count(*) as total from {$dbtbpre}down where checked=0");
//评论总数
$plnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downpl");
//系统信息
if (function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if ($onoff){
        $onoff="打开";
    }else{
        $onoff="关闭";
    }
    if (function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="可以";
    }else{
        $upload="不可以";
    }
//开启
$register_ok="开启";
if($public_r[openregister])
{$register_ok="关闭";}
$addsoft_ok="开启";
if($public_r[openadd])
{$addsoft_ok="关闭";}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>后台首页</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<br>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><div align="center"><strong> 
<!--        <h3>欢迎使用帝国下载系统(EmpireDown)</h3>-->
        </strong></div></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong></strong> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#edown"><strong>我的状态</strong></a></td>
                <td><div align="right"><a href="http://www.dotool.cn" target="_blank"><strong>站长工具</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25"><div align="left">登陆者:&nbsp;<b> 
                    <?=$myusername?>
                    </b></div></td>
                <td height="25">所属用户组:&nbsp;<b> 
                  <?=$gr[groupname]?>
                  </b></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=16><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td height="38">
<div align="center"><a href="http://www.phome.net/OpenSource/" target="_blank"><strong><font color="#0000FF" size="3">帝国网站管理系统全面开源 
              － 最安全、最稳定的开源CMS系统</font></strong></a></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#"><strong>系统信息</strong></a></td>
                <td><div align="right"><a href="http://www.phome.net/ebak2008os/" target="_blank"><strong>帝国MYSQL备份王下载</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">服务器软件: 
                  <?=$_SERVER['SERVER_SOFTWARE']?>
                </td>
                <td height="25">操作系统: <? echo defined('PHP_OS')?PHP_OS:'未知';?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">PHP版本: <? echo @phpversion();?></td>
                <td height="25">MYSQL版本:<? echo @mysql_get_server_info();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">全局变量: 
                  <?=$onoff?>
                </td>
                <td height="25">上传文件: 
                  <?=$upload?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">登陆者IP: <? echo $_SERVER['REMOTE_ADDR'];?></td>
                <td height="25">当前时间: <? echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">程序版本: <a href="http://www.phome.net" target="_blank"><strong>EmpireDown</strong></a><strong> 
                  v2.5</strong></td>
                <td height="25">使用域名: 
                  <?=$_SERVER['HTTP_HOST']?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">会员注册: 
                  <?=$register_ok?>
                </td>
                <td height="25">发布投稿: 
                  <?=$addsoft_ok?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">未审核下载数: <a href="ListAllSoft.php?sear=1&showspecial=3">
                  <?=$nochecksoftnum?>
                  </a> </td>
                <td height="25">错误报告总数: <a href="ListError.php">
                  <?=$errornum?>
                  </a> </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">管理员总数: <a href="ListUser.php">
                  <?=$adminnum?>
                  </a> </td>
                <td height="25">评论总数: <a href="ListAllPl.php">
                  <?=$plnum?>
                  </a> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=16></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">官方信息</td>
        </tr>
        <tr> 
          <td width="43%" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="30%" height="25">帝国官方主页: </td>
                <td width="70%" height="25"><a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">帝国官方论坛: </td>
                <td height="25"><a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">合作伙伴计划: </td>
                <td height="25"><a href="http://www.phome.net/partner/" target="_blank">http://www.phome.net/partner/</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">公司网站：</td>
                <td height="25"><a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
            </table></td>
          <td width="57%" height="125" valign="top" bgcolor="#FFFFFF"> <IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=25></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>