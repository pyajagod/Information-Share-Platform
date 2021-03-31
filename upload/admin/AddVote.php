<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"vote");
$phome=$_GET['phome'];
$r[width]=500;
$r[height]=300;
$r[dotime]="0000-00-00";
$voteclass0=" checked";
$doip0=" checked";
$editnum=8;
$url="<a href=ListVote.php>管理投票</a>&nbsp;>&nbsp;增加投票";
//修改专题
if($phome=="EditVote")
{
	$voteid=(int)$_GET['voteid'];
	$r=$empire->fetch1("select voteid,title,votetext,voteclass,doip,dotime,width,height from {$dbtbpre}downvote where voteid='$voteid'");
	$url="<a href=ListVote.php>管理投票</a>&nbsp;>&nbsp;修改投票".$r[title];
	$str="dotime".$r[dotime];
	$$str=" selected";
	if($r[voteclass]==1)
	{
		$voteclass0="";
		$voteclass1=" checked";
	}
	if($r[doip]==1)
	{
		$doip0="";
		$doip1=" checked";
	}
	$d_record=explode("\r\n",$r[votetext]);
	for($i=0;$i<count($d_record);$i++)
	{
		$j=$i+1;
		$d_field=explode("::::::",$d_record[$i]);
		$allv.="<tr><td width=9%><div align=center>".$j."</div></td><td width=65%><input name=votename[] type=text id=votename[] value='".$d_field[0]."' size=30></td><td width=26%><input name=votenum[] type=text id=votenum[] value='".$d_field[1]."' size=6><input type=hidden name=vid[] value=".$j."><input type=checkbox name=delvid[] value=".$j.">删除</td></tr>";
	}
	$editnum=$j;
	$allv="<table width=100% border=0 cellspacing=1 cellpadding=3>".$allv."</table>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>投票</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function doadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.editnum.value);
for(i=1;i<=document.add.vote_num.value;i++)
{
j=i+oldi;
str=str+"<tr><td width='9%' height=20> <div align=center>"+j+"</div></td><td width='65%'> <div align=center><input type=text name=votename[] size=30></div></td><td width='26%'> <div align=center><input type=text name=votenum[] value=0 size=6></div></td></tr>";
}
document.getElementById("addvote").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<script src=editor/setday.js></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置： 
      <?=$url?>
    </td>
  </tr>
</table>
<form name="add" method="post" action="ListVote.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"><p>增加投票</p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">主题标题(最大60个汉字)</td>
      <td width="79%" height="25"><input name="title" type="text" id="title" size="50" value="<?=$r[title]?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="voteid" type="hidden" id="voteid" value="<?=$r[voteid]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>投票项目<br>
        </p></td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr bgcolor="#DBEAF5"> 
                  <td width="9%" height="20"> <div align="center">编号</div></td>
                  <td width="65%"> <div align="center">项目名称</div></td>
                  <td width="26%"> <div align="center">投票数</div></td>
                </tr>
				</table>
				<?
				if($phome=="EditVote")
				{echo"$allv";}
				else
				{
				?>
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td height="24" width="9%"> <div align="center">1</div></td>
                  <td height="24" width="65%"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24" width="26%"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">2</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">3</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">4</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">5</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">6</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">7</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">8</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
              </table>
			  <?
			  }
			  ?>
			  </td>
          </tr>
          <tr> 
            <td>投票扩展数量: 
              <input name="vote_num" type="text" id="vote_num" value="1" size="6"> 
              <input type="button" name="Submit52" value="输出地址" onclick="javascript:doadd();">
              <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>"> </td>
          </tr>
          <tr> 
            <td id=addvote></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">投票类型:</td>
      <td height="25"><input name="voteclass" type="radio" value="0"<?=$voteclass0?>>
        单选 
        <input type="radio" name="voteclass" value="1"<?=$voteclass1?>>
        复选</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">限制IP:</td>
      <td height="25"><input type="radio" name="doip" value="0"<?=$doip0?>>
        不限制 
        <input name="doip" type="radio" value="1"<?=$doip1?>>
        限制(限制后同一IP只能投一次票)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">过期时间:</td>
      <td height="25"> <input name=olddotime type=hidden value="<?=$r[dotime]?>">
        <input name="dotime" type="text" id="dotime2" value="<?=$r[dotime]?>" size="12" onClick="setday(this)"> 
        <font color="#666666">(超过此期限,将不能投票,0000-00-00为不限制)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">查看投票窗口</td>
      <td height="25">宽度: 
        <input name="width" type="text" id="width" value="<?=$r[width]?>" size="6">
        高度: 
        <input name="height" type="text" id="height" value="<?=$r[height]?>" size="6"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
