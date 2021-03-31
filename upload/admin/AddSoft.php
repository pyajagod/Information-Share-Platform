<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$classid=(int)$_GET['classid'];
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"soft");
$cr=$empire->fetch1("select classid,formtype,islast from {$dbtbpre}downclass where classid='$classid'");
if(empty($cr['classid']))
{
	printerror('此分类不存在','history.go(-1)');
}
if(!$cr['islast'])
{
	printerror('此分类不是终极分类不能增加下载','history.go(-1)');
}
$phome=$_GET['phome'];
$url=AdminReturnClassLink($classid)."&nbsp;>&nbsp;增加下载";
//初始值
$filepass=time();
$r[writer]="不详";
$r[homepage]="http://";
$r[demo]="http://";
$r[softsay]="暂无相关说明";
$r[checked]=$public_r[checked];
$softtime=date("Y-m-d H:i:s");
$r[count_all]=0;
$r[count_week]=0;
$r[count_month]=0;
$r[count_day]=0;
$r[star]=3;
$showdnum=$public_r['defdownnum']?$public_r['defdownnum']:3;
$showonum=$public_r['defonlinenum']?$public_r['defonlinenum']:3;
$editnum=$showdnum;
$oeditnum=$showonum;
//----------会员组
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($phome=="EditSoft")
	{
		if($r[foruser]==$l_r[groupid])
		{$select=" selected";}
		else
		{$select="";}
	}
	else
	{
		if($class_r[$classid][groupid]==$l_r[groupid])
		{$select=" selected";}
		else
		{$select="";}
	}
	$group.="<option value=".$l_r[groupid].">".$l_r[groupname]."</option>";
}
$sgroup=$group;
//---------------地址前缀
$url_sql=$empire->query("select urlid,url,urlname from {$dbtbpre}downurl");
while($url_r=$empire->fetch($url_sql))
{
	$durl.="<option value='".$url_r[url]."'>".$url_r[urlname]."</option>";
	$newdurl.="<option value='".$url_r[urlid]."'>".$url_r[urlname]."</option>";
}
if($phome=="EditSoft")
{
	$softid=(int)$_GET[softid];
	$filepass=$softid;
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid' limit 1");
	$url=AdminReturnClassLink($classid)."&nbsp;>&nbsp;修改下载";
	$softtime=date("Y-m-d H:i:s",$r[softtime]);
	$sgroup=str_replace(" value=".$r[foruser].">"," value=".$r[foruser]." selected>",$group);
	$softsay=htmlspecialchars($r[softsay]);
	//标题属性
	if(strstr($r[titlefont],','))
	{
		$tfontr=explode(',',$r[titlefont]);
		$r[titlecolor]=$tfontr[0];
		$r[titlefont]=$tfontr[1];
	}
	//下载地址
	$editnum=0;
	if($r[downpath])
	{
		$j=0;
		$d_record=explode("\r\n",$r[downpath]);
		for($i=0;$i<count($d_record);$i++)
		{
			$j=$i+1;
			$d_field=explode("::::::",$d_record[$i]);
			//权限
			$tgroup=str_replace(" value=".$d_field[2].">"," value=".$d_field[2]." selected>",$group);
			//地址前缀
			$tnewurl=str_replace(" value='".$d_field[4]."'>"," value='".$d_field[4]."' selected>",$newdurl);
			$allpath.="<tr><td width='5%'><div align=center>".$j."</div></td><td width='18%'><div align=left><input name=downname[] type=text id=downname[] value='".$d_field[0]."' size=16></div></td><td width='50%'><select name=thedownqz[]><option value=''>--前缀--</option>".$tnewurl."</select><input name=downpath[] type=text value='".$d_field[1]."' size=30 id=downpath".$j."><a href='#edown' onclick=SpOpenChFile(0,'downpath".$j."')>上传</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'downpath".$j."')>选择</a> <input type=hidden name=pathid[] value=".$j."><input type=checkbox name=delpathid[] value=".$j.">删</td><td width='16%'><div align=center><select name=downuser[] id=select><option value=0>游客</option>".$tgroup."</select></div></td><td width='11%'><div align=center><input name=fen[] type=text id=fen[] value='".$d_field[3]."' size=6></div></td></tr>";
		}
		$editnum=$j;
		$allpath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$allpath."</table>";
	}
	//在线地址
	$oeditnum=0;
	if($r[onlinepath])
	{
		$j=0;
		$od_record=explode("\r\n",$r[onlinepath]);
		for($i=0;$i<count($od_record);$i++)
		{
			$j=$i+1;
			$od_field=explode("::::::",$od_record[$i]);
			//权限
			$tgroup=str_replace(" value=".$od_field[2].">"," value=".$od_field[2]." selected>",$group);
			//地址前缀
			$tnewurl=str_replace(" value='".$d_field[4]."'>"," value='".$d_field[4]."' selected>",$newdurl);
			$allonlinepath.="<tr><td width='5%'><div align=center>".$j."</div></td><td width='18%'><div align=left><input name=odownname[] type=text value='".$od_field[0]."' size=16></div></td><td width='50%'><select name=othedownqz[]><option value=''>--前缀--</option>".$tnewurl."</select><input name=odownpath[] type=text value='".$od_field[1]."' size=30 id=odownpath".$j."><a href='#edown' onclick=SpOpenChFile(0,'odownpath".$j."')>上传</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'odownpath".$j."')>选择</a> <input type=hidden name=opathid[] value=".$j."><input type=checkbox name=odelpathid[] value=".$j.">删</td><td width='16%'><div align=center><select name=odownuser[]><option value=0>游客</option>".$tgroup."</select></div></td><td width='11%'><div align=center><input name=ofen[] type=text value='".$od_field[3]."' size=6></div></td></tr>";
		}
		$oeditnum=$j;
		$allonlinepath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$allonlinepath."</table>";
	}
}
//---------------取得语言
$l_sql=$empire->query("select language,isdefault,languageid from {$dbtbpre}language");
while($l_r=$empire->fetch($l_sql))
{
	if($phome=="EditSoft")
	{
		if($r[language]==$l_r[languageid])
		{$select=" selected";}
		else
		{$select="";}
	}
	else
	{
		if($l_r[isdefault])
		{$select=" selected";}
		else
		{$select="";}
	}
	$l_options.="<option value=".$l_r[languageid].$select.">".$l_r[language]."</option>";
}
//---------------取得软件类型
$t_sql=$empire->query("select softtypeid,softtype,isdefault from {$dbtbpre}softtype");
while($t_r=$empire->fetch($t_sql))
{
	if($phome=="EditSoft")
	{
		if($r[softtype]==$t_r[softtypeid])
		{$select=" selected";}
		else
		{$select="";}
	}
	else
	{
		if($t_r[isdefault])
		{$select=" selected";}
		else
		{$select="";}
	}
	$t_options.="<option value=".$t_r[softtypeid].$select.">".$t_r[softtype]."</option>";
}
//---------------取得软件授权
$s_sql=$empire->query("select sqid,sqname,isdefault from {$dbtbpre}sq");
while($s_r=$empire->fetch($s_sql))
{
	if($phome=="EditSoft")
	{
		if($r[soft_sq]==$s_r[sqid])
		{$select=" selected";}
		else
		{$select="";}
	}
	else
	{
		if($s_r[isdefault])
		{$select=" selected";}
		else
		{$select="";}
	}
	$s_options.="<option value=".$s_r[sqid].$select.">".$s_r[sqname]."</option>";
}
$fj=0;
//---------------取得软件环境
$fj_sql=$empire->query("select fjid,fjname from {$dbtbpre}fj");
while($fj_r=$empire->fetch($fj_sql))
{
	$fj++;
	if($fj%6==0)
	{$br="<br>";}
	else
	{$br="";}
	$fj_check.="<input type=checkbox name=check value='".$fj_r[fjname]."' onclick=\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\">".$fj_r[fjname]."&nbsp;&nbsp;".$br;
}
//---------------专题
$zt_sql=$empire->query("select ztid,ztname from {$dbtbpre}downzt order by ztid");
while($zt_r=$empire->fetch($zt_sql))
{
	$selected='';
	if($r[ztid]==$zt_r[ztid])
	{
		$selected=' selected';
	}
	$zts.="<option value='".$zt_r[ztid]."'".$selected.">".$zt_r[ztname]."</option>";
}
//---------------播放器
$player_sql=$empire->query("select id,player from {$dbtbpre}downplayer");
while($player_r=$empire->fetch($player_sql))
{
	$select_player='';
	if($r[playerid]==$player_r[id])
	{
		$select_player=' selected';
	}
	$player_class.="<option value='".$player_r[id]."'".$select_player.">".$player_r[player]."</option>";
}
//字母
$word_r=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
for($i=0;$i<count($word_r);$i++)
{
	if($word_r[$i]==$r[zm])
	{
		$selected=' selected';
	}
	else
	{
		$selected='';
	}
	$zms.="<option value='".$word_r[$i]."'".$selected.">".$word_r[$i]."</option>";
}
//表单
$formtype=$cr[formtype]?$cr[formtype]:1;
$formfile="../data/form/".$formtype.".php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加软件</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
//运行环境
function AddFj(str){
	var r;
	var a;
	a=document.add.soft_fj.value;
	r=a.split(str);
	if(r.length!=1)
	{return true;}
	document.add.soft_fj.value+="/"+str;
}
function DelFj(str){
	var a;
	a=document.add.soft_fj.value;
	document.add.soft_fj.value=a.replace("/"+str,"");
}

