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
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"soft");
$s_r=$empire->fetch1("select softname,softid,titleurl,filename from {$dbtbpre}down where softid='$softid' and classid='$classid'");
if(!$s_r[softid])
{
	printerror("�����������","history.go(-1)");
}
//����
$url=AdminReturnClassLink($classid)." > ��������";
$softurl=EDReturnSoftPageUrl($s_r[filename],$s_r[titleurl]);
$search="&classid=".$classid."&softid=".$softid;
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//��ƫ����
$totalquery="select count(*) as total from {$dbtbpre}downpl where softid='$softid'";
$num=$empire->gettotal($totalquery);//ȡ��������
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
<title>��������</title>
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
    <td height="27"> <div align="left">λ��: <?=$url?></div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
      <td><div align="center">��� <a href="<?=$softurl?>" target="_blank"><b><?=$s_r[softname]?></b></a> ������</div></td>
    </tr>
  </table>
<form name="form2" method="post" action="comphome.php" onsubmit="return confirm('ȷ��Ҫɾ��?');">
	<?
	while($r=$empire->fetch($sql))
	{
	?>
  <table width="760" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr> 
      <td width="40%" height="25"><div align="left">������IP: 
          <?=$r[plip]?>
        </div></td>
      <td width="18%">���֣�<b> 
        <?=$r[plfen]?>
        </b> ��</td>
      <td width="32%" height="25"><div align="left">����ʱ��: 
          <?=$r[pltime]?>
        </div></td>
      <td width="10%"> <div align="right"> <font color="#FFFFFF"> 
          <input name="plid[]" type="checkbox" id="plid[]" value="<?=$r[plid]?>">
          <a href="comphome.php?phome=DelPl&plid=<?=$r[plid]?>&softid=<?=$softid?>&classid=<?=$classid?>" onclick="return confirm('���Ƿ�Ҫɾ����');">ɾ��</a> 
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
        <input type="submit" name="Submit" value="����ɾ��">
        <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        ѡ��ȫ�� 
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
