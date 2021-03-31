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
CheckLevel($myuserid,$myusername,$classid,"changedata");
//--------------------操作的栏目
$fcfile="../data/fc/downclass.js";
$do_class="<script src='../data/fc/downclass.js'></script>";
if(!file_exists($fcfile))
{
	$do_class=ShowClass_AddClass("","n",0,"|-",0);
}
//选择日期
$todaydate=date("Y-m-d");
$todaytime=time();
$changeday="<select name=selectday onchange=\"document.reform.startday.value=this.value;document.reform.endday.value='".$todaydate."'\">
<option value='".$todaydate."'>--选择--</option>
<option value='".$todaydate."'>今天</option>
<option value='".ToChangeTime($todaytime,7)."'>一周</option>
<option value='".ToChangeTime($todaytime,30)."'>一月</option>
<option value='".ToChangeTime($todaytime,90)."'>三月</option>
<option value='".ToChangeTime($todaytime,180)."'>半年</option>
<option value='".ToChangeTime($todaytime,365)."'>一年</option>
</select>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>数据更新管理</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script src="editor/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：数据更新管理</td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header"> 
    <td height="25"> <div align="center">一键全站生成</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
        <input type="button" name="Submit22222222" value="点击进行全站生成" onclick="if(confirm('确认要全站生成?')){window.open('chtmlphome.php?phome=ReIndex&OneReAll=1');}">
      </div></td>
  </tr>
  <tr>
    <td height="25" bgcolor="#FFFFFF"><div align="center">说明：全站生成将生成网站所有页面，此功能非常耗系统资源，一般为整站迁移时使用。</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="3"><div align="center">页面生成管理</div></td>
  </tr>
  <tr> 
    <td width="34%" height="25"> 
      <div align="center"><strong>基本页面</strong></div></td>
    <td width="33%"> <div align="center"><strong>专题页面</strong></div></td>
    <td width="33%"><div align="center"><strong>其他更新</strong></div></td>
  </tr>
  <tr> 
    <td width="34%" height="25" valign="top" bgcolor="#FFFFFF"> 
      <div align="center"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="45%" height="46"> 
              <div align="center"> 
                <input type="button" name="Submit2" value="生成首页" onclick="self.location.href='chtmlphome.php?phome=ReIndex'">
              </div></td>
            <td>(<a href="../" target="_blank">网站首页</a>)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit24" value="生成分类导航" onclick="self.location.href='chtmlphome.php?phome=ReSoftClass'">
              </div></td>
            <td>(<a href="<?=EDReturnClassNavUrl()?>" target="_blank">分类导航</a>)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit22" value="生成所有分类列表" onclick="window.open('chtmlphome.php?phome=ReHtml_all&from=ChangeData.php');">
              </div></td>
            <td>(分类列表)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit42" value="生成所有内容页面" onclick="window.open('chtmlphome.php?phome=ReSoftHtml&start=0&from=ChangeData.php');">
              </div></td>
            <td>(所有内容页面)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input name="Submit3" type="button" value="生成所有下载调用" onclick="window.open('chtmlphome.php?phome=ReListJs&do=class&from=ChangeData.php');">
              </div></td>
            <td>(总体/分类/专题/软件类型JS)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit23" value="生成所有分类导航" onclick="window.open('chtmlphome.php?phome=ReClassJS_all&do=class&from=ChangeData.php');">
              </div></td>
            <td>(分类导航JS)</td>
          </tr>
        </table>
      </div></td>
    <td width="33%" valign="top" bgcolor="#FFFFFF"> 
      <div align="center"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="45%" height="46"> 
              <div align="center"> 
                <input type="button" name="Submit222" value="生成专题列表" onclick="window.open('chtmlphome.php?phome=ReZtlistAll&from=ChangeData.php');">
              </div></td>
            <td>(专题列表)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit2222" value="软件类型列表" onclick="window.open('chtmlphome.php?phome=ReSoftTypelistAll&from=ChangeData.php');">
              </div></td>
            <td>(软件类型列表)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit22222" value="字母导航列表" onclick="window.open('chtmlphome.php?phome=ReZmlistAll&from=ChangeData.php');">
              </div></td>
            <td>(字母导航列表)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit222222" value="生成自定义列表" onclick="window.open('chtmlphome.php?phome=ReUserlistAll&from=ChangeData.php');">
              </div></td>
            <td>(所有自定义列表)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center">
                <input type="button" name="Submit2222223" value="生成自定义页面" onclick="window.open('chtmlphome.php?phome=ReUserpageAll&from=ChangeData.php');">
              </div></td>
            <td>(所有自定义页面)</td>
          </tr>
          <tr> 
            <td height="46"><div align="center">
                <input type="button" name="Submit2222222" value="更新动态页面" onclick="self.location.href='chtmlphome.php?phome=ChangeDtPage';">
              </div></td>
            <td>(搜索页、搜索表单、登陆状态调用、控制面板、公告)</td>
          </tr>
        </table>
      </div></td>
    <td width="33%" valign="top" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="45%" height="46">
<div align="center"> 
              <input type="button" name="Submit" value="更新数据库缓存" onclick="self.location.href='phome.php?phome=ReSoftData';">
            </div></td>
          <td>(更新数据库缓存)</td>
        </tr>
        <tr> 
          <td height="46"><div align="center">
              <input type="button" name="Submit43" value="更新分类关系" onclick="self.location.href='classphome.php?phome=ChangeSonclass';">
            </div></td>
          <td><p>(转移分类后使用)</p>
            </td>
        </tr>
        <tr> 
          <td height="46"><div align="center">
              <input type="button" name="Submit22222232" value="批量生成广告JS" onclick="window.open('ListAd.php?phome=ReAdJs_all&from=ChangeData.php');">
            </div></td>
          <td>(生成广告JS调用)</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<form action="chtmlphome.php" method="get" name="reform" target="_blank" onsubmit="return confirm('确认要刷新?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"> <div align="center">按条件生成软件内容页面</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">生成分类</td>
              <td height="25"><select name="classid" id="classid">
                  <option value="0">所有分类</option>
                  <?=$do_class?>
                </select> <font color="#666666">（如选择大分类类，将生成所有子分类）</font></td>
            </tr>
            <tr> 
              <td width="27%" height="25"> <input name="retype" type="radio" value="0" checked>
                按时间生成：</td>
              <td width="73%" height="25">从 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                到 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                之间的数据 
                <?=$changeday?>
                <font color="#666666">（不填将生成所有页面）</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                按ID生成：</td>
              <td height="25">从 
                <input name="startid" type="text" id="startid" value="0" size="6">
                到 
                <input name="endid" type="text" id="endid" value="0" size="6">
                之间的数据<font color="#666666">（如两个值为0将生成所有页面）</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit6" value="开始刷新"> 
                <input type="reset" name="Submit7" value="重置"> 
                <input name="phome" type="hidden" id="phome" value="ReSoftHtml"> 
                <input name="from" type="hidden" id="from" value="ChangeData.php"></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
  <br>
</body>
</html>
<?
db_close();
$empire=null;
?>
