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
//���һ���ļ�
if($p>=$tb[$btb[$t]])
{
	$t++;
	//�ָ����
	if($t>=$tbcount)
	{
		$varmessage="��ϲ�������ݻ�ԭ��ϣ�<br><br>������ʱ: ".ToChangeUseTime($stime);
		printerror($varmessage,'../../ReData.php',0,1);
	}
	$nfile=$btb[$t]."_1.php";
	//������һ����
	//echo $btb[$t-1].$fun_r['ReOneTableSuccess']."<script>self.location.href='$nfile?t=$t&p=0&mydbname=$mydbname&mypath=$mypath&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=$nfile?t=$t&p=0&mydbname=$mydbname&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."��ԭ��ϣ����ڽ�����һ����ԭ......";
	exit();
}
//������һ���ļ�
$p++;
$nfile=$btb[$t]."_".$p.".php";
//echo $fun_r['ReOneDataSuccess'].Ebak_EchoReDataSt($btb[$t],$tbcount,$t,$tb[$btb[$t]],$p)."<script>self.location.href='$nfile?t=$t&p=$p&mydbname=$mydbname&mypath=$mypath&stime=$stime';</script>";

echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=$nfile?t=$t&p=$p&mydbname=$mydbname&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">"."һ�����ݻָ���ϣ����ڽ�����һ������......".Ebak_EchoReDataSt($btb[$t],$tbcount,$t,$tb[$btb[$t]],$p);
db_close();
$empire=null;
?>