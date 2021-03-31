<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../data/cache/class.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$bclassid=(int)$_GET['bclassid'];
$classid=(int)$_GET['classid'];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"soft");
if(empty($class_r[$classid]['classid']))
{
	printerror('此分类不存在','history.go(-1)');
}
$line=20;//每页显示条数
$page_line=18;//每页显示链接数
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//总偏移量
$url=AdminReturnClassLink($classid);
$search="&classid=".$classid;
$where='';
//专题ID
$ztid=intval($_GET['ztid']);
if($ztid)
{
	$where.=" and ztid='$ztid'";
	$search.="&ztid=$ztid";
}
//取得专题
$ztclass="";
$doztclass="";
$z_sql=$empire->query("select ztname,ztid from {$dbtbpre}downzt order by ztid desc");
while($z_r=$empire->fetch($z_sql))
{
	$selected="";
	if($z_r[ztid]==$ztid)
	{
		$selected=" selected";
	}
	$ztclass.="<option value='".$z_r[ztid]."'".$selected.">".$z_r[ztname]."</option>";
	$doztclass.="<option value='".$z_r[ztid]."'>".$z_r[ztname]."</option>";
}
//搜索
$sear=$_GET['sear'];
if($sear)
{
	$showspecial=$_GET['showspecial'];
	if($showspecial==1)//置顶
	{
		$where.=' and istop<>0';
	}
	elseif($showspecial==2)//推荐
	{
		$where.=' and isgood=1';
	}
	elseif($showspecial==3)//未审核
	{
		$where.=' and checked=0';
	}
	elseif($showspecial==4)//已审核
	{
		$where.=' and checked=1';
	}
	if($_GET['keyboard'])
	{
		$keyboard=RepPostVar2($_GET['keyboard']);
		$show=$_GET['show'];
		if($show==0)//搜索全部
		{
			$where.=" and (softname like '%$keyboard%' or softsay like '%$keyboard%' or adduser like '%$keyboard%')";
		}
		elseif($show==1)//搜索软件名称
		{
			$where.=" and (softname like '%$keyboard%')";
		}
		elseif($show==2)//ID
		{
			$where.=" and (softid='$keyboard')";
		}
		elseif($show==3)//搜索软件介绍
		{
			$where.=" and (softsay like '%$keyboard%')";
		}
		else
		{
			$where.=" and (adduser like '%$keyboard%')";
		}
	}
	$search.="&sear=1&keyboard=$keyboard&show=$show&showspecial=$showspecial";
}
//排序
$orderby=$_GET['orderby'];
$doorderby=$orderby?'asc':'desc';
$myorder=$_GET['myorder'];
if($myorder==1)//ID号
{$doorder="softid";}
elseif($myorder==2)//时间
{$doorder="softtime";}
elseif($myorder==3)//总下载排行
{$doorder="count_all";}
elseif($myorder==4)//月下载排行
{$doorder="count_month";}
elseif($myorder==5)//周下载排行
{$doorder="count_week";}
elseif($myorder==6)//日下载排行
{$doorder="count_day";}
else//默认排序
{$doorder="softid";}
$doorder.=' '.$doorderby;
$search.="&myorder=$myorder&orderby=$orderby";
$query="select softid,softname,adduser,softtime,checked,ismember,filename,titleurl,istop,isgood,softpic from {$dbtbpre}down where classid='$classid'".$where;
//总记录数
$totalnum=(int)$_GET['totalnum'];
if(empty($totalnum))
{
	$totalquery="select count(*) as total from {$dbtbpre}down where classid='$classid'".$where;
	$num=$empire->gettotal($totalquery);
}
else
{
	$num=$totalnum;
}
$search.="&totalnum=$totalnum";
$query=$query." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$phpmyself=urlencode($_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]);
$softclassurl=EDReturnClassNavUrl();
$classurl=EDReturnClassUrl($classid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理软件</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置： 
      <?=$url?>
      <div align="right"></div>
      <div align="right"> </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
<form name="ReForm" method="get" action="infophome.php">
    <tr> 
      <td width="26%"> [<a href="../" target=_blank>预览首页</a>]&nbsp;[<a href="<?=$softclassurl?>" target=_blank>预览分类导航</a>]&nbsp;[<a href="<?=$classurl?>" target=_blank>预览分类</a>]</td>
      <td width="28%"> 
        <select name="dore">
        <option value="1">生成当前分类</option>
        <option value="2">生成首页</option>
        <option value="3">生成父分类</option>
        <option value="4">生成当前分类与父分类</option>
        <option value="5">生成父分类与首页</option>
        <option value="6" selected>生成当前分类、父分类与首页</option>
      </select> <input type="button" name="Submit12" value="提交" onclick="self.location.href='infophome.php?phome=AddSoftToReHtml&classid=<?=$classid?>&dore='+document.ReForm.dore.value;">
      </td>
      <td width="46%"> 
        <div align="right"> 
          <input type="button" name="Submit22" value="生成首页" onclick="self.location.href='chtmlphome.php?phome=ReIndex'">
          &nbsp;&nbsp; 
          <input type="button" name="Submit22" value="生成分类导航" onclick="self.location.href='chtmlphome.php?phome=ReClassJS_all&do=class&from=<?=$phpmyself?>'">
          &nbsp;&nbsp; 
          <input name="Submit32" type="button" value="生成排行调用" onclick="self.location.href='chtmlphome.php?phome=ReListJs&do=class&from=<?=$phpmyself?>'">
        </div></td>
  </tr>
</form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <form name="form2" method="get" action="ListSoft.php">
    <tr bgcolor="#FFFFFF">
      <td width="11%"> <input type="button" name="Submit3" value="增加下载" onclick="self.location.href='AddSoft.php?classid=<?=$classid?>&phome=AddSoft'"> 
      </td>
      <td width="89%" height="30"> <div align="center"> </div>
        <div align="center"></div>
        <div align="right">&nbsp;关键字: 
          <select name="showspecial" id="showspecial">
            <option value="0"<?=$showspecial==0?' selected':''?>>不限属性</option>
            <option value="1"<?=$showspecial==1?' selected':''?>>置顶</option>
            <option value="2"<?=$showspecial==2?' selected':''?>>推荐</option>
            <option value="3"<?=$showspecial==3?' selected':''?>>未审核</option>
            <option value="4"<?=$showspecial==4?' selected':''?>>已审核</option>
          </select>
          <input name="keyboard" type="text" value="<?=$keyboard?>">
          <select name="show" id="show">
            <option value="0"<?=$show==0?' selected':''?>>不限</option>
            <option value="1"<?=$show==1?' selected':''?>>软件名</option>
            <option value="2"<?=$show==2?' selected':''?>>软件ID</option>
            <option value="3"<?=$show==3?' selected':''?>>软件说明</option>
            <option value="4"<?=$show==4?' selected':''?>>增加者</option>
          </select>
          <select name="ztid" id="ztid">
            <option value="0">所有专题</option>
            <?=$ztclass?>
          </select>
          <select name="myorder" id="myorder">
            <option value="1"<?=$myorder==1?' selected':''?>>按ID</option>
            <option value="2"<?=$myorder==2?' selected':''?>>按增加时间</option>
            <option value="3"<?=$myorder==3?' selected':''?>>按总下载排行</option>
            <option value="4"<?=$myorder==4?' selected':''?>>按月下载排行</option>
            <option value="5"<?=$myorder==5?' selected':''?>>按周下载排行</option>
            <option value="6"<?=$myorder==6?' selected':''?>>按日下载排行</option>
          </select>
          <select name="orderby" id="orderby">
            <option value="0"<?=$orderby==0?' selected':''?>>降序排序</option>
            <option value="1"<?=$orderby==1?' selected':''?>>升序排序</option>
          </select>
          <input type="submit" name="Submit2" value="搜索">
          <input name="sear" type="hidden" id="sear" value="1">
          <input name="classid" type="hidden" id="classid" value="<?=$classid?>">
        </div></td>
    </tr>
  </form>
</table>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="listsoft" method="post" action="infophome.php" onsubmit="return confirm('确认要执行此操作?');">
    <tr class="header"> 
      <td width="4%">&nbsp;</td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="32%" height="25"><div align="center">下载名称</div></td>
      <td width="17%" height="25"><div align="center">增加者</div></td>
      <td width="6%"><div align="center">评论</div></td>
      <td width="22%" height="25"><div align="center">增加时间</div></td>
      <td width="13%" height="25"><div align="center">操作</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
		//置顶
		$istop="";
		if($r[istop])
		{
			$istop="<font color=red>[顶".$r[istop]."]</font>";
		}
		//推荐
		$isgood="";
		if($r[isgood])
		{
			$isgood="<font color=red>[推]</font>";
		}
		//标题图片
		$showsoftpic="";
		if($r[softpic])
		{
			$showsoftpic="<a href='".$r[softpic]."' title='预览缩图' target=_blank><img src='../data/images/showimg.gif' border=0></a>";
		}
		if(empty($r[checked]))
		{$checked=" title='未审核' style='background:#99C4E3'";}
		else
		{$checked="";}
		//会员
		if($r[ismember])
		{$fcolor="red";}
		else
		{$fcolor="000000";}
		//页面地址
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		$showid="<a href='infophome.php?phome=ReSingleSoftHtml&classid=$classid&softid[]=$r[softid]'>$r[softid]</a>";
	?>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="center"> 
          <input name="softid[]" type="checkbox" id="softid[]" value="<?=$r[softid]?>"<?=$checked?>>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$showid?>
        </div></td>
      <td height="25"><div align="">
		<?=$istop.$isgood?>
        <?=$showsoftpic?>
		<a href="<?=$softurl?>" target=_blank> 
          <?=$r[softname]?>
          </a></div></td>
      <td height="25"><div align="center"> <font color="<?=$fcolor?>"> 
          <?=$r[adduser]?>
          </font> </div></td>
      <td><div align="center"><a href="ListPl.php?softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>" target="_blank">管理</a></div></td>
      <td height="25"><div align="center"> 
          <?=date("Y-m-d H:i:s",$r[softtime])?>
        </div></td>
      <td height="25"><div align="center">[<a href="AddSoft.php?phome=EditSoft&softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>">修改</a>] 
          [<a href="infophome.php?phome=DelSoft&softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>" onclick="return confirm('您是否要删除？');">删除</a>]</div></td>
    </tr>
    <?
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        </div></td>
      <td height="25" colspan="6"><input type="submit" name="Submit42" value="生成" onclick="document.listsoft.phome.value='ReSingleSoftHtml';"> &nbsp;
        <input type="submit" name="Submit4" value="审核" onclick="document.listsoft.phome.value='CheckSoft_all';"> &nbsp;
        <select name="istop" id="select">
          <option value="0">0级置顶</option>
          <option value="1">1级置顶</option>
          <option value="2">2级置顶</option>
          <option value="3">3级置顶</option>
          <option value="4">4级置顶</option>
          <option value="5">5级置顶</option>
          <option value="6">6级置顶</option>
        </select> <input type="submit" name="Submit5" value="置顶" onclick="document.listsoft.phome.value='TopSoft_all';"> &nbsp;
        <span id="moveclassnav"></span>
		<input type="submit" name="Submit52" value="移动" onclick="document.listsoft.phome.value='MoveSoft';"> 
        <input type="submit" name="Submit6" value="复制" onclick="document.listsoft.phome.value='CopySoft';"> &nbsp;
        <input type="submit" name="Submit" value="删除" onclick="document.listsoft.phome.value='DelSoft_all';">
        <input name="phome" type="hidden" id="phome2" value="DelSoft_all">
        <input name="classid" type="hidden" value="<?=$classid?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7">&nbsp; 
        <?=$returnpage?>
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"><font color="#666666">备注：多选框为蓝色代表未审核软件，置顶级别越高越前面，增加者颜色为红色是会员发布的</font></td>
    </tr>
  </form>
</table>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=3" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?
db_close();
$empire=null;
?>
