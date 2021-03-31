<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
CheckLevel($lur[userid],$lur[username],$classid,"class");//验证权限
$phome=$_GET['phome'];
$url="<a href='ListClass.php'>管理分类</a>&nbsp;>&nbsp;增加分类";
$thisdo="增加";
//初始值
$islast="<input name='islast' type='checkbox' value='1'>是(终极分类下才能增加下载)";
$r[maxnum]=0;
$r[lencord]=20;
$r[link_num]=10;
$r[downnum]=1;
$r[onlinenum]=1;
$r[qaddfen]=0;
$r[myorder]=0;
//复制分类
$docopy=$_GET['docopy'];
if($docopy&&$phome=="AddClass")
{
	$copyclass=1;
}
//修改分类
if($phome=="EditClass"||$copyclass)
{
	if($copyclass)
	{
		$thisdo="复制";
	}
	else
	{
		$thisdo="修改";
	}
	$classid=(int)$_GET[classid];
	$r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	$url="<a href='ListClass.php'>管理分类</a>&nbsp;>&nbsp;".$thisdo."分类：<b>".$r[classname]."</b>";
	if($r[islast])
	{
		$islast="是<input name='islast' type='hidden' value='1'>";
	}
	else
	{
		$islast="否";
	}
}
//会员组
$group='';
$qgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[groupid]==$mgr[groupid])
	{
		$select=" selected";
	}
	else
	{
		$select="";
	}
	$group.="<option value='".$mgr[groupid]."'".$select.">".$mgr[groupname]."</option>";
	$qselect=$r[qaddgroupid]==$mgr[groupid]?" selected":"";
	$qgroup.="<option value='".$mgr[groupid]."'".$qselect.">".$mgr[groupname]."</option>";
}
//分类
$fcjsfile="../data/fc/downclass.js";
if(file_exists($fcjsfile))
{
	$options=GetFcfiletext($fcjsfile);
	$options=str_replace("<option value='$r[bclassid]'","<option value='$r[bclassid]' selected",$options);
}
else
{
	$options=ShowClass_AddClass("",$r[bclassid],0,"|-",0);
}
//列表模板
$listtemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	if($ltr[tempid]==$r[listtempid])
	{$select=" selected";}
	else
	{$select="";}
	$listtemp.="<option value=".$ltr[tempid].$select.">".$ltr[tempname]."</option>";
}
//内容模板
$softtemp="";
$stsql=$empire->query("select tempid,tempname from {$dbtbpre}downsofttemp order by tempid");
while($str=$empire->fetch($stsql))
{
	if($str[tempid]==$r[softtempid])
	{$select=" selected";}
	else
	{$select="";}
	$softtemp.="<option value=".$str[tempid].$select.">".$str[tempname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加分类</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="classform" method="post" action="classphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"><?=$thisdo?>分类</td>
    </tr>
    <tr> 
      <td width="31%" height="25" bgcolor="#FFFFFF">分类名：</td>
      <td width="69%" height="25" bgcolor="#FFFFFF"> <input name="classname" type="text" id="classname" value="<?=$r[classname]?>" size="30">
        (*) 
        <input name="classid" type="hidden" id="classid" value="<?=$classid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="oldbclassid" type="hidden" id="oldbclassid" value="<?=$r[bclassid]?>"> 
        <input name="oldclassname" type="hidden" id="oldclassname" value="<?=$r[classname]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">分类别名：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="bname" type="text" id="bname" value="<?=$r[bname]?>" size="30"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">父分类：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="bclassid" size="12" id="bclassid" style="width:180">
          <option value="0" selected>根分类</option>
          <?=$options?>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">终极分类：</td>
      <td height="25" bgcolor="#FFFFFF"> 
        <?=$islast?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">表单模式：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="formtype" id="formtype">
          <option value="1"<?=$r[formtype]==1?' selected':''?>>软件表单</option>
          <option value="2"<?=$r[formtype]==2?' selected':''?>>电影表单</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">显示排序：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="30"> 
        <font color="#666666">(值越小越前面)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">分类缩略图：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classimg" type="text" id="classimg" value="<?=$r[classimg]?>" size="30">
      </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">分类关键字：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classkey" type="text" id="classkey" value="<?=$r[classkey]?>" size="30"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">分类简介：</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="classintro" rows="5" style="WIDTH:100%" id="classintro"><?=$r[classintro]?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">模板设置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">所属列表模板：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="listtempid" id="listtempid">
          <?=$listtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p>所属内容模板：</p></td>
      <td height="25" bgcolor="#FFFFFF"><select name="softtempid" id="softtempid">
          <?=$softtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">下载地址每行显示：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downnum" type="text" id="downnum" value="<?=$r[downnum]?>" size="30">
        个地址</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">在线地址每行显示：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="onlinenum" type="text" id="onlinenum" value="<?=$r[onlinenum]?>" size="30">
        个地址</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">生成设置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">显示总记录数：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="30">
        条<font color="#666666">(0为不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">列表每页记录数：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="30">
        条</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">相关链接记录数：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="link_num" type="text" id="link_num" value="<?=$r[link_num]?>" size="30">
        条</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">投稿设置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">开启投稿：</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openadd" value="0"<?=$r[openadd]==0?' checked':''?>>
        开启 
        <input type="radio" name="openadd" value="1"<?=$r[openadd]==1?' checked':''?>>
        关闭 </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">投稿权限：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="qaddgroupid" id="qaddgroupid">
	  <option value="0">游客</option>
          <?=$qgroup?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">投稿获得点数：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qaddfen" type="text" id="qaddfen" value="<?=$r[qaddfen]?>" size="30">
        点</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <div align="left"> 
          <input type="submit" name="Submit" value="提交">
          &nbsp;&nbsp;<input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>