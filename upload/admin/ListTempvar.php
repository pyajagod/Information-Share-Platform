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
CheckLevel($myuserid,$myusername,$classid,"template");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select varid,myvar,varvalue,varname,isclose from {$dbtbpre}downtempvar";
$totalquery="select count(*) as total from {$dbtbpre}downtempvar";
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by varid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理模板变量</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置: 
      <a href="ListTempvar.php">管理模板变量</a></td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="增加模板变量" onclick="self.location.href='AddTempvar.php?phome=AddTempvar';">
      </div></td>
  </tr>
</table>
  
<br>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="33%" height="25"> <div align="center">模板变量名</div></td>
    <td width="28%" height="25"> <div align="center">变量标识</div></td>
    <td width="15%"><div align="center">开启</div></td>
    <td width="18%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  //开启
  if($r[isclose])
  {
  $isclose="<font color=red>关闭</font>";
  }
  else
  {
  $isclose="开启";
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[varid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <input name=text1 type=text value="[!--temp.<?=$r[myvar]?>--]" size="32">
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[varname]?>
      </div></td>
    <td><div align="center"><?=$isclose?></div></td>
    <td height="25"> <div align="center">[<a href="AddTempvar.php?phome=EditTempvar&varid=<?=$r[varid]?>">修改</a>]&nbsp;[<a href="tempphome.php?phome=DelTempvar&varid=<?=$r[varid]?>" onclick="return confirm('确认要删除？');">删除</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
