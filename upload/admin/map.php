<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��̨��ͼ</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function GoToUrl(url,totarget){
	if(totarget=='')
	{
		totarget='edmain';
	}
	opener.document.getElementById(totarget).src=url;
	window.close();
}
</script>
</head>

<body leftmargin="0" topmargin="0">
<table width="100%" height="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25">���ع���</td>
    <td width="12%">��������</td>
    <td width="25%">�������</td>
    <td width="27%">ģ�����</td>
    <td width="12%">�û�����</td>
    <td width="12%">��������</td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><a href="#down" onclick="GoToUrl('ListAllSoft.php','');">��������</a></td>
        </tr>
        <tr> 
          <td><a href="#edown" onclick="GoToUrl('ListAllSoft.php','');">��������</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong><a href="#edown" onclick="GoToUrl('public.php','');">��������</a></strong></td>
        </tr>
        <tr> 
          <td><strong><a href="#edown" onclick="GoToUrl('ChangeData.php','');">����ҳ�����</a></strong></td>
        </tr>
        <tr> 
          <td><strong>����/�ָ�����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ChangeDb.php','');">��������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ReData.php','');">�ָ�����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ebak/ChangePath.php','');">������Ŀ¼</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="50%"><strong>������ع���</strong></td>
          <td><strong>�������Թ���</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListError.php','');">������󱨸�</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('language.php','');">�����������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListAllPl.php','');">��������</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('softtype.php','');">�����������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListAllSoft.php?sear=1&showspecial=3','');">�������</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('sq.php','');">���������Ȩ</a></td>
        </tr>
        <tr> 
          <td><strong>�������</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('fj.php','');">�����������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddClass.php?phome=AddClass','');">���ӷ���</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('url.php','');">�����ַǰ׺</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListClass.php','');">�������</a></td>
          <td> &nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('player.php','');">��������</a></td>
        </tr>
        <tr> 
          <td><strong>ר�����</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('RepIp.php','');">�����滻��ַ</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddZt.php?phome=AddZt','');">����ר��</a></td>
          <td><strong>��������</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListZt.php','');">����ר��</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListGg.php','');">������</a></td>
        </tr>
        <tr> 
          <td><strong>��������</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListUserlist.php','');">�Զ����б�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListFile.php','');">���ݿ�ʽ������</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListPage.php','');">�Զ���ҳ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListFilePath.php','');">Ŀ¼ʽ������</a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="41%"><a href="#edown" onclick="GoToUrl('TempGroup.php','');"><strong>����/����ģ��</strong></a></td>
          <td width="59%"><strong>����ģ��</strong></td>
        </tr>
        <tr> 
          <td><strong>ģ���������</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=indextemp','');">�޸���ҳģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddTempvar.php?phome=AddTempvar','');">����ģ�����</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=softclasstemp','');">�޸ķ��ർ��ģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTempvar.php','');">����ģ�����</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchtemp','');">�޸�����ģ��</a></td>
        </tr>
        <tr> 
          <td><strong>�б�ģ��</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchformtemp','');">�޸�������ģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddListtemp.php?phome=AddListtemp','');">�����б�ģ��</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=ggtemp','');">�޸Ĺ����б�ģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListListtemp.php','');">�����б�ģ��</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=cptemp','');">�޸Ŀ������ģ��</a></td>
        </tr>
        <tr> 
          <td><strong>����ģ��</strong></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=classjstemp','');">�޸�����JSģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('AddSofttemp.php?phome=AddSofttemp','');">��������ģ��</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=navtemp','');">�޸ķ��ർ��JSģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListSofttemp.php','');">��������ģ��</a></td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=otherlinktemp','');">�޸��������ģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=ggjstemp','');">�޸Ĺ���JSģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchjstemp1','');">�޸ĺ�������JSģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=searchjstemp2','');">�޸���������JSģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=votetemp','');">�޸�ͶƱģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=downsofttemp','');">�޸����ص�ַģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=onlinesofttemp','');">�޸����ߵ�ַģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=listpagetemp','');">�޸��б��ҳģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=loginiframe','');">�޸Ŀ�ܵ�½״̬ģ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;<a href="#edown" onclick="GoToUrl('ListTemplate.php?tname=loginjstemp','');">�޸�JS��½״̬ģ��</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>����Ա����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('EditPassword.php','');">�޸�����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListUser.php','');">�����û�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListGroup.php','');">�����û���</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListLog.php','');">�����½��־</a></td>
        </tr>
        <tr> 
          <td><strong>��Ա����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListMember.php','');">�����Ա</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListMemberGroup.php','');">�����Ա��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('GetDown.php','');">�������͵���</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DelDownRecord.php','');">ɾ�����ر���</a></td>
        </tr>
        <tr> 
          <td><strong>�㿨����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddCard.php?phome=AddCard','');">���ӵ㿨</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddMoreCard.php','');">�������ӵ㿨</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListCard.php','');">����㿨</a></td>
        </tr>
        <tr>
          <td><strong>����֧��</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListBuyGroup.php','');">�����ֵ����</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/PayApi.php','');">����֧���ӿ�</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/ListPayRecord.php','');">����֧����¼</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>������</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AdClass.php','');">���������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddAd.php?phome=AddAd','');">���ӹ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListAd.php','');">������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListAd.php?time=1','');">������ڹ��</a></td>
        </tr>
        <tr> 
          <td><strong>�������ӹ���</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddLink.php?phome=AddLink','');">������������</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListLink.php','');">������������</a></td>
        </tr>
        <tr> 
          <td><strong>ͶƱ����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddVote.php?phome=AddVote','');">����ͶƱ</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListVote.php','');">����ͶƱ</a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
