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
CheckLevel($myuserid,$myusername,$classid,"changedata");
//--------------------��������Ŀ
$fcfile="../data/fc/downclass.js";
$do_class="<script src='../data/fc/downclass.js'></script>";
if(!file_exists($fcfile))
{
	$do_class=ShowClass_AddClass("","n",0,"|-",0);
}
//ѡ������
$todaydate=date("Y-m-d");
$todaytime=time();
$changeday="<select name=selectday onchange=\"document.reform.startday.value=this.value;document.reform.endday.value='".$todaydate."'\">
<option value='".$todaydate."'>--ѡ��--</option>
<option value='".$todaydate."'>����</option>
<option value='".ToChangeTime($todaytime,7)."'>һ��</option>
<option value='".ToChangeTime($todaytime,30)."'>һ��</option>
<option value='".ToChangeTime($todaytime,90)."'>����</option>
<option value='".ToChangeTime($todaytime,180)."'>����</option>
<option value='".ToChangeTime($todaytime,365)."'>һ��</option>
</select>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ݸ��¹���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script src="editor/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">λ�ã����ݸ��¹���</td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header"> 
    <td height="25"> <div align="center">һ��ȫվ����</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
        <input type="button" name="Submit22222222" value="�������ȫվ����" onclick="if(confirm('ȷ��Ҫȫվ����?')){window.open('chtmlphome.php?phome=ReIndex&OneReAll=1');}">
      </div></td>
  </tr>
  <tr>
    <td height="25" bgcolor="#FFFFFF"><div align="center">˵����ȫվ���ɽ�������վ����ҳ�棬�˹��ܷǳ���ϵͳ��Դ��һ��Ϊ��վǨ��ʱʹ�á�</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="3"><div align="center">ҳ�����ɹ���</div></td>
  </tr>
  <tr> 
    <td width="34%" height="25"> 
      <div align="center"><strong>����ҳ��</strong></div></td>
    <td width="33%"> <div align="center"><strong>ר��ҳ��</strong></div></td>
    <td width="33%"><div align="center"><strong>��������</strong></div></td>
  </tr>
  <tr> 
    <td width="34%" height="25" valign="top" bgcolor="#FFFFFF"> 
      <div align="center"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="45%" height="46"> 
              <div align="center"> 
                <input type="button" name="Submit2" value="������ҳ" onclick="self.location.href='chtmlphome.php?phome=ReIndex'">
              </div></td>
            <td>(<a href="../" target="_blank">��վ��ҳ</a>)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit24" value="���ɷ��ർ��" onclick="self.location.href='chtmlphome.php?phome=ReSoftClass'">
              </div></td>
            <td>(<a href="<?=EDReturnClassNavUrl()?>" target="_blank">���ർ��</a>)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit22" value="�������з����б�" onclick="window.open('chtmlphome.php?phome=ReHtml_all&from=ChangeData.php');">
              </div></td>
            <td>(�����б�)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit42" value="������������ҳ��" onclick="window.open('chtmlphome.php?phome=ReSoftHtml&start=0&from=ChangeData.php');">
              </div></td>
            <td>(��������ҳ��)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input name="Submit3" type="button" value="�����������ص���" onclick="window.open('chtmlphome.php?phome=ReListJs&do=class&from=ChangeData.php');">
              </div></td>
            <td>(����/����/ר��/�������JS)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit23" value="�������з��ർ��" onclick="window.open('chtmlphome.php?phome=ReClassJS_all&do=class&from=ChangeData.php');">
              </div></td>
            <td>(���ർ��JS)</td>
          </tr>
        </table>
      </div></td>
    <td width="33%" valign="top" bgcolor="#FFFFFF"> 
      <div align="center"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="45%" height="46"> 
              <div align="center"> 
                <input type="button" name="Submit222" value="����ר���б�" onclick="window.open('chtmlphome.php?phome=ReZtlistAll&from=ChangeData.php');">
              </div></td>
            <td>(ר���б�)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit2222" value="��������б�" onclick="window.open('chtmlphome.php?phome=ReSoftTypelistAll&from=ChangeData.php');">
              </div></td>
            <td>(��������б�)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit22222" value="��ĸ�����б�" onclick="window.open('chtmlphome.php?phome=ReZmlistAll&from=ChangeData.php');">
              </div></td>
            <td>(��ĸ�����б�)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center"> 
                <input type="button" name="Submit222222" value="�����Զ����б�" onclick="window.open('chtmlphome.php?phome=ReUserlistAll&from=ChangeData.php');">
              </div></td>
            <td>(�����Զ����б�)</td>
          </tr>
          <tr> 
            <td height="46"> <div align="center">
                <input type="button" name="Submit2222223" value="�����Զ���ҳ��" onclick="window.open('chtmlphome.php?phome=ReUserpageAll&from=ChangeData.php');">
              </div></td>
            <td>(�����Զ���ҳ��)</td>
          </tr>
          <tr> 
            <td height="46"><div align="center">
                <input type="button" name="Submit2222222" value="���¶�̬ҳ��" onclick="self.location.href='chtmlphome.php?phome=ChangeDtPage';">
              </div></td>
            <td>(����ҳ������������½״̬���á�������塢����)</td>
          </tr>
        </table>
      </div></td>
    <td width="33%" valign="top" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="45%" height="46">
<div align="center"> 
              <input type="button" name="Submit" value="�������ݿ⻺��" onclick="self.location.href='phome.php?phome=ReSoftData';">
            </div></td>
          <td>(�������ݿ⻺��)</td>
        </tr>
        <tr> 
          <td height="46"><div align="center">
              <input type="button" name="Submit43" value="���·����ϵ" onclick="self.location.href='classphome.php?phome=ChangeSonclass';">
            </div></td>
          <td><p>(ת�Ʒ����ʹ��)</p>
            </td>
        </tr>
        <tr> 
          <td height="46"><div align="center">
              <input type="button" name="Submit22222232" value="�������ɹ��JS" onclick="window.open('ListAd.php?phome=ReAdJs_all&from=ChangeData.php');">
            </div></td>
          <td>(���ɹ��JS����)</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="46"><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<form action="chtmlphome.php" method="get" name="reform" target="_blank" onsubmit="return confirm('ȷ��Ҫˢ��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"> <div align="center">�����������������ҳ��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">���ɷ���</td>
              <td height="25"><select name="classid" id="classid">
                  <option value="0">���з���</option>
                  <?=$do_class?>
                </select> <font color="#666666">����ѡ�������࣬�����������ӷ��ࣩ</font></td>
            </tr>
            <tr> 
              <td width="27%" height="25"> <input name="retype" type="radio" value="0" checked>
                ��ʱ�����ɣ�</td>
              <td width="73%" height="25">�� 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                �� 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                ֮������� 
                <?=$changeday?>
                <font color="#666666">�������������ҳ�棩</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                ��ID���ɣ�</td>
              <td height="25">�� 
                <input name="startid" type="text" id="startid" value="0" size="6">
                �� 
                <input name="endid" type="text" id="endid" value="0" size="6">
                ֮�������<font color="#666666">��������ֵΪ0����������ҳ�棩</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit6" value="��ʼˢ��"> 
                <input type="reset" name="Submit7" value="����"> 
                <input name="phome" type="hidden" id="phome" value="ReSoftHtml"> 
                <input name="from" type="hidden" id="from" value="ChangeData.php"></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
  <br>
</body>
</html>
<?
db_close();
$empire=null;
?>