//下载地址
function doadd(){
	var i;
	var str="";
	var oldi=0;
	var j=0;
	oldi=parseInt(document.add.editnum.value);
	for(i=1;i<=document.add.downnum.value;i++)
	{
		j=i+oldi;
		str=str+"<tr><td width='5%'> <div align=center>"+j+"</div></td><td width='18%'><div align=left><input name=downname[] type=text id=downname[] value=下载地址"+j+" size=16></div></td><td width='50%'><select name=thedownqz[]><option value=''>--前缀--</option><?=$newdurl?></select><input name=downpath[] type=text size=30 id=downpath"+j+"><a href='#edown' onclick=SpOpenChFile(0,'downpath"+j+"')>上传</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'downpath"+j+"')>选择</a></td><td width='16%'><div align=center><select name=downuser[] id=select><option value=0>游客</option><?=$group?></select></div></td><td width='11%'><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>";
	}
	document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}

//在线地址
function dooadd(){
	var i;
	var str="";
	var oldi=0;
	var j=0;
	oldi=parseInt(document.add.oeditnum.value);
	for(i=1;i<=document.add.odownnum.value;i++)
	{
		j=i+oldi;
		str=str+"<tr><td width='5%'> <div align=center>"+j+"</div></td><td width='18%'><div align=left><input name=odownname[] type=text value="+j+" size=16></div></td><td width='50%'><select name=othedownqz[]><option value=''>--前缀--</option><?=$newdurl?></select><input name=odownpath[] type=text size=30 id=odownpath"+j+"><a href='#edown' onclick=SpOpenChFile(0,'odownpath"+j+"')>上传</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'odownpath"+j+"')>选择</a></td><td width='16%'><div align=center><select name=odownuser[] id=select><option value=0>游客</option><?=$group?></select></div></td><td width='11%'><div align=center><input name=ofen[] type=text value=0 size=6></div></td></tr>";
	}
	document.getElementById("addonline").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}

