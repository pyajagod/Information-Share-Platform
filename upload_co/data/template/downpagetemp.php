<?php
if(!defined('InEmpireDown'))
{
	exit();
}
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=htmlspecialchars($r[softname])?> - <?=htmlspecialchars($thisdownname)?></title>
<meta name="keywords" content="<?=htmlspecialchars($r[keyboard])?>">
<meta name="description" content="<?=htmlspecialchars(strip_tags($r[softsay]))?>">
<link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<br>
<br>
<br>
<table align="center" width="100%">
  <tr> 
    <td height="32" align=center><a href="<?=$url?>" title="<?=$r[softname]?> ��<?=$thisdownname?>"><img src="../data/images/download.jpg" border=0></a></td>
  </tr>
  <tr> 
    <td align=center>(�������)</td>
  </tr>
</table>
<br>
</body>
</html>