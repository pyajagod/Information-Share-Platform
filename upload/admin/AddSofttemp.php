<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"template");
$phome=$_GET['phome'];
$r[showdate]="Y-m-d";
$url="<a href=ListSofttemp.php>��������ģ��</a>&nbsp;>&nbsp;��������ģ��";
if($phome=="EditSofttemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downsofttemp where tempid='$tempid'");
	$url="<a href=ListSofttemp.php>��������ģ��</a>&nbsp;>&nbsp;�޸�����ģ�壺".$r[tempname];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��������ģ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">����ģ��<font color="#FFFFFF"><strong> 
        <input type=hidden name=phome value="<?=$phome?>">
        <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>">
        </strong></font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="28%" height="25">ģ������</td>
      <td width="72%" height="25"><input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>" size="36"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ʱ����ʾ��ʽ��</td>
      <td> <input name="showdate" type="text" id="showdate" value="<?=$r[showdate]?>" size="20"> 
        <select name="select4" onchange="document.form1.showdate.value=this.value">
          <option value="Y-m-d H:i:s">ѡ��</option>
          <option value="Y-m-d H:i:s">2005-01-27 11:04:27</option>
          <option value="Y-m-d">2005-01-27</option>
          <option value="m-d">01-27</option>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>ҳ��ģ�����ݣ�</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><p>
          <textarea name="temptext" cols="90" rows="27" wrap="OFF" style="WIDTH: 100%"><?=htmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </p>
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><strong>ģ�����˵����</strong><br> 
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td height="22">վ���ַ�� 
              <input name="textfield3" type="text" value="[!--edown.url--]"> 
              <br> </td>
            <td height="22">ҳ�浼���� 
              <input name="textfield15" type="text" value="[!--empiredown.url--]"></td>
            <td height="22"> ҳ����⣺ 
              <input name="textfield16" type="text" value="[!--pagetitle--]"></td>
          </tr>
          <tr> 
            <td height="22">ҳ��ؼ��֣� 
              <input name="textfield17" type="text" value="[!--pagekey--]"></td>
            <td height="22">ҳ���飺 
              <input name="textfield18" type="text" value="[!--pagedes--]"></td>
            <td height="22">���ർ���� 
              <input name="textfield19" type="text" value="[!--empiredown.class--]"></td>
          </tr>
          <tr> 
            <td height="22">�������أ� 
              <input name="textfield20" type="text" value="[!--empiredown.topjs--]"></td>
            <td height="22">�������أ� 
              <input name="textfield21" type="text" value="[!--empiredown.newjs--]"></td>
            <td height="22">����ID�� 
              <input name="textfield22" type="text" value="[!--class.id--]"></td>
          </tr>
          <tr> 
            <td height="22">�������ƣ� 
              <input name="textfield23" type="text" value="[!--class.name--]"></td>
            <td height="22"> ������ID�� 
              <input name="textfield24" type="text" value="[!--bclass.id--]"></td>
            <td height="22"> ���������ƣ� 
              <input name="textfield25" type="text" value="[!--bclass.name--]"></td>
          </tr>
          <tr> 
            <td width="33%" height="22">ҳ������: 
              <input name="textfield" type="text" value="[!--softurl--]"> </td>
            <td width="33%" height="22">���ID: 
              <input name="textfield1442" type="text" value="[!--softid--]"></td>
            <td width="33%" height="22">�������: 
              <input name="textfield2" type="text" value="[!--softname--]"></td>
          </tr>
          <tr> 
            <td height="22">����ʱ��: 
              <input name="textfield5" type="text" value="[!--softtime--]"></td>
            <td height="22">����ר��: 
              <input name="textfield62" type="text" value="[!--ztname--]"></td>
            <td height="22">������: 
              <input name="textfield4" type="text" value="[!--softsay--]"></td>
          </tr>
          <tr> 
            <td height="22">�ļ���չ��: 
              <input name="textfield7" type="text" value="[!--filetype--]"></td>
            <td height="22">�ļ���С: 
              <input name="textfield6" type="text" value="[!--filesize--]"></td>
            <td height="22">Ԥ��ͼ: 
              <input name="textfield14" type="text" value="[!--softpic--]"></td>
          </tr>
          <tr> 
            <td height="22">����汾: 
              <input name="textfield144" type="text" value="[!--soft_version--]"></td>
            <td height="22">��Ȩ��ʽ: 
              <input name="textfield12" type="text" value="[!--soft_sq--]"></td>
            <td height="22">�������: 
              <input name="textfield13" type="text" value="[!--softtype--]"></td>
          </tr>
          <tr> 
            <td height="22">�������: 
              <input name="textfield143" type="text" value="[!--language--]"></td>
            <td height="22">���ص�ַ: 
              <input name="textfield145223" type="text" value="[!--downpath--]"></td>
            <td height="22">���߹ۿ���ַ: 
              <input name="textfield1452232" type="text" value="[!--onlinepath--]"></td>
          </tr>
          <tr> 
            <td height="22">���ص���: 
              <input name="textfield145225" type="text" value="[!--downfen--]"></td>
            <td height="22">���ؼ���: 
              <input name="textfield14524" type="text" value="[!--foruser--]"></td>
            <td height="22">����ȼ�: 
              <input name="textfield145" type="text" value="[!--star--]"></td>
          </tr>
          <tr> 
            <td height="22">������: 
              <input name="textfield1452" type="text" value="[!--adduser--]"></td>
            <td height="22">����: 
              <input name="textfield14522" type="text" value="[!--writer--]"></td>
            <td height="22">�ٷ���վ: 
              <input name="textfield14523" type="text" value="[!--homepage--]"></td>
          </tr>
          <tr> 
            <td height="22">��������: 
              <input name="textfield8" type="text" value="[!--count_all--]"></td>
            <td height="22">��������: 
              <input name="textfield10" type="text" value="[!--count_month--]"></td>
            <td height="22">��������: 
              <input name="textfield9" type="text" value="[!--count_week--]"></td>
          </tr>
          <tr> 
            <td height="22">��������: 
              <input name="textfield11" type="text" value="[!--count_day--]"></td>
            <td height="22">���л���: 
              <input name="textfield142" type="text" value="[!--soft_fj--]"></td>
            <td height="22">��ʾ��ַ: 
              <input name="textfield145224" type="text" value="[!--demo--]"></td>
          </tr>
          <tr> 
            <td height="22">�ؼ���: 
              <input name="textfield112" type="text" value="[!--keyboard--]"></td>
            <td height="22">�������: 
              <input name="textfield145226" type="text" value="[!--otherlink--]"></td>
            <td height="22">�����б� 
              <input name="textfield262" type="text" value="[!--class.menu--]"></td>
          </tr>
          <tr> 
            <td height="22" colspan="3">ʵʱ��ʾ������:&lt;script src=&quot;[!--edown.url--]ViewClick?softid=[!--softid--]&amp;all=1&amp;month=1&amp;week=1&amp;day=1&quot;&gt;&lt;/script&gt;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
