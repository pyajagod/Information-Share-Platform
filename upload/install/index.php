<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

//------ ������ʼ ------

$version="2.5,1228698490";
$dbchar="gbk";
$setchar="gbk";
$headerchar="gb2312";

//------ �������� ------

@header('Content-Type: text/html; charset='.$headerchar);

if(file_exists("install.off"))
{
	echo"���۹�����ϵͳ����װ���������������Ҫ���°�װ����ɾ����Ŀ¼�µ�<b>install.off</b>�ļ���";
	exit();
}

$phome=$_GET['phome'];
//�����ļ�
include("data/fun.php");
//���Բɼ�
if($phome=="TestCj")
{
	echo"<title>TEST</title>";
	TestCj();
}
$ok=$_GET['ok'];
$f=$_GET['f'];
if(empty($f))
{
	$f=1;
}
$font="f".$f;
$$font="red";
//����
if($phome=="setdb"&&$ok)
{
	SetDb($_POST);
}
elseif($phome=="firstadmin"&&$ok)
{
	FirstAdmin($_POST);
}
elseif($phome=="defaultdata"&&$ok)
{
	InstallDefaultData($_GET);
}
//�汾
@include("../class/EmpireDown_version.php");
$shorttag=0;
?>
<?
$shorttag=1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�۹�����ϵͳ��װ���� - Powered by EmpireDown</title>

