<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"file");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$add="";
//ѡ�����
$classid=(int)$_GET['classid'];
//��Ŀ
if($classid)
{
	if($class_r[$classid]['islast'])
	{
		$add.=" and classid='$classid'";
	}
	else
	{
		$add.=" and ".ReturnClass($class_r[$classid]['sonclass']);
	}
}
//�ؼ���
$keyboard=RepPostVar2($_GET['keyboard']);
if(!empty($keyboard))
{
	$show=$_GET['show'];
	//����ȫ��
	if($show==0)
	{
		$add.=" and (filename like '%$keyboard%' or fileno like '%$keyboard%' or adduser like '%$keyboard%')";
	}
	//�����ļ���
	elseif($show==1)
	{
		$add.=" and filename like '%$keyboard%'";
	}
	//�������
	elseif($show==2)
	{
		$add.=" and fileno like '%$keyboard%'";
	}
	//�����ϴ���
	else
	{
		$add.=" and adduser like '%$keyboard%'";
	}
}
$search="&classid=$classid&show=$show&keyboard=$keyboard";
$query="select fileid,filename,adduser,filetime,filesize,fileno,classid,path,softid from {$dbtbpre}downfile where 1=1".$add;
$totalquery="select count(*) as total from {$dbtbpre}downfile where 1=1".$add;
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by fileid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>������</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td width="36%">λ�ã�<a href="ListFile.php">������(����ʽ)</a>&nbsp;</td>
    <td width="64%"><div align="right"> 
        <input type="button" name="Submit52" value="Ŀ¼ʽ������" onclick="self.location.href='ListFilePath.php';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form2" method="get" action="ListFile.php">
    <tr> 
      <td>�ؼ���: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> <select name="show" id="show">
          <option value="0"<?=$show==0?' checked':''?>>����</option>
          <option value="1"<?=$show==1?' checked':''?>>�ļ���</option>
          <option value="2"<?=$show==2?' checked':''?>>���</option>
          <option value="3"<?=$show==3?' checked':''?>>�ϴ���</option>
        </select> <span id="listfileclassnav"></span> <input type="submit" name="Submit2" value="����"> 
        <input name="sear" type="hidden" id="sear" value="1"> </td>
      <td><div align="center">[<a href="filephome.php?phome=DelFreeFile" onclick="return confirm('ȷ��Ҫ����?');">����ʧЧ����</a>]</div></td>
    </tr>
  </form>
</table>

<form name="form1" method="post" action="filephome.php" onsubmit="return confirm('ȷ��Ҫɾ��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="5%" height="25"><div align="center">ID</div></td>
      <td width="29%" height="25"><div align="center">�ļ���</div></td>
      <td width="19%"><div align="center">��������</div></td>
      <td width="10%" height="25"><div align="center">������</div></td>
      <td width="9%"><div align="center">�ļ���С(KB)</div></td>
      <td width="17%" height="25"><div align="center">����ʱ��</div></td>
      <td width="11%" height="25"><div align="center">����</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
         if($r[fileno])
         {$fileno="<br>[<b>".$r[fileno]."</b>]";}
         else
         {$fileno="";}
		 $bclassid=$class_r[$r[classid]][bclassid];
		 $url=$class_r[$bclassid][classname]."&nbsp;>&nbsp;".$class_r[$r[classid]][classname];
		 $filesize=ChTheFilesize($r[filesize]);
		 if(empty($r[path]))
	     {
	     	$filename="../data/".$public_r[downpath]."/".$r[filename];
         }
         else
	     {
         	$filename="../data/".$public_r[downpath]."/".$r[path]."/".$r[filename];
	     }
		 //����
		$thisfileid=$r['fileid'];
		if($r['softid'])
		{
			$softr=$empire->fetch1("select filename,titleurl from {$dbtbpre}down where softid='$r[softid]'");
			$thisfileid="<b><a href='".EDReturnSoftPageUrl($softr[filename],$softr[titleurl])."' target=_blank>".$r[fileid]."</a></b>";
		}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$thisfileid?>
        </div></td>
      <td height="25"><div align="center"> <a href="<?=$filename?>" target=_blank> 
          <?=$r[filename]?>
          </a> 
          <?=$fileno?>
        </div></td>
      <td><div align="center">
	  <?=$url?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[adduser]?>
        </div></td>
      <td><div align="center"> 
          <?=$filesize?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[filetime]?>
        </div></td>
      <td height="25"><div align="center">[<a href="filephome.php?phome=DelFile&fileid=<?=$r[fileid]?>" onclick="return confirm('���Ƿ�Ҫɾ����');">ɾ��</a> 
          <input name="fileid[]" type="checkbox" id="fileid[]" value="<?=$r[fileid]?>">
          ]</div></td>
    </tr>
    <?
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"> 
        <?=$returnpage?>
        &nbsp;&nbsp;<input type="submit" name="Submit" value="����ɾ��"> <input name="phome" type="hidden" id="phome" value="DelFile_all">
		&nbsp;
        <input type=checkbox name=chkall value=on onClick="CheckAll(this.form)">
        ѡ��ȫ��</td>
    </tr>
  </table>
</form>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=5&classid=<?=$classid?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?
db_close();
$empire=null;
?>
