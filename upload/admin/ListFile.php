<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"file");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$add="";
//选择分类
$classid=(int)$_GET['classid'];
//栏目
if($classid)
{
	if($class_r[$classid]['islast'])
	{
		$add.=" and classid='$classid'";
	}
	else
	{
		$add.=" and ".ReturnClass($class_r[$classid]['sonclass']);
	}
}
//关键字
$keyboard=RepPostVar2($_GET['keyboard']);
if(!empty($keyboard))
{
	$show=$_GET['show'];
	//搜索全部
	if($show==0)
	{
		$add.=" and (filename like '%$keyboard%' or fileno like '%$keyboard%' or adduser like '%$keyboard%')";
	}
	//搜索文件名
	elseif($show==1)
	{
		$add.=" and filename like '%$keyboard%'";
	}
	//搜索编号
	elseif($show==2)
	{
		$add.=" and fileno like '%$keyboard%'";
	}
	//搜索上传者
	else
	{
		$add.=" and adduser like '%$keyboard%'";
	}
}
$search="&classid=$classid&show=$show&keyboard=$keyboard";
$query="select fileid,filename,adduser,filetime,filesize,fileno,classid,path,softid from {$dbtbpre}downfile where 1=1".$add;
$totalquery="select count(*) as total from {$dbtbpre}downfile where 1=1".$add;
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by fileid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理附件</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td width="36%">位置：<a href="ListFile.php">管理附件(数据式)</a>&nbsp;</td>
    <td width="64%"><div align="right"> 
        <input type="button" name="Submit52" value="目录式管理附件" onclick="self.location.href='ListFilePath.php';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form2" method="get" action="ListFile.php">
    <tr> 
      <td>关键字: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> <select name="show" id="show">
          <option value="0"<?=$show==0?' checked':''?>>不限</option>
          <option value="1"<?=$show==1?' checked':''?>>文件名</option>
          <option value="2"<?=$show==2?' checked':''?>>编号</option>
          <option value="3"<?=$show==3?' checked':''?>>上传者</option>
        </select> <span id="listfileclassnav"></span> <input type="submit" name="Submit2" value="搜索"> 
        <input name="sear" type="hidden" id="sear" value="1"> </td>
      <td><div align="center">[<a href="filephome.php?phome=DelFreeFile" onclick="return confirm('确认要操作?');">清理失效附件</a>]</div></td>
    </tr>
  </form>
</table>

<form name="form1" method="post" action="filephome.php" onsubmit="return confirm('确认要删除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="5%" height="25"><div align="center">ID</div></td>
      <td width="29%" height="25"><div align="center">文件名</div></td>
      <td width="19%"><div align="center">所属分类</div></td>
      <td width="10%" height="25"><div align="center">增加者</div></td>
      <td width="9%"><div align="center">文件大小(KB)</div></td>
      <td width="17%" height="25"><div align="center">增加时间</div></td>
      <td width="11%" height="25"><div align="center">操作</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
         if($r[fileno])
         {$fileno="<br>[<b>".$r[fileno]."</b>]";}
         else
         {$fileno="";}
		 $bclassid=$class_r[$r[classid]][bclassid];
		 $url=$class_r[$bclassid][classname]."&nbsp;>&nbsp;".$class_r[$r[classid]][classname];
		 $filesize=ChTheFilesize($r[filesize]);
		 if(empty($r[path]))
	     {
	     	$filename="../data/".$public_r[downpath]."/".$r[filename];
         }
         else
	     {
         	$filename="../data/".$public_r[downpath]."/".$r[path]."/".$r[filename];
	     }
		 //引用
		$thisfileid=$r['fileid'];
		if($r['softid'])
		{
			$softr=$empire->fetch1("select filename,titleurl from {$dbtbpre}down where softid='$r[softid]'");
			$thisfileid="<b><a href='".EDReturnSoftPageUrl($softr[filename],$softr[titleurl])."' target=_blank>".$r[fileid]."</a></b>";
		}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$thisfileid?>
        </div></td>
      <td height="25"><div align="center"> <a href="<?=$filename?>" target=_blank> 
          <?=$r[filename]?>
          </a> 
          <?=$fileno?>
        </div></td>
      <td><div align="center">
	  <?=$url?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[adduser]?>
        </div></td>
      <td><div align="center"> 
          <?=$filesize?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[filetime]?>
        </div></td>
      <td height="25"><div align="center">[<a href="filephome.php?phome=DelFile&fileid=<?=$r[fileid]?>" onclick="return confirm('您是否要删除？');">删除</a> 
          <input name="fileid[]" type="checkbox" id="fileid[]" value="<?=$r[fileid]?>">
          ]</div></td>
    </tr>
    <?
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"> 
        <?=$returnpage?>
        &nbsp;&nbsp;<input type="submit" name="Submit" value="批量删除"> <input name="phome" type="hidden" id="phome" value="DelFile_all">
		&nbsp;
        <input type=checkbox name=chkall value=on onClick="CheckAll(this.form)">
        选中全部</td>
    </tr>
  </table>
</form>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=5&classid=<?=$classid?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?
db_close();
$empire=null;
?>
