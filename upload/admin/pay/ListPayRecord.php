<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"pay");

//批量删除
function DelPayRecord_all($id,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"pay");
	$count=count($id);
	if(!$count)
	{
		printerror("请选择要删除的记录","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add.=" id='".intval($id[$i])."' or";
	}
	$add=substr($add,0,strlen($add)-3);
	$sql=$empire->query("delete from {$dbtbpre}downpayrecord where".$add);
	if($sql)
	{
		printerror("删除支付记录成功","ListPayRecord.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
//批量删除
if($phome=="DelPayRecord_all")
{
	$id=$_POST['id'];
	DelPayRecord_all($id,$myuserid,$myusername);
}

$line=25;//每页显示条数
$page_line=18;//每页显示链接数
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//总偏移量
$query="select id,userid,username,orderid,money,posttime,paybz,type,payip from {$dbtbpre}downpayrecord";
$totalquery="select count(*) as total from {$dbtbpre}downpayrecord";
//搜索
$search='';
$where='';
if($_GET['sear']==1)
{
	$search.="&sear=1";
	$a='';
	$startday=RepPostVar($_GET['startday']);
	$endday=RepPostVar($_GET['endday']);
	if($startday&&$endday)
	{
		$search.="&startday=$startday&endday=$endday";
		$a.="posttime<='".$endday." 23:59:59' and posttime>='".$startday." 00:00:00'";
	}
	$keyboard=RepPostVar($_GET['keyboard']);
	if($keyboard)
	{
		$and=$a?' and ':'';
		$show=$_GET['show'];
		if($show==1)
		{
			$a.=$and."username like '%$keyboard%'";
		}
		elseif($show==2)
		{
			$a.=$and."payip like '%$keyboard%'";
		}
		elseif($show==3)
		{
			$a.=$and."paybz like '%$keyboard%'";
		}
		else
		{
			$a.=$and."orderid like '%$keyboard%'";
		}
		$search.="&keyboard=$keyboard&show=$show";
	}
	if($a)
	{
		$where.=" where ".$a;
	}
	$query.=$where;
	$totalquery.=$where;
}
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<html>
<head>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>在线支付</title>
<script src=editor/setday.js></script>
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
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：在线支付&gt; <a href="ListPayRecord.php">管理支付记录</a></td>
    <td width="50%"><div align="right">
        <input type="button" name="Submit5" value="管理支付接口" onclick="self.location.href='PayApi.php';">
      </div></td>
  </tr>
</table>
  
<br>
<table width="100%" align=center cellpadding=0 cellspacing=0>
  <form name=searchlogform method=get action='ListPayRecord.php'>
    <tr> 
      <td height="25"> <div align="center">时间从 
          <input name="startday" type="text" value="<?=$startday?>" size="12" onclick="setday(this)">
          到 
          <input name="endday" type="text" value="<?=$endday?>" size="12" onclick="setday(this)">
          ，关键字： 
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show" id="show">
            <option value="0"<?=$show==0?' selected':''?>>订单号</option>
            <option value="1"<?=$show==1?' selected':''?>>汇款者</option>
            <option value="2"<?=$show==2?' selected':''?>>汇款IP</option>
			<option value="3"<?=$show==3?' selected':''?>>备注</option>
          </select>
          <input name=submit1 type=submit id="submit12" value=搜索>
          <input name="sear" type="hidden" id="sear" value="1">
        </div></td>
    </tr>
  </form>
</table>
<form name="form2" method="post" action="ListPayRecord.php" onsubmit="return confirm('确认要删除?');">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="3%"><div align="center"> 
          <input type=checkbox name=chkall value=on onClick="CheckAll(this.form)">
        </div></td>
      <td width="19%"><div align="center">订单号</div></td>
      <td width="13%"><div align="center">汇款者</div></td>
      <td width="10%" height="25"><div align="center">金额</div></td>
      <td width="15%"><div align="center">汇款时间</div></td>
      <td width="12%" height="25"><div align="center">汇款IP</div></td>
      <td width="20%"><div align="center">备注</div></td>
      <td width="8%" height="25"><div align="center">接口</div></td>
    </tr>
    <?
  while($r=$empire->fetch($sql))
  {
  	if($r['userid'])
	{
		$username="<a href='EditMember.php?phome=EditMember&userid=$r[userid]'>$r[username]</a>";
	}
	else
	{
		$username="游客(".$r[username].")";
	}
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="center"> 
          <input name="id[]" type="checkbox" id="id[]" value="<?=$r[id]?>">
        </div></td>
      <td><div align="center"> 
          <?=$r[orderid]?>
        </div></td>
      <td><div align="center"> 
          <?=$username?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[money]?>
        </div></td>
      <td><div align="center"> 
          <?=$r[posttime]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[payip]?>
        </div></td>
      <td><div align="center"> 
          <?=$r[paybz]?>
        </div></td>
      <td height="25"><div align="center"><?=$r[type]?></div></td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8">&nbsp;
        <?=$returnpage?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="批量删除"> <input name="phome" type="hidden" id="phome" value="DelPayRecord_all"></td>
    </tr>
  </table>
</form>
<?
db_close();
$empire=null;
?>
</body>
</html>