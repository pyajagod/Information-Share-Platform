<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/q_functions.php");
include("../../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//�������
$searchid=(int)$_GET['searchid'];
if(empty($searchid))
{
	printerror("û����������ص�����","history.go(-1)",1);
}
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$search="&searchid=".$searchid;
$page_line=12;//ÿҳ��ʾ������
$line=20;//ÿҳ��ʾ��¼��
$offset=$start+$page*$line;//��ƫ����
$add='';
$search_r=$empire->fetch1("select searchid,keyboard,result_num,classid,softtype,language,soft_sq,searchclass,ztid from {$dbtbpre}downsearch where searchid='$searchid'");
if(!$search_r[searchid])
{
	printerror("û���������������","history.go(-1)",1);
}
//������Ŀ
if($search_r[classid])
{
	if($class_r[$search_r[classid]][islast])//�ռ���Ŀ
	{
		$add.="classid='$search_r[classid]' and ";
	}
	else
	{
		$add.="(".ReturnClass($class_r[$search_r[classid]][sonclass]).") and ";
	}
}
//����ר��
if($search_r['ztid'])
{
	$add.="ztid='$search_r[ztid]' and ";
}
//����������
if($search_r[softtype])
{
	$add.="softtype='$search_r[softtype]' and ";
}
//��������
if($search_r[language])
{
	$add.="language='$search_r[language]' and ";
}
//��Ȩ��ʽ
if($search_r[soft_sq])
{
	$add.="soft_sq='$search_r[soft_sq]' and ";
}
//������ʽ
if($search_r[searchclass]==0)//��ѯȫ��
{
	$add.="(softname like '%$search_r[keyboard]%' or softsay like '%$search_r[keyboard]%')";
}
elseif($search_r[searchclass]==1)//���������ѯ
{
	$add.="softname like '%$search_r[keyboard]%'";
}
elseif($search_r[searchclass]==2)//�����˵����ѯ
{
	$add.="softsay like '%$search_r[keyboard]%'";
}
else
{
	$add.="writer like '%$search_r[keyboard]%'";
}
$query="select softid,softname,softsay,classid,softtime,homepage,adduser,writer,filesize,filetype,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,language,softtype,foruser,soft_version,titleurl,titlefont,count_day,filename,ztid from {$dbtbpre}down where ".$add;
$num=$search_r[result_num];
$query.=" order by softid desc limit $offset,$line";
$sql=$empire->query($query);
$listpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='../../'>��ҳ</a>&nbsp;>&nbsp;<a href='".EDReturnSearchFormUrl()."'>�߼�����</a>&nbsp;>&nbsp;�������";
$keyboard=$search_r[keyboard];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������� - Powered by EmpireDown</title>
<meta name="keywords" content="�������" />
<meta name="description" content="�������" />
<link href="/ccxm/upload/skin/default/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body topmargin="0">
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" background="/ccxm/upload/skin/default/images/menu_bg.gif" class="tablebordercss">
  <tr> 
    <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3" class="topfontcss">
        <tr>
          <td width="50%"><script src="/ccxm/upload/iframe/loginjs.php"></script></td>
          <td><div align="right">
		  		<a href="/ccxm/upload/">������ҳ</a> | <a href="/ccxm/upload/list/class.html">�������</a> | <a href="/ccxm/upload/list/list1_1.html">�������</a> | <a href="/ccxm/upload/list/list2_1.html">�����Ƽ�</a> | <a href="/ccxm/upload/list/list3_1.html">��������</a></div></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr>
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="27%" height="65">
	  <a href="http://www.phome.net"><img height="65" alt="�۹����" src="/ccxm/upload/skin/default/images/logo.jpg" width="180" border="0" /></a>
	  </td>
      <td width="63%" align="center">
	  <a href="http://www.phome.net" target="_blank"><img src="/ccxm/upload/skin/default/images/opensource.gif" alt="�۹�CMSϵ�������Դ����" width="468" height="60" border="0" /></a>
	  </td>
      <td width="10%"> 
          <table cellspacing="0" cellpadding="0" width="100%" border="0">
		    <tr> 
              <td>
			  <img height="16" hspace="2" src="/ccxm/upload/skin/default/images/home.gif" width="16" align="absmiddle" vspace="2" /><a onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.phome.net');" href="#edown">��Ϊ��ҳ</a>
			  </td>
            </tr>
		    <tr> 
              <td>
			  <img height="16" hspace="2" 
                  src="/ccxm/upload/skin/default/images/bookmark.gif" width="16" align="absmiddle" 
                  vspace="2" /><a onclick="window.external.addFavorite(location.href,document.title)" href="#edown">�����ղ�</a>
              </td>
            </tr>
            <tr> 
              <td>
			  <img height="17" hspace="2" src="/ccxm/upload/skin/default/images/email.gif" width="16" align="absmiddle" vspace="2" /><a href="#edown">��ϵ����</a>
			  </td>
            </tr>
          </table>
      </td>
    </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" background="/ccxm/upload/skin/default/images/menu_bg.gif" class="tablebordercss">
  <tr> 
    <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td height="25" align="center" class="classmenucss"> 
            
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" class="gginfocss">
  <tr>
    <td>
		<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
        <tr> 
          <td width="23" height="24">
		  <div align="center"><img src="/ccxm/upload/skin/default/images/gonggao.gif" width="20" height="16" align="middle" /></div>
		  </td>
          <td width="326" valign="middle">
			<script src="/ccxm/upload/data/js/gg.js"></script>
          </td>
          <td width="427" align="right"> 
              <table border="0" cellpadding="3" cellspacing="1">
			  <form name="searchform" method="post" action="/ccxm/upload/search/index.php">
			  <tr>
			  	  <td valign="middle">����: 
                    <select name="show">
					<option value="0">����</option>
					<option value="1" selected>�����</option>
					<option value="2">������</option>
					</select> <input name="keyboard" type="text"><input type="submit" name="Submit" value="����"> [<a href="/ccxm/upload/list/search.html">�߼�����</a>]
				</td>
              </tr>
              </form>
              </table>
          </td>
        </tr>
      	</table>
	</td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebordercss">
  <tr>
    <td>
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
			<a href="http://www.phome.net/OpenSource/" target="_blank"><img src="/ccxm/upload/skin/default/images/EmpireCMS51os.jpg" border="0" width="776" height="134" alt="�۹�CMSȫ�濪Դ" /></a></td>
          </tr>
        </table>
      </div>
	</td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr> 
    <td></td>
  </tr>
</table> 
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebordercss">
  <tr>
    <td height="25" background="/ccxm/upload/skin/default/images/header_bg.gif">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td>����λ��: <?=$url?></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="6">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="222" valign="top"> 
      <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tablebordercss">
        <tr> 
          <td height="27" background="/ccxm/upload/skin/default/images/bclass_bg.gif"> 
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="6">&nbsp;</td>
                <td width="103" valign="bottom" background="/ccxm/upload/skin/default/images/titlebg_l.gif"> 
                  <div align="center"><strong>���ർ��</strong></div></td>
                <td width="109"><img src="/ccxm/upload/skin/default/images/titlebg_r.gif" width="7" height="27" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td valign="top"><script src='/ccxm/upload/data/js/class.js'></script></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" height="8">
        <tr> 
          <td></td>
        </tr>
      </table>
      <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tablebordercss">
        <tr> 
          <td height="27" background="/ccxm/upload/skin/default/images/bclass_bg.gif"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><strong>��������</strong></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td valign="top"><script src='/ccxm/upload/data/js/top.js'></script></td>
              </tr>
            </table>
          </td>
        </tr>
      </table> 
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" height="8">
        <tr> 
          <td></td>
        </tr>
      </table>
      <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tablebordercss">
        <tr> 
          <td height="27" background="/ccxm/upload/skin/default/images/bclass_bg.gif"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><strong>�������</strong></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr height="100%"> 
          <td valign="top"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td valign="top"><script src='/ccxm/upload/data/js/new.js'></script></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td width="556" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebordercss">
        <tr> 
          <td height="27" background="/ccxm/upload/skin/default/images/bclass_bg.gif"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><strong>���������<?=$keyboard?></strong></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td valign="top">
		  
<?php
$strlen='200';
$subtitle='0';
$formatdate='Y-m-d';
while($r=$empire->fetch($sql))
{
	$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);//���ӵ�ַ
	//��������
	$thisclassurl=EDReturnClassUrl($r[classid]);
	$thisclassname=EdReturnClassname($r[classid]);
	$classname="[<a href='".$thisclassurl."'>".$thisclassname."</a>]&nbsp;";
	//��Ȩ��ʽ
	$soft_sq=$class_sqr[$r[soft_sq]][sqname];
	//�������
	$softtype="<a href='".EDReturnTypeUrl($r[softtype])."'>".$class_sr[$r[softtype]][softtype]."</a>";
	//����
	$language=$class_lr[$r[language]][language];
	//ר��
	$ztname="<a href='".EDReturnZtUrl($r[ztid])."'>".$class_zr[$r[ztid]][ztname]."</a>";
	//ͼƬ
	$softpic=$r[softpic]?$r[softpic]:$public_r[sitedown]."data/images/notimg.gif";
	//�����
	$softname=esub($r[softname],$subtitle);
	//���
	$softsay=nl2br(GetEBBcode(esub(strip_tags(trim($r[softsay])),$strlen)));
	//ʱ��
	$softtime=date($formatdate,$r[softtime]);
?>
 
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="28" background="/ccxm/upload/skin/default/images/listbg1.gif">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3">
                    <tr> 
                      <td width="65%"><img src="/ccxm/upload/skin/default/images/listjt.gif" width="9" height="9" align="absmiddle"> 
                        <a href="<?=$softurl?>" title="<?=$r[softname]?>"><?=$softname?></a>
                      </td>
                      <td width="20%"><div align="center"><a href="<?=$thisclassurl?>">[<?=$thisclassname?>]</a></div></td>
                      <td width="15%"><div align="center"><?=$softtime?></div></td>
                    </tr>
                  </table>
				</td>
              </tr>
              <tr> 
                <td valign="top">
                  <table width="100%" border="0" cellspacing="1" cellpadding="3" style="word-break:break-all;line-height:20px">
                    <tr>
                      <td height="27" valign="top"><?=$softsay?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr> 
                <td height="36" valign="top"> 
                  <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EFF5FE" class="softinfo">
                    <tr>
                      <td width="23%"><img src="/ccxm/upload/skin/default/images/listjt2.gif" width="4" height="7" align="absmiddle"> 
                        ���ԣ�<?=$language?></td>
                      <td width="23%"><img src="/ccxm/upload/skin/default/images/listjt2.gif" width="4" height="7" align="absmiddle"> 
                        ���ͣ�<?=$softtype?></td>
                      <td width="23%"><img src="/ccxm/upload/skin/default/images/listjt2.gif" width="4" height="7" align="absmiddle"> 
                        ��Ȩ��<?=$soft_sq?></td>
                      <td width="31%"><img src="/ccxm/upload/skin/default/images/listjt2.gif" width="4" height="7" align="absmiddle"> 
                        �ȼ���<img src='../../data/images/<?=$r[star]?>star.gif'></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table> 
			
<?php
}
db_close();
$empire=null;
?>

          </td>
        </tr>
        <tr>
          <td height="25" bgcolor="#E7F1FE"> 
            <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr>
                <td height="27"><?=$listpage?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="12">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebordercss">
  <tr>
    <td height="27" background="/ccxm/upload/skin/default/images/bclass_bg.gif">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td><strong>����ĸ����</strong></td>
        </tr>
      </table>
	</td>
  </tr>
  <tr> 
    <td> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
              <tr bgcolor="#E7F1FE"> 
                <td height="23"> <div align="center"><strong><a href="/ccxm/upload/list/zm_A_1.html">A</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_B_1.html">B</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_C_1.html">C</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_D_1.html">D</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_E_1.html">E</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_F_1.html">F</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_G_1.html">G</a></strong></div></td>
                <td bgcolor="#E7F1FE"> <div align="center"><strong><a href="/ccxm/upload/list/zm_H_1.html">H</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_I_1.html">I</a></strong></div></td>
                <td bgcolor="#E7F1FE"> <div align="center"><strong><a href="/ccxm/upload/list/zm_J_1.html">J</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_K_1.html">K</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_L_1.html">L</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_M_1.html">M</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_N_1.html">N</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_O_1.html">O</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_P_1.html">P</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_Q_1.html">Q</a></strong></div></td>
                <td bgcolor="#E7F1FE"> 
                  <div align="center"><strong><a href="/ccxm/upload/list/zm_R_1.html">R</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_S_1.html">S</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_T_1.html">T</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_U_1.html">U</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_V_1.html">V</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_W_1.html">W</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_X_1.html">X</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_Y_1.html">Y</a></strong></div></td>
                <td> <div align="center"><strong><a href="/ccxm/upload/list/zm_Z_1.html">Z</a></strong></div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="12">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" height="12">
  <tr> 
    <td></td>
  </tr>
</table>
<table width="778" border="0" align="center" cellpadding="3" cellspacing="1" class="tablebordercss">
  <tr> 
    <td bgcolor="#E7F1FE"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td height="36" align="center">
		  	<a href="/ccxm/upload/">��վ��ҳ</a> | <a href="#">��������</a> | <a href="#">��������</a> | <a href="#">������</a> | <a href="#">��ϵ����</a> | <a href="#">��������</a> | <a href="http://www.phome.net" target="_blank">����֧��</a> 
          </td>
        </tr>
        <tr> 
          <td><div align="center">Powered by <strong><a href="http://www.phome.net" target="_blank">EmpireDown</a></strong> 
              <strong><font color="#FF9900">2.5</font></strong>&nbsp; &copy; 2002-2009 
              <a href="http://www.digod.com" target="_blank">EmpireSoft Inc.</a></div></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</body>
</html>