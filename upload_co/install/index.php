<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

//------ 参数开始 ------

$version="2.5,1228698490";
$dbchar="gbk";
$setchar="gbk";
$headerchar="gb2312";

//------ 参数结束 ------

@header('Content-Type: text/html; charset='.$headerchar);

if(file_exists("install.off"))
{
	echo"《帝国下载系统》安装程序已锁定。如果要重新安装，请删除本目录下的<b>install.off</b>文件！";
	exit();
}

$phome=$_GET['phome'];
//导入文件
include("data/fun.php");
//测试采集
if($phome=="TestCj")
{
	echo"<title>TEST</title>";
	TestCj();
}
$ok=$_GET['ok'];
$f=$_GET['f'];
if(empty($f))
{
	$f=1;
}
$font="f".$f;
$$font="red";
//处理
if($phome=="setdb"&&$ok)
{
	SetDb($_POST);
}
elseif($phome=="firstadmin"&&$ok)
{
	FirstAdmin($_POST);
}
elseif($phome=="defaultdata"&&$ok)
{
	InstallDefaultData($_GET);
}
//版本
@include("../class/EmpireDown_version.php");
$shorttag=0;
?>
<?
$shorttag=1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>帝国下载系统安装程序 - Powered by EmpireDown</title>

<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#56A5DE" leftmargin="0" topmargin="0">
<?php
if($shorttag==0)
{
?>
<br><br><br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td height="25" class="header"><div align="center"><strong><font color="#FFFFFF">错误提示</font></strong></div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25">您的PHP配置文件php.ini配置有问题，请按下面操作即可解决：</td>
        </tr>
        <tr>
          <td height="25">1、修改php.ini，将：short_open_tag 设为 On</td>
        </tr>
        <tr>
          <td height="25">2、修改后重启apache/iis方能生效。</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
	echo"</body></html>";
	exit();
}
?>
<table width="776" height="100%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td height="56" colspan="2" background="images/topbg.gif"> 
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="80%"><div align="center"><img src="images/installsay.gif" width="500" height="50"></div></td>
            <td width="20%" valign="bottom"><font color="#FFFFFF">最后更新: <?=EmpireDown_LASTTIME?></font></td>
          </tr>
        </table>
        
      </div></td>
  </tr>
  <tr> 
    <td width="21%" rowspan="3" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="center"><a href="http://www.phome.net" target="_blank"><img src="images/logo.gif" width="170" height="72" border="0"></a></div></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="left"><strong><font color="#FFFFFF">版权信息</font></strong></div></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="34%" height="25">软件名称</td>
          <td width="66%" height="25">帝国下载系统</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">程序版本</td>
          <td height="25">Version 2.5</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">开发团队</td>
          <td height="25">帝国软件开发团队</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">公司名称</td>
          <td height="25">帝兴软件</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">官方网站</td>
          <td height="25"><a href="http://www.PHome.Net" target="_blank">www.PHome.Net</a></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong><font color="#FFFFFF">安装进程</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f1?>">阅读用户使用条款</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f2?>">检测运行环境</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f3?>">设置目录权限</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f4?>">配置数据库</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f5?>">初始化管理员账号</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?=$f6?>">安装完毕</font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td><div align="center"><strong><font color="#0000FF" size="3">开源下载系统第一品牌 
        - 帝国下载系统</font></strong></div></td>
  </tr>
  <tr> 
    <td valign="top"> 
    <?php
	//用户条款
	if($phome=="checkfj")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第二步：检测运行环境</font></strong></div></td>
          </tr>
          <tr> 
            <td height="250" bgcolor="#FFFFFF"> 
              <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="21"> <li>粗体字项目是必须支持的项目。</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="25%" height="23"> <div align="center"><strong>项目</strong></div></td>
                    <td width="30%"> <div align="center"><strong>帝国下载所需配置</strong></div></td>
                    <td width="30%"> <div align="center"><strong>当前服务器</strong></div></td>
                    <td width="15%"> <div align="center"><strong>测试结果</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">操作系统</div></td>
                    <td><div align="center">不限</div></td>
                    <td><div align="center"> 
                        <?=GetUseSys()?>
                      </div></td>
                    <td><div align="center">√</div></td>
                  </tr>
                  <?
					$phpr=GetPhpVer();
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP版本</strong></div></td>
                    <td><div align="center"><strong>4.2.3+<br>
                        </strong></div></td>
                    <td><div align="center"> <b> 
                        <?=$phpr['ver']?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?=$phpr['result']?>
                      </div></td>
                  </tr>
                  <?
  					$mysqlr=CanMysql();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>MYSQL支持</strong></div></td>
                    <td><div align="center"><strong>支持</strong></div></td>
                    <td><div align="center"> <b> 
                        <?=$mysqlr['can']?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?=$mysqlr['result']?>
                      </div></td>
                  </tr>
                  <?
 					//$phpsafer=GetPhpSafemod();
  					?>
                  <?
  					//$gdr=GetGd();
  					?>
                  <?
  					//$cjr=GetCj();
  					?>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit523" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="下一步" onclick="self.location.href='index.php?phome=path&f=3';">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//设置目录权限
	elseif($phome=="path")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第三步：设置目录权限</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"><li><font color="#FF0000">如果您的服务器使用 
                              Windows 操作系统，可跳过这一步。</font></li></td>
                        </tr>
                        <tr> 
                          <td height="25"> <li>将下面目录权限设为0777, 是目录全部要把权限应用于子目录与文件。 
                            </li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="34%" height="23"> <div align="center"><strong>目录文件名称</strong></div></td>
                    <td width="42%"> <div align="center"><strong>说明</strong></div></td>
                    <td width="24%"> <div align="center"><strong>权限检查</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/index.html</div></td>
                    <td> <div align="center"><font color="#666666">首页</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../index.html");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/admin/ebak/bdata</td>
                    <td> <div align="center"><font color="#666666">备份数据存放目录</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../admin/ebak/bdata");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/admin/ebak/zip</td>
                    <td> <div align="center"><font color="#666666">备份数据压缩存放目录</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../admin/ebak/zip");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/class/user.php</div></td>
                    <td> <div align="center"><font color="#666666">会员配置文件</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../class/user.php");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/data</div></td>
                    <td> <div align="center"><font color="#666666">部分配置文件与附件存放目录</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../data","../data/tmp");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/iframe</div></td>
                    <td> <div align="center"><font color="#666666">登陆状态显示</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../iframe","../iframe/index.php");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/install</td>
                    <td> <div align="center"><font color="#666666">安装目录</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../install");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/list</td>
                    <td><div align="center"><font color="#666666">列表页生成目录</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../list");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/view</td>
                    <td><div align="center"><font color="#666666">内容页生成目录</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../view");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/page</td>
                    <td> <div align="center"><font color="#666666">单页生成目录</font></div></td>
                    <td> <div align="center"> 
                        <?=CheckFileMod("../page");?>
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/search</td>
                    <td><div align="center"><font color="#666666">搜索目录</font></div></td>
                    <td><div align="center"> 
                        <?=CheckFileMod("../search","../search/result/index.php");?>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <script>
			  function CheckNext()
			  {
			  var ok;
			  //ok=confirm("确认有应用于子目录?");
			  ok=true;
			  if(ok)
			  {
			  self.location.href='index.php?phome=setdb&f=4';
			  }
			  }
			  </script>
                <input type="button" name="Submit523" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit72" value="刷新权限状态" onclick="javascript:self.location.href='index.php?phome=path&f=3';">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="下一步" onclick="javascript:CheckNext();">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//设置配置数据库
	elseif($phome=="setdb")
	{
		$mycookievarpre=strtolower(InstallMakePassword(5));
	?>
      <script>
		  function CheckSubmit()
		  {
		  	var ok;
			ok=confirm("确认要进入下一步?");
			if(ok)
			{
		  		document.form1.Submit6223.disabled=true;
				return true;
			}
			return false;
		  }
		  </script> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=setdb&ok=1&f=5" onsubmit="document.form1.Submit6223.disabled=true;">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第四步：配置数据库</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="23"> <li>请在下面填写您的数据库账号信息, 通常情况下不需要修改绿色选项内容。</li></td>
                        </tr>
                        <tr> 
                          <td height="23"> <li>带*项为不能为空。</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="21%" height="23"> <div align="center"><strong>设置选项</strong></div></td>
                    <td width="36%"><div align="center"><strong>当前值</strong></div></td>
                    <td width="43%"><div align="center"><strong>注释</strong></div></td>
                  </tr>
                  <?
					$getmysqlver=@mysql_get_server_info();
					$selectmysqlver=$getmysqlver;
					if(empty($selectmysqlver))
					{
						$selectmysqlver='5.0';
					}
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">MYSQL版本:</td>
                    <td><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="22"><input type="radio" name="mydbver" value="auto" checked>
                            自动识别</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.0">
                            MYSQL 4.0.*/3.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.1">
                            MYSQL 4.1.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="5.0">
                            MYSQL 5.*</td>
                        </tr>
                      </table></td>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td>系统检测到的版本号: <b> <u> 
                            <?=$getmysqlver?$getmysqlver:''?>
                            </u> </b></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td width="21%" height="25"><font color="#009900">数据库服务器(*):</font></td>
                    <td width="36%"> <input name="mydbhost" type="text" id="mydbhost" value="localhost" size="30"></td>
                    <td width="43%"><font color="#666666">数据库服务器地址, 一般为 localhost</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">数据库服务器端口:</font></td>
                    <td> <input name="mydbport" type="text" id="mydbport" size="30"> 
                    </td>
                    <td><font color="#666666">MYSQL端口,空为默认端口, 一般为空</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">数据库用户名:</td>
                    <td> <input name="mydbusername" type="text" id="mydbusername" value="username" size="30"></td>
                    <td><font color="#666666">MYSQL数据库链接账号</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">数据库密码:</td>
                    <td> <input name="mydbpassword" type="password" id="mydbpassword" size="30"></td>
                    <td><font color="#666666">MYSQL数据库链接密码</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">数据库名(*):</td>
                    <td> <input name="mydbname" type="text" id="mydbname" value="empiredown" size="30"> 
                    </td>
                    <td><font color="#666666">数据库名称</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">表名前缀(*):</font></td>
                    <td><input name="mydbtbpre" type="text" id="mydbtbpre" value="e_" size="30" onClick="javascript:alert('安装向导提示:\n\n除非您需要在同一数据库安装多个 帝国下载 \n系统,否则,强烈建议您不要修改表名前缀。');"></td>
                    <td><font color="#666666">同一数据库安装多个帝国时可改变默认</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">COOKIE前缀(*):</td>
                    <td><input name="mycookievarpre" type="text" id="mycookievarpre" value="<?=$mycookievarpre?>" size="30"></td>
                    <td><font color="#666666">由<strong>英文字母</strong>组成</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">内置初始数据:</td>
                    <td><input name="defaultdata" type="checkbox" id="defaultdata" value="1">
                      是</td>
                    <td><font color="#666666">测试软件时选择</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5223" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit6223" value="下一步">
                <input name="mydbtype" type="hidden" id="mydbtype" value="mysql">
                <input name="mydbchar" type="hidden" id="mydbchar" value="<?=$dbchar?>">
                <input name="mysetchar" type="hidden" id="mysetchar" value="<?=$setchar?>">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//初使化管理员
	elseif($phome=="firstadmin")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=firstadmin&ok=1&f=6" onsubmit="document.form1.Submit62222.disabled=true">
          <input type="hidden" name="defaultdata" value="<?=$_GET['defaultdata']?>">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第五步：初始化管理员账号</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"> <li>请在下面填写您要设置的管理员账号信息。</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23" colspan="3"><strong>初始化管理员账号</strong></td>
                  </tr>
                  <tr> 
                    <td width="21%" height="25" bgcolor="#FFFFFF">用户名:</td>
                    <td width="36%" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="30"> 
                    </td>
                    <td width="43%" bgcolor="#FFFFFF"><font color="#666666">管理员用户名</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF">密码:</td>
                    <td bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">管理员账号密码</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"> <p>重复密码:</p></td>
                    <td bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">重复账号密码</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit52223" value="上一步" onclick="javascript:history.go(-2);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit62222" value="下一步">
              </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//安装完毕
	elseif($phome=="success")
	{
		//锁定安装程序
		$fp=@fopen("install.off","w");
		@fclose($fp);
		$word='恭喜您！您已成功安装帝国下载系统．<br>请继续安装说明第5步操作(看安装说明).';
		if($_GET['defaultdata'])
		{
			$word='恭喜您！您已成功安装帝国下载系统．<br>请继续安装说明第5步操作(看安装说明).';
		}
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?phome=setdb&ok=1&f=7">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第六步：安装完毕</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100"> <div align="center"> 
                <table width="92%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"> 
                        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                          <tr> 
                            <td height="42"> <div align="center"><font color="#FF0000"> 
                                <?=$word?>
                                </font></div></td>
                          </tr>
                          <tr> 
                            <td height="30"> <div align="center">(友情提示：请马上删除/install目录，以避免被再次安装.)</div></td>
                          </tr>
                          <tr> 
                            <td height="42"> <div align="center"> 
                                <input type="button" name="Submit82" value="进入后台控制面板" onclick="javascript:self.location.href='../admin/index.php'">
                              </div></td>
                          </tr>
                          <tr> 
                            <td height="25"> <div align="center"></div></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> </div></td>
          </tr>
        </form>
      </table>
      <?
	}
	//条款
	else
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第一步：帝国下载系统用户许可协议</font></strong></div></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" height="350" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td><div align="center"> 
                        <IFRAME frameBorder=0 name=xy scrolling=auto src="data/xieyi.html" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5" value="我不同意" onclick="window.close();">
				                &nbsp;&nbsp; 
				<input type="button" name="Submit6" value="我同意" onclick="javascript:self.location.href='index.php?phome=checkfj&f=2';">
              </div></td>
          </tr>
        </form>
      </table>
      <?
		}
		?>
    </td>
  </tr>
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><hr align="center"></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><a href="http://www.PHome.Net" target="_blank">官方网站</a>&nbsp; 
              | &nbsp;<a href="http://bbs.PHome.Net" target="_blank">官方技术论坛</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/OpenSource/" target="_blank">帝国CMS开源下载</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/ebak2008os/" target="_blank">帝国备份王开源下载</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/service/about.html" target="_blank">关于帝国</a></div></td>
        </tr>
        <tr> 
          <td height="36"> <div align="center">漳州市芗城帝兴软件开发有限公司 版权所有<BR>
              <font face="Arial, Helvetica, sans-serif">Copyright &copy; 2002 
              - 2009 <b><a href="http://www.PHome.net"><font color="#000000">PHome</font><font color="#FF6600">.Net</font></a></b></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
