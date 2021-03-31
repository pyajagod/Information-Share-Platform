<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
CheckLevel($lur[userid],$lur[username],$classid,"public");//验证权限

//总体设置
function SetPublic($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"public");//验证权限
	$add[exittime]=(int)$add[exittime];
	if(empty($add[exittime]))
	{
		$add[exittime]=30;
	}
	//备份目录
	if(empty($add[bakdbpath]))
	{
		$add[bakdbpath]="bdata";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbpath])))
	{
		printerror("此备份目录不存在，请重输","history.go(-1)");
	}
	if(empty($add[bakdbzip]))
	{
		$add[bakdbzip]="zip";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbzip])))
	{
		printerror("此压缩目录不存在，请重输","history.go(-1)");
	}
	if($add[change_path])
	{
		$old="../data/".$add[downpath];
		$newpath=make_password(20);
		$new="../data/".$newpath;
		$rename=rename($old,$new);
		$add1=",downpath='$newpath'";
		$empire->query("update {$dbtbpre}down set downpath=REPLACE(downpath,'$add[downpath]','$newpath')");
	}
	$add[trantype]=','.$add[trantype].',';
	$add[imgtrantype]=','.$add[imgtrantype].',';
	$add[qtrantype]=','.$add[qtrantype].',';
	$add[qimgtrantype]=','.$add[qimgtrantype].',';
	$add[transize]=(int)$add[transize];
	$add[topnum]=(int)$add[topnum];
	$add[save_soft]=(int)$add[save_soft];
	$add[relist_num]=(int)$add[relist_num];
	$add[resoft_num]=(int)$add[resoft_num];
	$add[openregister]=(int)$add[openregister];
	$add[openadd]=(int)$add[openadd];
	$add[checked]=(int)$add[checked];
	$add[newnum]=(int)$add[newnum];
	$add[sub_top]=(int)$add[sub_top];
	$add[sub_new]=(int)$add[sub_new];
	$add[defaultgroupid]=(int)$add[defaultgroupid];
	$add[redodown]=(int)$add[redodown];
	$add[reindextime]=(int)$add[reindextime];
	$add[dohtml]=(int)$add[dohtml];
	$add[repnum]=(int)$add[repnum];
	$add[ebakthisdb]=(int)$add[ebakthisdb];
	$add[limittype]=(int)$add[limittype];
	$add[filechmod]=(int)$add[filechmod];
	$add[defdownnum]=(int)$add[defdownnum];
	$add[defonlinenum]=(int)$add[defonlinenum];
	$add[imgtransize]=(int)$add[imgtransize];
	$add[qtransize]=(int)$add[qtransize];
	$add[qimgtransize]=(int)$add[qimgtransize];
	$add[ebakcanlistdb]=(int)$add[ebakcanlistdb];
	$add[retime]=(int)$add[retime];
	$add[openpl]=(int)$add[openpl];
	$add[plsize]=(int)$add[plsize];
	$add[min_userlen]=(int)$add[min_userlen];
	$add[max_userlen]=(int)$add[max_userlen];
	$add[min_passlen]=(int)$add[min_passlen];
	$add[max_passlen]=(int)$add[max_passlen];
	$add[adminloginkey]=(int)$add[adminloginkey];
	$add[registerkey]=(int)$add[registerkey];
	$add[loginkey]=(int)$add[loginkey];
	$add[emailonly]=(int)$add[emailonly];
	$add[opengetdown]=(int)$add[opengetdown];
	$add[plkey]=(int)$add[plkey];
	$add[zmnum]=(int)$add[zmnum];
	$add[zmmaxnum]=(int)$add[zmmaxnum];
	$add[gg_num]=(int)$add[gg_num];
	$add[classnavline]=(int)$add[classnavline];
	$add[regdownfen]=(int)$add[regdownfen];
	$add[dozthtml]=(int)$add[dozthtml];
	$add[memberchecked]=(int)$add[memberchecked];
	$add[checkresoftname]=(int)$add[checkresoftname];
	$add[reuserpagenum]=(int)$add[reuserpagenum];
	$add[zmlisttempid]=(int)$add[zmlisttempid];
	$add[listpagelistnum]=(int)$add[listpagelistnum];
	if($add[reindextime]<12)
	{$add[reindextime]=12;}
	$sql=$empire->query("update {$dbtbpre}downpublic set sitename='$add[sitename]',sitedown='$add[sitedown]',email='$add[email]',trantype='$add[trantype]',transize='$add[transize]',topnum='$add[topnum]',save_soft='$add[save_soft]',relist_num='$add[relist_num]',resoft_num='$add[resoft_num]',openregister='$add[openregister]',openadd='$add[openadd]',checked='$add[checked]',newnum='$add[newnum]',sub_top='$add[sub_top]',sub_new='$add[sub_new]',exittime='$add[exittime]',defaultgroupid='$add[defaultgroupid]',bakdbpath='$add[bakdbpath]',bakdbzip='$add[bakdbzip]',downpass='$add[downpass]',redodown='$add[redodown]',reindextime='$add[reindextime]',dohtml='$add[dohtml]',repnum='$add[repnum]',ebakthisdb='$add[ebakthisdb]',limittype='$add[limittype]',filechmod='$add[filechmod]',defdownnum='$add[defdownnum]',defonlinenum='$add[defonlinenum]',imgtrantype='$add[imgtrantype]',imgtransize='$add[imgtransize]',qtrantype='$add[qtrantype]',qtransize='$add[qtransize]',qimgtrantype='$add[qimgtrantype]',qimgtransize='$add[qimgtransize]',ebakcanlistdb='$add[ebakcanlistdb]',refiletype='$add[refiletype]',relistpath='$add[relistpath]',resoftpath='$add[resoftpath]',retime='$add[retime]',sitekey='$add[sitekey]',siteintro='$add[siteintro]',openpl='$add[openpl]',plsize='$add[plsize]',plcloseword='$add[plcloseword]',closeusername='$add[closeusername]',min_userlen='$add[min_userlen]',max_userlen='$add[max_userlen]',min_passlen='$add[min_passlen]',max_passlen='$add[max_passlen]',adminloginkey='$add[adminloginkey]',registerkey='$add[registerkey]',loginkey='$add[loginkey]',emailonly='$add[emailonly]',opengetdown='$add[opengetdown]',plkey='$add[plkey]',navfh='$add[navfh]',zmnum='$add[zmnum]',zmmaxnum='$add[zmmaxnum]',adfile='$add[adfile]',gg_num='$add[gg_num]',classnavline='$add[classnavline]',classnavfh='$add[classnavfh]',regdownfen='$add[regdownfen]',dozthtml='$add[dozthtml]',memberchecked='$add[memberchecked]',checkresoftname='$add[checkresoftname]',reuserpagenum='$add[reuserpagenum]',zmlisttempid='$add[zmlisttempid]',listpagelistnum='$add[listpagelistnum]'".$add1);
	//更新缓存
	GetPublic();
	if($sql)
	{
		printerror("总体设置成功","public.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if($phome=='SetPublic')
{
	SetPublic($_POST,$lur[userid],$lur[username]);
}

$r=$empire->fetch1("select * from {$dbtbpre}downpublic limit 1");
$r[trantype]=substr($r[trantype],1,strlen($r[trantype])-2);
$r[imgtrantype]=substr($r[imgtrantype],1,strlen($r[imgtrantype])-2);
$r[qtrantype]=substr($r[qtrantype],1,strlen($r[qtrantype])-2);
$r[qimgtrantype]=substr($r[qimgtrantype],1,strlen($r[qimgtrantype])-2);
//会员组
$mgsql=$empire->query("select * from {$dbtbpre}downmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[defaultgroupid]==$mgr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$mgr[groupid].$select.">".$mgr[groupname]."</option>";
}
//列表模板
$zmlisttemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	if($ltr[tempid]==$r[zmlisttempid])
	{$select=" selected";}
	else
	{$select="";}
	$zmlisttemp.="<option value=".$ltr[tempid].$select.">".$ltr[tempname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>总体设置</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>位置：<a href="public.php">总体设置</a></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="public.php">
    <tr class="header"> 
      <td height="25" colspan="2">总体设置 
        <input type=hidden name=old_sitedown value="<?=$r[sitedown]?>"></td>
    </tr>
    <tr> 
      <td width="31%" height="25">站点信息</td>
      <td width="69%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">站点名称:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitename" type="text" id="sitename" value="<?=$r[sitename]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">站点地址:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitedown" type="text" id="sitedown" value="<?=$r[sitedown]?>" size="38"> 
        <font color="#666666">(填edown安装地址，请在后面加上&quot;/&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">站长邮箱:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="email" type="text" id="sitename4" value="<?=$r[email]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">站点关键字:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitekey" type="text" id="email" value="<?=$r[sitekey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">站点简介:</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="siteintro" cols="60" rows="5" id="siteintro"><?=$r[siteintro]?></textarea></td>
    </tr>
    <tr> 
      <td height="25">后台设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台登录超时:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="exittime" type="text" id="exittime" value="<?=$r[exittime]?>" size="38">
        分钟</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台登录验证码:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginkey" type="radio" value="1"<?=$r[adminloginkey]==1?' checked':''?>>
        开启 
        <input name="adminloginkey" type="radio" value="0"<?=$r[adminloginkey]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25">下载管理</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">增加下载直接审核通过:</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        是 
        <input type="radio" name="checked" value="0"<?=$r[checked]==0?' checked':''?>>
        否<font color="#666666">(增加下载时默认选项)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">增加下载后直接生成列表:</td>
      <td height="25" bgcolor="#FFFFFF">分类： 
        <select name="dohtml" style="width:210;">
          <option value="0"<?=$r['dohtml']==0?' selected':''?>>不生成</option>
          <option value="1"<?=$r['dohtml']==1?' selected':''?>>生成当前分类页</option>
          <option value="2"<?=$r['dohtml']==2?' selected':''?>>生成首页</option>
          <option value="3"<?=$r['dohtml']==3?' selected':''?>>生成父分类页</option>
          <option value="4"<?=$r['dohtml']==4?' selected':''?>>生成当前分类页与父分类页</option>
          <option value="5"<?=$r['dohtml']==5?' selected':''?>>生成父分类页与首页</option>
          <option value="6"<?=$r['dohtml']==6?' selected':''?>>生成当前分类页、父分类页与首页</option>
        </select> <font color="#666666">(数据量大的情况下不推荐选择)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">专题： 
        <select name="dozthtml" style="width:210;">
          <option value="0"<?=$r['dozthtml']==0?' selected':''?>>不生成</option>
          <option value="1"<?=$r['dozthtml']==1?' selected':''?>>生成软件类型页</option>
          <option value="2"<?=$r['dozthtml']==2?' selected':''?>>生成专题页</option>
          <option value="3"<?=$r['dozthtml']==3?' selected':''?>>生成字母导航页</option>
          <option value="4"<?=$r['dozthtml']==4?' selected':''?>>生成软件类型页、专题页</option>
          <option value="5"<?=$r['dozthtml']==5?' selected':''?>>生成软件类型页、专题页、字母页</option>
        </select> <font color="#666666">(数据量大的情况下不推荐选择)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">检查重复软件名</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="checkresoftname" value="1"<?=$r[checkresoftname]==1?' checked':''?>>
        是 
        <input type="radio" name="checkresoftname" value="0"<?=$r[checkresoftname]==0?' checked':''?>>
        否</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默认录入下载地址数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="defdownnum" type="text" id="exittime" value="<?=$r[defdownnum]?>" size="38"> 
        <font color="#666666">(增加下载时默认选项)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默认录入在线地址数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="defonlinenum" type="text" id="defdownnum" value="<?=$r[defonlinenum]?>" size="38"> 
        <font color="#666666">(增加下载时默认选项)</font></td>
    </tr>
    <tr> 
      <td height="25">下载设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">同一地址超过:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="redodown" type="text" id="redodown" value="<?=$r[redodown]?>" size="38">
        个小时 将重复扣点<strong></strong></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">下载验证码:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downpass" type="text" id="downpass" value="<?=$r[downpass]?>" size="38"> 
        <font color="#666666">(主要用于防盗链,请定期更新一次密码)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">开启直接下载方式:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetdown" value="1"<?=$r[opengetdown]==1?' checked':''?>>
        开启 
        <input type="radio" name="opengetdown" value="0"<?=$r[opengetdown]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25">生成设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">定时生成首页:</td>
      <td height="25" bgcolor="#FFFFFF">执行时间间隔: 
        <input name="reindextime" type="text" id="reindextime" value="<?=$r[reindextime]?>" size="6">
        分钟<font color="#666666">(小于12分钟系统将视为12分钟)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件扩展名:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="refiletype" type="text" id="refiletype" value="<?=$r[refiletype]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">列表页存放目录:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="relistpath" type="text" id="relistpath" value="<?=$r[relistpath]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">内容页存放目录:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="resoftpath" type="text" id="resoftpath" value="<?=$r[resoftpath]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每组生成列表页记录数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="relist_num" type="text" id="relist_num" value="<?=$r[relist_num]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每组生成内容页记录数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="resoft_num" type="text" id="resoft_num" value="<?=$r[resoft_num]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每组生成自定义页面记录数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="reuserpagenum" type="text" id="reuserpagenum" value="<?=$r[reuserpagenum]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">生成时间间隔:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="retime" type="text" id="retime" value="<?=$r[retime]?>" size="38">
        秒 </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每组替换下载地址数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="repnum" type="text" id="repnum" value="<?=$r[repnum]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">字母导航页</td>
      <td height="25" bgcolor="#FFFFFF">列表模板 
        <select name="zmlisttempid" id="zmlisttempid">
          <?=$zmlisttemp?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每页显示: 
        <input name="zmnum" type="text" id="zmnum" value="<?=$r[zmnum]?>" size="6">
        条，最大记录数: 
        <input name="zmmaxnum" type="text" id="zmmaxnum" value="<?=$r[zmmaxnum]?>" size="6">
        条</td>
    </tr>
    <tr> 
      <td height="25">会员设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">开启注册:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openregister" value="0"<?=$r[openregister]==0?' checked':''?>>
        开启 
        <input type="radio" name="openregister" value="1"<?=$r[openregister]==1?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">会员是否要审核:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="memberchecked" value="0"<?=$r[memberchecked]==0?' checked':''?>>
        直接通过 
        <input type="radio" name="memberchecked" value="1"<?=$r[memberchecked]==1?' checked':''?>>
        需要审核</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">注册会员默认会员组:</td>
      <td height="25" bgcolor="#FFFFFF"><select name="defaultgroupid" id="defaultgroupid">
          <?=$membergroup?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">注册赠送点数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="regdownfen" type="text" id="regdownfen" value="<?=$r[regdownfen]?>" size="38">
        点</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">用户名限制:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="min_userlen" type="text" id="min_userlen" value="<?=$r[min_userlen]?>" size="6">
        ~ 
        <input name="max_userlen" type="text" id="max_userlen" value="<?=$r[max_userlen]?>" size="6">
        个字节</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">密码限制:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="min_passlen" type="text" id="min_userlen3" value="<?=$r[min_passlen]?>" size="6">
        ~ 
        <input name="max_passlen" type="text" id="max_passlen" value="<?=$r[max_passlen]?>" size="6">
        个字节</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">用户名注册限制名称:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="closeusername" type="text" id="repnum3" value="<?=$r[closeusername]?>" size="38"> 
        <font color="#666666">(禁止包含字符,多个用&quot;|&quot;号隔开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">会员邮箱唯一性检查:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="emailonly" type="radio" value="1"<?=$r[emailonly]==1?' checked':''?>>
        开启 
        <input name="emailonly" type="radio" value="0"<?=$r[emailonly]==0?' checked':''?>>
        关闭 </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">注册开启验证码:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="registerkey" type="radio" value="1"<?=$r[registerkey]==1?' checked':''?>>
        开启 
        <input name="registerkey" type="radio" value="0"<?=$r[registerkey]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">登录开启验证码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="loginkey" type="radio" value="1"<?=$r[loginkey]==1?' checked':''?>>
        开启 
        <input name="loginkey" type="radio" value="0"<?=$r[loginkey]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">开启投稿:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openadd" value="0"<?=$r[openadd]==0?' checked':''?>>
        开启 
        <input type="radio" name="openadd" value="1"<?=$r[openadd]==1?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25">评论设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">开启评论:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openpl" value="1"<?=$r[openpl]==1?' checked':''?>>
        开启 
        <input type="radio" name="openpl" value="0"<?=$r[openpl]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">评论验证码:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plkey" type="radio" value="1"<?=$r[plkey]==1?' checked':''?>>
        开启 
        <input name="plkey" type="radio" value="0"<?=$r[plkey]==0?' checked':''?>>
        关闭</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">评论最大字数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plsize" type="text" id="plsize" value="<?=$r[plsize]?>" size="38">
        字节</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">禁止出现的字符:<br> <font color="#666666">(多个请用&quot;<strong>|</strong>&quot;隔开)</font></td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="plcloseword" cols="60" rows="5" id="plcloseword"><?=$r[plcloseword]?></textarea></td>
    </tr>
    <tr> 
      <td height="25">文件设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">附件上传目录:</td>
      <td height="25" bgcolor="#FFFFFF">data/ 
        <input name="downpath" type="text" id="downpath" value="<?=$r[downpath]?>" size="32" readonly> 
        <font color="#666666">(为了安全问题,不可更改)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><input name="change_path" type="checkbox" id="change_path" value="1">
        改变上传目录<font color="#666666">(这个是防盗链时用的.如要修改目录,请打上勾,系统会自动改变目录)</font> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台允许上传附件类型:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="trantype" type="text" id="trantype" value="<?=$r[trantype]?>" size="38"> 
        <font color="#666666">(多个请用&quot;,&quot;隔开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台允许上传附件大小:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="transize" type="text" id="transize" value="<?=$r[transize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台允许上传图片类型:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="imgtrantype" type="text" id="trantype3" value="<?=$r[imgtrantype]?>" size="38"> 
        <font color="#666666">(多个请用&quot;,&quot;隔开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">后台允许上传图片大小:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="imgtransize" type="text" id="transize3" value="<?=$r[imgtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">附件存放是否按日期存放:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="save_soft" value="0"<?=$r[save_soft]==0?' checked':''?>>
        是 
        <input type="radio" name="save_soft" value="1"<?=$r[save_soft]==1?' checked':''?>>
        否<font color="#666666">(如选否，将所有上传的软件放在同一个目录)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">前台允许上传文件类型:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qtrantype" type="text" id="qtrantype" value="<?=$r[qtrantype]?>" size="38"> 
        <font color="#666666">(多个请用&quot;,&quot;隔开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">前台允许上传文件大小:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qtransize" type="text" id="qtransize" value="<?=$r[qtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">前台允许上传图片类型:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qimgtrantype" type="text" id="imgtrantype" value="<?=$r[qimgtrantype]?>" size="38"> 
        <font color="#666666">(多个请用&quot;,&quot;隔开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">前台允许上传图片大小:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qimgtransize" type="text" id="imgtransize" value="<?=$r[qimgtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件生成权限:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="filechmod" value="1"<?=$r[filechmod]==1?' checked':''?>>
        不限制 
        <input type="radio" name="filechmod" value="0"<?=$r[filechmod]==0?' checked':''?>>
        0777 <font color="#666666">(通常情况选择不限制) </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">广告JS文件前缀:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adfile" type="text" id="adfile" value="<?=$r[adfile]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25">数据库备份设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">数据备份存放目录:</td>
      <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
        <input name="bakdbpath" type="text" id="bakdbpath" value="<?=$r[bakdbpath]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">压缩包存放目录:</td>
      <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
        <input name="bakdbzip" type="text" id="bakdbzip" value="<?=$r[bakdbzip]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">备份只选择当前数据库:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ebakthisdb" type="checkbox" id="ebakthisdb" value="1"<?=$r[ebakthisdb]==1?' checked':''?>>
        是</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">空间不支持数据库列表:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ebakcanlistdb" type="checkbox" id="ebakcanlistdb" value="1"<?=$r[ebakcanlistdb]==1?' checked':''?>>
        是<font color="#666666">(如果空间不允许列出数据库,请打勾)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">支持MYSQL查询方式:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="limittype" type="checkbox" id="limittype" value="1"<?=$r[limittype]==1?' checked':''?>>
        支持</td>
    </tr>
    <tr> 
      <td height="25">JS调用设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">最新调用条数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="newnum" type="text" id="newnum" value="<?=$r[newnum]?>" size="6">
        条，截取 
        <input name="sub_new" type="text" id="sub_new" value="<?=$r[sub_new]?>" size="6">
        字节</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">排行调用条数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="topnum" type="text" id="topnum" value="<?=$r[topnum]?>" size="6">
        条，截取 
        <input name="sub_top" type="text" id="sub_top" value="<?=$r[sub_top]?>" size="6">
        字节</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">公告JS调用条数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="gg_num" type="text" id="gg_num" value="<?=$r[gg_num]?>" size="6">
        条</td>
    </tr>
    <tr> 
      <td height="25">其他设置</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">“您的位置”导航间隔字符:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="navfh" type="text" id="navfh" value="<?=htmlspecialchars($r[navfh])?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">分类导航显示个数:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classnavline" type="text" id="classnavline" value="<?=$r[classnavline]?>" size="38"> 
        <font color="#666666">(0为不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">分类导航分隔字符:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classnavfh" type="text" id="navfh3" value="<?=htmlspecialchars($r[classnavfh])?>" size="38"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">列表式分页每页显示:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="listpagelistnum" type="text" id="listpagelistnum" value="<?=$r[listpagelistnum]?>" size="38">
        个链接</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="提交"> 
        <input type="reset" name="Submit2" value="重置"> <input name="phome" type="hidden" id="phome" value="SetPublic"></td>
    </tr>
  </form>
</table>
</body>
</html>
