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
CheckLevel($myuserid,$myusername,$classid,"class");

//��ʾ���޼�����[�������ʱ]
function ShowClass_ListClass($bclassid,$exp){
	global $empire,$dbtbpre;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="";
    }
	else
	{$exp="&nbsp;&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select * from {$dbtbpre}downclass where bclassid='$bclassid' order by classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		//�ռ����
		if($r[islast])
		{
			$img="../data/images/txt.gif";
			$bgcolor="#ffffff";
			$renewshtml="&nbsp;[<a href='chtmlphome.php?phome=ReSoftHtml&classid=".$r[classid]."&from=ListClass.php'>����</a>]&nbsp;";
			$islastclass="<a href='#edown' onclick='ChangeLastClass(".$r[classid].")' title='ת��Ϊ���ռ�����'>��</a>";
		}
		else
		{
			$img="../data/images/dir.gif";
			if(empty($r[bclassid]))
			{$bgcolor="#DBEAF5";}
			else
			{$bgcolor="#ffffff";}
			$renewshtml="&nbsp;[<a href='chtmlphome.php?phome=ReSoftHtml&classid=".$r[classid]."&from=ListClass.php'>����</a>]&nbsp;";
			$islastclass="<a href='#edown' onclick='ChangeLastClass(".$r[classid].")' title='ת��Ϊ�ռ�����'>��</a>";
		}
		$classurl=EDReturnClassUrl($r[classid]);
		$returnstr.="<tr bgcolor=".$bgcolor."><td>".$exp."<img src=".$img." width=19 height=15></td><td><div align=center><input type=text size=3 name=myorder[] value=".$r[myorder]."><input type=hidden name=classid[] value=".$r[classid]."></div></td><td height=25> <div align=center>".$r[classid]."</div></td><td height=25><a href='$classurl' target=_blank>".$r[classname]."</a></td><td align='center'>$islastclass</td><td height=25><div align=center><a href='#edown' onclick=javascript:window.open('view/ClassUrl.php?classid=".$r[classid]."','','width=500,height=200');>�鿴��ַ</a></div></td><td height=25><div align=center>[<a href='$classurl' target=_blank>Ԥ��</a>]&nbsp;[<a href='chtmlphome.php?phome=ReHtml&classid=".$r[classid]."'>����</a>]".$renewshtml."[<a href='chtmlphome.php?phome=rejs&doing=0&classid=".$r[classid]."'>JS</a>]&nbsp;[<a href='AddClass.php?classid=".$r[classid]."&phome=EditClass'>�޸�</a>]&nbsp;[<a href='classphome.php?classid=".$r[classid]."&phome=DelClass' onclick=\"return confirm('ȷ��Ҫɾ���˷��࣬��ɾ���������༰����');\">ɾ��</a>]</div></td></tr>";
		//ȡ�������
		$returnstr.=ShowClass_ListClass($r[classid],$exp);
	}
	return $returnstr;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�������</title>
<script>
function ChangeLastClass(classid){
	if(confirm('ȷ��Ҫת��?'))
	{
		self.location.href="classphome.php?phome=ChangeClassIslast&from=ListClass.php&classid="+classid;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<a href="ListClass.php">�������</a></td>
    <td> <div align="right">
        <input type="button" name="Submit2" value="���ӷ���" onclick="self.location.href='AddClass.php?phome=AddClass';">
      </div></td>
  </tr>
</table>
<form name="editorder" method="post" action="classphome.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="7%">&nbsp;</td>
      <td width="6%" height="24"> <div align="center">˳��</div></td>
      <td width="7%" height="24"> <div align="center">ID</div></td>
      <td width="27%" height="24"> <div align="center">�����</div></td>
      <td width="8%"><div align="center">�ռ�����</div></td>
      <td width="8%" height="24"> <div align="center">���õ�ַ</div></td>
      <td width="37%" height="24"> <div align="center">����</div></td>
    </tr>
    <?
 echo ShowClass_ListClass(0,$exp);
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <div align="left"> 
          <input type="submit" name="Submit" value="�޸����˳��" onClick="document.editorder.phome.value='EditClassOrder';">
          <input name="phome" type="hidden" id="phome" value="EditClassOrder">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <strong>�ռ���������ת��˵����</strong><br>
        �����<font color="#FF0000">���ռ�����</font>����תΪ<font color="#FF0000">�ռ�����</font><font color="#666666">(�˷��಻�����ӷ���)</font><br>
        �����<font color="#FF0000">�ռ�����</font>����תΪ<font color="#FF0000">���ռ�����</font><font color="#666666">(�˷����²���������)<br>
        </font><strong>�޸ķ���˳��:˳��ֵԽСԽǰ�档</strong> </td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
