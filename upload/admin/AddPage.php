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
CheckLevel($myuserid,$myusername,$classid,"userpage");
$phome=$_GET['phome'];
$url="<a href=ListPage.php>�����Զ���ҳ��</a>&nbsp;>&nbsp;�����Զ���ҳ��";
//����
if($phome=="AddUserpage"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserpage where id='$id'");
	$url="<a href=ListPage.php>�����Զ���ҳ��</a>&nbsp;>&nbsp;�����Զ���ҳ�棺<b>".$r[title]."</b>";
}
//�޸�
if($phome=="EditUserpage")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserpage where id='$id'");
	$url="<a href=ListPage.php>�����Զ���ҳ��</a>&nbsp;>&nbsp;�޸��Զ���ҳ�棺<b>".$r[title]."</b>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����Զ���ҳ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.pagetext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">λ�ã�<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ListPage.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�����Զ���ҳ�� 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
        <input name="oldfilename" type="hidden" value="<?=$r[filename]?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">ҳ������(*)</td>
      <td width="81%" height="25"> <input name="title" type="text" id="title" value="<?=$r[title]?>" size="35"> 
        <font color="#666666">(�磺��ϵ����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ļ���(*)</td>
      <td height="25">/page/ 
        <input name="filename" type="text" id="filename" value="<?=$r[filename]?>" size="28"> 
        <font color="#666666">(�磺contact.html)</font> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ҳ����</td>
      <td height="25"><input name="pagetitle" type="text" id="pagetitle" value="<?=htmlspecialchars(stripSlashes($r[pagetitle]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ҳ�ؼ���</td>
      <td height="25"><input name="pagekeywords" type="text" id="pagekeywords" value="<?=htmlspecialchars(stripSlashes($r[pagekeywords]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ҳ����</td>
      <td height="25"><input name="pagedescription" type="text" id="pagedescription" value="<?=htmlspecialchars(stripSlashes($r[pagedescription]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><strong>ҳ������</strong>(*)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><div align="center"> 
          <textarea name="pagetext" cols="90" rows="27" id="pagetext" wrap="OFF" style="WIDTH: 100%"><?=htmlspecialchars(stripSlashes($r[pagetext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td height="24"> ��ҳ���⣺ 
              <input name="textfield" type="text" value="[!--pagetitle--]"> </td>
            <td> ��ҳ�ؼ��ʣ� 
              <input name="textfield2" type="text" value="[!--pagekey--]"> </td>
            <td> ��ҳ������ 
              <input name="textfield3" type="text" value="[!--pagedes--]"> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="24">վ���ַ�� 
              <input name="textfield32" type="text" value="[!--edown.url--]"> 
            </td>
            <td>ҳ�浼���� 
              <input name="textfield15" type="text" value="[!--empiredown.url--]"></td>
            <td>�����б� 
              <input name="textfield262" type="text" value="[!--class.menu--]"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="24">�������أ� 
              <input name="textfield20" type="text" value="[!--empiredown.topjs--]"></td>
            <td>�������أ� 
              <input name="textfield21" type="text" value="[!--empiredown.newjs--]"></td>
            <td>���ർ���� 
              <input name="textfield19" type="text" value="[!--empiredown.class--]"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="24"><strong>֧�ֹ���ģ�����</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
