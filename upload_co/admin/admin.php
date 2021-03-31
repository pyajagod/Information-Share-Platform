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
?>
    <HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
        <title>后台管理</title>
<!--        <base onmouseover="window.status='开源下载系统第一品牌 － 帝国下载系统';return true">-->
        <script language="javascript">
            if(self!=top)
            {
                parent.location.href='index.php';
            }

            function switchSysBar(){
                if (switchPoint.innerText==3){
                    switchPoint.innerText=4
                    document.all("frmTitle").style.display="none"
                }else{
                    switchPoint.innerText=3
                    document.all("frmTitle").style.display=""
                }}

            function ChangeMenuBg(doobj,dofont,mid){
                menusystem.style.backgroundColor='#FFFFFF';
                fontsystem.style.color='#000000';
                menulistdown.style.backgroundColor='#FFFFFF';
                fontlistdown.style.color='#000000';
                menuclass.style.backgroundColor='#FFFFFF';
                fontclass.style.color='#000000';
                menutemp.style.backgroundColor='#FFFFFF';
                fonttemp.style.color='#000000';
                menuuser.style.backgroundColor='#FFFFFF';
                fontuser.style.color='#000000';
                menuother.style.backgroundColor='#FFFFFF';
                fontother.style.color='#000000';
                doobj.style.backgroundColor='#8CBDEF';
                dofont.style.color='#ffffff';
                document.menuform.menuid.value=mid;
            }

            function JumpToLeftMenu(url){
                document.getElementById("edleft").src=url;
            }

            function JumpToMain(url){
                document.getElementById("edmain").src=url;
            }
        </SCRIPT>
        <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
    </HEAD>

    <BODY bgcolor="#8CBDEF" style="MARGIN:0px" scroll="no">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <form name="menuform">
            <input type="hidden" name="menuid" value="5">
            <tr>
                <td width="230" align="left">
                    <div align="left"><img src="../../staticPoj/imgs/log.jpg" width="180" height="65"></div></td>
                <td valign="bottom">
                    <table width="630" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="CURSOR: hand" align="center" id="menulistdown" onmouseout="if(document.menuform.menuid.value!=2){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=2){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menulistdown,fontlistdown,2);JumpToLeftMenu('left.php?phome=uploadvideo');">
                                <font id="fontlistdown"><strong>上传管理</strong></font>
                            </td>
                            <td  hidden="hidden" style="CURSOR: hand" height="30" id="menusystem" align="center" onmouseout="if(document.menuform.menuid.value!=1){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=1){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menusystem,fontsystem,1);JumpToLeftMenu('left.php?phome=system');">
                                <font id="fontsystem"><strong>总体设置</strong></font>
                            </td>
                            <td hidden="hidden" style="CURSOR: hand" id="menuclass" align="center" onmouseout="if(document.menuform.menuid.value!=3){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=3){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menuclass,fontclass,3);JumpToLeftMenu('left.php?phome=class');">
                                <font id="fontclass"><strong>分类管理</strong></font>
                            </td>
                            <td hidden="hidden" style="CURSOR: hand" id="menutemp" align="center" onmouseout="if(document.menuform.menuid.value!=4){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=4){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menutemp,fonttemp,4);JumpToLeftMenu('left.php?phome=temp');">
                                <strong><font id="fonttemp">模板管理</font></strong>
                            </td>
                            <td  style="CURSOR: hand" align="center" id="menuuser" onmouseout="if(document.menuform.menuid.value!=5){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=5){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menuuser,fontuser,5);JumpToLeftMenu('left.php?phome=user');">
                                <font id="fontuser"><strong>用户管理</strong></font>
                            </td>

                            <td hidden="hidden" style="CURSOR: hand" align="center" id="menuother" onmouseout="if(document.menuform.menuid.value!=6){this.style.backgroundColor='#ffffff';}" onmouseover="if(document.menuform.menuid.value!=6){this.style.backgroundColor='#EBF3FC';}" onclick="ChangeMenuBg(menuother,fontother,6);JumpToLeftMenu('left.php?phome=other');">
                                <font id="fontother"><strong>其他管理</strong></font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#8CBDEF">&nbsp;</td>
                <td bgcolor="#8CBDEF"><table width="700" border="0" align="right" cellpadding="1" cellspacing="3">
                        <tr>
                            <td><div align="center"><a href="EditPassword.php" target="edmain">修改密码</a></div></td>
                            <td><div align="center"><a href="main.php" target="edmain">后台首页</a></div></td>
                            <td><div align="center"><a href="../webPage/intro.php" target="_blank">网站首页</a></div></td>
                            <td><div align="center"><a href="adminphome.php?phome=exit" target="_parent" onclick="return confirm('确认要退出?');">退出</a></div></td>
                            <td width="12"><div align="center"></div></td>
                        </tr>
                    </table></td>
            </tr>
        </form>
    </table>
    <TABLE border="0" cellPadding="0" cellSpacing="0" height="86%" width="100%">
        <TBODY>
        <TR>
            <TD bgcolor="#FFFFFF" rowspan="2" align="middle" vAlign="center" noWrap id="frmTitle">
                <IFRAME frameBorder="0" id="edleft" name="edleft" scrolling="yes" src="left.php?phome=uploadvideo" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:230px;Z-INDEX:2"></IFRAME>
            </TD>
            <TD rowspan="2" bgColor="#8CBDEF">
                <TABLE border="0" cellPadding="0" cellSpacing="0" height="100%">
                    <TBODY>
                    <TR>
                        <TD onclick="switchSysBar()" style="HEIGHT:100%">
                            <font style="COLOR:#666666;CURSOR:hand;FONT-FAMILY:Webdings;FONT-SIZE:9pt;">
                                <SPAN id="switchPoint" title="打开/关闭左边导航栏">3</SPAN>
                            </font>
                        </TD>
                    </TR>
                    </TBODY>
                </TABLE>
            </TD>
            <TD bgcolor="#FFFFFF" style="WIDTH:100%">
                <table border="0" cellPadding="0" cellSpacing="0" height="100%" width="100%">
                    <tr height="97%">
                        <td> <IFRAME frameBorder="0" id="edmain" name="edmain" scrolling="yes" src="main.php" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:1"></IFRAME>
                        </td>
                    </tr>

                </table>
            </TD>
        </TR>
        </TBODY>
    </TABLE>
    <IFRAME frameBorder=0 id="dorepage" name="dorepage" scrolling="no" src="DoTimeRepage.php" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
    </BODY>
    </HTML>
<?php
db_close();
$empire=null;
?>