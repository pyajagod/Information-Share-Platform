<?php
if(!defined('InEmpireDown'))
{
	exit();
}
$waitbaktime=(int)$_GET['waitbaktime'];
$stime=$_GET['stime'];
if(empty($stime))
{
	$stime=time();
}
$t=$_GET['t'];
if(empty($t))
{$t=0;}
$p=$_GET['p'];
if(empty($p))
{$p=1;}
$btb=explode(",",$b_table);
$tbcount=count($btb);
//最后一个文件
if($p>=$tb[$btb[$t]])
{
	$t++;
	//恢复完毕
	if($t>=$tbcount)
	{
		$varmessage="恭喜您！数据还原完毕．<br><br>共计用时: ".ToChangeUseTime($stime);
		printerror($varmessage,'../../ReData.php',0,1);
	}
	$nfile=$btb[$t]."_1.php";
	//进入下一个表
	//echo $btb[$t-1].$fun_r['ReOneTableSuccess']."<script>self.location.href='$nfile?t=$t&p=0&mydbname=$mydbname&mypath=$mypath&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=$nfile?t=$t&p=0&mydbname=$mydbname&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."表还原完毕，正在进入下一个表还原......";
	exit();
}
//进入下一个文件
$p++;
$nfile=$btb[$t]."_".$p.".php";
//echo $fun_r['ReOneDataSuccess'].Ebak_EchoReDataSt($btb[$t],$tbcount,$t,$tb[$btb[$t]],$p)."<script>self.location.href='$nfile?t=$t&p=$p&mydbname=$mydbname&mypath=$mypath&stime=$stime';</script>";

echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=$nfile?t=$t&p=$p&mydbname=$mydbname&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">"."一组数据恢复完毕，正在进入下一组数据......".Ebak_EchoReDataSt($btb[$t],$tbcount,$t,$tb[$btb[$t]],$p);
db_close();
$empire=null;
?>