function foreColor(){
  if (!Error())	return;
  var arr = showModalDialog("editor/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.add.titlecolor.value=arr;
  else document.add.titlecolor.focus();
}

function doSpChangeFile(name,url,filesize,filetype,idvar){
	document.getElementById(idvar).value=url;
	if(document.add.filetype!=null)
	{
		if(document.add.filetype.value=='')
		{
			document.add.filetype.value=filetype;
		}
	}
	if(document.add.filesize!=null)
	{
		if(document.add.filesize.value=='')
		{
			document.add.filesize.value=filesize;
		}
	}
}

function SpOpenChFile(type,field){
	window.open('TranFile.php?classid=<?=$classid?>&filepass=<?=$filepass?>&field='+field+'&softname='+document.add.softname.value,'','width=450,height=200,scrollbars=yes');
}

function SpOpenChFilePath(type,field){
	window.open('ChangeFile.php?classid=<?=$classid?>&filepass=<?=$filepass?>&field='+field+'&softname='+document.add.softname.value,'','width=760,height=600,scrollbars=yes');
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="ReForm" method="get" action="infophome.php">
  <tr> 
    <td height="25">位置：
      <?=$url?>
    </td>
      <td width="30%">
<div align="right"> 
          <select name="dore">
          <option value="1">生成当前分类</option>
          <option value="2">生成首页</option>
          <option value="3">生成父分类</option>
          <option value="4">生成当前分类与父分类</option>
          <option value="5">生成父分类与首页</option>
          <option value="6" selected>生成当前分类、父分类与首页</option>
        </select>
        <input type="button" name="Submit12" value="提交" onclick="self.location.href='infophome.php?phome=AddSoftToReHtml&classid=<?=$classid?>&dore='+document.ReForm.dore.value;">
      </div></td>
  </tr>
  </form>
</table>
<?php
include($formfile);
?>
</body>
</html>
<?
db_close();
$empire=null;
?>
