<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
CheckLevel($lur[userid],$lur[username],$classid,"public");//��֤Ȩ��

//��������
function SetPublic($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"public");//��֤Ȩ��
	$add[exittime]=(int)$add[exittime];
	if(empty($add[exittime]))
	{
		$add[exittime]=30;
	}
	//����Ŀ¼
	if(empty($add[bakdbpath]))
	{
		$add[bakdbpath]="bdata";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbpath])))
	{
		printerror("�˱���Ŀ¼�����ڣ�������","history.go(-1)");
	}
	if(empty($add[bakdbzip]))
	{
		$add[bakdbzip]="zip";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbzip])))
	{
		printerror("��ѹ��Ŀ¼�����ڣ�������","history.go(-1)");
	}
	if($add[change_path])
	{
		$old="../data/".$add[downpath];
		$newpath=make_password(20);
		$new="../data/".$newpath;
		$rename=rename($old,$new);
		$add1=",downpath='$newpath'";
		$empire->query("update {$dbtbpre}down set downpath=REPLACE(downpath,'$add[downpath]','$newpath')");
	}
	$add[trantype]=','.$add[trantype].',';
	$add[imgtrantype]=','.$add[imgtrantype].',';
	$add[qtrantype]=','.$add[qtrantype].',';
	$add[qimgtrantype]=','.$add[qimgtrantype].',';
	$add[transize]=(int)$add[transize];
	$add[topnum]=(int)$add[topnum];
	$add[save_soft]=(int)$add[save_soft];
	$add[relist_num]=(int)$add[relist_num];
	$add[resoft_num]=(int)$add[resoft_num];
	$add[openregister]=(int)$add[openregister];
	$add[openadd]=(int)$add[openadd];
	$add[checked]=(int)$add[checked];
	$add[newnum]=(int)$add[newnum];
	$add[sub_top]=(int)$add[sub_top];
	$add[sub_new]=(int)$add[sub_new];
	$add[defaultgroupid]=(int)$add[defaultgroupid];
	$add[redodown]=(int)$add[redodown];
	$add[reindextime]=(int)$add[reindextime];
	$add[dohtml]=(int)$add[dohtml];
	$add[repnum]=(int)$add[repnum];
	$add[ebakthisdb]=(int)$add[ebakthisdb];
	$add[limittype]=(int)$add[limittype];
	$add[filechmod]=(int)$add[filechmod];
	$add[defdownnum]=(int)$add[defdownnum];
	$add[defonlinenum]=(int)$add[defonlinenum];
	$add[imgtransize]=(int)$add[imgtransize];
	$add[qtransize]=(int)$add[qtransize];
	$add[qimgtransize]=(int)$add[qimgtransize];
	$add[ebakcanlistdb]=(int)$add[ebakcanlistdb];
	$add[retime]=(int)$add[retime];
	$add[openpl]=(int)$add[openpl];
	$add[plsize]=(int)$add[plsize];
	$add[min_userlen]=(int)$add[min_userlen];
	$add[max_userlen]=(int)$add[max_userlen];
	$add[min_passlen]=(int)$add[min_passlen];
	$add[max_passlen]=(int)$add[max_passlen];
	$add[adminloginkey]=(int)$add[adminloginkey];
	$add[registerkey]=(int)$add[registerkey];
	$add[loginkey]=(int)$add[loginkey];
	$add[emailonly]=(int)$add[emailonly];
	$add[opengetdown]=(int)$add[opengetdown];
	$add[plkey]=(int)$add[plkey];
	$add[zmnum]=(int)$add[zmnum];
	$add[zmmaxnum]=(int)$add[zmmaxnum];
	$add[gg_num]=(int)$add[gg_num];
	$add[classnavline]=(int)$add[classnavline];
	$add[regdownfen]=(int)$add[regdownfen];
	$add[dozthtml]=(int)$add[dozthtml];
	$add[memberchecked]=(int)$add[memberchecked];
	$add[checkresoftname]=(int)$add[checkresoftname];
	$add[reuserpagenum]=(int)$add[reuserpagenum];
	$add[zmlisttempid]=(int)$add[zmlisttempid];
	$add[listpagelistnum]=(int)$add[listpagelistnum];
	if($add[reindextime]<12)
	{$add[reindextime]=12;}
	$sql=$empire->query("update {$dbtbpre}downpublic set sitename='$add[sitename]',sitedown='$add[sitedown]',email='$add[email]',trantype='$add[trantype]',transize='$add[transize]',topnum='$add[topnum]',save_soft='$add[save_soft]',relist_num='$add[relist_num]',resoft_num='$add[resoft_num]',openregister='$add[openregister]',openadd='$add[openadd]',checked='$add[checked]',newnum='$add[newnum]',sub_top='$add[sub_top]',sub_new='$add[sub_new]',exittime='$add[exittime]',defaultgroupid='$add[defaultgroupid]',bakdbpath='$add[bakdbpath]',bakdbzip='$add[bakdbzip]',downpass='$add[downpass]',redodown='$add[redodown]',reindextime='$add[reindextime]',dohtml='$add[dohtml]',repnum='$add[repnum]',ebakthisdb='$add[ebakthisdb]',limittype='$add[limittype]',filechmod='$add[filechmod]',defdownnum='$add[defdownnum]',defonlinenum='$add[defonlinenum]',imgtrantype='$add[imgtrantype]',imgtransize='$add[imgtransize]',qtrantype='$add[qtrantype]',qtransize='$add[qtransize]',qimgtrantype='$add[qimgtrantype]',qimgtransize='$add[qimgtransize]',ebakcanlistdb='$add[ebakcanlistdb]',refiletype='$add[refiletype]',relistpath='$add[relistpath]',resoftpath='$add[resoftpath]',retime='$add[retime]',sitekey='$add[sitekey]',siteintro='$add[siteintro]',openpl='$add[openpl]',plsize='$add[plsize]',plcloseword='$add[plcloseword]',closeusername='$add[closeusername]',min_userlen='$add[min_userlen]',max_userlen='$add[max_userlen]',min_passlen='$add[min_passlen]',max_passlen='$add[max_passlen]',adminloginkey='$add[adminloginkey]',registerkey='$add[registerkey]',loginkey='$add[loginkey]',emailonly='$add[emailonly]',opengetdown='$add[opengetdown]',plkey='$add[plkey]',navfh='$add[navfh]',zmnum='$add[zmnum]',zmmaxnum='$add[zmmaxnum]',adfile='$add[adfile]',gg_num='$add[gg_num]',classnavline='$add[classnavline]',classnavfh='$add[classnavfh]',regdownfen='$add[regdownfen]',dozthtml='$add[dozthtml]',memberchecked='$add[memberchecked]',checkresoftname='$add[checkresoftname]',reuserpagenum='$add[reuserpagenum]',zmlisttempid='$add[zmlisttempid]',listpagelistnum='$add[listpagelistnum]'".$add1);
	//���»���
	GetPublic();
	if($sql)
	{
		printerror("�������óɹ�","public.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if($phome=='SetPublic')
{
	SetPublic($_POST,$lur[userid],$lur[username]);
}

$r=$empire->fetch1("select * from {$dbtbpre}downpublic limit 1");
$r[trantype]=substr($r[trantype],1,strlen($r[trantype])-2);
$r[imgtrantype]=substr($r[imgtrantype],1,strlen($r[imgtrantype])-2);
$r[qtrantype]=substr($r[qtrantype],1,strlen($r[qtrantype])-2);
$r[qimgtrantype]=substr($r[qimgtrantype],1,strlen($r[qimgtrantype])-2);
//��Ա��
$mgsql=$empire->query("select * from {$dbtbpre}downmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[defaultgroupid]==$mgr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$mgr[groupid].$select.">".$mgr[groupname]."</option>";
}
//�б�ģ��
$zmlisttemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	if($ltr[tempid]==$r[zmlisttempid])
	{$select=" selected";}
	else
	{$select="";}
	$zmlisttemp.="<option value=".$ltr[tempid].$select.">".$ltr[tempname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��������</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>λ�ã�<a href="public.php">��������</a></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="public.php">
    <tr class="header"> 
      <td height="25" colspan="2">�������� 
        <input type=hidden name=old_sitedown value="<?=$r[sitedown]?>"></td>
    </tr>
    <tr> 
      <td width="31%" height="25">վ����Ϣ</td>
      <td width="69%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">վ������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitename" type="text" id="sitename" value="<?=$r[sitename]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">վ���ַ:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitedown" type="text" id="sitedown" value="<?=$r[sitedown]?>" size="38"> 
        <font color="#666666">(��edown��װ��ַ�����ں������&quot;/&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">վ������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="email" type="text" id="sitename4" value="<?=$r[email]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">վ��ؼ���:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sitekey" type="text" id="email" value="<?=$r[sitekey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">վ����:</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="siteintro" cols="60" rows="5" id="siteintro"><?=$r[siteintro]?></textarea></td>
    </tr>
    <tr> 
      <td height="25">��̨����</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨��¼��ʱ:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="exittime" type="text" id="exittime" value="<?=$r[exittime]?>" size="38">
        ����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨��¼��֤��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginkey" type="radio" value="1"<?=$r[adminloginkey]==1?' checked':''?>>
        ���� 
        <input name="adminloginkey" type="radio" value="0"<?=$r[adminloginkey]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25">���ع���</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������ֱ�����ͨ��:</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        �� 
        <input type="radio" name="checked" value="0"<?=$r[checked]==0?' checked':''?>>
        ��<font color="#666666">(��������ʱĬ��ѡ��)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">�������غ�ֱ�������б�:</td>
      <td height="25" bgcolor="#FFFFFF">���ࣺ 
        <select name="dohtml" style="width:210;">
          <option value="0"<?=$r['dohtml']==0?' selected':''?>>������</option>
          <option value="1"<?=$r['dohtml']==1?' selected':''?>>���ɵ�ǰ����ҳ</option>
          <option value="2"<?=$r['dohtml']==2?' selected':''?>>������ҳ</option>
          <option value="3"<?=$r['dohtml']==3?' selected':''?>>���ɸ�����ҳ</option>
          <option value="4"<?=$r['dohtml']==4?' selected':''?>>���ɵ�ǰ����ҳ�븸����ҳ</option>
          <option value="5"<?=$r['dohtml']==5?' selected':''?>>���ɸ�����ҳ����ҳ</option>
          <option value="6"<?=$r['dohtml']==6?' selected':''?>>���ɵ�ǰ����ҳ��������ҳ����ҳ</option>
        </select> <font color="#666666">(�������������²��Ƽ�ѡ��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ר�⣺ 
        <select name="dozthtml" style="width:210;">
          <option value="0"<?=$r['dozthtml']==0?' selected':''?>>������</option>
          <option value="1"<?=$r['dozthtml']==1?' selected':''?>>�����������ҳ</option>
          <option value="2"<?=$r['dozthtml']==2?' selected':''?>>����ר��ҳ</option>
          <option value="3"<?=$r['dozthtml']==3?' selected':''?>>������ĸ����ҳ</option>
          <option value="4"<?=$r['dozthtml']==4?' selected':''?>>�����������ҳ��ר��ҳ</option>
          <option value="5"<?=$r['dozthtml']==5?' selected':''?>>�����������ҳ��ר��ҳ����ĸҳ</option>
        </select> <font color="#666666">(�������������²��Ƽ�ѡ��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ظ������</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="checkresoftname" value="1"<?=$r[checkresoftname]==1?' checked':''?>>
        �� 
        <input type="radio" name="checkresoftname" value="0"<?=$r[checkresoftname]==0?' checked':''?>>
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">Ĭ��¼�����ص�ַ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="defdownnum" type="text" id="exittime" value="<?=$r[defdownnum]?>" size="38"> 
        <font color="#666666">(��������ʱĬ��ѡ��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">Ĭ��¼�����ߵ�ַ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="defonlinenum" type="text" id="defdownnum" value="<?=$r[defonlinenum]?>" size="38"> 
        <font color="#666666">(��������ʱĬ��ѡ��)</font></td>
    </tr>
    <tr> 
      <td height="25">��������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ͬһ��ַ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="redodown" type="text" id="redodown" value="<?=$r[redodown]?>" size="38">
        ��Сʱ ���ظ��۵�<strong></strong></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������֤��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downpass" type="text" id="downpass" value="<?=$r[downpass]?>" size="38"> 
        <font color="#666666">(��Ҫ���ڷ�����,�붨�ڸ���һ������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ֱ�����ط�ʽ:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetdown" value="1"<?=$r[opengetdown]==1?' checked':''?>>
        ���� 
        <input type="radio" name="opengetdown" value="0"<?=$r[opengetdown]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25">��������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʱ������ҳ:</td>
      <td height="25" bgcolor="#FFFFFF">ִ��ʱ����: 
        <input name="reindextime" type="text" id="reindextime" value="<?=$r[reindextime]?>" size="6">
        ����<font color="#666666">(С��12����ϵͳ����Ϊ12����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ļ���չ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="refiletype" type="text" id="refiletype" value="<?=$r[refiletype]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�б�ҳ���Ŀ¼:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="relistpath" type="text" id="relistpath" value="<?=$r[relistpath]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ҳ���Ŀ¼:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="resoftpath" type="text" id="resoftpath" value="<?=$r[resoftpath]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿ�������б�ҳ��¼��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="relist_num" type="text" id="relist_num" value="<?=$r[relist_num]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿ����������ҳ��¼��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="resoft_num" type="text" id="resoft_num" value="<?=$r[resoft_num]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿ�������Զ���ҳ���¼��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="reuserpagenum" type="text" id="reuserpagenum" value="<?=$r[reuserpagenum]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ʱ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="retime" type="text" id="retime" value="<?=$r[retime]?>" size="38">
        �� </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿ���滻���ص�ַ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="repnum" type="text" id="repnum" value="<?=$r[repnum]?>" size="38"> 
      </td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">��ĸ����ҳ</td>
      <td height="25" bgcolor="#FFFFFF">�б�ģ�� 
        <select name="zmlisttempid" id="zmlisttempid">
          <?=$zmlisttemp?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿҳ��ʾ: 
        <input name="zmnum" type="text" id="zmnum" value="<?=$r[zmnum]?>" size="6">
        ��������¼��: 
        <input name="zmmaxnum" type="text" id="zmmaxnum" value="<?=$r[zmmaxnum]?>" size="6">
        ��</td>
    </tr>
    <tr> 
      <td height="25">��Ա����</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ע��:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openregister" value="0"<?=$r[openregister]==0?' checked':''?>>
        ���� 
        <input type="radio" name="openregister" value="1"<?=$r[openregister]==1?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��Ա�Ƿ�Ҫ���:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="memberchecked" value="0"<?=$r[memberchecked]==0?' checked':''?>>
        ֱ��ͨ�� 
        <input type="radio" name="memberchecked" value="1"<?=$r[memberchecked]==1?' checked':''?>>
        ��Ҫ���</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ע���ԱĬ�ϻ�Ա��:</td>
      <td height="25" bgcolor="#FFFFFF"><select name="defaultgroupid" id="defaultgroupid">
          <?=$membergroup?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ע�����͵���:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="regdownfen" type="text" id="regdownfen" value="<?=$r[regdownfen]?>" size="38">
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�û�������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="min_userlen" type="text" id="min_userlen" value="<?=$r[min_userlen]?>" size="6">
        ~ 
        <input name="max_userlen" type="text" id="max_userlen" value="<?=$r[max_userlen]?>" size="6">
        ���ֽ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="min_passlen" type="text" id="min_userlen3" value="<?=$r[min_passlen]?>" size="6">
        ~ 
        <input name="max_passlen" type="text" id="max_passlen" value="<?=$r[max_passlen]?>" size="6">
        ���ֽ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�û���ע����������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="closeusername" type="text" id="repnum3" value="<?=$r[closeusername]?>" size="38"> 
        <font color="#666666">(��ֹ�����ַ�,�����&quot;|&quot;�Ÿ���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��Ա����Ψһ�Լ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="emailonly" type="radio" value="1"<?=$r[emailonly]==1?' checked':''?>>
        ���� 
        <input name="emailonly" type="radio" value="0"<?=$r[emailonly]==0?' checked':''?>>
        �ر� </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ע�Ὺ����֤��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="registerkey" type="radio" value="1"<?=$r[registerkey]==1?' checked':''?>>
        ���� 
        <input name="registerkey" type="radio" value="0"<?=$r[registerkey]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��¼������֤��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="loginkey" type="radio" value="1"<?=$r[loginkey]==1?' checked':''?>>
        ���� 
        <input name="loginkey" type="radio" value="0"<?=$r[loginkey]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����Ͷ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openadd" value="0"<?=$r[openadd]==0?' checked':''?>>
        ���� 
        <input type="radio" name="openadd" value="1"<?=$r[openadd]==1?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25">��������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openpl" value="1"<?=$r[openpl]==1?' checked':''?>>
        ���� 
        <input type="radio" name="openpl" value="0"<?=$r[openpl]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������֤��:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plkey" type="radio" value="1"<?=$r[plkey]==1?' checked':''?>>
        ���� 
        <input name="plkey" type="radio" value="0"<?=$r[plkey]==0?' checked':''?>>
        �ر�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plsize" type="text" id="plsize" value="<?=$r[plsize]?>" size="38">
        �ֽ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ֹ���ֵ��ַ�:<br> <font color="#666666">(�������&quot;<strong>|</strong>&quot;����)</font></td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="plcloseword" cols="60" rows="5" id="plcloseword"><?=$r[plcloseword]?></textarea></td>
    </tr>
    <tr> 
      <td height="25">�ļ�����</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF">�����ϴ�Ŀ¼:</td>
      <td height="25" bgcolor="#FFFFFF">data/ 
        <input name="downpath" type="text" id="downpath" value="<?=$r[downpath]?>" size="32" readonly> 
        <font color="#666666">(Ϊ�˰�ȫ����,���ɸ���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><input name="change_path" type="checkbox" id="change_path" value="1">
        �ı��ϴ�Ŀ¼<font color="#666666">(����Ƿ�����ʱ�õ�.��Ҫ�޸�Ŀ¼,����Ϲ�,ϵͳ���Զ��ı�Ŀ¼)</font> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨�����ϴ���������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="trantype" type="text" id="trantype" value="<?=$r[trantype]?>" size="38"> 
        <font color="#666666">(�������&quot;,&quot;����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨�����ϴ�������С:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="transize" type="text" id="transize" value="<?=$r[transize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨�����ϴ�ͼƬ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="imgtrantype" type="text" id="trantype3" value="<?=$r[imgtrantype]?>" size="38"> 
        <font color="#666666">(�������&quot;,&quot;����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��̨�����ϴ�ͼƬ��С:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="imgtransize" type="text" id="transize3" value="<?=$r[imgtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������Ƿ����ڴ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="save_soft" value="0"<?=$r[save_soft]==0?' checked':''?>>
        �� 
        <input type="radio" name="save_soft" value="1"<?=$r[save_soft]==1?' checked':''?>>
        ��<font color="#666666">(��ѡ�񣬽������ϴ����������ͬһ��Ŀ¼)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ǰ̨�����ϴ��ļ�����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qtrantype" type="text" id="qtrantype" value="<?=$r[qtrantype]?>" size="38"> 
        <font color="#666666">(�������&quot;,&quot;����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ǰ̨�����ϴ��ļ���С:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qtransize" type="text" id="qtransize" value="<?=$r[qtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ǰ̨�����ϴ�ͼƬ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qimgtrantype" type="text" id="imgtrantype" value="<?=$r[qimgtrantype]?>" size="38"> 
        <font color="#666666">(�������&quot;,&quot;����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ǰ̨�����ϴ�ͼƬ��С:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qimgtransize" type="text" id="imgtransize" value="<?=$r[qimgtransize]?>" size="38">
        KB</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ļ�����Ȩ��:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="filechmod" value="1"<?=$r[filechmod]==1?' checked':''?>>
        ������ 
        <input type="radio" name="filechmod" value="0"<?=$r[filechmod]==0?' checked':''?>>
        0777 <font color="#666666">(ͨ�����ѡ������) </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���JS�ļ�ǰ׺:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adfile" type="text" id="adfile" value="<?=$r[adfile]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25">���ݿⱸ������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ݱ��ݴ��Ŀ¼:</td>
      <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
        <input name="bakdbpath" type="text" id="bakdbpath" value="<?=$r[bakdbpath]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ѹ�������Ŀ¼:</td>
      <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
        <input name="bakdbzip" type="text" id="bakdbzip" value="<?=$r[bakdbzip]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����ֻѡ��ǰ���ݿ�:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ebakthisdb" type="checkbox" id="ebakthisdb" value="1"<?=$r[ebakthisdb]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ռ䲻֧�����ݿ��б�:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ebakcanlistdb" type="checkbox" id="ebakcanlistdb" value="1"<?=$r[ebakcanlistdb]==1?' checked':''?>>
        ��<font color="#666666">(����ռ䲻�����г����ݿ�,���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">֧��MYSQL��ѯ��ʽ:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="limittype" type="checkbox" id="limittype" value="1"<?=$r[limittype]==1?' checked':''?>>
        ֧��</td>
    </tr>
    <tr> 
      <td height="25">JS��������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���µ�������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="newnum" type="text" id="newnum" value="<?=$r[newnum]?>" size="6">
        ������ȡ 
        <input name="sub_new" type="text" id="sub_new" value="<?=$r[sub_new]?>" size="6">
        �ֽ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���е�������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="topnum" type="text" id="topnum" value="<?=$r[topnum]?>" size="6">
        ������ȡ 
        <input name="sub_top" type="text" id="sub_top" value="<?=$r[sub_top]?>" size="6">
        �ֽ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����JS��������:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="gg_num" type="text" id="gg_num" value="<?=$r[gg_num]?>" size="6">
        ��</td>
    </tr>
    <tr> 
      <td height="25">��������</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������λ�á���������ַ�:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="navfh" type="text" id="navfh" value="<?=htmlspecialchars($r[navfh])?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ർ����ʾ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classnavline" type="text" id="classnavline" value="<?=$r[classnavline]?>" size="38"> 
        <font color="#666666">(0Ϊ����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ർ���ָ��ַ�:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="classnavfh" type="text" id="navfh3" value="<?=htmlspecialchars($r[classnavfh])?>" size="38"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�б�ʽ��ҳÿҳ��ʾ:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="listpagelistnum" type="text" id="listpagelistnum" value="<?=$r[listpagelistnum]?>" size="38">
        ������</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="�ύ"> 
        <input type="reset" name="Submit2" value="����"> <input name="phome" type="hidden" id="phome" value="SetPublic"></td>
    </tr>
  </form>
</table>
</body>
</html>
