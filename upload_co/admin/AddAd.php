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
CheckLevel($myuserid,$myusername,$classid,"ad");
$t=$_GET['t'];
$phome=$_GET['phome'];
$time=$_GET['time'];
$url="<a href='ListAd.php'>������</a>&nbsp;>&nbsp;���ӹ��";
//��ʼ������
$r[starttime]=date("Y-m-d");
$r[endtime]=date("Y-m-d",time()+30*24*3600);
$r[pic_width]=468;
$r[pic_height]=60;
//�޸Ĺ��
if($phome=="EditAd")
{
	$adid=(int)$_GET['adid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downad where adid='$adid'");
	$url="<a href=ListAd.php>������</a>&nbsp;>&nbsp;�޸Ĺ�棺<b>".$r[title]."</b>";
	$a="adtype".$r[adtype];
	$$a=" selected";
	if($r[target]=="_blank")
	{$target1=" selected";}
	elseif($r[target]=="_self")
	{$target2=" selected";}
	else
	{$target3=" selected";}
	$t=$r[t];
}
//���ģʽ
if(strlen($_GET[changet])!=0)
{
	$t=$_GET['changet'];
}
//������
$sql=$empire->query("select classid,classname from {$dbtbpre}downadclass");
while($cr=$empire->fetch($sql))
{
	if($r[classid]==$cr[classid])
	{$s=" selected";}
	else
	{$s="";}
	$options.="<option value=".$cr[classid].$s.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function foreColor()
{
  if (!Error())	return;
  var arr = showModalDialog("editor/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.form1.titlecolor.value=arr;
  else document.form1.titlecolor.focus();
}
</script>
<script src=editor/setday.js></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="30%" height="25">λ�ã� 
      <?=$url?>
    </td>
    <td><table width="500" border="0" align="right" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="25"> <div align="center">[<a href="AddAd.php?phome=AddAd&t=0"><strong>����ͼƬ/FLASH���</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=1"><strong>�������ֹ��</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=2"><strong>����HTML���</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?phome=AddAd&t=3"><strong>���ӵ������</strong></a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td><div align="center"> 
        <?
	//���ֹ��
	if($t==1)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">�������ֹ�� 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>���ģʽ��</strong></td>
              <td height="25"><select name="changet" id="changet" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">ͼƬ/FLASH���</option>
                  <option value="1" selected>���ֹ��</option>
                  <option value="2">HTML���</option>
                  <option value="3">�������</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">�����ࣺ</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit3" value="�������" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">������ƣ�</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (�磺��վBanner���)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������ͣ�</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>��ͨ��ʾ</option>
                  <option value="3"<?=$adtype3?>>���ƶ�͸���Ի���</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���֣�</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td width="51%">���ԣ� 
                      <input name="titlefont[b]" type="checkbox" id="titlefont[b]" value="b"<?=strstr($r[titlefont],'b|')?' checked':''?>>
                      ���� 
                      <input name="titlefont[i]" type="checkbox" id="titlefont[i]" value="i"<?=strstr($r[titlefont],'i|')?' checked':''?>>
                      б�� 
                      <input name="titlefont[s]" type="checkbox" id="titlefont[s]" value="s"<?=strstr($r[titlefont],'s|')?' checked':''?>>
                      ɾ����</td>
                    <td width="49%">��ɫ�� 
                      <input name="titlecolor" type="text" id="titlecolor" value="<?=$r[titlecolor]?>" size="10">
                      <a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
                  </tr>
                </table></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���ӵ�ַ��</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                ��ʾԭ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>���´��ڴ�</option>
                  <option value="_self"<?=$target2?>>��ԭ���ڴ�</option>
                  <option value="_parent"<?=$target3?>>�ڸ����ڴ�</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                �� 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (�����)[���ƶ�͸���Ի�����Ч]</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ʾ���֣�</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">����ʱ�䣺</td>
              <td height="25">�� 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                �� 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                ֹ (��ʽ��2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���õ������</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ע�ͣ�</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="�ύ"> 
                <input type="reset" name="Submit2" value="����"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//html���
	elseif($t==2)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">����HTML��� 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>���ģʽ��</strong></td>
              <td height="25"><select name="changet" id="select2" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">ͼƬ/FLASH���</option>
                  <option value="1">���ֹ��</option>
                  <option value="2" selected>HTML���</option>
                  <option value="3">�������</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">�����ࣺ</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit32" value="�������" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">������ƣ�</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (�磺��վBanner���)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������ͣ�</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>��ͨ��ʾ</option>
                  <option value="3"<?=$adtype3?>>���ƶ�͸���Ի���</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                �� 
                <input name="add[pic_height]2" type="text" id="add[pic_height]2" value="<?=$r[pic_height]?>" size="4">
                (�����)[���ƶ�͸���Ի�����Ч]</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">HTML���룺</td>
              <td height="25"> <textarea name="add[htmlcode]" cols="42" rows="8" id="add[htmlcode]"><?=htmlspecialchars($r[htmlcode])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">����ʱ�䣺</td>
              <td height="25">�� 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                �� 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                ֹ (��ʽ��2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���õ������</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ע�ͣ�</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="�ύ"> 
                <input type="reset" name="Submit2" value="����"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//�������
	elseif($t==3)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">���ӵ������ 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]3" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>���ģʽ��</strong></td>
              <td height="25"><select name="changet" id="select3" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">ͼƬ/FLASH���</option>
                  <option value="1">���ֹ��</option>
                  <option value="2">HTML���</option>
                  <option value="3" selected>�������</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">�����ࣺ</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit33" value="�������" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">������ƣ�</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (�磺��վBanner���)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������ͣ�</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="8"<?=$adtype8?>>���´���</option>
                  <option value="9"<?=$adtype9?>>�����´���</option>
                  <option value="10"<?=$adtype10?>>��ͨ��ҳ�Ի���</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������ַ��</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                �� 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (�����)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">����ʱ�䣺</td>
              <td height="25">�� 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                �� 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                ֹ (��ʽ��2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���õ������</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ע�ͣ�</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="�ύ"> 
                <input type="reset" name="Submit2" value="����"></td>
            </tr>
          </table>
        </form>
        <?
	}
	//ͼƬ/flash���
	else
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr class="header"> 
              <td height="25" colspan="2">����ͼƬ/FLASH��� 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
                <input name="add[t]" type="hidden" id="add[t]4" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>���ģʽ��</strong></td>
              <td height="25"><select name="changet" id="select4" onchange=window.location='AddAd.php?phome=<?=$phome?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0" selected>ͼƬ/FLASH���</option>
                  <option value="1">���ֹ��</option>
                  <option value="2">HTML���</option>
                  <option value="3">�������</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">�����ࣺ</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit34" value="�������" onclick="window.open('AdClass.php');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">������ƣ�</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                (�磺��վBanner���)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������ͣ�</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>��ͨ��ʾ</option>
                  <option value="4"<?=$adtype4?>>����������ʾ</option>
                  <option value="5"<?=$adtype5?>>���¸�����ʾ - ��</option>
                  <option value="6"<?=$adtype6?>>���¸�����ʾ - ��</option>
                  <option value="7"<?=$adtype7?>>ȫ��Ļ������ʧ</option>
                  <option value="3"<?=$adtype3?>>���ƶ�͸���Ի���</option>
                  <option value="11"<?=$adtype11?>>����ʽ���</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">ͼƬ/FLASH��ַ��</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42">
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���</td>
              <td height="25"> <input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                �� 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (�����)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���ӵ�ַ��</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                ��ʾԭ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>���´��ڴ�</option>
                  <option value="_self"<?=$target2?>>��ԭ���ڴ�</option>
                  <option value="_parent"<?=$target3?>>�ڸ����ڴ�</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ʾ���֣�</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>">
                (FLASH�����Ч)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">����ʱ�䣺</td>
              <td height="25">�� 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                �� 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                ֹ (��ʽ��2004-09-01)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">���õ������</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                ����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">��ע�ͣ�</td>
              <td height="25"> <textarea name="add[adsay]" cols="50" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="�ύ"> 
                <input type="reset" name="Submit2" value="����"></td>
            </tr>
          </table>
        </form>
        <?
	}
	?>
      </div></td>
  </tr>
</table>
</body>
</html>
