<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../data/cache/class.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$bclassid=(int)$_GET['bclassid'];
$classid=(int)$_GET['classid'];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"soft");
if(empty($class_r[$classid]['classid']))
{
	printerror('�˷��಻����','history.go(-1)');
}
$line=20;//ÿҳ��ʾ����
$page_line=18;//ÿҳ��ʾ������
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//��ƫ����
$url=AdminReturnClassLink($classid);
$search="&classid=".$classid;
$where='';
//ר��ID
$ztid=intval($_GET['ztid']);
if($ztid)
{
	$where.=" and ztid='$ztid'";
	$search.="&ztid=$ztid";
}
//ȡ��ר��
$ztclass="";
$doztclass="";
$z_sql=$empire->query("select ztname,ztid from {$dbtbpre}downzt order by ztid desc");
while($z_r=$empire->fetch($z_sql))
{
	$selected="";
	if($z_r[ztid]==$ztid)
	{
		$selected=" selected";
	}
	$ztclass.="<option value='".$z_r[ztid]."'".$selected.">".$z_r[ztname]."</option>";
	$doztclass.="<option value='".$z_r[ztid]."'>".$z_r[ztname]."</option>";
}
//����
$sear=$_GET['sear'];
if($sear)
{
	$showspecial=$_GET['showspecial'];
	if($showspecial==1)//�ö�
	{
		$where.=' and istop<>0';
	}
	elseif($showspecial==2)//�Ƽ�
	{
		$where.=' and isgood=1';
	}
	elseif($showspecial==3)//δ���
	{
		$where.=' and checked=0';
	}
	elseif($showspecial==4)//�����
	{
		$where.=' and checked=1';
	}
	if($_GET['keyboard'])
	{
		$keyboard=RepPostVar2($_GET['keyboard']);
		$show=$_GET['show'];
		if($show==0)//����ȫ��
		{
			$where.=" and (softname like '%$keyboard%' or softsay like '%$keyboard%' or adduser like '%$keyboard%')";
		}
		elseif($show==1)//�����������
		{
			$where.=" and (softname like '%$keyboard%')";
		}
		elseif($show==2)//ID
		{
			$where.=" and (softid='$keyboard')";
		}
		elseif($show==3)//�����������
		{
			$where.=" and (softsay like '%$keyboard%')";
		}
		else
		{
			$where.=" and (adduser like '%$keyboard%')";
		}
	}
	$search.="&sear=1&keyboard=$keyboard&show=$show&showspecial=$showspecial";
}
//����
$orderby=$_GET['orderby'];
$doorderby=$orderby?'asc':'desc';
$myorder=$_GET['myorder'];
if($myorder==1)//ID��
{$doorder="softid";}
elseif($myorder==2)//ʱ��
{$doorder="softtime";}
elseif($myorder==3)//����������
{$doorder="count_all";}
elseif($myorder==4)//����������
{$doorder="count_month";}
elseif($myorder==5)//����������
{$doorder="count_week";}
elseif($myorder==6)//����������
{$doorder="count_day";}
else//Ĭ������
{$doorder="softid";}
$doorder.=' '.$doorderby;
$search.="&myorder=$myorder&orderby=$orderby";
$query="select softid,softname,adduser,softtime,checked,ismember,filename,titleurl,istop,isgood,softpic from {$dbtbpre}down where classid='$classid'".$where;
//�ܼ�¼��
$totalnum=(int)$_GET['totalnum'];
if(empty($totalnum))
{
	$totalquery="select count(*) as total from {$dbtbpre}down where classid='$classid'".$where;
	$num=$empire->gettotal($totalquery);
}
else
{
	$num=$totalnum;
}
$search.="&totalnum=$totalnum";
$query=$query." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$phpmyself=urlencode($_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]);
$softclassurl=EDReturnClassNavUrl();
$classurl=EDReturnClassUrl($classid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�������</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã� 
      <?=$url?>
      <div align="right"></div>
      <div align="right"> </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
<form name="ReForm" method="get" action="infophome.php">
    <tr> 
      <td width="26%"> [<a href="../" target=_blank>Ԥ����ҳ</a>]&nbsp;[<a href="<?=$softclassurl?>" target=_blank>Ԥ�����ർ��</a>]&nbsp;[<a href="<?=$classurl?>" target=_blank>Ԥ������</a>]</td>
      <td width="28%"> 
        <select name="dore">
        <option value="1">���ɵ�ǰ����</option>
        <option value="2">������ҳ</option>
        <option value="3">���ɸ�����</option>
        <option value="4">���ɵ�ǰ�����븸����</option>
        <option value="5">���ɸ���������ҳ</option>
        <option value="6" selected>���ɵ�ǰ���ࡢ����������ҳ</option>
      </select> <input type="button" name="Submit12" value="�ύ" onclick="self.location.href='infophome.php?phome=AddSoftToReHtml&classid=<?=$classid?>&dore='+document.ReForm.dore.value;">
      </td>
      <td width="46%"> 
        <div align="right"> 
          <input type="button" name="Submit22" value="������ҳ" onclick="self.location.href='chtmlphome.php?phome=ReIndex'">
          &nbsp;&nbsp; 
          <input type="button" name="Submit22" value="���ɷ��ർ��" onclick="self.location.href='chtmlphome.php?phome=ReClassJS_all&do=class&from=<?=$phpmyself?>'">
          &nbsp;&nbsp; 
          <input name="Submit32" type="button" value="�������е���" onclick="self.location.href='chtmlphome.php?phome=ReListJs&do=class&from=<?=$phpmyself?>'">
        </div></td>
  </tr>
</form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <form name="form2" method="get" action="ListSoft.php">
    <tr bgcolor="#FFFFFF">
      <td width="11%"> <input type="button" name="Submit3" value="��������" onclick="self.location.href='AddSoft.php?classid=<?=$classid?>&phome=AddSoft'"> 
      </td>
      <td width="89%" height="30"> <div align="center"> </div>
        <div align="center"></div>
        <div align="right">&nbsp;�ؼ���: 
          <select name="showspecial" id="showspecial">
            <option value="0"<?=$showspecial==0?' selected':''?>>��������</option>
            <option value="1"<?=$showspecial==1?' selected':''?>>�ö�</option>
            <option value="2"<?=$showspecial==2?' selected':''?>>�Ƽ�</option>
            <option value="3"<?=$showspecial==3?' selected':''?>>δ���</option>
            <option value="4"<?=$showspecial==4?' selected':''?>>�����</option>
          </select>
          <input name="keyboard" type="text" value="<?=$keyboard?>">
          <select name="show" id="show">
            <option value="0"<?=$show==0?' selected':''?>>����</option>
            <option value="1"<?=$show==1?' selected':''?>>�����</option>
            <option value="2"<?=$show==2?' selected':''?>>���ID</option>
            <option value="3"<?=$show==3?' selected':''?>>���˵��</option>
            <option value="4"<?=$show==4?' selected':''?>>������</option>
          </select>
          <select name="ztid" id="ztid">
            <option value="0">����ר��</option>
            <?=$ztclass?>
          </select>
          <select name="myorder" id="myorder">
            <option value="1"<?=$myorder==1?' selected':''?>>��ID</option>
            <option value="2"<?=$myorder==2?' selected':''?>>������ʱ��</option>
            <option value="3"<?=$myorder==3?' selected':''?>>������������</option>
            <option value="4"<?=$myorder==4?' selected':''?>>������������</option>
            <option value="5"<?=$myorder==5?' selected':''?>>������������</option>
            <option value="6"<?=$myorder==6?' selected':''?>>������������</option>
          </select>
          <select name="orderby" id="orderby">
            <option value="0"<?=$orderby==0?' selected':''?>>��������</option>
            <option value="1"<?=$orderby==1?' selected':''?>>��������</option>
          </select>
          <input type="submit" name="Submit2" value="����">
          <input name="sear" type="hidden" id="sear" value="1">
          <input name="classid" type="hidden" id="classid" value="<?=$classid?>">
        </div></td>
    </tr>
  </form>
</table>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="listsoft" method="post" action="infophome.php" onsubmit="return confirm('ȷ��Ҫִ�д˲���?');">
    <tr class="header"> 
      <td width="4%">&nbsp;</td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="32%" height="25"><div align="center">��������</div></td>
      <td width="17%" height="25"><div align="center">������</div></td>
      <td width="6%"><div align="center">����</div></td>
      <td width="22%" height="25"><div align="center">����ʱ��</div></td>
      <td width="13%" height="25"><div align="center">����</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
		//�ö�
		$istop="";
		if($r[istop])
		{
			$istop="<font color=red>[��".$r[istop]."]</font>";
		}
		//�Ƽ�
		$isgood="";
		if($r[isgood])
		{
			$isgood="<font color=red>[��]</font>";
		}
		//����ͼƬ
		$showsoftpic="";
		if($r[softpic])
		{
			$showsoftpic="<a href='".$r[softpic]."' title='Ԥ����ͼ' target=_blank><img src='../data/images/showimg.gif' border=0></a>";
		}
		if(empty($r[checked]))
		{$checked=" title='δ���' style='background:#99C4E3'";}
		else
		{$checked="";}
		//��Ա
		if($r[ismember])
		{$fcolor="red";}
		else
		{$fcolor="000000";}
		//ҳ���ַ
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		$showid="<a href='infophome.php?phome=ReSingleSoftHtml&classid=$classid&softid[]=$r[softid]'>$r[softid]</a>";
	?>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="center"> 
          <input name="softid[]" type="checkbox" id="softid[]" value="<?=$r[softid]?>"<?=$checked?>>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$showid?>
        </div></td>
      <td height="25"><div align="">
		<?=$istop.$isgood?>
        <?=$showsoftpic?>
		<a href="<?=$softurl?>" target=_blank> 
          <?=$r[softname]?>
          </a></div></td>
      <td height="25"><div align="center"> <font color="<?=$fcolor?>"> 
          <?=$r[adduser]?>
          </font> </div></td>
      <td><div align="center"><a href="ListPl.php?softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>" target="_blank">����</a></div></td>
      <td height="25"><div align="center"> 
          <?=date("Y-m-d H:i:s",$r[softtime])?>
        </div></td>
      <td height="25"><div align="center">[<a href="AddSoft.php?phome=EditSoft&softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>">�޸�</a>] 
          [<a href="infophome.php?phome=DelSoft&softid=<?=$r[softid]?>&bclassid=<?=$bclassid?>&classid=<?=$classid?>" onclick="return confirm('���Ƿ�Ҫɾ����');">ɾ��</a>]</div></td>
    </tr>
    <?
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        </div></td>
      <td height="25" colspan="6"><input type="submit" name="Submit42" value="����" onclick="document.listsoft.phome.value='ReSingleSoftHtml';"> &nbsp;
        <input type="submit" name="Submit4" value="���" onclick="document.listsoft.phome.value='CheckSoft_all';"> &nbsp;
        <select name="istop" id="select">
          <option value="0">0���ö�</option>
          <option value="1">1���ö�</option>
          <option value="2">2���ö�</option>
          <option value="3">3���ö�</option>
          <option value="4">4���ö�</option>
          <option value="5">5���ö�</option>
          <option value="6">6���ö�</option>
        </select> <input type="submit" name="Submit5" value="�ö�" onclick="document.listsoft.phome.value='TopSoft_all';"> &nbsp;
        <span id="moveclassnav"></span>
		<input type="submit" name="Submit52" value="�ƶ�" onclick="document.listsoft.phome.value='MoveSoft';"> 
        <input type="submit" name="Submit6" value="����" onclick="document.listsoft.phome.value='CopySoft';"> &nbsp;
        <input type="submit" name="Submit" value="ɾ��" onclick="document.listsoft.phome.value='DelSoft_all';">
        <input name="phome" type="hidden" id="phome2" value="DelSoft_all">
        <input name="classid" type="hidden" value="<?=$classid?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7">&nbsp; 
        <?=$returnpage?>
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"><font color="#666666">��ע����ѡ��Ϊ��ɫ����δ���������ö�����Խ��Խǰ�棬��������ɫΪ��ɫ�ǻ�Ա������</font></td>
    </tr>
  </form>
</table>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=3" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?
db_close();
$empire=null;
?>
