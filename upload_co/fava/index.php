<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//是否登陆
$user=islogin();
$line=25;
$page_line=12;
$start=(int)$_GET['start'];
$page=(int)$_GET['page'];
$offset=$start+$page*$line;
$query="select favaid,favatime,softid from {$dbtbpre}downfava where userid='$user[userid]'";
$totalquery="select count(*) as total from {$dbtbpre}downfava where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);
$query.=" order by favaid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='../'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;收藏夹";
include("../data/template/cp_1.php");
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
<form name=favaform method=post action="../phome/index.php" onsubmit="return confirm('确认要删除?');">
  <tr class="header"> 
    <td width="5%"><div align="center"><input type=hidden value=DelFava_all name=phome></div></td>
    <td width="51%"><div align="center">软件名</div></td>
    <td width="10%"><div align="center">下载</div></td>
    <td width="28%"><div align="center">收藏时间</div></td>
    <td width="6%"><div align="center">删除</div></td>
  </tr>
  <?
  while($fr=$empire->fetch($sql))
  {
	$r=$empire->fetch1("select softname,softid,titleurl,filename,count_all from {$dbtbpre}down where softid='$fr[softid]'");
	$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td> <div align="center"><img src="../data/images/dir.gif" border=0></div></td>
    <td> <div align="left"><a href="<?=$softurl?>" target=_blank><?=$r[softname]?></a></div></td>
    <td> <div align="center"><?=$r[count_all]?></div></td>
    <td> <div align="center"><?=$fr[favatime]?></div></td>
    <td> <div align="center">
          <input name="favaid[]" type="checkbox" id="favaid[]" value="<?=$fr[favaid]?>">
        </div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
      <td colspan="5"> &nbsp;&nbsp;&nbsp;
        <?=$returnpage?>
        &nbsp;&nbsp;
        <input type="submit" name="Submit" value="删除"></td>
  </tr>
  </form>
</table>
<?php
include("../data/template/cp_2.php");
db_close();
$empire=null;
?>