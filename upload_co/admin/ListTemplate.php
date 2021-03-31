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
CheckLevel($myuserid,$myusername,$classid,"template");
$r=$empire->fetch1("select * from {$dbtbpre}downpubtemp limit 1");
db_close();
$empire=null;
$tname=$_GET['tname'];
$jspath=$public_r['sitedown']."data/js/";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>修改模板</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr>
    <td bgcolor="#FFFFFF">模板修改技巧：先用Dreamweaver修改完模板，然后在复制到相应的文本框中。</td>
  </tr>
</table>
<?php
if($tname=="indextemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="indextemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改首页模板&nbsp;(<a href="../" target=_blank>预览</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[indextemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="indextemp">
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td><strong><font color="#0000FF">软件调用操作类型说明：</font></strong></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="25%">调用所有（分类ID=0）</td>
                  <td width="25%">分类调用（分类ID=分类ID）</td>
                  <td width="25%">专题调用（分类ID=专题ID）</td>
                  <td width="25%">软件类型调用（分类ID=软件类型ID）</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>0：所有下载最新</td>
                  <td>6：分类最新</td>
                  <td>12：专题最新</td>
                  <td>18：软件类型最新</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>1：所有下载推荐</td>
                  <td>7：分类推荐</td>
                  <td>13：专题推荐</td>
                  <td>19：软件类型推荐</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>2：所有总下载排行</td>
                  <td>8：分类总下载排行</td>
                  <td>14：专题总下载排行</td>
                  <td>20：软件类型总排行</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>3：所有月下载排行</td>
                  <td>9：分类月下载排行</td>
                  <td>15：专题月下载排行</td>
                  <td>21：软件类型月排行</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>4：所有周下载排行</td>
                  <td>10：分类周下载排行</td>
                  <td>16：专题周下载排行</td>
                  <td>22：软件类型周排行</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>5：所有日下载排行</td>
                  <td>11：分类日下载排行</td>
                  <td>17：专题日下载排行</td>
                  <td>23：软件类型日排行</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td height="23"><strong><font color="#0000FF">文字调用标签说明：[phomedown]分类ID,显示条数,软件名称截取数,是否显示时间,操作类型,是否显示分类名,'时间格式'[/phomedown]</font></strong></td>
          </tr>
          <tr>
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">分类ID</td>
                  <td width="88%">要调用的分类ID/专题ID/软件类型ID(查看类别ID号点<a href="ListClass.php" target="_blank"><strong>这里</strong></a>/专题ID点<a href="ListZt.php" target="_blank"><strong>这里</strong></a>/软件类型ID号点<a href="softtype.php" target="_blank"><strong>这里</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>显示条数</td>
                  <td>调用软件数量</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>软件名称截取字数</td>
                  <td>截取软件名称字数</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>是否显示时间</td>
                  <td>1为显示，0为不显示</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>操作类型</td>
                  <td>详细看上面的软件调用操作类型说明</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>是否显示分类名</td>
                  <td>是否在软件名称前面显示分类名称</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>时间格式</td>
                  <td>时间格式形式：Y-m-d H:i:s．默认为：'(m-d)'，如：“Y-m-d”为“2008-08-08”</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">图片调用标签说明：[downpic]分类ID,显示总条数,每行图片数,图片宽度,图片高度,是否显示软件名,软件名截取长度,操作类型[/downpic]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">分类ID</td>
                  <td width="88%">要调用的分类ID/专题ID/软件类型ID(查看类别ID号点<a href="ListClass.php" target="_blank"><strong>这里</strong></a>/专题ID点<a href="ListZt.php" target="_blank"><strong>这里</strong></a>/软件类型ID号点<a href="softtype.php" target="_blank"><strong>这里</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>显示总条数</td>
                  <td>调用软件总数量</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>每行图片数</td>
                  <td>每行显示几个图片</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>图片宽度</td>
                  <td>显示图片的宽度</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>图片高度</td>
                  <td>显示图片的高度</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>是否显示软件名称</td>
                  <td>0为不显示，1为显示</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>软件名称截取字数</td>
                  <td>截取软件名称字数</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td>操作类型</td>
                  <td>详细看上面的软件调用操作类型说明</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">灵动标签使用说明：[<b>e:loop</b>]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="12%">格式:</td>
                  <td width="88%">
<textarea name="textfdsf" cols="80" rows="4" id="textfdsf" style="width:100%">[e:loop={分类ID,显示条数,操作类型,只显示有预览图的软件}]
模板代码内容
[/e:loop]</textarea></td>
                </tr>
                <tr> 
                  <td>例子:</td>
                  <td><textarea name="textareafd" cols="80" rows="9" id="textareafd" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:loop={分类ID,显示条数,操作类型,只显示有预览图的软件}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[softurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[softname]?&gt;&lt;/a&gt;
(&lt;?=date("Y-m-d",$bqr[softtime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:loop]
&lt;/table&gt;</textarea></td>
                </tr>
              </table>
              <strong>标签参数说明</strong> 
              <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">分类ID</td>
                  <td width="88%">要调用的分类ID/专题ID/软件类型ID(查看类别ID号点<a href="ListClass.php" target="_blank"><strong>这里</strong></a>/专题ID点<a href="ListZt.php" target="_blank"><strong>这里</strong></a>/软件类型ID号点<a href="softtype.php" target="_blank"><strong>这里</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>显示条数</td>
                  <td>调用软件数量</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>操作类型</td>
                  <td>详细看上面的软件调用操作类型说明</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>只显示有图片的下载</td>
                  <td>0为不限制，1为只显示有预览图的下载</td>
                </tr>
              </table>
              <strong>标签变量说明</strong><br>
              <table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
                <tbody>
                  <tr> 
                    <td width="12%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                    <td height="25" bgcolor="#ffffff">$bqr[字段名]：显示字段的内容</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                    <td height="25" bgcolor="#ffffff">$bqsr[softurl]：软件链接<br>
                      $bqsr[classname]：分类名称<br>
                      $bqsr[classurl]：分类链接</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                    <td height="25" bgcolor="#ffffff">$bqno：为调用序号</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                    <td height="25" bgcolor="#ffffff">$public_r[sitedown]：网站地址</td>
                  </tr>
                </tbody>
              </table>
              <strong>常用函数介绍</strong>
              <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td>文字截取：<strong>esub(字符串,截取长度)</strong>，例子：esub($bqr[softname],30)截取软件名称前30个字符<br>
                    时间格式：<strong>date(&quot;格式字串&quot;,时间字段)</strong>，例子：date(&quot;Y-m-d&quot;,$bqr[softtime])时间显示格式为&quot;2009-10-01&quot;</td>
                </tr>
              </table> </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">数据统计标签:[downtotal]分类ID,操作类型,时间范围[/downtotal]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td>操作类型</td>
                  <td>0为总软件数，1为统计分类软件数，2为统计专题软件数，3为软件类型软件数，4为总下载数</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">分类ID</td>
                  <td width="88%">要调用的分类ID/专题ID/软件类型ID(查看类别ID号点<a href="ListClass.php" target="_blank"><strong>这里</strong></a>/专题ID点<a href="ListZt.php" target="_blank"><strong>这里</strong></a>/软件类型ID号点<a href="softtype.php" target="_blank"><strong>这里</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>时间范围</td>
                  <td>0为不限，1为今日更新数，2为本月更新数，3为本年更新数</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">广告标签说明：[downad]广告ID[/downad]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">广告ID</td>
                  <td width="88%">查看广告ID号点<strong><a href="ListAd.php" target="_blank">这里</a></strong></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"> <strong><font color="#0000FF">投票标签说明:[downvote]投票ID[/downvote]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">投票ID</td>
                  <td width="88%">查看投票ID，点<strong><a href="ListVote.php" target="_blank">这里</a></strong></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"> <strong><font color="#0000FF">友情链接标签说明：[downlink]每行显示数,显示总数,操作类型,是否显示原链接[/downlink]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td>每行显示数</td>
                  <td>每行显示多少个友情链接</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">显示总数</td>
                  <td width="88%">显示总的友情链接数</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>操作类型</td>
                  <td>0所有链接，1为图片链接，2文字链接</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td>是否显示原链接</td>
                  <td><strong></strong>0为统计链接,1为直接显示原链接</td>
                </tr>
              </table></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="softclasstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="softclasstemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改分类导航页面模板&nbsp;[<a href="<?=EDReturnClassNavUrl()?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[softclasstemp]))?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">每行显示：
          <input name="softclassnum" type="text" id="softclassnum" value="<?=$r[softclassnum]?>" size="12">
          背景颜色： 
          <input name="softclassbgcolor" type="text" id="softclassbgcolor" value="<?=$r[softclassbgcolor]?>" size="12">
          单元格颜色：
          <input name="softclasstdcolor" type="text" id="softclasstdcolor" value="<?=$r[softclasstdcolor]?>" size="12">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="softclasstemp">
          <input type="reset" name="Submit25" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 说明：<br>
        在显示分类的地方加上&quot;[!--empiredown.template--]&quot;<br>
        显示&quot;您的位置&quot;的地方加上&quot;[!--empiredown.url--]&quot; <br>
        分类列表： [!--class.menu--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchtemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改搜索列表模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchtemp]))?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">软件名截取字数：
          <input name="schsubtitle" type="text" id="schsubtitle" value="<?=$r[schsubtitle]?>" size="6">
          简介截取字数： 
          <input name="schsubsay" type="text" id="schsubsay" value="<?=$r[schsubsay]?>" size="6">
          时间格式： 
          <input name="schformatdate" type="text" id="schformatdate" value="<?=$r[schformatdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchtemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>变量说明：</strong><br>
        站点地址：[!--edown.url--]，页面导航：[!--empiredown.url--]，页面标题：[!--pagetitle--]，页面关键字：[!--pagekey--]，页面简介：[!--pagedes--]<br>
        分类导航：[!--empiredown.class--]，热门下载：[!--empiredown.topjs--]，最新下载：[!--empiredown.newjs--]，分页导航[!--show.page--]<br>
        分类列表： [!--class.menu--]，关键字：[!--keyboard--]<br>
        <br>
        软件链接:[!--softurl--]，软件ID:[!--softid--]，软件名称:[!--softname--]，分类ID:[!--classid--]<br>
        分类名称:[!--classname--](带链接)，分类名称:[!--thisclassname--]，分类链接:[!--thisclassurl--]<br>
        所属专题:[!--ztname--]，软件名称ALT:[!--oldsoftname--]，发布时间:[!--softtime--]，软件简介:[!--softsay--]<br>
        文件扩展名:[!--filetype--]，文件大小:[!--filesize--]，预览图:[!--softpic--]，软件版本:[!--soft_version--]<br>
        授权形式:[!--soft_sq--]，软件类型:[!--softtype--]，软件语言:[!--language--]，软件等级:[!--star--]<br>
        下载点数:[!--downfen--]，发布者:[!--adduser--]，作者:[!--writer--]，官方网站:[!--homepage--]<br>
        总下载数:[!--count_all--]，月下载数:[!--count_month--]，周下载数:[!--count_week--]，日下载数:[!--count_day--]<br>
        运行环境:[!--soft_fj--]，演示地址:[!--demo--] <br>
        <br>
        模板格式：软件列表头部[!--empiredown.listtemp--]软件列表内容[!--empiredown.listtemp--]软件列表结尾</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchformtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchformtemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改搜索表单模板&nbsp;[<a href="<?=EDReturnSearchFormUrl()?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchformtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchformtemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><p>说明：<br>
          分类列表： [!--class.menu--] <br>
          网站地址:[!--edown.url--]<br>
          页面导航：[!--empiredown.url--] <br>
          分类:[!--class--]<br>
          专题:[!--zt--] <br>
          软件类型:[!--softtype--]<br>
          软件语言:[!--language--]<br>
          授权类型:[!--soft_sq--]<br>
        </p>
        </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="ggtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ggtemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改公告列表模板&nbsp;[<a href="<?=EDReturnGgUrl()?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[ggtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="ggtemp">
          <input type="reset" name="Submit24" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        模板格式：公告列表头部[!--empiredown.listtemp--]公告列表内容[!--empiredown.listtemp--]公告列表结尾<br>
        标题：[!--title--]，公告内容：[!--ggtext--]，发布时间：[!--ggtime--]，公告ID：[!--ggid--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="cptemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="cptemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改控制面板模板&nbsp;[<a href="../cp" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[cptemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="cptemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        在显示内容的地方加上&quot;[!--empiredown.template--]&quot;<br>
        显示&quot;您的位置&quot;的地方加上&quot;[!--empiredown.url--]&quot; <br>
        分类列表： [!--class.menu--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="classjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="classjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改下载JS模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=stripSlashes($r[classjstemp])?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">时间格式： 
          <input name="classjsshowdate" type="text" id="classjsshowdate" value="<?=$r[classjsshowdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="classjstemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        格式: JS头部[!--empiredown.listtemp--]类别JS内容[!--empiredown.listtemp--]JS尾部<br>
        软件ID:[!--softid--] ,页面链接:[!--softurl--] ,软件名称:[!--softname--] ,软件ALT:[!--oldsoftname--]<br>
        发布时间:[!--softtime--] ,分类ID:[!--classid--] ,分类名称:[!--classname--] ,分类地址:[!--classurl--]<br>
        软件图片:[!--softpic--] ,总下载数:[!--count_all--] ,月下载数:[!--count_month--] ,周下载数:[!--count_week--]<br>
        日下载数:[!--count_day--]，站点地址：[!--edown.url--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="navtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="navtemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改分类导航JS模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[navtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="navtemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        格式: JS头部[!--empiredown.listtemp--]分类导行JS内容[!--empiredown.listtemp--]JS尾部<br>
        分类ID:[!--classid--] ,分类名:[!--classname--] ,分类地址:[!--classurl--] ,软件数:[!--num--]，站点地址：[!--edown.url--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="otherlinktemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="otherlinktemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改相关链接模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[otherlinktemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">截取字数： 
          <input name="otherlinktempsub" type="text" id="otherlinktempsub" value="<?=$r[otherlinktempsub]?>">
          ，时间格式： 
          <input name="otherlinktempdate" type="text" id="otherlinktempdate" value="<?=$r[otherlinktempdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="otherlinktemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        格式: 列表头[!--empiredown.listtemp--]列表内容[!--empiredown.listtemp--]列表尾<br>
        软件名称：[!--softname--]，软件ID：[!--softid--]，发布时间：[!--softtime--]<br>
        软件链接：[!--softurl--]，软件缩图：[!--softpic--]，软件名ALT：[!--oldsoftname--]<br>
        分类名称：[!--classname--]，分类地址：[!--classurl--]，分类ID：[!--classid--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="ggjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ggjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改公告JS模板&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."gg.js";?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[ggjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="ggjstemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        格式: JS头部[!--empiredown.listtemp--]公告JS内容[!--empiredown.listtemp--]JS尾部<br>
        标题：[!--title--]，公告内容：[!--ggtext--]，发布时间：[!--ggtime--]，公告ID：[!--ggid--] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchjstemp1"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchjstemp1">
    <tr class="header"> 
      <td height="25"><div align="center">修改横向搜索JS模板&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."search_soft1.js";?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchjstemp1]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchjstemp1">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        搜索分类:[!--class--]<br>
        网站地址:[!--edown.url--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchjstemp2"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchjstemp2">
    <tr class="header"> 
      <td height="25"><div align="center">修改纵向搜索JS模板&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."search_soft2.js";?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchjstemp2]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchjstemp2">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 说明：<br>
        搜索分类:[!--class--] <br>
        网站地址:[!--edown.url--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="votetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="votetemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改投票模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[votetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="votetemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <strong>变量说明：</strong><br>
        网站地址：[!--edown.url--]，表单提交地址：[!--vote.action--]，标题：[!--title--]，查看投票结果地址：[!--vote.view--]<br>
        投票的ID：[!--voteid--]，投票选项：[!--vote.box--]，投票选项名称：[!--vote.name--] <br>
        弹出投票结果窗口大小：[!--width--](宽度)、[!--height--](高度) </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="downsofttemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="downsofttemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改下载地址模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[downsofttemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="downsofttemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        下载名称:[!--down.name--],弹出下载地址:[!--down.url--],文件真实地址：[!--true.down.url--]，软件名称：[!--softname--]<br>
        下载地址号:[!--pathid--],分类ID:[!--classid--],软件ID:[!--softid--],扣除积分:[!--fen--],下载等级:[!--group--] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="onlinesofttemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="onlinesofttemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改在线观看地址模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[onlinesofttemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="onlinesofttemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">说明：<br>
        观看名称:[!--down.name--],弹出观看地址:[!--down.url--],文件真实地址：[!--true.down.url--]，软件名称：[!--softname--]<br>
        观看地址号:[!--pathid--],分类ID:[!--classid--],软件ID:[!--softid--],扣除积分:[!--fen--],下载等级:[!--group--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="listpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="listpagetemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改列表分页模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[listpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="listpagetemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>模板变量说明：</strong><br>
        本页页码:[!--thispage--], 总页数:[!--pagenum--], 每页显示条数:[!--lencord--] <br>
        总条数:[!--num--], 分页链接:[!--pagelink--], 下拉分页:[!--options--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="loginiframe"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="loginiframe">
    <tr class="header"> 
      <td height="25"><div align="center">框架调用登陆状态模板 (<a href="../iframe" target="_blank">预览</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[loginiframe]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="loginiframe">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>模板格式：</strong>登陆前显示内容[!--empiredown.template--]登陆后显示内容<br> 
        <strong>模板变量说明： </strong><br>
        用户ID:[!--userid--]，用户名:[!--username--]，网站地址：[!--edown.url--]<br>
        会员等级:[!--groupname--]，帐户有效天数:[!--downdate--]，积分:[!--downfen--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="loginjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="loginjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">JS调用登陆状态模板&nbsp;[<a href="view/js.php?classid=1&js=<?=$public_r[sitedown]."iframe/loginjs.php";?>" target=_blank>预览</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[loginjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="loginjstemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>模板格式：</strong>登陆前显示内容[!--empiredown.template--]登陆后显示内容<br> 
        <strong>模板变量说明：</strong> <br>
        用户ID:[!--userid--]，用户名:[!--username--]，网站地址：[!--edown.url--]<br>
        会员等级:[!--groupname--]，帐户有效天数:[!--downdate--]，积分:[!--downfen--]<br> <br> <strong>调用地址：</strong> 
        <input name="textfield132" type="text" id="textfield132" size="60" value="&lt;script src=&quot;<?=$public_r[sitedown]."iframe/loginjs.php";?>&quot;&gt;&lt;/script&gt;">
        [<a href="view/js.php?classid=1&js=<?=$public_r[sitedown]."iframe/loginjs.php";?>" target="_blank">预览</a>] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="downpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="downpagetemp">
    <tr class="header"> 
      <td height="25"><div align="center">修改下载页面模板</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[downpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="修改">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="downpagetemp">
          <input type="reset" name="Submit26" value="重置">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"> 站点地址：[!--edown.url--]，页面导航：[!--empiredown.url--]，分类列表：[!--class.menu--]<br>
        页面标题：[!--pagetitle--]，页面关键字：[!--pagekey--]，页面简介：[!--pagedes--]<br>
        分类导航：[!--empiredown.class--]，热门下载：[!--empiredown.topjs--]，最新下载：[!--empiredown.newjs--]<br>
        分类ID：[!--class.id--]，分类名：[!--class.name--]，父分类ID：[!--bclass.id--]，父分类名：[!--bclass.name--]<br>
        软件ID:[!--softid--]，页面链接:[!--softurl--]，软件名称:[!--softname--]，发布时间:[!--softtime--]<br>
        软件简介:[!--softsay--]，预览图:[!--softpic--]，软件版本:[!--soft_version--]，关键字:[!--keyboard--]<br>
        文件扩展名:[!--filetype--]，文件大小:[!--filesize--]，作者:[!--writer--]，官方网站:[!--homepage--]<br>
        演示地址:[!--demo--]，发布者:[!--adduser--]，软件等级:[!--star--]，运行环境:[!--soft_fj--]<br>
        软件类型:[!--softtype--]，授权形式:[!--soft_sq--]，软件语言:[!--language--]<br>
        下载地址:[!--thisdownpath--]，文件真实地址：[!--thistruedownpath--]，下载地址名称：[!--thisdownname--]<br>
        下载点数:[!--downfen--]，下载级别:[!--foruser--]，总下载数:[!--count_all--]<br>
        月下载数:[!--count_month--]，周下载数:[!--count_week--]，日下载数:[!--count_day--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
