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
CheckLevel($myuserid,$myusername,$classid,"repip");
//--------------------��������Ŀ
$fcfile="../data/fc/downclass.js";
$do_class="<script src='../data/fc/downclass.js'></script>";
if(!file_exists($fcfile))
{
	$do_class=ShowClass_AddClass("","n",0,"|-",0);
}
//----------��Ա��
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	$ygroup.="<option value=".$l_r[groupid].">".$l_r[groupname]."</option>";
}
//----------��ַǰ׺
$qz="";
$downsql=$empire->query("select urlname,urlid from {$dbtbpre}downurl order by urlid");
while($downr=$empire->fetch($downsql))
{
	$qz.="<option value='".$downr[urlid]."'>".$downr[urlname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����滻��ַ</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã� �����滻��ַ</td>
  </tr>
</table>
<form name="form1" method="post" action="comphome.php" target="_blank" onsubmit="return confirm('ȷ��Ҫ������');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">������������/���ߵ�ַȨ�� 
          <input type=hidden name=phome value=RepIp>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">�滻���ࣺ</td>
      <td width="79%" height="25"><select name="classid" id="classid">
          <option value=0>���з���</option>
          <?=$do_class?>
        </select>
        <font color="#666666"> (��ѡ�����࣬��Ӧ���������ӷ���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�滻�ֶ�(*)��</td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="32%"><input name="downpath" type="checkbox" id="downpath" value="1">
              ���ص�ַ(downpath)</td>
            <td width="68%"><input name="onlinepath" type="checkbox" id="onlinepath" value="1">
              ���ߵ�ַ(onlinepath)</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">Ȩ��ת���� 
        <input name="dogroup" type="checkbox" id="dogroup" value="1"></td>
      <td height="25"><div align="left"> 
          <table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
            <tr> 
              <td width="49%"><div align="center">ԭ��Ա��</div></td>
              <td width="51%"><div align="center">�»�Ա��</div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"> 
                  <select name="oldgroupid" id="oldgroupid">
                    <option value="no">������</option>
                    <option value="0">�ο�</option>
                    <?=$ygroup?>
                  </select>
                </div></td>
              <td><div align="center"> 
                  <select name="newgroupid" id="newgroupid">
                    <option value="0">�ο�</option>
                    <?=$ygroup?>
                  </select>
                </div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����ת���� 
        <input name="dofen" type="checkbox" id="dofen" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">ԭ����</div></td>
            <td width="51%"><div align="center">�µ���</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldfen" type="text" id="oldfen" value="no" size="6">
              </div></td>
            <td><div align="center"> 
                <input name="newfen" type="text" id="newfen" value="0" size="6">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ǰ׺ת���� 
        <input name="doqz" type="checkbox" id="doqz" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">ԭǰ׺</div></td>
            <td width="51%"><div align="center">��ǰ׺</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <select name="oldqz" id="oldqz">
                  <option value="no">������</option>
                  <option value="0">��ǰ׺</option>
                  <?=$qz?>
                </select>
              </div></td>
            <td><div align="center"> 
                <select name="newqz">
                  <option value="0">��ǰ׺</option>
                  <?=$qz?>
                </select>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ַ�滻�� 
        <input name="dopath" type="checkbox" id="dopath" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">ԭ���ص�ַ�ַ�</div></td>
            <td width="51%"><div align="center">�����ص�ַ�ַ�</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldpath" type="text" id="oldpath">
              </div></td>
            <td><div align="center"> 
                <input name="newpath" type="text" id="newpath">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����滻�� 
        <input name="doname" type="checkbox" id="doname" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">ԭ���������ַ�</div></td>
            <td width="51%"><div align="center">�����������ַ�</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldname" type="text" id="oldname">
              </div></td>
            <td><div align="center"> 
                <input name="newname" type="text" id="newname">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����SQL������</td>
      <td height="25"><input name="query" type="text" id="query" size="75"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">�磺softname='�����'</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit2" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">˵������ԭ����Ϊno����������Ϣ�ĵ�����Ϊ�µ��������ѡ��Ϊ�����ã���������Ϣ��Ϊ�µ�ֵ��<br>
        ע�⣺<font color="#FF0000">ʹ�ô˹��ܣ���ñ���һ�����ݣ��Է���һ</font></td>
    </tr>
  </table>
</form>
</body>
</html>
