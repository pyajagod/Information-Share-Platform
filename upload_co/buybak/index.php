<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//�Ƿ��½
$user=islogin();
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$totalquery="select count(*) as total from {$dbtbpre}downbuy_bak where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);//ȡ��������
$query="select card_no,buytime,downfen,money,downdate,type from {$dbtbpre}downbuy_bak where userid='$user[userid]'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='../webPage/intro.php'>��ҳ</a>&nbsp;>&nbsp;<a href='../cp'>��Ա����</a>&nbsp;>&nbsp;��ֵ��¼";
@include("../data/template/cp_1.php");
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%"><div align="center">����</div></td>
    <td width="42%" height="25"><div align="center">��ֵ����</div></td>
    <td width="8%" height="25"><div align="center">���</div></td>
    <td width="8%" height="25"><div align="center">����</div></td>
    <td width="8%"><div align="center">��Ч��</div></td>
    <td width="22%" height="25"><div align="center">����ʱ��</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  		//����
		if($r['type']==0)
		{
			$type='�㿨��ֵ';
		}
		elseif($r['type']==1)
		{
			$type='���߳�ֵ';
		}
		else
		{
			$type='';
		}
	  	if($r[downdate])
	  	{$r[downfen]=$r[downdate]." ��";}
	  	else
	  	{$r[downfen]=$r[downfen]." ��";}
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
