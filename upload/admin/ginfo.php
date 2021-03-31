<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
db_close();
$empire=null;
@header('Content-Type: text/html; charset=gb2312');
@include('../class/EmpireDown_version.php');
$pd="?product=empiredown&usechar=gbk&doupdate=".EmpireDown_UPDATE."&ver=".EmpireDown_VERSION."&lasttime=".EmpireDown_LASTTIME."&domain=".$_SERVER['HTTP_HOST']."&ip=".$_SERVER['REMOTE_ADDR'];
?>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<body leftmargin="0" topmargin="0">
<script>
function EchoUpdateInfo(showdiv,messagereturn){
	document.getElementById(showdiv).innerHTML=messagereturn;
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="empirecmsdt"></div></td>
  </tr>
</table>
<script type="text/javascript" src="http://www.phome.net/empireupdate/<?php echo $pd;?>"></script>