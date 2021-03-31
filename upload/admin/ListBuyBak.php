<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$userid=(int)$_GET['userid'];
$username=RepPostVar($_GET['username']);
$search="&username=".$username."&userid=".$userid;
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select * from {$dbtbpre}downbuy_bak where userid='$userid'";
$num=$empire->num($query);//取得总条数
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>购买记录</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>查看<b><?=$username?></b>购买记录</td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="34%" height="25"><div align="center"><strong>充值卡号</strong></div></td>
    <td width="21%" height="25"><div align="center"><strong>冲值金额</strong></div></td>
    <td width="18%" height="25"><div align="center"><strong>购买点数</strong></div></td>
    <td width="27%" height="25"><div align="center"><strong>购买时间</strong></div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center"> 
        <?=$r[card_no]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[money]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[downfen]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[buytime]?>
      </div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