<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#56A5DE" leftmargin="0" topmargin="0">
<?php
if($shorttag==0)
{
?>
<br><br><br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td height="25" class="header"><div align="center"><strong><font color="#FFFFFF">������ʾ</font></strong></div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25">����PHP�����ļ�php.ini���������⣬�밴����������ɽ����</td>
        </tr>
        <tr>
          <td height="25">1���޸�php.ini������short_open_tag ��Ϊ On</td>
        </tr>
        <tr>
          <td height="25">2���޸ĺ�����apache/iis������Ч��</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
	echo"</body></html>";
	exit();
}
?>
<table width="776" height="100%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td height="56" colspan="2" background="images/topbg.gif"> 
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="80%"><div align="center"><img src="images/installsay.gif" width="500" height="50"></div></td>
            <td width="20%" valign="bottom"><font color="#FFFFFF">������: <?=EmpireDown_LASTTIME?></font></td>
          </tr>
        </table>
        
      </div></td>
  </tr>
  <tr> 
    <td width="21%" rowspan="3" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="center"><a href="http://www.phome.net" target="_blank"><img src="images/logo.gif" width="170" height="72" border="0"></a></div></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="left"><strong><font color="#FFFFFF">��Ȩ��Ϣ</font></strong></div></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="34%" height="25">�������</td>
          <td width="66%" height="25">�۹�����ϵͳ</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">����汾</td>
          <td height="25">Version 2.5</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">�����Ŷ�</td>
          <td height="25">�۹���������Ŷ�</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">��˾����</td>
          <td height="25">�������</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">�ٷ���վ</td>
          <td height="25"><a href="http://www.PHome.Net" target="_blank">www.PHome.Net</a></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong><font color="#FFFFFF">��װ����</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f1?>">�Ķ��û�ʹ������</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f2?>">������л���</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f3?>">����Ŀ¼Ȩ��</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f4?>">�������ݿ�</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f5?>">��ʼ������Ա�˺�</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f6?>">��װ���</font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td><div align="center"><strong><font color="#0000FF" size="3">��Դ����ϵͳ��һƷ�� 
        - �۹�����ϵͳ</font></strong></div></td>
  </tr>
  <tr> 
    <td valign="top"> 
    <?php
	//�û�����
	if($phome=="checkfj")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�ڶ�����������л���</font></strong></div></td>
          </tr>
          <tr> 
            <td height="250" bgcolor="#FFFFFF"> 
              <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>��ʾ��Ϣ</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="21"> <li>��������Ŀ�Ǳ���֧�ֵ���Ŀ��</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="25%" height="23"> <div align="center"><strong>��Ŀ</strong></div></td>
                    <td width="30%"> <div align="center"><strong>�۹�������������</strong></div></td>
                    <td width="30%"> <div align="center"><strong>��ǰ������</strong></div></td>
                    <td width="15%"> <div align="center"><strong>���Խ��</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">����ϵͳ</div></td>
                    <td><div align="center">����</div></td>
                    <td><div align="center"> 
                        <?=GetUseSys()?>
                      </div></td>
                    <td><div align="center">��</div></td>
                  </tr>
                  <?
					$phpr=GetPhpVer();
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP�汾</strong></div></td>
                    <td><div align="center"><strong>4.2.3+<br>
                        </strong></div></td>
                    <td><div align="center"> <b> 
                        <?=$phpr['ver']?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?=$phpr['result']?>
                      </div></td>
                  </tr>
                  <?
  					$mysqlr=CanMysql();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>MYSQL֧��</strong></div></td>
                    <td><div align="center"><strong>֧��</strong></div></td>
                    <td><div align="center"> <b> 
                        <?=$mysqlr['can']?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?=$mysqlr['result']?>
                      </div></td>
                  </tr>
                  <?
 					//$phpsafer=GetPhpSafemod();
  					?>
                  <?
  					//$gdr=GetGd();
  					?>
                  <?
  					//$cjr=GetCj();
  					?>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit523" value="��һ��" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="��һ��" onclick="self.location.href='index.php?phome=path&f=3';">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//����Ŀ¼Ȩ��
	elseif($phome=="path")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">������������Ŀ¼Ȩ��</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>��ʾ��Ϣ</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"><li><font color="#FF0000">������ķ�����ʹ�� 
                              Windows ����ϵͳ����������һ����</font></li></td>
                        </tr>
                        <tr> 
                          <td height="25"> <li>������Ŀ¼Ȩ����Ϊ0777, ��Ŀ¼ȫ��Ҫ��Ȩ��Ӧ������Ŀ¼���ļ��� 
                            </li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="34%" height="23"> <div align="center"><strong>Ŀ¼�ļ�����</strong></div></td>
                    <td width="42%"> <div align="center"><strong>˵��</strong></div></td>
                    <td width="24%"> <div align="center"><strong>Ȩ�޼��</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/index.html</div></td>
                    <td> <div align="center"><font color="#666666">��ҳ</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../index.html");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/admin/ebak/bdata</td>
                    <td> <div align="center"><font color="#666666">�������ݴ��Ŀ¼</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../admin/ebak/bdata");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/admin/ebak/zip</td>
                    <td> <div align="center"><font color="#666666">��������ѹ�����Ŀ¼</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../admin/ebak/zip");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/class/user.php</div></td>
                    <td> <div align="center"><font color="#666666">��Ա�����ļ�</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../class/user.php");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/data</div></td>
                    <td> <div align="center"><font color="#666666">���������ļ��븽�����Ŀ¼</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../data","../data/tmp");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/iframe</div></td>
                    <td> <div align="center"><font color="#666666">��½״̬��ʾ</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../iframe","../iframe/index.php");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/install</td>
                    <td> <div align="center"><font color="#666666">��װĿ¼</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../install");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/list</td>
                    <td><div align="center"><font color="#666666">�б�ҳ����Ŀ¼</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../list");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/view</td>
                    <td><div align="center"><font color="#666666">����ҳ����Ŀ¼</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../view");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/page</td>
                    <td> <div align="center"><font color="#666666">��ҳ����Ŀ¼</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../page");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/search</td>
                    <td><div align="center"><font color="#666666">����Ŀ¼</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../search","../search/result/index.php");?>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <script>
			  function CheckNext()
			  {
			  var ok;
			  //ok=confirm("ȷ����Ӧ������Ŀ¼?");
			  ok=true;
			  if(ok)
			  {
			  self.location.href='index.php?phome=setdb&f=4';
			  }
			  }
			  </script>
                <input type="button" name="Submit523" value="��һ��" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit72" value="ˢ��Ȩ��״̬" onclick="javascript:self.location.href='index.php?phome=path&f=3';">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="��һ��" onclick="javascript:CheckNext();">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//�����������ݿ�
	elseif($phome=="setdb")
	{
		$mycookievarpre=strtolower(InstallMakePassword(5));
	?>
      <script>
		  function CheckSubmit()
		  {
		  	var ok;
			ok=confirm("ȷ��Ҫ������һ��?");
			if(ok)
			{
		  		document.form1.Submit6223.disabled=true;
				return true;
			}
			return false;
		  }
		  </script> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=setdb&ok=1&f=5" onsubmit="document.form1.Submit6223.disabled=true;">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">���Ĳ����������ݿ�</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>��ʾ��Ϣ</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="23"> <li>����������д�������ݿ��˺���Ϣ, ͨ������²���Ҫ�޸���ɫѡ�����ݡ�</li></td>
                        </tr>
                        <tr> 
                          <td height="23"> <li>��*��Ϊ����Ϊ�ա�</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="21%" height="23"> <div align="center"><strong>����ѡ��</strong></div></td>
                    <td width="36%"><div align="center"><strong>��ǰֵ</strong></div></td>
                    <td width="43%"><div align="center"><strong>ע��</strong></div></td>
                  </tr>
                  <?
					$getmysqlver=@mysql_get_server_info();
					$selectmysqlver=$getmysqlver;
					if(empty($selectmysqlver))
					{
						$selectmysqlver='5.0';
					}
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">MYSQL�汾:</td>
                    <td><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="22"><input type="radio" name="mydbver" value="auto" checked>
                            �Զ�ʶ��</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.0">
                            MYSQL 4.0.*/3.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.1">
                            MYSQL 4.1.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="5.0">
                            MYSQL 5.*</td>
                        </tr>
                      </table></td>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td>ϵͳ��⵽�İ汾��: <b> <u> 
                            <?=$getmysqlver?$getmysqlver:''?>
                            </u> </b></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td width="21%" height="25"><font color="#009900">���ݿ������(*):</font></td>
                    <td width="36%"> <input name="mydbhost" type="text" id="mydbhost" value="localhost" size="30"></td>
                    <td width="43%"><font color="#666666">���ݿ��������ַ, һ��Ϊ localhost</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">���ݿ�������˿�:</font></td>
                    <td> <input name="mydbport" type="text" id="mydbport" size="30"> 
                    </td>
                    <td><font color="#666666">MYSQL�˿�,��ΪĬ�϶˿�, һ��Ϊ��</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">���ݿ��û���:</td>
                    <td> <input name="mydbusername" type="text" id="mydbusername" value="username" size="30"></td>
                    <td><font color="#666666">MYSQL���ݿ������˺�</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">���ݿ�����:</td>
                    <td> <input name="mydbpassword" type="password" id="mydbpassword" size="30"></td>
                    <td><font color="#666666">MYSQL���ݿ���������</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">���ݿ���(*):</td>
                    <td> <input name="mydbname" type="text" id="mydbname" value="empiredown" size="30"> 
                    </td>
                    <td><font color="#666666">���ݿ�����</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">����ǰ׺(*):</font></td>
                    <td><input name="mydbtbpre" type="text" id="mydbtbpre" value="e_" size="30" onClick="javascript:alert('��װ����ʾ:\n\n��������Ҫ��ͬһ���ݿⰲװ��� �۹����� \nϵͳ,����,ǿ�ҽ�������Ҫ�޸ı���ǰ׺��');"></td>
                    <td><font color="#666666">ͬһ���ݿⰲװ����۹�ʱ�ɸı�Ĭ��</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">COOKIEǰ׺(*):</td>
                    <td><input name="mycookievarpre" type="text" id="mycookievarpre" value="<?=$mycookievarpre?>" size="30"></td>
                    <td><font color="#666666">��<strong>Ӣ����ĸ</strong>���</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">���ó�ʼ����:</td>
                    <td><input name="defaultdata" type="checkbox" id="defaultdata" value="1">
                      ��</td>
                    <td><font color="#666666">�������ʱѡ��</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5223" value="��һ��" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit6223" value="��һ��">
                <input name="mydbtype" type="hidden" id="mydbtype" value="mysql">
                <input name="mydbchar" type="hidden" id="mydbchar" value="<?=$dbchar?>">
                <input name="mysetchar" type="hidden" id="mysetchar" value="<?=$setchar?>">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//��ʹ������Ա
	elseif($phome=="firstadmin")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=firstadmin&ok=1&f=6" onsubmit="document.form1.Submit62222.disabled=true">
          <input type="hidden" name="defaultdata" value="<?=$_GET['defaultdata']?>">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">���岽����ʼ������Ա�˺�</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>��ʾ��Ϣ</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"> <li>����������д��Ҫ���õĹ���Ա�˺���Ϣ��</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23" colspan="3"><strong>��ʼ������Ա�˺�</strong></td>
                  </tr>
                  <tr> 
                    <td width="21%" height="25" bgcolor="#FFFFFF">�û���:</td>
                    <td width="36%" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="30"> 
                    </td>
                    <td width="43%" bgcolor="#FFFFFF"><font color="#666666">����Ա�û���</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF">����:</td>
                    <td bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">����Ա�˺�����</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"> <p>�ظ�����:</p></td>
                    <td bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">�ظ��˺�����</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit52223" value="��һ��" onclick="javascript:history.go(-2);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit62222" value="��һ��">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//��װ���
	elseif($phome=="success")
	{
		//������װ����
		$fp=@fopen("install.off","w");
		@fclose($fp);
		$word='��ϲ�������ѳɹ���װ�۹�����ϵͳ��<br>�������װ˵����5������(����װ˵��).';
		if($_GET['defaultdata'])
		{
			$word='��ϲ�������ѳɹ���װ�۹�����ϵͳ��<br>�������װ˵����5������(����װ˵��).';
		}
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=setdb&ok=1&f=7">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">����������װ���</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100"> <div align="center"> 
                <table width="92%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"> 
                        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                          <tr> 
                            <td height="42"> <div align="center"><font color="#FF0000"> 
                                <?=$word?>
                                </font></div></td>
                          </tr>
                          <tr> 
                            <td height="30"> <div align="center">(������ʾ��������ɾ��/installĿ¼���Ա��ⱻ�ٴΰ�װ.)</div></td>
                          </tr>
                          <tr> 
                            <td height="42"> <div align="center"> 
                                <input type="button" name="Submit82" value="�����̨�������" onclick="javascript:self.location.href='../admin/index.php'">
                              </div></td>
                          </tr>
                          <tr> 
                            <td height="25"> <div align="center"></div></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//����
	else
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">��һ�����۹�����ϵͳ�û����Э��</font></strong></div></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" height="350" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td><div align="center"> 
                        <IFRAME frameBorder=0 name=xy scrolling=auto src="data/xieyi.html" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5" value="�Ҳ�ͬ��" onclick="window.close();">
				                &nbsp;&nbsp; 
				<input type="button" name="Submit6" value="��ͬ��" onclick="javascript:self.location.href='index.php?phome=checkfj&f=2';">
              </div></td>
          </tr>
        </form>
      </table>
      <?
		}
		?>
    </td>
  </tr>
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><hr align="center"></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><a href="http://www.PHome.Net" target="_blank">�ٷ���վ</a>&nbsp; 
              | &nbsp;<a href="http://bbs.PHome.Net" target="_blank">�ٷ�������̳</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/OpenSource/" target="_blank">�۹�CMS��Դ����</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/ebak2008os/" target="_blank">�۹���������Դ����</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/service/about.html" target="_blank">���ڵ۹�</a></div></td>
        </tr>
        <tr> 
          <td height="36"> <div align="center">������ܼ�ǵ�������������޹�˾ ��Ȩ����<BR>
              <font face="Arial, Helvetica, sans-serif">Copyright &copy; 2002 
              - 2009 <b><a href="http://www.PHome.net"><font color="#000000">PHome</font><font color="#FF6600">.Net</font></a></b></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
