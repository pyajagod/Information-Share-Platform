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
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$totalquery="select count(*) as total from {$dbtbpre}downbuy_bak where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);//取得总条数
$query="select card_no,buytime,downfen,money,downdate,type from {$dbtbpre}downbuy_bak where userid='$user[userid]'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='../webPage/intro.php'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;充值记录";
@include("../data/template/cp_1.php");
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%"><div align="center">类型</div></td>
    <td width="42%" height="25"><div align="center">充值卡号</div></td>
    <td width="8%" height="25"><div align="center">金额</div></td>
    <td width="8%" height="25"><div align="center">点数</div></td>
    <td width="8%"><div align="center">有效期</div></td>
    <td width="22%" height="25"><div align="center">购买时间</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  		//类型
		if($r['type']==0)
		{
			$type='点卡充值';
		}
		elseif($r['type']==1)
		{
			$type='在线充值';
		}
		else
		{
			$type='';
		}
	  	if($r[downdate])
	  	{$r[downfen]=$r[downdate]." 天";}
	  	else
	  	{$r[downfen]=$r[downfen]." 点";}
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><div align="center">
        <?=$type?>
      </div></td>
    <td height="25"> 
      <?=$r[card_no]?>
    </td>
    <td height="25"><div align="center"> 
        <?=$r[money]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[downfen]?>
      </div></td>
    <td><div align="center"><?=$r[downdate]?></div></td>
    <td height="25"><div align="center"> 
        <?=$r[buytime]?>
      </div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>
