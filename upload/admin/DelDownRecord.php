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
CheckLevel($myuserid,$myusername,$classid,"card");

//����ɾ�����ݼ�¼
function DelDownRecord($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[downtime]=RepPostVar2($add[downtime]);
	if(empty($add[downtime]))
	{printerror("�������ֹʱ��","history.go(-1)");}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$sql=$empire->query("delete from {$dbtbpre}downdown where downtime<'".$add[downtime]."'");
	if($sql)
	{
		printerror("ɾ�����ؼ�¼�ɹ�","DelDownRecord.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//����ɾ�����ݼ�¼
if($phome=="DelDownRecord")
{
	DelDownRecord($_POST,$myuserid,$myusername);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>ɾ�����ر��ݼ�¼</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ��: ɾ�����ر��ݼ�¼</td>
  </tr>
</table>
<form name="form1" method="post" action="DelDownRecord.php" onsubmit="return confirm('ȷ��Ҫɾ��?');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">ɾ�����ر��ݼ�¼ 
          <input name="phome" type="hidden" id="phome" value="DelDownRecord">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">ɾ����ֹ�� 
          <input name="downtime" type="text" id="downtime" value="<?=date("Y-m-d H:i:s")?>" size="20">
          ֮ǰ�ı��ݼ�¼ 
          <input type="submit" name="Submit" value="�ύ">
          &nbsp; </div></td>
    </tr>
  </table>
</form>
</body>
</html>
