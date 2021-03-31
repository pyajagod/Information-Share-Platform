<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>后台地图</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function GoToUrl(url,totarget){
	if(totarget=='')
	{
		totarget='edmain';
	}
	opener.document.getElementById(totarget).src=url;
	window.close();
}
</script>
</head>

<body leftmargin="0" topmargin="0">
<table width="100%" height="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25">下载管理</td>
    <td width="12%">总体设置</td>
    <td width="25%">分类管理</td>
    <td width="27%">模板管理</td>
    <td width="12%">用户管理</td>
    <td width="12%">其他管理</td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><a href="#down" onclick="GoToUrl('ListAllSoft.php','');">管理下载</a></td>
        </tr>
        <tr> 
          <td><a href="#edown" onclick="GoToUrl('ListAllSoft.php','');">增加下载</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong><a href="#edown" onclick="GoToUrl('public.php','');">总体设置</a></strong></td>
        </tr>
        <tr> 
          <td><strong><a href="#edown" onclick="GoToUrl('ChangeData.php','');">生成页面管理</a></strong></td>
        </tr>
        <tr> 
          <td><strong>备份/恢复数据</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ChangeDb.php','');">备份数据</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ReData.php','');">恢复数据</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ChangePath.php','');">管理备份目录</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="50%"><strong>下载相关管理</strong></td>
          <td><strong>下载属性管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListError.php','');">管理错误报告</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('language.php','');">管理软件语言</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListAllPl.php','');">管理评论</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('softtype.php','');">管理软件类型</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListAllSoft.php?sear=1&showspecial=3','');">审核下载</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('sq.php','');">管理软件授权</a></td>
        </tr>
        <tr> 
          <td><strong>分类管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('fj.php','');">管理软件环境</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddClass.php?phome=AddClass','');">增加分类</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('url.php','');">管理地址前缀</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListClass.php','');">管理分类</a></td>
          <td> &nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('player.php','');">管理播放器</a></td>
        </tr>
        <tr> 
          <td><strong>专题管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('RepIp.php','');">批量替换地址</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddZt.php?phome=AddZt','');">增加专题</a></td>
          <td><strong>其他管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListZt.php','');">管理专题</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListGg.php','');">管理公告</a></td>
        </tr>
        <tr> 
          <td><strong>附件管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListUserlist.php','');">自定义列表</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListFile.php','');">数据库式管理附件</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListPage.php','');">自定义页面</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListFilePath.php','');">目录式管理附件</a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="41%"><a href="#edown" onclick="GoToUrl('TempGroup.php','');"><strong>导入/导出模板</strong></a></td>
          <td width="59%"><strong>公共模板</strong></td>
        </tr>
        <tr> 
          <td><strong>模板变量管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=indextemp','');">修改首页模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddTempvar.php?phome=AddTempvar','');">增加模板变量</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=softclasstemp','');">修改分类导航模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTempvar.php','');">管理模板变量</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchtemp','');">修改搜索模板</a></td>
        </tr>
        <tr> 
          <td><strong>列表模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchformtemp','');">修改搜索表单模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddListtemp.php?phome=AddListtemp','');">增加列表模板</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=ggtemp','');">修改公告列表模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListListtemp.php','');">管理列表模板</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=cptemp','');">修改控制面板模板</a></td>
        </tr>
        <tr> 
          <td><strong>内容模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=classjstemp','');">修改下载JS模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddSofttemp.php?phome=AddSofttemp','');">增加内容模板</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=navtemp','');">修改分类导航JS模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListSofttemp.php','');">管理内容模板</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=otherlinktemp','');">修改相关链接模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=ggjstemp','');">修改公告JS模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchjstemp1','');">修改横向搜索JS模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchjstemp2','');">修改纵向搜索JS模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=votetemp','');">修改投票模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=downsofttemp','');">修改下载地址模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=onlinesofttemp','');">修改在线地址模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=listpagetemp','');">修改列表分页模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=loginiframe','');">修改框架登陆状态模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=loginjstemp','');">修改JS登陆状态模板</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>管理员管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('EditPassword.php','');">修改密码</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListUser.php','');">管理用户</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListGroup.php','');">管理用户组</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListLog.php','');">管理登陆日志</a></td>
        </tr>
        <tr> 
          <td><strong>会员管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListMember.php','');">管理会员</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListMemberGroup.php','');">管理会员组</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('GetDown.php','');">批量赠送点数</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DelDownRecord.php','');">删除下载备份</a></td>
        </tr>
        <tr> 
          <td><strong>点卡管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddCard.php?phome=AddCard','');">增加点卡</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddMoreCard.php','');">批量增加点卡</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListCard.php','');">管理点卡</a></td>
        </tr>
        <tr>
          <td><strong>在线支付</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListBuyGroup.php','');">管理充值类型</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/PayApi.php','');">管理支付接口</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/ListPayRecord.php','');">管理支付记录</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>广告管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AdClass.php','');">管理广告类别</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddAd.php?phome=AddAd','');">增加广告</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListAd.php','');">管理广告</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListAd.php?time=1','');">管理过期广告</a></td>
        </tr>
        <tr> 
          <td><strong>友情链接管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddLink.php?phome=AddLink','');">增加友情链接</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListLink.php','');">管理友情链接</a></td>
        </tr>
        <tr> 
          <td><strong>投票管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddVote.php?phome=AddVote','');">增加投票</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListVote.php','');">管理投票</a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
