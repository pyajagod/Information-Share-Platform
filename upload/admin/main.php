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
//�ʺ�״̬
$gr=$empire->fetch1("select groupname from {$dbtbpre}downgroup where groupid='$lur[groupid]'");
//����Աͳ��
$adminnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downuser");
//���󱨸���
$errornum=$empire->gettotal("select count(*) as total from {$dbtbpre}downerror");
//δ�����������
$nochecksoftnum=$empire->gettotal("select count(*) as total from {$dbtbpre}down where checked=0");
//��������
$plnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downpl");
//ϵͳ��Ϣ
if (function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if ($onoff){
        $onoff="��";
    }else{
        $onoff="�ر�";
    }
    if (function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="����";
    }else{
        $upload="������";
    }
//����
$register_ok="����";
if($public_r[openregister])
{$register_ok="�ر�";}
$addsoft_ok="����";
if($public_r[openadd])
{$addsoft_ok="�ر�";}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��̨��ҳ</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<br>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><div align="center"><strong> 
<!--        <h3>��ӭʹ�õ۹�����ϵͳ(EmpireDown)</h3>-->
        </strong></div></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong></strong> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#edown"><strong>�ҵ�״̬</strong></a></td>
                <td><div align="right"><a href="http://www.dotool.cn" target="_blank"><strong>վ������</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25"><div align="left">��½��:&nbsp;<b> 
                    <?=$myusername?>
                    </b></div></td>
                <td height="25">�����û���:&nbsp;<b> 
                  <?=$gr[groupname]?>
                  </b></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=16><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td height="38">
<div align="center"><a href="http://www.phome.net/OpenSource/" target="_blank"><strong><font color="#0000FF" size="3">�۹���վ����ϵͳȫ�濪Դ 
              �� �ȫ�����ȶ��Ŀ�ԴCMSϵͳ</font></strong></a></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#"><strong>ϵͳ��Ϣ</strong></a></td>
                <td><div align="right"><a href="http://www.phome.net/ebak2008os/" target="_blank"><strong>�۹�MYSQL����������</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">���������: 
                  <?=$_SERVER['SERVER_SOFTWARE']?>
                </td>
                <td height="25">����ϵͳ: <? echo defined('PHP_OS')?PHP_OS:'δ֪';?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">PHP�汾: <? echo @phpversion();?></td>
                <td height="25">MYSQL�汾:<? echo @mysql_get_server_info();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">ȫ�ֱ���: 
                  <?=$onoff?>
                </td>
                <td height="25">�ϴ��ļ�: 
                  <?=$upload?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">��½��IP: <? echo $_SERVER['REMOTE_ADDR'];?></td>
                <td height="25">��ǰʱ��: <? echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">����汾: <a href="http://www.phome.net" target="_blank"><strong>EmpireDown</strong></a><strong> 
                  v2.5</strong></td>
                <td height="25">ʹ������: 
                  <?=$_SERVER['HTTP_HOST']?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">��Աע��: 
                  <?=$register_ok?>
                </td>
                <td height="25">����Ͷ��: 
                  <?=$addsoft_ok?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">δ���������: <a href="ListAllSoft.php?sear=1&showspecial=3">
                  <?=$nochecksoftnum?>
                  </a> </td>
                <td height="25">���󱨸�����: <a href="ListError.php">
                  <?=$errornum?>
                  </a> </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">����Ա����: <a href="ListUser.php">
                  <?=$adminnum?>
                  </a> </td>
                <td height="25">��������: <a href="ListAllPl.php">
                  <?=$plnum?>
                  </a> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=16></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">�ٷ���Ϣ</td>
        </tr>
        <tr> 
          <td width="43%" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="30%" height="25">�۹��ٷ���ҳ: </td>
                <td width="70%" height="25"><a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�۹��ٷ���̳: </td>
                <td height="25"><a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�������ƻ�: </td>
                <td height="25"><a href="http://www.phome.net/partner/" target="_blank">http://www.phome.net/partner/</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">��˾��վ��</td>
                <td height="25"><a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
            </table></td>
          <td width="57%" height="125" valign="top" bgcolor="#FFFFFF"> <IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height=25></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>