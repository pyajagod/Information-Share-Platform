<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
CheckLevel($lur[userid],$lur[username],$classid,"class");//��֤Ȩ��
$phome=$_GET['phome'];
$url="<a href='ListClass.php'>�������</a>&nbsp;>&nbsp;���ӷ���";
$thisdo="����";
//��ʼֵ
$islast="<input name='islast' type='checkbox' value='1'>��(�ռ������²�����������)";
$r[maxnum]=0;
$r[lencord]=20;
$r[link_num]=10;
$r[downnum]=1;
$r[onlinenum]=1;
$r[qaddfen]=0;
$r[myorder]=0;
//���Ʒ���
$docopy=$_GET['docopy'];
if($docopy&&$phome=="AddClass")
{
	$copyclass=1;
}
//�޸ķ���
if($phome=="EditClass"||$copyclass)
{
	if($copyclass)
	{
		$thisdo="����";
	}
	else
	{
		$thisdo="�޸�";
	}
	$classid=(int)$_GET[classid];
	$r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	$url="<a href='ListClass.php'>�������</a>&nbsp;>&nbsp;".$thisdo."���ࣺ<b>".$r[classname]."</b>";
	if($r[islast])
	{
		$islast="��<input name='islast' type='hidden' value='1'>";
	}
	else
	{
		$islast="��";
	}
}
//��Ա��
$group='';
$qgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[groupid]==$mgr[groupid])
	{
		$select=" selected";
	}
	else
	{
		$select="";
	}
	$group.="<option value='".$mgr[groupid]."'".$select.">".$mgr[groupname]."</option>";
	$qselect=$r[qaddgroupid]==$mgr[groupid]?" selected":"";
	$qgroup.="<option value='".$mgr[groupid]."'".$qselect.">".$mgr[groupname]."</option>";
}
//����
$fcjsfile="../data/fc/downclass.js";
if(file_exists($fcjsfile))
{
	$options=GetFcfiletext($fcjsfile);
	$options=str_replace("<option value='$r[bclassid]'","<option value='$r[bclassid]' selected",$options);
}
else
{
	$options=ShowClass_AddClass("",$r[bclassid],0,"|-",0);
}
//�б�ģ��
$listtemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	if($ltr[tempid]==$r[listtempid])
	{$select=" selected";}
	else
	{$select="";}
	$listtemp.="<option value=".$ltr[tempid].$select.">".$ltr[tempname]."</option>";
}
//����ģ��
$softtemp="";
$stsql=$empire->query("select tempid,tempname from {$dbtbpre}downsofttemp order by tempid");
while($str=$empire->fetch($stsql))
{
	if($str[tempid]==$r[softtempid])
	{$select=" selected";}
	else
	{$select="";}
	$softtemp.="<option value=".$str[tempid].$select.">".$str[tempname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ӷ���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="classform" method="post" action="classphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"><?=$thisdo?>����</td>
    </tr>
    <tr> 
      <td width="31%" height="25" bgcolor="#FFFFFF">��������</td>
      <td width="69%" height="25" bgcolor="#FFFFFF"> <input name="classname" type="text" id="classname" value="<?=$r[classname]?>" size="30">
        (*) 
        <input name="classid" type="hidden" id="classid" value="<?=$classid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="oldbclassid" type="hidden" id="oldbclassid" value="<?=$r[bclassid]?>"> 
        <input name="oldclassname" type="hidden" id="oldclassname" value="<?=$r[classname]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���������</td>
      <td height="25" bgcolor="#FFFFFF"><input name="bname" type="text" id="bname" value="<?=$r[bname]?>" size="30"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">�����ࣺ</td>
      <td height="25" bgcolor="#FFFFFF"><select name="bclassid" size="12" id="bclassid" style="width:180">
          <option value="0" selected>������</option>
          <?=$options?>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ռ����ࣺ</td>
      <td height="25" bgcolor="#FFFFFF"> 
        <?=$islast?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ģʽ��</td>
      <td height="25" bgcolor="#FFFFFF"><select name="formtype" id="formtype">
          <option value="1"<?=$r[formtype]==1?' selected':''?>>�����</option>
          <option value="2"<?=$r[formtype]==2?' selected':''?>>��Ӱ��</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʾ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="30"> 
        <font color="#666666">(ֵԽСԽǰ��)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">��������ͼ��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classimg" type="text" id="classimg" value="<?=$r[classimg]?>" size="30">
      </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">����ؼ��֣�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classkey" type="text" id="classkey" value="<?=$r[classkey]?>" size="30"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�����飺</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="classintro" rows="5" style="WIDTH:100%" id="classintro"><?=$r[classintro]?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">ģ������</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����б�ģ�壺</td>
      <td height="25" bgcolor="#FFFFFF"><select name="listtempid" id="listtempid">
          <?=$listtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p>��������ģ�壺</p></td>
      <td height="25" bgcolor="#FFFFFF"><select name="softtempid" id="softtempid">
          <?=$softtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ص�ַÿ����ʾ��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downnum" type="text" id="downnum" value="<?=$r[downnum]?>" size="30">
        ����ַ</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ߵ�ַÿ����ʾ��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="onlinenum" type="text" id="onlinenum" value="<?=$r[onlinenum]?>" size="30">
        ����ַ</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��������</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʾ�ܼ�¼����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="30">
        ��<font color="#666666">(0Ϊ����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�б�ÿҳ��¼����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="30">
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������Ӽ�¼����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="link_num" type="text" id="link_num" value="<?=$r[link_num]?>" size="30">
        ��</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">Ͷ������</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����Ͷ�壺</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openadd" value="0"<?=$r[openadd]==0?' checked':''?>>
        ���� 
        <input type="radio" name="openadd" value="1"<?=$r[openadd]==1?' checked':''?>>
        �ر� </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">Ͷ��Ȩ�ޣ�</td>
      <td height="25" bgcolor="#FFFFFF"><select name="qaddgroupid" id="qaddgroupid">
	  <option value="0">�ο�</option>
          <?=$qgroup?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">Ͷ���õ�����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qaddfen" type="text" id="qaddfen" value="<?=$r[qaddfen]?>" size="30">
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <div align="left"> 
          <input type="submit" name="Submit" value="�ύ">
          &nbsp;&nbsp;<input type="reset" name="Submit2" value="����">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>