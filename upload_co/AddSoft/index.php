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
	printerror("投稿功能被管理员关闭","history.go(-1)",1);
}
$filepass=time();
//取得语言
$l_sql=$empire->query("select language,isdefault,languageid from {$dbtbpre}language");
while($l_r=$empire->fetch($l_sql))
{
	if($l_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$l_options.="<option value=".$l_r[languageid].$select.">".$l_r[language]."</option>";
}
//取得软件类型
$t_sql=$empire->query("select softtypeid,softtype,isdefault from {$dbtbpre}softtype");
while($t_r=$empire->fetch($t_sql))
{
	if($t_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$t_options.="<option value=".$t_r[softtypeid].$select.">".$t_r[softtype]."</option>";
}
//取得软件授权
$s_sql=$empire->query("select sqid,sqname,isdefault from {$dbtbpre}sq");
while($s_r=$empire->fetch($s_sql))
{
	if($s_r[isdefault])
	{$select=" selected";}
	else
	{$select="";}
	$s_options.="<option value=".$s_r[sqid].$select.">".$s_r[sqname]."</option>";
}
//取得软件环境
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
//专题
$zt_sql=$empire->query("select ztid,ztname from {$dbtbpre}downzt order by ztid");
while($zt_r=$empire->fetch($zt_sql))
{
	$zts.="<option value='".$zt_r[ztid]."'>".$zt_r[ztname]."</option>";
}
$url="<a href='../'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;投稿";
@include("../data/template/cp_1.php");
?>
<script>
//运行环境
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
		str=str+"<tr><td width='10%'><div align=center>"+j+"</div></td><td width='26%'><input name=downname[] type=text id=downname[] value=下载地址"+j+" size=18></td><td width='64%'><input name=downpath[] type=text id=downpath[] size=45></td></tr>";
	}
	document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="add" method="post" action="../phome/index.php" enctype="multipart/form-data">
    <tr class="header"> 
      <td height="25" colspan="2">发布软件 <input type=hidden name=phome value=AddSoft>
        <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="18%" height="25">软件名称:(*)</td>
      <td width="82%" height="25"><input name="softname" type="text" id="softname" size="35">
        版本： 
        <input name="soft_version" type="text" id="soft_version2" size="15"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">选择分类:(*)</td>
      <td height="25"><script src=../data/js/addsoft_class.js></script> <font color="#666666">(要选择蓝色条[终极分类])</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">选择专题:</td>
      <td height="25"><select name="ztid" id="ztid">
          <option value="0">不隶属专题</option>
          <?=$zts?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">关键字:</td>
      <td height="25"><input name="keyboard" type="text" id="keyboard" size="45"> 
        <font color="#666666">(多个请用&quot;,&quot;格开)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top">预览图:</td>
      <td height="25"><input name="softpic" type="text" id="softpic" size="45"> 
        <font color="#666666">(如没有，请留空)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">上传图片： 
        <input name="imgfile" type="file" id="imgfile"> <font color="#666666">(比直接地址优先) 
        </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">作者:</td>
      <td height="25"><input name="writer" type="text" id="writer" size="45"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">官方网站:</td>
      <td height="25"><input name="homepage" type="text" id="homepage" size="45" value="http://"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">演示地址:</td>
      <td height="25"><input name="demo" type="text" id="demo" size="45" value="http://"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">运行环境:</td>
      <td height="25"><input name="soft_fj" type="text" id="soft_fj" size="45"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> 
        <?=$fj_check?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">软件属性</td>
      <td height="25">界面语言: 
        <select name="language" id="language">
          <?=$l_options?>
        </select>
        ，软件类型: 
        <select name="softtype" id="softtype">
          <?=$t_options?>
        </select>
        ，授权型式: 
        <select name="soft_sq" id="select">
          <?=$s_options?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">文件类型: 
        <input name="filetype" type="text" id="filetype" size="10"> <select name="select2" onchange="document.add.filetype.value=this.value">
          <option value="">类型</option>
          <option value=".zip">.zip</option>
          <option value=".rar">.rar</option>
          <option value=".exe">.exe</option>
        </select>
        ，文件大小: 
        <input name="filesize" type="text" id="filesize2" size="10"> <select name="select" onchange="document.add.filesize.value+=this.value">
          <option value="">单位</option>
          <option value=" MB">MB</option>
          <option value=" KB">KB</option>
          <option value=" GB">GB</option>
          <option value=" BYTES">BYTES</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>下载地址:(*)</p></td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="10%"> <div align="center">编号</div></td>
                  <td width="26%">下载名称</td>
                  <td width="64%">下载地址</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="10%"> <div align="center">1</div></td>
                  <td width="26%"> <input name="downname[]" type="text" id="downname[]" value="下载地址1" size="16"> 
                  </td>
                  <td width="64%"> <input name="downpath[]" type="text" id="downpath[]" size="32"> 
                  </td>
                </tr>
                <tr> 
                  <td><div align="center">2</div></td>
                  <td><input name="downname[]" type="text" id="downname[]" value="下载地址2" size="16"></td>
                  <td><input name="downpath[]" type="text" id="downpath[]" size="32"></td>
                </tr>
                <tr> 
                  <td><div align="center">3</div></td>
                  <td><input name="downname[]" type="text" id="downname[]" value="下载地址3" size="16"></td>
                  <td><input name="downpath[]" type="text" id="downpath[]" size="32"></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">软件介绍:(*)</td>
      <td height="25"> <textarea name="softsay" cols="67" rows="10" style="WIDTH:100%"></textarea> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit2" value="提交"> <input type="reset" name="Submit3" value="重置"></td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>