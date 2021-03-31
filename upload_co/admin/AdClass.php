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
CheckLevel($myuserid,$myusername,$classid,"ad");
$sql=$empire->query("select classid,classname from {$dbtbpre}downadclass order by classid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: <a href="ListAd.php">管理广告</a> &gt; 管理广告类别</td>
  </tr>
</table>
<form name="form1" method="post" action="ListAd.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
      <td height="25"><strong>增加广告类别:<font color="#FFFFFF"> 
        <input type=hidden name=phome value=AddAdClass>
        </font></strong></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 类别名称: 
        <input name="add[classname]" type="text" id="add[classname]">
        <input type="submit" name="Submit" value="增加">
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="10%"><div align="center">ID</div></td>
    <td width="59%" height="25"><div align="center"><strong>类别名称</strong></div></td>
    <td width="31%" height="25"><div align="center"><strong>操作</strong></div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=ListAd.php>
    <input type=hidden name=phome value=EditAdClass>
    <input type=hidden name=add[classid] value=<?=$r[classid]?>>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="center">
          <?=$r[classid]?>
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="add[classname]" type="text" id="add[classname]" value="<?=$r[classname]?>">
        </div></td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="修改">
          &nbsp; 
          <input type="button" name="Submit4" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='ListAd.php?phome=DelAdClass&classid=<?=$r[classid]?>';}">
        </div></td>
    </tr>
  </form>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
