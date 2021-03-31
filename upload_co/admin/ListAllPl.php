<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
CheckLevel($lur[userid],$lur[username],$classid,"pl");//验证权限

$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//总偏移量
//搜索
$search='';
$a='';
if($_GET['sear'])
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	if($keyboard)
	{
		$show=$_GET['show'];
		if($show==1)//评论内容
		{
			$a.=" where content like '%$keyboard%'";
		}
		elseif($show==2)//评论IP
		{
			$a.=" where plip like '%$keyboard%'";
		}
		else//软件ID
		{
			$a.=" where softid='$keyboard'";
		}
		$search.="&sear=1&show=$show&keyboard=$keyboard";
	}
}
$totalquery="select count(*) as total from {$dbtbpre}downpl".$a;
$num=$empire->gettotal($totalquery);//取得总条数
$query="select plid,softid,content,pltime,plfen,plip from {$dbtbpre}downpl".$a;
$query=$query." order by plid desc limit $offset,$line";
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
    <td height="27"> 
      <div align="left">位置: <a href="ListAllPl.php">管理评论</a></div></td>
  </tr>
</table>
        
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="sform" method="get" action="ListAllPl.php">
  <tr>     
      <td bgcolor="#FFFFFF">
		<div align="center">关键字： 
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
                <select name="show" id="show">
                  <option value="0"<?=$show==0?' selected':''?>>软件ID</option>
                  <option value="1"<?=$show==1?' selected':''?>>评论内容</option>
                  <option value="2"<?=$show==2?' selected':''?>>评论IP</option>
                </select>
                <input type="submit" name="Submit2" value="搜索评论">
                <input name="sear" type="hidden" id="sear" value="1">
        </div>
		</td>
  </tr>
  </form>
</table>
<form name="form2" method="post" action="comphome.php" onsubmit="return confirm('确认要删除?');">
	<?php
	while($r=$empire->fetch($sql))
	{
  		$sr=$empire->fetch1("select softname,filename,titleurl from {$dbtbpre}down where softid='$r[softid]'");
		$softurl=EDReturnSoftPageUrl($sr[filename],$sr[titleurl]);
	?>
  <table width="760" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr> 
      <td height="25" colspan="4" class="header"><a href="<?=$softurl?>" target="_blank"><?=$sr[softname]?></a></td>
    </tr>
    <tr> 
      <td width="40%" height="25"><div align="left">发表者IP: 
          <?=$r[plip]?>
        </div></td>
      <td width="18%">评分：<b> 
        <?=$r[plfen]?>
        </b></td>
      <td width="32%" height="25"><div align="left">发表时间: 
          <?=$r[pltime]?>
        </div></td>
      <td width="10%"> <div align="right"> <font color="#FFFFFF"> 
          <input name="plid[]" type="checkbox" id="plid[]" value="<?=$r[plid]?>">
          <a href="comphome.php?phome=DelPl&plid=<?=$r[plid]?>" onclick="return confirm('您是否要删除？');">删除</a> 
          </font></div></td>
    </tr>
    <tr valign="top" bgcolor="#FFFFFF"> 
      <td height="25" colspan="4"><?=$r[content]?></td>
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
