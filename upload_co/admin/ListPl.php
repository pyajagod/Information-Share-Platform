<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$softid=(int)$_GET['softid'];
$classid=(int)$_GET['classid'];
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"soft");
$s_r=$empire->fetch1("select softname,softid,titleurl,filename from {$dbtbpre}down where softid='$softid' and classid='$classid'");
if(!$s_r[softid])
{
	printerror("此软件不存在","history.go(-1)");
}
//导航
$url=AdminReturnClassLink($classid)." > 管理评论";
$softurl=EDReturnSoftPageUrl($s_r[filename],$s_r[titleurl]);
$search="&classid=".$classid."&softid=".$softid;
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//总偏移量
$totalquery="select count(*) as total from {$dbtbpre}downpl where softid='$softid'";
$num=$empire->gettotal($totalquery);//取得总条数
$query="select plid,content,pltime,plfen,plip from {$dbtbpre}downpl where softid='$softid'";
$query.=" order by plid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理评论</title>
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
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td height="27"> <div align="left">位置: <?=$url?></div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
      <td><div align="center">软件 <a href="<?=$softurl?>" target="_blank"><b><?=$s_r[softname]?></b></a> 的评论</div></td>
    </tr>
  </table>
<form name="form2" method="post" action="comphome.php" onsubmit="return confirm('确认要删除?');">
	<?
	while($r=$empire->fetch($sql))
	{
	?>
  <table width="760" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr> 
      <td width="40%" height="25"><div align="left">发表者IP: 
          <?=$r[plip]?>
        </div></td>
      <td width="18%">评分：<b> 
        <?=$r[plfen]?>
        </b> 分</td>
      <td width="32%" height="25"><div align="left">发表时间: 
          <?=$r[pltime]?>
        </div></td>
      <td width="10%"> <div align="right"> <font color="#FFFFFF"> 
          <input name="plid[]" type="checkbox" id="plid[]" value="<?=$r[plid]?>">
          <a href="comphome.php?phome=DelPl&plid=<?=$r[plid]?>&softid=<?=$softid?>&classid=<?=$classid?>" onclick="return confirm('您是否要删除？');">删除</a> 
          </font></div></td>
    </tr>
    <tr valign="top" bgcolor="#FFFFFF"> 
      <td height="25" colspan="4"> 
        <?=$r[content]?>
      </td>
    </tr>
  </table>
  <br>
	<?
  }
  ?>
  <table width="760" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3"> 
        <?=$returnpage?>&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="批量删除">
        <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        选中全部 
        <input type=hidden name=classid value="<?=$classid?>">
        <input type=hidden name=softid value="<?=$softid?>">
        <input name="phome" type="hidden" id="phome" value="DelPl_all"> 
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
