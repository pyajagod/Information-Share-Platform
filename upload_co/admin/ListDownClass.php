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

//显示无限级分类[管理下载时]
function ShowClass_ListSoft($adminclass,$doall,$bclassid,$exp){
	global $empire,$dbtbpre;
	$sql=$empire->query("select classid,classname,bclassid,islast,sonclass from {$dbtbpre}downclass where bclassid='$bclassid' order by myorder,classid");
	if(empty($exp))//js
	{
		$exp="|-";
	}
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="|-";
    }
	else
	{
		$exp="&nbsp;&nbsp;".$exp;
	}
	$num=$empire->num1($sql);
	if($num==0&&$bclassid==0)//无记录
	{
		echo $GLOBALS['notrecordword'];
		return "";
	}
	$returnstr="";
    ?>
	<table border='0' cellspacing='0' cellpadding='0'>
	<?
	$i=1;
	while($r=$empire->fetch($sql))
	{
		//需要权限
		if(empty($doall))
		{
			if(CheckHaveInClassid($r,$adminclass)==0)
			{
				continue;
			}
		}
		//终级类别
		if($r[islast])
		{
			$color=" style='background:#99C4E3'";
			//最后一个子类别
			if($i==$num)
			{$menutype="file1";}
			else
			{$menutype="file";}
			$classname="<a href='ListSoft.php?bclassid=".$r[bclassid]."&classid=".$r[classid]."' target='edmain'>".$r[classname]."</a>";
			$onmouseup="";
		}
		else
		{
			$color="";
			//最后一个大类别
			if($i==$num)
			{
				$menutype="menu3";
				$listtype="list1";
				$onmouseup="chengstate('".$r[classid]."')";
			}
			else
			{
				$menutype="menu1";
				$listtype="list";
				$onmouseup="chengstate('".$r[classid]."')";
			}
			$classname=$r[classname];
		}
		?>
		<tr>
			<td id="pr<?=$r[classid]?>" class="<?=$menutype?>" onMouseUp="<?=$onmouseup?>"><?=$classname?></td>
		  </tr>
		  <tr id="item<?=$r[classid]?>" style="display:none">
			<td class="<?=$listtype?>">
		<?
			$jsstr.="<option value='".$r[classid]."'".$color.">".$exp.$r[classname]."</option>";
			$jsstr.=ShowClass_ListSoft($adminclass,$doall,$r[classid],$exp);
		?>
			</td>
		 </tr>	
		<?
		$i+=1;
    }
	?>
	</table>
	<?
	return $jsstr;
}

$user_r=$empire->fetch1("select adminclass,groupid from {$dbtbpre}downuser where userid='$myuserid'");
//用户组权限
$gr=$empire->fetch1("select doall from {$dbtbpre}downgroup where groupid='$user_r[groupid]'");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理下载</title>
<link href="../data/menu/menu.css" rel="stylesheet" type="text/css">
<script src="../data/menu/menu.js" type="text/javascript"></script>
<SCRIPT lanuage="JScript">
if(self==top)
{self.location.href='admin.php';}
</SCRIPT>
</head>
<body onLoad="initialize()">
	<table border='0' cellspacing='0' cellpadding='0'>
	<tr height=20>
			<td id="home"><img src="../data/images/homepage.gif" border=0></td>
			<td><a href="ListAllSoft.php" target="edmain">管理下载</a></td>
	</tr>
	</table>
<?
$notrecordword="您还未添加分类,<br><a href='AddClass.php?phome=AddClass' target='edmain'><u><b>点击这里</b></u></a>进行添加操作";
$jsstr=ShowClass_ListSoft($user_r[adminclass],$gr[doall],0,$exp);
if(!file_exists('../data/fc/downclass.js'))
{
	$jsfile="../data/fc/downclass.js";
	$search_jsfile="../data/fc/searchclass.js";
	$search_jsstr=str_replace(" style='background:#99C4E3'","",$jsstr);
	WriteFiletext_n($jsfile,"document.write(\"".addslashes($jsstr)."\");");
	WriteFiletext_n($search_jsfile,"document.write(\"".addslashes($search_jsstr)."\");");
}
?>
</body>
</html>
<?
db_close();
$empire=null;
?>
