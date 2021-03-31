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
//验证权限
CheckLevel($myuserid,$myusername,$classid,"buygroup");

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;
$page_line=25;
$offset=$start+$line*$page;
$totalquery="select count(*) as total from {$dbtbpre}downbuygroup";
$num=$empire->gettotal($totalquery);
$query="select id,gname,gmoney,gfen,gdate from {$dbtbpre}downbuygroup";
$query.=" order by myorder,id limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理充值类型</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置：<a href="ListBuyGroup.php">管理充值类型</a></td>
    <td><div align="right">
        <input type="button" name="Submit5" value="增加充值类型" onclick="self.location.href='AddBuyGroup.php?phome=AddBuyGroup';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="41%" height="25"> <div align="center">类型名称</div></td>
    <td width="15%" height="25"> <div align="center">金额(元)</div></td>
    <td width="11%" height="25"> <div align="center">点数</div></td>
    <td width="11%"><div align="center">有效期(天)</div></td>
    <td width="16%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gname]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gmoney]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gfen]?>
      </div></td>
    <td><div align="center"><?=$r[gdate]?></div></td>
    <td height="25"> <div align="center">[<a href="AddBuyGroup.php?phome=EditBuyGroup&id=<?=$r[id]?>">修改</a>]　[<a href="memberphome.php?phome=DelBuyGroup&id=<?=$r[id]?>" onclick="return confirm('确认要删除?');">删除</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> &nbsp;&nbsp; 
      <?=$returnpage?>
      <div align="left"></div></td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>