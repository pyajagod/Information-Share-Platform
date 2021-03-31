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
CheckLevel($myuserid,$myusername,$classid,"downurl");

//增加url地址
function AddDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[urlname])||empty($add[url]))
	{
		printerror("请输入地址前缀名称与地址","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"downurl");
	$add[downtype]=(int)$add[downtype];
	$sql=$empire->query("insert into {$dbtbpre}downurl(urlname,url,downtype) values('$add[urlname]','$add[url]','$add[downtype]');");
	if($sql)
	{
		printerror("增加地址前缀成功","url.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改url地址
function EditDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[urlid]=(int)$add[urlid];
	if(empty($add[urlname])||empty($add[url])||empty($add[urlid]))
	{printerror("请输入地址前缀名称与地址","history.go(-1)");}
	//验证权限
	CheckLevel($userid,$username,$classid,"downurl");
	$add[downtype]=(int)$add[downtype];
	$sql=$empire->query("update {$dbtbpre}downurl set urlname='$add[urlname]',url='$add[url]',downtype='$add[downtype]' where urlid='$add[urlid]'");
	if($sql)
	{
		printerror("修改地址前缀成功","url.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除url地址
function DelDownurl($urlid,$userid,$username){
	global $empire,$dbtbpre;
	$urlid=(int)$urlid;
	if(empty($urlid))
	{
		printerror("请选择要删除的url地址","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"downurl");
	$sql=$empire->query("delete from {$dbtbpre}downurl where urlid='$urlid'");
	if($sql)
	{
		printerror("删除地址前缀成功","url.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//增加地址前缀
if($phome=="AddDownurl")
{
	AddDownurl($_POST,$myuserid,$myusername);
}
elseif($phome=="EditDownurl")
{
	EditDownurl($_POST,$myuserid,$myusername);
}
elseif($phome=="DelDownurl")
{
	$urlid=$_GET['urlid'];
	DelDownurl($urlid,$myuserid,$myusername);
}

$sql=$empire->query("select urlid,urlname,url from {$dbtbpre}downurl order by urlid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: 管理下载地址前缀</td>
  </tr>
</table>
<form name="form1" method="post" action="url.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
      <td height="25">增加下载地址前缀:<font color="#FFFFFF"><strong> 
        <input type=hidden name=phome value=AddDownurl>
        </strong></font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 名称: 
        <input name="urlname" type="text" id="urlname">
        地址: 
        <input name="url" type="text" id="url" value="http://" size="42">
        下载方式: 
        <select name="downtype" id="downtype">
          <option value="0">HEADER</option>
          <option value="1">META</option>
          <option value="2">READ</option>
        </select> 
        <input type="submit" name="Submit" value="增加">
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25">下载地址前缀管理
<div align="left"></div></td>
    <td width="26%" height="25">
<div align="center"><font color="#FFFFFF"><strong>操作</strong></font></div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=url.php>
    <input type=hidden name=phome value=EditDownurl>
    <input type=hidden name=urlid value=<?=$r[urlid]?>>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">名称: 
        <input name="urlname" type="text" id="urlname" value="<?=$r[urlname]?>">
        地址: 
        <input name="url" type="text" id="url" value="<?=$r[url]?>" size="30"> 
        <select name="select" id="select">
          <option value="0"<?=$r['downtype']==0?' selected':''?>>HEADER</option>
          <option value="1"<?=$r['downtype']==1?' selected':''?>>META</option>
          <option value="2"<?=$r['downtype']==2?' selected':''?>>READ</option>
        </select>
        <div align="left"></div></td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="修改">
          &nbsp; 
          <input type="button" name="Submit4" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='url.php?phome=DelDownurl&urlid=<?=$r[urlid]?>';}">
        </div></td>
    </tr>
  </form>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
<br>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class=tableborder>
  <tr> 
    <td height="26" bgcolor="#FFFFFF"><strong>下载方式说明：</strong></td>
  </tr>
  <tr> 
    <td height="26" bgcolor="#FFFFFF"><strong>HEADER：</strong>使用header转向，通常设为这个。<br> 
      <strong>META：</strong>直接转自，如果是FTP地址推荐选择这个。<br> <strong>READ：</strong>使用PHP程序读取，防盗链较强，但较占资源，服务器本地小文件可选择。</td>
  </tr>
</table>
</body>
</html>
