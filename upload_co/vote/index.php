<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/q_functions.php");
include("../class/db_sql.php");
$link=db_connect();
$empire=new mysqlquery();
$voteid=(int)$_GET['voteid'];
if(empty($voteid))
{
	printerror("此投票不存在","history.go(-1)",1);
}
$r=$empire->fetch1("select voteid,title,votenum,votetext,voteclass,addtime from {$dbtbpre}downvote where voteid='$voteid'");
if(empty($r[voteid]))
{
	printerror("此投票不存在","history.go(-1)",1);
}
db_close();
$empire=null;
$r_exp="\r\n";
$f_exp="::::::";
if($r[voteclass])
{$voteclass="多选";}
else
{$voteclass="单选";}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>投票: <?=$r[title]?></title>
<meta name="keywords" content="<?=$r[title]?> 投票" />
<meta name="description" content="<?=$r[title]?> 投票" />
<link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td height="25">标题:<?=$r[title]?>&nbsp;(<?=$voteclass?>)</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
<?
//取得行
$r_r=explode($r_exp,$r[votetext]);
for($i=0;$i<count($r_r);$i++)
{
	$f_r=explode($f_exp,$r_r[$i]);
	if($r[votenum])
	{
	$width=number_format(($f_r[1]/$r[votenum])*100,2);
	}
	else
	{$width=0;}
	?>
        <tr height=24> 
          <td width="48%"><b>.</b>&nbsp;
            <?=$f_r[0]?>
          </td>
          <td width="10%"><div align="center"><?=$f_r[1]?>票</div></td>
          <td width="42%"><img src="../data/images/showvote.gif" width="<?=$width?>" height="6" border=0>
            <?=$width?>%
          </td>
        </tr>
	<?
}
?>
      </table></td>
  </tr>
  <tr>
    <td><table width="95%" border="0" align="right" cellpadding="3" cellspacing="1">
        <tr>
          <td>发布时间:<?=$r[addtime]?>,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;共&nbsp;<b><?=$r[votenum]?></b>&nbsp;票</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<br>
<br>
<center><input type=button name=button value=关闭 onclick="self.window.close();"></center>
</body>
</html>