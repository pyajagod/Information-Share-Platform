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
CheckLevel($myuserid,$myusername,$classid,"class");

//显示无限级分类[管理类别时]
function ShowClass_ListClass($bclassid,$exp){
	global $empire,$dbtbpre;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="";
    }
	else
	{$exp="&nbsp;&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select * from {$dbtbpre}downclass where bclassid='$bclassid' order by classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		//终级类别
		if($r[islast])
		{
			$img="../data/images/txt.gif";
			$bgcolor="#ffffff";
			$renewshtml="&nbsp;[<a href='chtmlphome.php?phome=ReSoftHtml&classid=".$r[classid]."&from=ListClass.php'>内容</a>]&nbsp;";
			$islastclass="<a href='#edown' onclick='ChangeLastClass(".$r[classid].")' title='转换为非终极分类'>是</a>";
		}
		else
		{
			$img="../data/images/dir.gif";
			if(empty($r[bclassid]))
			{$bgcolor="#DBEAF5";}
			else
			{$bgcolor="#ffffff";}
			$renewshtml="&nbsp;[<a href='chtmlphome.php?phome=ReSoftHtml&classid=".$r[classid]."&from=ListClass.php'>内容</a>]&nbsp;";
			$islastclass="<a href='#edown' onclick='ChangeLastClass(".$r[classid].")' title='转换为终极分类'>否</a>";
		}
		$classurl=EDReturnClassUrl($r[classid]);
		$returnstr.="<tr bgcolor=".$bgcolor."><td>".$exp."<img src=".$img." width=19 height=15></td><td><div align=center><input type=text size=3 name=myorder[] value=".$r[myorder]."><input type=hidden name=classid[] value=".$r[classid]."></div></td><td height=25> <div align=center>".$r[classid]."</div></td><td height=25><a href='$classurl' target=_blank>".$r[classname]."</a></td><td align='center'>$islastclass</td><td height=25><div align=center><a href='#edown' onclick=javascript:window.open('view/ClassUrl.php?classid=".$r[classid]."','','width=500,height=200');>查看地址</a></div></td><td height=25><div align=center>[<a href='$classurl' target=_blank>预览</a>]&nbsp;[<a href='chtmlphome.php?phome=ReHtml&classid=".$r[classid]."'>生成</a>]".$renewshtml."[<a href='chtmlphome.php?phome=rejs&doing=0&classid=".$r[classid]."'>JS</a>]&nbsp;[<a href='AddClass.php?classid=".$r[classid]."&phome=EditClass'>修改</a>]&nbsp;[<a href='classphome.php?classid=".$r[classid]."&phome=DelClass' onclick=\"return confirm('确认要删除此分类，将删除所属子类及下载');\">删除</a>]</div></td></tr>";
		//取得子类别
		$returnstr.=ShowClass_ListClass($r[classid],$exp);
	}
	return $returnstr;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理分类</title>
<script>
function ChangeLastClass(classid){
	if(confirm('确认要转换?'))
	{
		self.location.href="classphome.php?phome=ChangeClassIslast&from=ListClass.php&classid="+classid;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="ListClass.php">管理分类</a></td>
    <td> <div align="right">
        <input type="button" name="Submit2" value="增加分类" onclick="self.location.href='AddClass.php?phome=AddClass';">
      </div></td>
  </tr>
</table>
<form name="editorder" method="post" action="classphome.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="7%">&nbsp;</td>
      <td width="6%" height="24"> <div align="center">顺序</div></td>
      <td width="7%" height="24"> <div align="center">ID</div></td>
      <td width="27%" height="24"> <div align="center">类别名</div></td>
      <td width="8%"><div align="center">终极分类</div></td>
      <td width="8%" height="24"> <div align="center">调用地址</div></td>
      <td width="37%" height="24"> <div align="center">操作</div></td>
    </tr>
    <?
 echo ShowClass_ListClass(0,$exp);
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <div align="left"> 
          <input type="submit" name="Submit" value="修改类别顺序" onClick="document.editorder.phome.value='EditClassOrder';">
          <input name="phome" type="hidden" id="phome" value="EditClassOrder">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <strong>终极分类属性转换说明：</strong><br>
        如果是<font color="#FF0000">非终极分类</font>，则转为<font color="#FF0000">终极分类</font><font color="#666666">(此分类不能有子分类)</font><br>
        如果是<font color="#FF0000">终极分类</font>，则转为<font color="#FF0000">非终极分类</font><font color="#666666">(此分类下不能有数据)<br>
        </font><strong>修改分类顺序:顺序值越小越前面。</strong> </td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
