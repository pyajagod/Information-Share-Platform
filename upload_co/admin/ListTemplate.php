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
$r=$empire->fetch1("select * from {$dbtbpre}downpubtemp limit 1");
db_close();
$empire=null;
$tname=$_GET['tname'];
$jspath=$public_r['sitedown']."data/js/";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�޸�ģ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr>
    <td bgcolor="#FFFFFF">ģ���޸ļ��ɣ�����Dreamweaver�޸���ģ�壬Ȼ���ڸ��Ƶ���Ӧ���ı����С�</td>
  </tr>
</table>
<?php
if($tname=="indextemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="indextemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸���ҳģ��&nbsp;(<a href="../" target=_blank>Ԥ��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[indextemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="indextemp">
          <input type="reset" name="Submit2" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td><strong><font color="#0000FF">������ò�������˵����</font></strong></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="25%">�������У�����ID=0��</td>
                  <td width="25%">������ã�����ID=����ID��</td>
                  <td width="25%">ר����ã�����ID=ר��ID��</td>
                  <td width="25%">������͵��ã�����ID=�������ID��</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>0��������������</td>
                  <td>6����������</td>
                  <td>12��ר������</td>
                  <td>18�������������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>1�����������Ƽ�</td>
                  <td>7�������Ƽ�</td>
                  <td>13��ר���Ƽ�</td>
                  <td>19����������Ƽ�</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>2����������������</td>
                  <td>8����������������</td>
                  <td>14��ר������������</td>
                  <td>20���������������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>3����������������</td>
                  <td>9����������������</td>
                  <td>15��ר������������</td>
                  <td>21���������������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>4����������������</td>
                  <td>10����������������</td>
                  <td>16��ר������������</td>
                  <td>22���������������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>5����������������</td>
                  <td>11����������������</td>
                  <td>17��ר������������</td>
                  <td>23���������������</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td height="23"><strong><font color="#0000FF">���ֵ��ñ�ǩ˵����[phomedown]����ID,��ʾ����,������ƽ�ȡ��,�Ƿ���ʾʱ��,��������,�Ƿ���ʾ������,'ʱ���ʽ'[/phomedown]</font></strong></td>
          </tr>
          <tr>
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">����ID</td>
                  <td width="88%">Ҫ���õķ���ID/ר��ID/�������ID(�鿴���ID�ŵ�<a href="ListClass.php" target="_blank"><strong>����</strong></a>/ר��ID��<a href="ListZt.php" target="_blank"><strong>����</strong></a>/�������ID�ŵ�<a href="softtype.php" target="_blank"><strong>����</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��ʾ����</td>
                  <td>�����������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>������ƽ�ȡ����</td>
                  <td>��ȡ�����������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>�Ƿ���ʾʱ��</td>
                  <td>1Ϊ��ʾ��0Ϊ����ʾ</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��������</td>
                  <td>��ϸ�������������ò�������˵��</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>�Ƿ���ʾ������</td>
                  <td>�Ƿ����������ǰ����ʾ��������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ʱ���ʽ</td>
                  <td>ʱ���ʽ��ʽ��Y-m-d H:i:s��Ĭ��Ϊ��'(m-d)'���磺��Y-m-d��Ϊ��2008-08-08��</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">ͼƬ���ñ�ǩ˵����[downpic]����ID,��ʾ������,ÿ��ͼƬ��,ͼƬ���,ͼƬ�߶�,�Ƿ���ʾ�����,�������ȡ����,��������[/downpic]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">����ID</td>
                  <td width="88%">Ҫ���õķ���ID/ר��ID/�������ID(�鿴���ID�ŵ�<a href="ListClass.php" target="_blank"><strong>����</strong></a>/ר��ID��<a href="ListZt.php" target="_blank"><strong>����</strong></a>/�������ID�ŵ�<a href="softtype.php" target="_blank"><strong>����</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��ʾ������</td>
                  <td>�������������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ÿ��ͼƬ��</td>
                  <td>ÿ����ʾ����ͼƬ</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ͼƬ���</td>
                  <td>��ʾͼƬ�Ŀ��</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ͼƬ�߶�</td>
                  <td>��ʾͼƬ�ĸ߶�</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>�Ƿ���ʾ�������</td>
                  <td>0Ϊ����ʾ��1Ϊ��ʾ</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>������ƽ�ȡ����</td>
                  <td>��ȡ�����������</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td>��������</td>
                  <td>��ϸ�������������ò�������˵��</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">�鶯��ǩʹ��˵����[<b>e:loop</b>]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="12%">��ʽ:</td>
                  <td width="88%">
<textarea name="textfdsf" cols="80" rows="4" id="textfdsf" style="width:100%">[e:loop={����ID,��ʾ����,��������,ֻ��ʾ��Ԥ��ͼ�����}]
ģ���������
[/e:loop]</textarea></td>
                </tr>
                <tr> 
                  <td>����:</td>
                  <td><textarea name="textareafd" cols="80" rows="9" id="textareafd" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:loop={����ID,��ʾ����,��������,ֻ��ʾ��Ԥ��ͼ�����}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[softurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[softname]?&gt;&lt;/a&gt;
(&lt;?=date("Y-m-d",$bqr[softtime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:loop]
&lt;/table&gt;</textarea></td>
                </tr>
              </table>
              <strong>��ǩ����˵��</strong> 
              <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">����ID</td>
                  <td width="88%">Ҫ���õķ���ID/ר��ID/�������ID(�鿴���ID�ŵ�<a href="ListClass.php" target="_blank"><strong>����</strong></a>/ר��ID��<a href="ListZt.php" target="_blank"><strong>����</strong></a>/�������ID�ŵ�<a href="softtype.php" target="_blank"><strong>����</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��ʾ����</td>
                  <td>�����������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��������</td>
                  <td>��ϸ�������������ò�������˵��</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ֻ��ʾ��ͼƬ������</td>
                  <td>0Ϊ�����ƣ�1Ϊֻ��ʾ��Ԥ��ͼ������</td>
                </tr>
              </table>
              <strong>��ǩ����˵��</strong><br>
              <table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
                <tbody>
                  <tr> 
                    <td width="12%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                    <td height="25" bgcolor="#ffffff">$bqr[�ֶ���]����ʾ�ֶε�����</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                    <td height="25" bgcolor="#ffffff">$bqsr[softurl]���������<br>
                      $bqsr[classname]����������<br>
                      $bqsr[classurl]����������</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                    <td height="25" bgcolor="#ffffff">$bqno��Ϊ�������</td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                    <td height="25" bgcolor="#ffffff">$public_r[sitedown]����վ��ַ</td>
                  </tr>
                </tbody>
              </table>
              <strong>���ú�������</strong>
              <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td>���ֽ�ȡ��<strong>esub(�ַ���,��ȡ����)</strong>�����ӣ�esub($bqr[softname],30)��ȡ�������ǰ30���ַ�<br>
                    ʱ���ʽ��<strong>date(&quot;��ʽ�ִ�&quot;,ʱ���ֶ�)</strong>�����ӣ�date(&quot;Y-m-d&quot;,$bqr[softtime])ʱ����ʾ��ʽΪ&quot;2009-10-01&quot;</td>
                </tr>
              </table> </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">����ͳ�Ʊ�ǩ:[downtotal]����ID,��������,ʱ�䷶Χ[/downtotal]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td>��������</td>
                  <td>0Ϊ���������1Ϊͳ�Ʒ����������2Ϊͳ��ר���������3Ϊ��������������4Ϊ��������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">����ID</td>
                  <td width="88%">Ҫ���õķ���ID/ר��ID/�������ID(�鿴���ID�ŵ�<a href="ListClass.php" target="_blank"><strong>����</strong></a>/ר��ID��<a href="ListZt.php" target="_blank"><strong>����</strong></a>/�������ID�ŵ�<a href="softtype.php" target="_blank"><strong>����</strong></a>)</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>ʱ�䷶Χ</td>
                  <td>0Ϊ���ޣ�1Ϊ���ո�������2Ϊ���¸�������3Ϊ���������</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"><strong><font color="#0000FF">����ǩ˵����[downad]���ID[/downad]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">���ID</td>
                  <td width="88%">�鿴���ID�ŵ�<strong><a href="ListAd.php" target="_blank">����</a></strong></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"> <strong><font color="#0000FF">ͶƱ��ǩ˵��:[downvote]ͶƱID[/downvote]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">ͶƱID</td>
                  <td width="88%">�鿴ͶƱID����<strong><a href="ListVote.php" target="_blank">����</a></strong></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td height="23"> <strong><font color="#0000FF">�������ӱ�ǩ˵����[downlink]ÿ����ʾ��,��ʾ����,��������,�Ƿ���ʾԭ����[/downlink]</font></strong></td>
          </tr>
          <tr> 
            <td height="23"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr bgcolor="#FFFFFF"> 
                  <td>ÿ����ʾ��</td>
                  <td>ÿ����ʾ���ٸ���������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="12%">��ʾ����</td>
                  <td width="88%">��ʾ�ܵ�����������</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td>��������</td>
                  <td>0�������ӣ�1ΪͼƬ���ӣ�2��������</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td>�Ƿ���ʾԭ����</td>
                  <td><strong></strong>0Ϊͳ������,1Ϊֱ����ʾԭ����</td>
                </tr>
              </table></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="softclasstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="softclasstemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸ķ��ർ��ҳ��ģ��&nbsp;[<a href="<?=EDReturnClassNavUrl()?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[softclasstemp]))?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">ÿ����ʾ��
          <input name="softclassnum" type="text" id="softclassnum" value="<?=$r[softclassnum]?>" size="12">
          ������ɫ�� 
          <input name="softclassbgcolor" type="text" id="softclassbgcolor" value="<?=$r[softclassbgcolor]?>" size="12">
          ��Ԫ����ɫ��
          <input name="softclasstdcolor" type="text" id="softclasstdcolor" value="<?=$r[softclasstdcolor]?>" size="12">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="softclasstemp">
          <input type="reset" name="Submit25" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> ˵����<br>
        ����ʾ����ĵط�����&quot;[!--empiredown.template--]&quot;<br>
        ��ʾ&quot;����λ��&quot;�ĵط�����&quot;[!--empiredown.url--]&quot; <br>
        �����б� [!--class.menu--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchtemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸������б�ģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchtemp]))?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">�������ȡ������
          <input name="schsubtitle" type="text" id="schsubtitle" value="<?=$r[schsubtitle]?>" size="6">
          ����ȡ������ 
          <input name="schsubsay" type="text" id="schsubsay" value="<?=$r[schsubsay]?>" size="6">
          ʱ���ʽ�� 
          <input name="schformatdate" type="text" id="schformatdate" value="<?=$r[schformatdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchtemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>����˵����</strong><br>
        վ���ַ��[!--edown.url--]��ҳ�浼����[!--empiredown.url--]��ҳ����⣺[!--pagetitle--]��ҳ��ؼ��֣�[!--pagekey--]��ҳ���飺[!--pagedes--]<br>
        ���ർ����[!--empiredown.class--]���������أ�[!--empiredown.topjs--]���������أ�[!--empiredown.newjs--]����ҳ����[!--show.page--]<br>
        �����б� [!--class.menu--]���ؼ��֣�[!--keyboard--]<br>
        <br>
        �������:[!--softurl--]�����ID:[!--softid--]���������:[!--softname--]������ID:[!--classid--]<br>
        ��������:[!--classname--](������)����������:[!--thisclassname--]����������:[!--thisclassurl--]<br>
        ����ר��:[!--ztname--]���������ALT:[!--oldsoftname--]������ʱ��:[!--softtime--]��������:[!--softsay--]<br>
        �ļ���չ��:[!--filetype--]���ļ���С:[!--filesize--]��Ԥ��ͼ:[!--softpic--]������汾:[!--soft_version--]<br>
        ��Ȩ��ʽ:[!--soft_sq--]���������:[!--softtype--]���������:[!--language--]������ȼ�:[!--star--]<br>
        ���ص���:[!--downfen--]��������:[!--adduser--]������:[!--writer--]���ٷ���վ:[!--homepage--]<br>
        ��������:[!--count_all--]����������:[!--count_month--]����������:[!--count_week--]����������:[!--count_day--]<br>
        ���л���:[!--soft_fj--]����ʾ��ַ:[!--demo--] <br>
        <br>
        ģ���ʽ������б�ͷ��[!--empiredown.listtemp--]����б�����[!--empiredown.listtemp--]����б��β</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchformtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchformtemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸�������ģ��&nbsp;[<a href="<?=EDReturnSearchFormUrl()?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchformtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchformtemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><p>˵����<br>
          �����б� [!--class.menu--] <br>
          ��վ��ַ:[!--edown.url--]<br>
          ҳ�浼����[!--empiredown.url--] <br>
          ����:[!--class--]<br>
          ר��:[!--zt--] <br>
          �������:[!--softtype--]<br>
          �������:[!--language--]<br>
          ��Ȩ����:[!--soft_sq--]<br>
        </p>
        </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="ggtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ggtemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸Ĺ����б�ģ��&nbsp;[<a href="<?=EDReturnGgUrl()?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="temptext" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[ggtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="ggtemp">
          <input type="reset" name="Submit24" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ģ���ʽ�������б�ͷ��[!--empiredown.listtemp--]�����б�����[!--empiredown.listtemp--]�����б��β<br>
        ���⣺[!--title--]���������ݣ�[!--ggtext--]������ʱ�䣺[!--ggtime--]������ID��[!--ggid--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="cptemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="cptemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸Ŀ������ģ��&nbsp;[<a href="../cp" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[cptemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="cptemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ����ʾ���ݵĵط�����&quot;[!--empiredown.template--]&quot;<br>
        ��ʾ&quot;����λ��&quot;�ĵط�����&quot;[!--empiredown.url--]&quot; <br>
        �����б� [!--class.menu--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="classjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="classjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸�����JSģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=stripSlashes($r[classjstemp])?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">ʱ���ʽ�� 
          <input name="classjsshowdate" type="text" id="classjsshowdate" value="<?=$r[classjsshowdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="classjstemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��ʽ: JSͷ��[!--empiredown.listtemp--]���JS����[!--empiredown.listtemp--]JSβ��<br>
        ���ID:[!--softid--] ,ҳ������:[!--softurl--] ,�������:[!--softname--] ,���ALT:[!--oldsoftname--]<br>
        ����ʱ��:[!--softtime--] ,����ID:[!--classid--] ,��������:[!--classname--] ,�����ַ:[!--classurl--]<br>
        ���ͼƬ:[!--softpic--] ,��������:[!--count_all--] ,��������:[!--count_month--] ,��������:[!--count_week--]<br>
        ��������:[!--count_day--]��վ���ַ��[!--edown.url--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="navtemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="navtemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸ķ��ർ��JSģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[navtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="navtemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��ʽ: JSͷ��[!--empiredown.listtemp--]���ർ��JS����[!--empiredown.listtemp--]JSβ��<br>
        ����ID:[!--classid--] ,������:[!--classname--] ,�����ַ:[!--classurl--] ,�����:[!--num--]��վ���ַ��[!--edown.url--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="otherlinktemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="otherlinktemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸��������ģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[otherlinktemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">��ȡ������ 
          <input name="otherlinktempsub" type="text" id="otherlinktempsub" value="<?=$r[otherlinktempsub]?>">
          ��ʱ���ʽ�� 
          <input name="otherlinktempdate" type="text" id="otherlinktempdate" value="<?=$r[otherlinktempdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="otherlinktemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��ʽ: �б�ͷ[!--empiredown.listtemp--]�б�����[!--empiredown.listtemp--]�б�β<br>
        ������ƣ�[!--softname--]�����ID��[!--softid--]������ʱ�䣺[!--softtime--]<br>
        ������ӣ�[!--softurl--]�������ͼ��[!--softpic--]�������ALT��[!--oldsoftname--]<br>
        �������ƣ�[!--classname--]�������ַ��[!--classurl--]������ID��[!--classid--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="ggjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ggjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸Ĺ���JSģ��&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."gg.js";?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[ggjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="ggjstemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��ʽ: JSͷ��[!--empiredown.listtemp--]����JS����[!--empiredown.listtemp--]JSβ��<br>
        ���⣺[!--title--]���������ݣ�[!--ggtext--]������ʱ�䣺[!--ggtime--]������ID��[!--ggid--] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchjstemp1"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchjstemp1">
    <tr class="header"> 
      <td height="25"><div align="center">�޸ĺ�������JSģ��&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."search_soft1.js";?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchjstemp1]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchjstemp1">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��������:[!--class--]<br>
        ��վ��ַ:[!--edown.url--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="searchjstemp2"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="searchjstemp2">
    <tr class="header"> 
      <td height="25"><div align="center">�޸���������JSģ��&nbsp;[<a href="view/js.php?classid=1&js=<?=$jspath."search_soft2.js";?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[searchjstemp2]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="searchjstemp2">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> ˵����<br>
        ��������:[!--class--] <br>
        ��վ��ַ:[!--edown.url--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="votetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="votetemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸�ͶƱģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[votetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="votetemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <strong>����˵����</strong><br>
        ��վ��ַ��[!--edown.url--]�����ύ��ַ��[!--vote.action--]�����⣺[!--title--]���鿴ͶƱ�����ַ��[!--vote.view--]<br>
        ͶƱ��ID��[!--voteid--]��ͶƱѡ�[!--vote.box--]��ͶƱѡ�����ƣ�[!--vote.name--] <br>
        ����ͶƱ������ڴ�С��[!--width--](���)��[!--height--](�߶�) </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="downsofttemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="downsofttemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸����ص�ַģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[downsofttemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="downsofttemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        ��������:[!--down.name--],�������ص�ַ:[!--down.url--],�ļ���ʵ��ַ��[!--true.down.url--]��������ƣ�[!--softname--]<br>
        ���ص�ַ��:[!--pathid--],����ID:[!--classid--],���ID:[!--softid--],�۳�����:[!--fen--],���صȼ�:[!--group--] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="onlinesofttemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="onlinesofttemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸����߹ۿ���ַģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[onlinesofttemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="onlinesofttemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">˵����<br>
        �ۿ�����:[!--down.name--],�����ۿ���ַ:[!--down.url--],�ļ���ʵ��ַ��[!--true.down.url--]��������ƣ�[!--softname--]<br>
        �ۿ���ַ��:[!--pathid--],����ID:[!--classid--],���ID:[!--softid--],�۳�����:[!--fen--],���صȼ�:[!--group--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="listpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="listpagetemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸��б��ҳģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="12" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[listpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="listpagetemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>ģ�����˵����</strong><br>
        ��ҳҳ��:[!--thispage--], ��ҳ��:[!--pagenum--], ÿҳ��ʾ����:[!--lencord--] <br>
        ������:[!--num--], ��ҳ����:[!--pagelink--], ������ҳ:[!--options--] </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="loginiframe"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="loginiframe">
    <tr class="header"> 
      <td height="25"><div align="center">��ܵ��õ�½״̬ģ�� (<a href="../iframe" target="_blank">Ԥ��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[loginiframe]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="loginiframe">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>ģ���ʽ��</strong>��½ǰ��ʾ����[!--empiredown.template--]��½����ʾ����<br> 
        <strong>ģ�����˵���� </strong><br>
        �û�ID:[!--userid--]���û���:[!--username--]����վ��ַ��[!--edown.url--]<br>
        ��Ա�ȼ�:[!--groupname--]���ʻ���Ч����:[!--downdate--]������:[!--downfen--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="loginjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="loginjstemp">
    <tr class="header"> 
      <td height="25"><div align="center">JS���õ�½״̬ģ��&nbsp;[<a href="view/js.php?classid=1&js=<?=$public_r[sitedown]."iframe/loginjs.php";?>" target=_blank>Ԥ��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[loginjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="loginjstemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>ģ���ʽ��</strong>��½ǰ��ʾ����[!--empiredown.template--]��½����ʾ����<br> 
        <strong>ģ�����˵����</strong> <br>
        �û�ID:[!--userid--]���û���:[!--username--]����վ��ַ��[!--edown.url--]<br>
        ��Ա�ȼ�:[!--groupname--]���ʻ���Ч����:[!--downdate--]������:[!--downfen--]<br> <br> <strong>���õ�ַ��</strong> 
        <input name="textfield132" type="text" id="textfield132" size="60" value="&lt;script src=&quot;<?=$public_r[sitedown]."iframe/loginjs.php";?>&quot;&gt;&lt;/script&gt;">
        [<a href="view/js.php?classid=1&js=<?=$public_r[sitedown]."iframe/loginjs.php";?>" target="_blank">Ԥ��</a>] 
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
<?php
if($tname=="downpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="downpagetemp">
    <tr class="header"> 
      <td height="25"><div align="center">�޸�����ҳ��ģ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="70" rows="27" id="textarea" style="WIDTH:100%"><?=htmlspecialchars(stripSlashes($r[downpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�޸�">
          <input name="phome" type="hidden" id="phome" value="EditTemplate">
          <input name="templatename" type="hidden" id="templatename" value="downpagetemp">
          <input type="reset" name="Submit26" value="����">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"> վ���ַ��[!--edown.url--]��ҳ�浼����[!--empiredown.url--]�������б�[!--class.menu--]<br>
        ҳ����⣺[!--pagetitle--]��ҳ��ؼ��֣�[!--pagekey--]��ҳ���飺[!--pagedes--]<br>
        ���ർ����[!--empiredown.class--]���������أ�[!--empiredown.topjs--]���������أ�[!--empiredown.newjs--]<br>
        ����ID��[!--class.id--]����������[!--class.name--]��������ID��[!--bclass.id--]������������[!--bclass.name--]<br>
        ���ID:[!--softid--]��ҳ������:[!--softurl--]���������:[!--softname--]������ʱ��:[!--softtime--]<br>
        ������:[!--softsay--]��Ԥ��ͼ:[!--softpic--]������汾:[!--soft_version--]���ؼ���:[!--keyboard--]<br>
        �ļ���չ��:[!--filetype--]���ļ���С:[!--filesize--]������:[!--writer--]���ٷ���վ:[!--homepage--]<br>
        ��ʾ��ַ:[!--demo--]��������:[!--adduser--]������ȼ�:[!--star--]�����л���:[!--soft_fj--]<br>
        �������:[!--softtype--]����Ȩ��ʽ:[!--soft_sq--]���������:[!--language--]<br>
        ���ص�ַ:[!--thisdownpath--]���ļ���ʵ��ַ��[!--thistruedownpath--]�����ص�ַ���ƣ�[!--thisdownname--]<br>
        ���ص���:[!--downfen--]�����ؼ���:[!--foruser--]����������:[!--count_all--]<br>
        ��������:[!--count_month--]����������:[!--count_week--]����������:[!--count_day--]</td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
