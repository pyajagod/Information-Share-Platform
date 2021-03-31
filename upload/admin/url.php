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
CheckLevel($myuserid,$myusername,$classid,"downurl");

//����url��ַ
function AddDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[urlname])||empty($add[url]))
	{
		printerror("�������ַǰ׺�������ַ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"downurl");
	$add[downtype]=(int)$add[downtype];
	$sql=$empire->query("insert into {$dbtbpre}downurl(urlname,url,downtype) values('$add[urlname]','$add[url]','$add[downtype]');");
	if($sql)
	{
		printerror("���ӵ�ַǰ׺�ɹ�","url.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�url��ַ
function EditDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[urlid]=(int)$add[urlid];
	if(empty($add[urlname])||empty($add[url])||empty($add[urlid]))
	{printerror("�������ַǰ׺�������ַ","history.go(-1)");}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"downurl");
	$add[downtype]=(int)$add[downtype];
	$sql=$empire->query("update {$dbtbpre}downurl set urlname='$add[urlname]',url='$add[url]',downtype='$add[downtype]' where urlid='$add[urlid]'");
	if($sql)
	{
		printerror("�޸ĵ�ַǰ׺�ɹ�","url.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��url��ַ
function DelDownurl($urlid,$userid,$username){
	global $empire,$dbtbpre;
	$urlid=(int)$urlid;
	if(empty($urlid))
	{
		printerror("��ѡ��Ҫɾ����url��ַ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"downurl");
	$sql=$empire->query("delete from {$dbtbpre}downurl where urlid='$urlid'");
	if($sql)
	{
		printerror("ɾ����ַǰ׺�ɹ�","url.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//���ӵ�ַǰ׺
if($phome=="AddDownurl")
{
	AddDownurl($_POST,$myuserid,$myusername);
}
elseif($phome=="EditDownurl")
{
	EditDownurl($_POST,$myuserid,$myusername);
}
elseif($phome=="DelDownurl")
{
	$urlid=$_GET['urlid'];
	DelDownurl($urlid,$myuserid,$myusername);
}

$sql=$empire->query("select urlid,urlname,url from {$dbtbpre}downurl order by urlid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ��: �������ص�ַǰ׺</td>
  </tr>
</table>
<form name="form1" method="post" action="url.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
      <td height="25">�������ص�ַǰ׺:<font color="#FFFFFF"><strong> 
        <input type=hidden name=phome value=AddDownurl>
        </strong></font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> ����: 
        <input name="urlname" type="text" id="urlname">
        ��ַ: 
        <input name="url" type="text" id="url" value="http://" size="42">
        ���ط�ʽ: 
        <select name="downtype" id="downtype">
          <option value="0">HEADER</option>
          <option value="1">META</option>
          <option value="2">READ</option>
        </select> 
        <input type="submit" name="Submit" value="����">
        <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25">���ص�ַǰ׺����
<div align="left"></div></td>
    <td width="26%" height="25">
<div align="center"><font color="#FFFFFF"><strong>����</strong></font></div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=url.php>
    <input type=hidden name=phome value=EditDownurl>
    <input type=hidden name=urlid value=<?=$r[urlid]?>>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����: 
        <input name="urlname" type="text" id="urlname" value="<?=$r[urlname]?>">
        ��ַ: 
        <input name="url" type="text" id="url" value="<?=$r[url]?>" size="30"> 
        <select name="select" id="select">
          <option value="0"<?=$r['downtype']==0?' selected':''?>>HEADER</option>
          <option value="1"<?=$r['downtype']==1?' selected':''?>>META</option>
          <option value="2"<?=$r['downtype']==2?' selected':''?>>READ</option>
        </select>
        <div align="left"></div></td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit4" value="ɾ��" onclick="if(confirm('ȷʵҪɾ��?')){self.location.href='url.php?phome=DelDownurl&urlid=<?=$r[urlid]?>';}">
        </div></td>
    </tr>
  </form>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
<br>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class=tableborder>
  <tr> 
    <td height="26" bgcolor="#FFFFFF"><strong>���ط�ʽ˵����</strong></td>
  </tr>
  <tr> 
    <td height="26" bgcolor="#FFFFFF"><strong>HEADER��</strong>ʹ��headerת��ͨ����Ϊ�����<br> 
      <strong>META��</strong>ֱ��ת�ԣ������FTP��ַ�Ƽ�ѡ�������<br> <strong>READ��</strong>ʹ��PHP�����ȡ����������ǿ������ռ��Դ������������С�ļ���ѡ��</td>
  </tr>
</table>
</body>
</html>
