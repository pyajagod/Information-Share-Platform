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
$t=$_GET['t'];
$phome=$_GET['phome'];
$time=$_GET['time'];
$url="<a href='ListAd.php'>广告管理</a>&nbsp;>&nbsp;增加广告";
//初始化数据
$r[starttime]=date("Y-m-d");
$r[endtime]=date("Y-m-d",time()+30*24*3600);
$r[pic_width]=468;
$r[pic_height]=60;
//修改广告
if($phome=="EditAd")
{
	$adid=(int)$_GET['adid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downad where adid='$adid'");
	$url="<a href=ListAd.php>管理广告</a>&nbsp;>&nbsp;修改广告：<b>".$r[title]."</b>";
	$a="adtype".$r[adtype];
	$$a=" selected";
	if($r[target]=="_blank")
	{$target1=" selected";}
	elseif($r[target]=="_self")
	{$target2=" selected";}
	else
	{$target3=" selected";}
	$t=$r[t];
}
//广告模式
if(strlen($_GET[changet])!=0)
{
	$t=$_GET['changet'];
}
//广告类别
$sql=$empire->query("select classid,classname from {$dbtbpre}downadclass");
while($cr=$empire->fetch($sql))
{
	if($r[classid]==$cr[classid])
	{$s=" selected";}
	else
	{$s="";}
	$options.="<option value=".$cr[classid].$s.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>广告管理</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function foreColor()
{
  if (!Error())	return;
  var arr = showModalDialog("editor/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.form1.titlecolor.value=arr;
  else document.form1.titlecolor.focus();
}
</script>
<script src=editor/setday.js></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="30%" height="25">位置： 
      <?=$url?>
    </td>
    <td><table width="500" border="0" align="right" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="25"> <div align="center">[<a href="AddAd.php?phome=AddAd&t=0"><strong>增加图片/FLASH广告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=1"><strong>增加文字广告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=2"><strong>增加HTML广告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=3"><strong>增加弹出广告</strong></a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td><div align="center"> 
        <?
	//文字广告
	if($t==1)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">增加文字广告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>广告模式：</strong></td>
              <td height="25"><select name="changet" id="changet" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">图片/FLASH广告</option>
                  <option value="1" selected>文字广告</option>
                  <option value="2">HTML广告</option>
                  <option value="3">弹出广告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告分类：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit3" value="管理分类" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">广告名称：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (如：网站Banner广告)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告类型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通显示</option>
                  <option value="3"<?=$adtype3?>>可移动透明对话框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">文字：</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td width="51%">属性： 
                      <input name="titlefont[b]" type="checkbox" id="titlefont[b]" value="b"<?=strstr($r[titlefont],'b|')?' checked':''?>>
                      粗体 
                      <input name="titlefont[i]" type="checkbox" id="titlefont[i]" value="i"<?=strstr($r[titlefont],'i|')?' checked':''?>>
                      斜体 
                      <input name="titlefont[s]" type="checkbox" id="titlefont[s]" value="s"<?=strstr($r[titlefont],'s|')?' checked':''?>>
                      删除线</td>
                    <td width="49%">颜色： 
                      <input name="titlecolor" type="text" id="titlecolor" value="<?=$r[titlecolor]?>" size="10">
                      <a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
                  </tr>
                </table></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">链接地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                显示原链接</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>在新窗口打开</option>
                  <option value="_self"<?=$target2?>>在原窗口打开</option>
                  <option value="_parent"<?=$target3?>>在父窗口打开</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">规格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (宽×高)[可移动透明对话框有效]</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">提示文字：</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">过期时间：</td>
              <td height="25">从 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 (格式：2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置点击数：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">简单注释：</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//html广告
	elseif($t==2)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">增加HTML广告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>广告模式：</strong></td>
              <td height="25"><select name="changet" id="select2" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">图片/FLASH广告</option>
                  <option value="1">文字广告</option>
                  <option value="2" selected>HTML广告</option>
                  <option value="3">弹出广告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告分类：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit32" value="管理分类" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">广告名称：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (如：网站Banner广告)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告类型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通显示</option>
                  <option value="3"<?=$adtype3?>>可移动透明对话框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">规格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]2" type="text" id="add[pic_height]2" value="<?=$r[pic_height]?>" size="4">
                (宽×高)[可移动透明对话框有效]</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">HTML代码：</td>
              <td height="25"> <textarea name="add[htmlcode]" cols="42" rows="8" id="add[htmlcode]"><?=htmlspecialchars($r[htmlcode])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">过期时间：</td>
              <td height="25">从 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 (格式：2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置点击数：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">简单注释：</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//弹出广告
	elseif($t==3)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">增加弹出广告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]3" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>广告模式：</strong></td>
              <td height="25"><select name="changet" id="select3" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">图片/FLASH广告</option>
                  <option value="1">文字广告</option>
                  <option value="2">HTML广告</option>
                  <option value="3" selected>弹出广告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告分类：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit33" value="管理分类" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">广告名称：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (如：网站Banner广告)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告类型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="8"<?=$adtype8?>>打开新窗口</option>
                  <option value="9"<?=$adtype9?>>弹出新窗口</option>
                  <option value="10"<?=$adtype10?>>普通网页对话框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">弹出地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">规格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (宽×高)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">过期时间：</td>
              <td height="25">从 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 (格式：2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置点击数：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">简单注释：</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//图片/flash广告
	else
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">增加图片/FLASH广告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]4" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>广告模式：</strong></td>
              <td height="25"><select name="changet" id="select4" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0" selected>图片/FLASH广告</option>
                  <option value="1">文字广告</option>
                  <option value="2">HTML广告</option>
                  <option value="3">弹出广告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告分类：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit34" value="管理分类" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">广告名称：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (如：网站Banner广告)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">广告类型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通显示</option>
                  <option value="4"<?=$adtype4?>>满屏浮动显示</option>
                  <option value="5"<?=$adtype5?>>上下浮动显示 - 右</option>
                  <option value="6"<?=$adtype6?>>上下浮动显示 - 左</option>
                  <option value="7"<?=$adtype7?>>全屏幕渐隐消失</option>
                  <option value="3"<?=$adtype3?>>可移动透明对话框</option>
                  <option value="11"<?=$adtype11?>>对联式广告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">图片/FLASH地址：</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42">
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">规格：</td>
              <td height="25"> <input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (宽×高)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">链接地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                显示原链接</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>在新窗口打开</option>
                  <option value="_self"<?=$target2?>>在原窗口打开</option>
                  <option value="_parent"<?=$target3?>>在父窗口打开</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">提示文字：</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>">
                (FLASH广告无效)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">过期时间：</td>
              <td height="25">从 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 (格式：2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置点击数：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">简单注释：</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?
	}
	?>
      </div></td>
  </tr>
</table>
</body>
</html>
