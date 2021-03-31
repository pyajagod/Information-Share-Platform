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
CheckLevel($myuserid,$myusername,$classid,"card");

$time=$_GET['time'];
if(empty($time))
{$time=$_POST['time'];}
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;
$page_line=25;
$add="";
//搜索
$sear=$_POST['sear'];
if(empty($sear))
{$sear=$_GET['sear'];}
if($sear)
{
	$show=$_POST['show'];
	if(empty($show))
	{$show=$_GET['show'];}
	$keyboard=$_POST['keyboard'];
	if(empty($keyboard))
	{$keyboard=$_GET['keyboard'];}
	$keyboard=RepPostVar2($keyboard);
	if($show==1)
	{$add=" where card_no like '%$keyboard%'";}
	elseif($show==2)
	{$add=" where money='$keyboard'";}
	elseif($show==3)
	{$add=" where cardfen='$keyboard'";}
	else
	{$add=" where carddate='$keyboard'";}
	$search="&sear=1&show=$show&keyboard=$keyboard";
}
//过期
if($time)
{
	$today=date("Y-m-d");
	$search.="&time=$time";
	if($add)
	{$add.=" and endtime<>'0000-00-00' and endtime<'$today'";}
	else
	{$add.=" where endtime<>'0000-00-00' and endtime<'$today'";}
}
$offset=$start+$line*$page;
$totalquery="select count(*) as total from {$dbtbpre}downcard".$add;
$num=$empire->gettotal($totalquery);
$query="select cardid,card_no,password,cardfen,money,endtime,cardtime,carddate from {$dbtbpre}downcard".$add;
$query.=" order by cardid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理点卡</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置：<a href="ListCard.php">管理点卡</a></td>
    <td><div align="right">
        <input type="button" name="Submit5" value="增加点卡" onclick="self.location.href='AddCard.php?phome=AddCard';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="批量增加点卡" onclick="self.location.href='AddMoreCard.php';">
		&nbsp;&nbsp;
        <input type="button" name="Submit53" value="管理过期点卡" onclick="self.location.href='ListCard.php?time=1';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
  <form name=search method=get action=ListCard.php>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6"> 搜索： 
        <input name="keyboard" type="text" id="keyboard"> <select name="show" id="show">
          <option value="1">卡号</option>
          <option value="2">金额</option>
          <option value="3">点数</option>
          <option value="4">天数</option>
        </select> <input type="submit" name="Submit" value="搜索"> <input name="sear" type="hidden" id="sear" value="1"> 
        <input name="time" type="hidden" id="time" value="<?=$time?>"> </td>
    </tr>
	</form>
</table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="7%" height="25"> <div align="center">ID</div></td>
    <td width="49%" height="25"> <div align="center">卡号</div></td>
    <td width="13%" height="25"> <div align="center">金额(元)</div></td>
    <td width="13%" height="25"> <div align="center">点数</div></td>
    <td width="9%" height="25"> <div align="center">修改</div></td>
    <td width="9%" height="25"> <div align="center">删除</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  //月卡
  if($r[carddate])
  {
  $cardfen="<b>".$r[carddate]."</b>天";
  }
  else
  {
  $cardfen="<b>".$r[cardfen]."</b>点";
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center">
        <?=$r[cardid]?>
      </div></td>
    <td height="25"> <div align="center">
        <a alt="End Time:<?=$r[endtime]?><br>Add Time:<?=$r[cardtime]?>"><?=$r[card_no]?></a>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[money]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$cardfen?>
      </div></td>
    <td height="25"> <div align="center"><a href="AddCard.php?phome=EditCard&cardid=<?=$r[cardid]?>&time=<?=$time?>">修改</a></div></td>
    <td height="25"> <div align="center"><a href="memberphome.php?phome=DelCard&cardid=<?=$r[cardid]?>&time=<?=$time?>" onclick="return confirm('确认要删除?');">删除</a></div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> &nbsp;&nbsp;
      <?=$returnpage?>
      <div align="left"></div></td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>