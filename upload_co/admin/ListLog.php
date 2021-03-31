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
CheckLevel($myuserid,$myusername,$classid,"log");

//ɾ����־
function DelLog($loginid,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"log");
	$loginid=(int)$loginid;
	if(!$loginid)
	{
		printerror("��ѡ��Ҫɾ������־","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}loginlog where loginid='$loginid'");
	if($sql)
	{
		printerror("ɾ����־�ɹ�","ListLog.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ɾ����־
function DelLog_all($loginid,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"log");
	$count=count($loginid);
	if(!$count)
	{
		printerror("��ѡ��Ҫɾ������־","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add=" loginid='".intval($loginid[$i])."' or";
	}
	$add=substr($add,0,strlen($add)-3);
	$sql=$empire->query("delete from {$dbtbpre}loginlog where".$add);
	if($sql)
	{
		printerror("ɾ����־�ɹ�","ListLog.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ɾ����־
function DelLog_date($start_y,$start_m,$start_d,$end_y,$end_m,$end_d,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"log");
	$start=RepPostVar($start_y.$start_m.$start_d);
	$end=RepPostVar($end_y.$end_m.$end_d);
	$sql=$empire->query("delete from {$dbtbpre}loginlog where logintime<'$end' and logintime>'$start'");
	if($sql)
	{
		printerror("ɾ����־�ɹ�","ListLog.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="DelLog")//ɾ����־
{
	$loginid=$_GET['loginid'];
	DelLog($loginid,$myuserid,$myusername);
}
elseif($phome=="DelLog_all")//����ɾ����־
{
	$loginid=$_POST['loginid'];
	DelLog_all($loginid,$myuserid,$myusername);
}

$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//��ƫ����
$query="select loginid,username,loginip,logintime from {$dbtbpre}loginlog";
$totalquery="select count(*) as total from {$dbtbpre}loginlog";
//����
$doing=$_GET['doing'];
if(empty($doing))
{$doing=$_POST['doing'];}
if($doing=="del")
{
	$start_y=$_POST['start_y'];
	$start_m=$_POST['start_m'];
	$start_d=$_POST['start_d'];
	$end_y=$_POST['end_y'];
	$end_m=$_POST['end_m'];
	$end_d=$_POST['end_d'];
	DelLog_date($start_y,$start_m,$start_d,$end_y,$end_m,$end_d,$myuserid,$myusername);
}
elseif($doing=="search")
{
	$start_y=$_POST['start_y'];
	if(empty($start_y))
	{$start_y=$_GET['start_y'];}
	$start_m=$_POST['start_m'];
	if(empty($start_m))
	{$start_m=$_GET['start_m'];}
	$start_d=$_POST['start_d'];
	if(empty($start_d))
	{$start_d=$_GET['start_d'];}
	$end_y=$_POST['end_y'];
	if(empty($end_y))
	{$end_y=$_GET['end_y'];}
	$end_m=$_POST['end_m'];
	if(empty($end_m))
	{$end_m=$_GET['end_m'];}
	$end_d=$_POST['end_d'];
	if(empty($end_d))
	{$end_d=$_GET['end_d'];}
	$start1=RepPostVar($start_y.$start_m.$start_d);
	$end=RepPostVar($end_y.$end_m.$end_d);
	$query.=" where logintime<='$end' and logintime>='$start1'";
	$totalquery.=" where logintime<='$end' and logintime>='$start1'";
	$search="&doing=search&start_y=$start_y&start_m=$start_m&start_d=$start_d&end_y=$end_y&end_m=$end_m&end_d=$end_d";
}
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by loginid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//������
$thisyear=date("Y");
for($i=2003;$i<=$thisyear+1;$i++)
{
	$yearoption.="<option value='".$i."'>".$i."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����滻��ַȨ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã������½��־
    </td>
  </tr>
</table>
<form name=form1 method=post action='ListLog.php' onsubmit="return confirm('ȷ��Ҫִ�д˲���?');">
  <table width="100%" align=center cellpadding=0 cellspacing=0>
    <tr>
      <td><div align="center"><font color=#333333>����: 
          <select name=start_y size=1>
            <?=$yearoption?>
          </select>
          �� 
          <select name=start_m size=1>
            <option value=01>1</option>
            <option value=02>2</option>
            <option value=03>3</option>
            <option value=04>4</option>
            <option value=05>5</option>
            <option value=06>6</option>
            <option value=07>7</option>
            <option value=08>8</option>
            <option value=09>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
          </select>
          �� 
          <select name=start_d size=1>
            <option value=01>1</option>
            <option value=02>2</option>
            <option value=03>3</option>
            <option value=0>4</option>
            <option value=05>5</option>
            <option value=06>6</option>
            <option value=07>7</option>
            <option value=08>8</option>
            <option value=09>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
            <option value=13>13</option>
            <option value=14>14</option>
            <option value=15>15</option>
            <option value=16>16</option>
            <option value=17>17</option>
            <option value=18>18</option>
            <option value=19>19</option>
            <option value=20>20</option>
            <option value=21>21</option>
            <option value=22>22</option>
            <option value=23>23</option>
            <option value=24>24</option>
            <option value=25>25</option>
            <option value=26>26</option>
            <option value=27>27</option>
            <option value=28>28</option>
            <option value=29>29</option>
            <option value=30>30</option>
            <option value=31>31</option>
          </select>
          ��---��--- 
          <select name=end_y size=1>
            <?=$yearoption?>
          </select>
          �� 
          <select name=end_m size=1>
            <option value=01>1</option>
            <option value=02>2</option>
            <option value=03>3</option>
            <option value=04>4</option>
            <option value=05>5</option>
            <option value=06>6</option>
            <option value=07>7</option>
            <option value=08>8</option>
            <option value=09>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
          </select>
          �� 
          <select name=end_d size=1>
            <option value=01>1</option>
            <option value=02>2</option>
            <option value=03>3</option>
            <option value=04>4</option>
            <option value=05>5</option>
            <option value=06>6</option>
            <option value=07>7</option>
            <option value=08>8</option>
            <option value=09>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
            <option value=13>13</option>
            <option value=14>14</option>
            <option value=15>15</option>
            <option value=16>16</option>
            <option value=17>17</option>
            <option value=18>18</option>
            <option value=19>19</option>
            <option value=20>20</option>
            <option value=21>21</option>
            <option value=22>22</option>
            <option value=23>23</option>
            <option value=24>24</option>
            <option value=25>25</option>
            <option value=26>26</option>
            <option value=27>27</option>
            <option value=28>28</option>
            <option value=29>29</option>
            <option value=30>30</option>
            <option value=31>31</option>
          </select>
          �յ���־</font></div></td></tr><tr> <td> <div align=center>
          <input name="doing" type="radio" value="search" checked>
          ��ѯ��־ 
          <input type="radio" name="doing" value="del">
          ɾ����־ 
          <input name=do type=submit id="do" value=ִ�в���>
          <input type=hidden name=phome2 value=DelLog_date>
        </div></td></tr></table>
</form>
<form name="form2" method="post" action="ListLog.php" onsubmit="return confirm('ȷ��Ҫɾ��?');">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">��½�û�</div></td>
      <td height="25"><div align="center">��½IP</div></td>
      <td><div align="center">��½ʱ��</div></td>
      <td height="25"><div align="center">ɾ��</div></td>
    </tr>
    <?
  while($r=$empire->fetch($sql))
  {
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[loginip]?>
        </div></td>
      <td><div align="center"> 
          <?=$r[logintime]?>
        </div></td>
      <td height="25"><div align="center">[<a href="ListLog.php?phome=DelLog&loginid=<?=$r[loginid]?>" onclick="return confirm('ȷ��Ҫɾ������־?');">ɾ��</a> 
          <input name="loginid[]" type="checkbox" id="loginid[]" value="<?=$r[loginid]?>">
          ]</div></td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="4"> 
        <?=$returnpage?>&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="����ɾ��"> <input name="phome" type="hidden" id="phome" value="DelLog_all"> 
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
