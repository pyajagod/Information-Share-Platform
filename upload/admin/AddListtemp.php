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
$r[subsay]=0;
$r[showdate]="Y-m-d";
$url="<a href=ListListtemp.php>�����б�ģ��</a>&nbsp;>&nbsp;�����б�ģ��";
if($phome=="EditListtemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downlisttemp where tempid='$tempid'");
	$url="<a href=ListListtemp.php>�����б�ģ��</a>&nbsp;>&nbsp;�޸��б�ģ�壺".$r[tempname];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����б�ģ��</title>
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
      <td height="25" colspan="2">����ģ�� <font color="#FFFFFF"><strong> 
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
      <td height="25">�������ȡ������</td>
      <td height="25"><input name="subtitle" type="text" id="subtitle" value="<?=$r[subtitle]?>" size="36">
        ���ֽ�<font color="#666666">(Ϊ0ʱ����ȡ)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����ȡ������</td>
      <td height="25"><input name="subsay" type="text" id="subsay" value="<?=$r[subsay]?>" size="36">
        ���ֽ�<font color="#666666">(Ϊ0ʱ����ȡ)</font></td>
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
      <td height="25" colspan="2" valign="top"> 
        <textarea name="temptext" cols="90" rows="27" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[temptext]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><strong>(1)������ҳ��ģ��֧�ֵı���<br>
        </strong> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="22">վ���ַ�� 
              <input name="textfield3" type="text" value="[!--edown.url--]"> </td>
            <td>ҳ�浼���� 
              <input name="textfield15" type="text" value="[!--empiredown.url--]"></td>
            <td>ҳ����⣺ 
              <input name="textfield16" type="text" value="[!--pagetitle--]"></td>
          </tr>
          <tr> 
            <td height="22">ҳ��ؼ��֣� 
              <input name="textfield17" type="text" value="[!--pagekey--]"></td>
            <td>ҳ���飺 
              <input name="textfield18" type="text" value="[!--pagedes--]"></td>
            <td>���ർ���� 
              <input name="textfield19" type="text" value="[!--empiredown.class--]"></td>
          </tr>
          <tr> 
            <td height="22">�������أ� 
              <input name="textfield20" type="text" value="[!--empiredown.topjs--]"></td>
            <td>�������أ� 
              <input name="textfield21" type="text" value="[!--empiredown.newjs--]"></td>
            <td>����ID�� 
              <input name="textfield22" type="text" value="[!--class.id--]"></td>
          </tr>
          <tr> 
            <td height="22">�������ƣ� 
              <input name="textfield23" type="text" value="[!--class.name--]"></td>
            <td>������ID�� 
              <input name="textfield24" type="text" value="[!--bclass.id--]"></td>
            <td>���������ƣ� 
              <input name="textfield25" type="text" value="[!--bclass.name--]"></td>
          </tr>
          <tr> 
            <td height="22">����ʽ��ҳ������ 
              <input name="textfield26" type="text" value="[!--show.page--]"></td>
            <td>�б�ʽ��ҳ������ 
              <input name="textfield27" type="text" value="[!--show.listpage--]"></td>
            <td>��ҳ�룺 
              <input name="textfield28" type="text" value="[!--list.pageno--]"></td>
          </tr>
          <tr>
            <td height="22">�����б� 
              <input name="textfield262" type="text" value="[!--class.menu--]"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <strong><br>
        (2)������б�����ģ��֧�ֵı���</strong><br> 
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="33%" height="22">�������: 
              <input name="textfield" type="text" value="[!--softurl--]"> </td>
            <td width="33%" height="22">���ID: 
              <input name="textfield1442" type="text" value="[!--softid--]"></td>
            <td width="33%" height="22">�������: 
              <input name="textfield2" type="text" value="[!--softname--]"></td>
          </tr>
          <tr> 
            <td height="22">����ID: 
              <input name="textfield30" type="text" value="[!--classid--]"></td>
            <td height="22">��������: 
              <input name="textfield29" type="text" value="[!--classname--]">
              (������) </td>
            <td height="22">����ר��: 
              <input name="textfield62" type="text" value="[!--ztname--]"></td>
          </tr>
          <tr> 
            <td height="22">�������ALT: 
              <input name="textfield52" type="text" value="[!--oldsoftname--]"></td>
            <td height="22">����ʱ��: 
              <input name="textfield5" type="text" value="[!--softtime--]"></td>
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
            <td height="22">����ȼ�: 
              <input name="textfield145" type="text" value="[!--star--]"></td>
            <td height="22">���ص���: 
              <input name="textfield145225" type="text" value="[!--downfen--]"></td>
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
            <td height="22">��������: 
              <input name="textfield292" type="text" value="[!--thisclassname--]">
            </td>
            <td height="22">��������: 
              <input name="textfield2922" type="text" value="[!--thisclassurl--]"></td>
            <td height="22">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����˵��</td>
      <td height="25"><p>ģ���ʽ������б�ͷ��[!--empiredown.listtemp--]����б�����[!--empiredown.listtemp--]����б��β<br>
        </p></td>
    </tr>
  </table>
</form>
</body>
</html>
