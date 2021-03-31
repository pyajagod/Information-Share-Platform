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
CheckLevel($myuserid,$myusername,$classid,"error");

//删除错误报告
function DelError($errorid,$userid,$username){
	global $empire,$dbtbpre;
	$errorid=(int)$errorid;
	if(!$errorid)
	{
		printerror("请选择要删除的错误报告","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"error");
	$sql=$empire->query("delete from {$dbtbpre}downerror where errorid='$errorid'");
	if($sql)
	{
		printerror("删除错误报告成功","ListError.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//批量错误报告
function DelError_all($errorid,$userid,$username){
	global $empire,$dbtbpre;
	$count=count($errorid);
	if(!$count)
	{
		printerror("请选择要删除的错误报告","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"error");
	for($i=0;$i<$count;$i++)
	{
		$add.="errorid='".intval($errorid[$i])."' or ";
	}
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("delete from {$dbtbpre}downerror where ".$add);
	if($sql)
	{
		printerror("删除错误报告成功","ListError.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="DelError")//删除错误报告
{
	$errorid=$_GET['errorid'];
	DelError($errorid,$myuserid,$myusername);
}
elseif($phome=="DelError_all")//批量错误报告
{
	$errorid=$_POST['errorid'];
	DelError_all($errorid,$myuserid,$myusername);
}

$search="";
$line=10;//每页显示条数
$page_line=12;//每页显示链接数
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//总偏移量
$totalquery="select count(*) as total from {$dbtbpre}downerror";
$num=$empire->gettotal($totalquery);//取得总条数
$query="select errorid,errortext,errorip,errortime,softid from {$dbtbpre}downerror";
$query=$query." order by errorid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理错误报告</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td height="27" bordercolor="#3366CC"> 
      <div align="left">位置: <a href="ListError.php">管理错误报告</a></div></td>
  </tr>
</table>
<form name=form1 method=post action=ListError.php onsubmit="return confirm('确认要删除？');">
<?
while($r=$empire->fetch($sql))
{
	$r1=$empire->fetch1("select softname,filename,titleurl from {$dbtbpre}down where softid='$r[softid]'");
	$softurl=EDReturnSoftPageUrl($r1[filename],$r1[titleurl]);
?>
  <table width="100%" border="0" align="center" cellpadding="6" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF"> 
    <td height="25">软件名称：<a href="<?=$softurl?>" target=_blank><?=$r1[softname]?></a></td>
    <td height="25"><input name="errorid[]" type="checkbox" id="errorid[]" value="<?=$r[errorid]?>">
        <a href="ListError.php?phome=DelError&errorid=<?=$r[errorid]?>" onclick="return confirm('确认要删除？');">删除</a></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="38%" height="25">发布者IP：<?=$r[errorip]?></td>
    <td width="62%" height="25">发布时间：<?=$r[errortime]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="2"> 
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td><?=$r[errortext]?></td>
        </tr>
      </table></td>
  </tr>
</table><br>
<?
}
?>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><?=$returnpage?>&nbsp;&nbsp;&nbsp;<input type=submit name=submit value="批量删除">
        <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        选中全部
		<input type=hidden name=phome value=DelError_all></td>
    </tr>
  </table>
 </form>
</body>
</html>
<?
db_close();
$empire=null;
?>
