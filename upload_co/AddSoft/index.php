<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
if($public_r[openadd])
{
	printerror("Ͷ�幦�ܱ�����Ա�ر�","history.go(-1)",1);
}
$filepass=time();
//ȡ������
$l_sql=$empire->query("select language,isdefault,languageid from {$dbtbpre}language");
while($l_r=$empire->fetch($l_sql))
{
	if($l_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$l_options.="<option value=".$l_r[languageid].$select.">".$l_r[language]."</option>";
}
//ȡ���������
$t_sql=$empire->query("select softtypeid,softtype,isdefault from {$dbtbpre}softtype");
while($t_r=$empire->fetch($t_sql))
{
	if($t_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$t_options.="<option value=".$t_r[softtypeid].$select.">".$t_r[softtype]."</option>";
}
//ȡ�������Ȩ
$s_sql=$empire->query("select sqid,sqname,isdefault from {$dbtbpre}sq");
while($s_r=$empire->fetch($s_sql))
{
	if($s_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$s_options.="<option value=".$s_r[sqid].$select.">".$s_r[sqname]."</option>";
}
//ȡ���������
$fj=0;
$fj_sql=$empire->query("select fjid,fjname from {$dbtbpre}fj");
while($fj_r=$empire->fetch($fj_sql))
{
	$fj++;
	if($fj%5==0)
	{$br="<br>";}
	else
	{$br="";}
	$fj_check.="<input type=checkbox name=check value='".$fj_r[fjname]."' onclick=\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\">".$fj_r[fjname]."&nbsp;&nbsp;".$br;
}
//ר��
$zt_sql=$empire->query("select ztid,ztname from {$dbtbpre}downzt order by ztid");
while($zt_r=$empire->fetch($zt_sql))
{
	$zts.="<option value='".$zt_r[ztid]."'>".$zt_r[ztname]."</option>";
}
$url="<a href='../'>��ҳ</a>&nbsp;>&nbsp;<a href='../cp'>��Ա����</a>&nbsp;>&nbsp;Ͷ��";
@include("../data/template/cp_1.php");
?>
<script>
//���л���
function AddFj(str){
	var r;
	var a;
	a=document.add.soft_fj.value;
	r=a.split(str);
	if(r.length!=1)
	{return true;}
	document.add.soft_fj.value+="/"+str;
}
function DelFj(str){
	var a;
	a=document.add.soft_fj.value;
	document.add.soft_fj.value=a.replace("/"+str,"");
}

function doadd(){
	var i;
	var str="";
	var oldi=0;
	var j=0;
	oldi=parseInt(document.add.editnum.value);
	for(i=1;i<=document.add.downnum.value;i++)
	{
		j=i+oldi;
		str=str+"<tr><td width='10%'><div align=center>"+j+"</div></td><td width='26%'><input name=downname[] type=text id=downname[] value=���ص�ַ"+j+" size=18></td><td width='64%'><input name=downpath[] type=text id=downpath[] size=45></td></tr>";
	}
	document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="add" method="post" action="../phome/index.php" enctype="multipart/form-data">
    <tr class="header"> 
      <td height="25" colspan="2">������� <input type=hidden name=phome value=AddSoft>
        <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="18%" height="25">�������:(*)</td>
      <td width="82%" height="25"><input name="softname" type="text" id="softname" size="35">
        �汾�� 
        <input name="soft_version" type="text" id="soft_version2" size="15"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ѡ�����:(*)</td>
      <td height="25"><script src=../data/js/addsoft_class.js></script> <font color="#666666">(Ҫѡ����ɫ��[�ռ�����])</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ѡ��ר��:</td>
      <td height="25"><select name="ztid" id="ztid">
          <option value="0">������ר��</option>
          <?=$zts?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ؼ���:</td>
      <td height="25"><input name="keyboard" type="text" id="keyboard" size="45"> 
        <font color="#666666">(�������&quot;,&quot;��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top">Ԥ��ͼ:</td>
      <td height="25"><input name="softpic" type="text" id="softpic" size="45"> 
        <font color="#666666">(��û�У�������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ϴ�ͼƬ�� 
        <input name="imgfile" type="file" id="imgfile"> <font color="#666666">(��ֱ�ӵ�ַ����) 
        </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����:</td>
      <td height="25"><input name="writer" type="text" id="writer" size="45"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ٷ���վ:</td>
      <td height="25"><input name="homepage" type="text" id="homepage" size="45" value="http://"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ʾ��ַ:</td>
      <td height="25"><input name="demo" type="text" id="demo" size="45" value="http://"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���л���:</td>
      <td height="25"><input name="soft_fj" type="text" id="soft_fj" size="45"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> 
        <?=$fj_check?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������</td>
      <td height="25">��������: 
        <select name="language" id="language">
          <?=$l_options?>
        </select>
        ���������: 
        <select name="softtype" id="softtype">
          <?=$t_options?>
        </select>
        ����Ȩ��ʽ: 
        <select name="soft_sq" id="select">
          <?=$s_options?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">�ļ�����: 
        <input name="filetype" type="text" id="filetype" size="10"> <select name="select2" onchange="document.add.filetype.value=this.value">
          <option value="">����</option>
          <option value=".zip">.zip</option>
          <option value=".rar">.rar</option>
          <option value=".exe">.exe</option>
        </select>
        ���ļ���С: 
        <input name="filesize" type="text" id="filesize2" size="10"> <select name="select" onchange="document.add.filesize.value+=this.value">
          <option value="">��λ</option>
          <option value=" MB">MB</option>
          <option value=" KB">KB</option>
          <option value=" GB">GB</option>
          <option value=" BYTES">BYTES</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>���ص�ַ:(*)</p></td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="10%"> <div align="center">���</div></td>
                  <td width="26%">��������</td>
                  <td width="64%">���ص�ַ</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="10%"> <div align="center">1</div></td>
                  <td width="26%"> <input name="downname[]" type="text" id="downname[]" value="���ص�ַ1" size="16"> 
                  </td>
                  <td width="64%"> <input name="downpath[]" type="text" id="downpath[]" size="32"> 
                  </td>
                </tr>
                <tr> 
                  <td><div align="center">2</div></td>
                  <td><input name="downname[]" type="text" id="downname[]" value="���ص�ַ2" size="16"></td>
                  <td><input name="downpath[]" type="text" id="downpath[]" size="32"></td>
                </tr>
                <tr> 
                  <td><div align="center">3</div></td>
                  <td><input name="downname[]" type="text" id="downname[]" value="���ص�ַ3" size="16"></td>
                  <td><input name="downpath[]" type="text" id="downpath[]" size="32"></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�������:(*)</td>
      <td height="25"> <textarea name="softsay" cols="67" rows="10" style="WIDTH:100%"></textarea> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit2" value="�ύ"> <input type="reset" name="Submit3" value="����"></td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>