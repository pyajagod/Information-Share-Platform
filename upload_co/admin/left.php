<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$r=ReturnLeftLevel($lur[groupid]);
$movecolor=" onMouseOver=\"this.style.backgroundColor='#EFEFEF'\" onMouseOut=\"this.style.backgroundColor='#FFFFFF'\"";
//��������
$display="";
if($display=="")
{
    $addimg="../data/images/noadd.gif";
}
else
{
    $addimg="../data/images/add.gif";
}
$phome=$_GET['phome'];
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>�˵�</title>
    <SCRIPT lanuage="JScript">
        function DisplayImg(ss,imgname,phome)
        {
            if(imgname=="dbdataimg")
            {
                img=todisplay(dodbdata,phome);
                document.images.dbdataimg.src=img;
            }
            else if(imgname=="listdownimg")
            {
                img=todisplay(dolistdown,phome);
                document.images.listdownimg.src=img;
            }
            else if(imgname=="softtypeimg")
            {
                img=todisplay(dosofttype,phome);
                document.images.softtypeimg.src=img;
            }
            else if(imgname=="classimg")
            {
                img=todisplay(doclass,phome);
                document.images.classimg.src=img;
            }
            else if(imgname=="ztimg")
            {
                img=todisplay(dozt,phome);
                document.images.ztimg.src=img;
            }
            else if(imgname=="fileimg")
            {
                img=todisplay(dofile,phome);
                document.images.fileimg.src=img;
            }
            else if(imgname=="ggimg")
            {
                img=todisplay(dogg,phome);
                document.images.ggimg.src=img;
            }
            else if(imgname=="listtempimg")
            {
                img=todisplay(dolisttemp,phome);
                document.images.listtempimg.src=img;
            }
            else if(imgname=="softtempimg")
            {
                img=todisplay(dosofttemp,phome);
                document.images.softtempimg.src=img;
            }
            else if(imgname=="tempvarimg")
            {
                img=todisplay(dotempvar,phome);
                document.images.tempvarimg.src=img;
            }
            else if(imgname=="pubtempimg")
            {
                img=todisplay(dopubtemp,phome);
                document.images.pubtempimg.src=img;
            }
            else if(imgname=="userimg")
            {
                img=todisplay(douser,phome);
                document.images.userimg.src=img;
            }
            else if(imgname=="memberimg")
            {
                img=todisplay(domember,phome);
                document.images.memberimg.src=img;
            }
            else if(imgname=="cardimg")
            {
                img=todisplay(docard,phome);
                document.images.cardimg.src=img;
            }
            else if(imgname=="payimg")
            {
                img=todisplay(dopay,phome);
                document.images.payimg.src=img;
            }
            else if(imgname=="adimg")
            {
                img=todisplay(doad,phome);
                document.images.adimg.src=img;
            }
            else if(imgname=="linkimg")
            {
                img=todisplay(dolink,phome);
                document.images.linkimg.src=img;
            }
            else if(imgname=="voteimg")
            {
                img=todisplay(dovote,phome);
                document.images.voteimg.src=img;
            }
            else
            {
            }
        }
        function todisplay(ss,phome)
        {
            if(ss.style.display=="")
            {
                ss.style.display="none";
                theimg="../data/images/add.gif";
            }
            else
            {
                ss.style.display="";
                theimg="../data/images/noadd.gif";
            }
            return theimg;
        }
        function turnit(ss,img)
        {
            DisplayImg(ss,img,0);
        }
    </SCRIPT>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0">
<br>
<?php
if($phome=='system')
{
    ?>
    <?php
    if($r['dopublic'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dopublicid">
            <tr>
                <td height="25" class="header"><img src="../data/images/noadd.gif" width="20" height="9" border="0"><a href="public.php" target="edmain">��������</a></td>
            </tr>
        </table>
        <br>
        <?php
    }
    if($r['dochangedata'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dochangedataid">
            <tr>
                <td height="25" class="header"><img src="../data/images/noadd.gif" width="20" height="9" border="0"><a href="ChangeData.php" target="edmain">���ݸ��¹���</a></td>
            </tr>
        </table>
        <br>
        <?php
    }
    if($r['dodbdata'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dodbdataid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="dbdataimg"><a href="#edown" onMouseUp=turnit(dodbdata,"dbdataimg"); style="CURSOR: hand">������ָ�����</a></td>
            </tr>
            <tbody id="dodbdata"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ebak/ChangeDb.php" target="edmain">��������</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ebak/ReData.php" target="edmain">�ָ�����</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ebak/ChangePath.php" target="edmain">����Ŀ¼����</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    ?>
    <?php
}
elseif($phome=='class')
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dolistdownid">
        <tr>
            <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="listdownimg"><a href="#edown" onMouseUp=turnit(dolistdown,"listdownimg"); style="CURSOR: hand">������ع���</a></td>
        </tr>
        <tbody id="dolistdown"<?=$display?>>
        <?php
        if($r['doerror'])
        {
            ?>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListError.php" target="edmain">������󱨸�</a></td>
            </tr>
            <?php
        }
        if($r['dopl'])
        {
            ?>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListAllPl.php" target="edmain">��������</a></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListAllSoft.php?sear=1&showspecial=3" target="edmain">�������</a></td>
        </tr>
        </tbody>
    </table>
    <br>
    <?php
    if($r['doclass'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="doclassid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="classimg"><a href="#edown" onMouseUp=turnit(doclass,"classimg"); style="CURSOR: hand">�������</a></td>
            </tr>
            <tbody id="doclass"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddClass.php?phome=AddClass" target="edmain">���ӷ���</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListClass.php" target="edmain">�������</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dozt'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="doztid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="ztimg"><a href="#edown" onMouseUp=turnit(dozt,"ztimg"); style="CURSOR: hand">ר�����</a></td>
            </tr>
            <tbody id="dozt"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddZt.php?phome=AddZt" target="edmain">����ר��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListZt.php" target="edmain">����ר��</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r[dolanguage]||$r[dosofttype]||$r[dosq]||$r[dofj]||$r[dodownurl]||$r[doplayer]||$r[dorepip])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dosofttypeid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="softtypeimg"><a href="#edown" onMouseUp=turnit(dosofttype,"softtypeimg"); style="CURSOR: hand">�������Թ���</a></td>
            </tr>
            <tbody id="dosofttype"<?=$display?>>
            <?php
            if($r['dolanguage'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="language.php" target="edmain">�����������</a></td>
                </tr>
                <?php
            }
            if($r['dosofttype'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="softtype.php" target="edmain">�����������</a></td>
                </tr>
                <?php
            }
            if($r['dosq'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="sq.php" target="edmain">���������Ȩ</a></td>
                </tr>
                <?php
            }
            if($r['dofj'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="fj.php" target="edmain">�����������</a></td>
                </tr>
                <?php
            }
            if($r['dodownurl'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="url.php" target="edmain">�����ַǰ׺</a></td>
                </tr>
                <?php
            }
            if($r['doplayer'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="player.php" target="edmain">��������</a></td>
                </tr>
                <?php
            }
            if($r['dorepip'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="RepIp.php" target="edmain">�����滻��ַ</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dofile'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dofileid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="fileimg"><a href="#edown" onMouseUp=turnit(dofile,"fileimg"); style="CURSOR: hand">��������</a></td>
            </tr>
            <tbody id="dofile"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListFile.php" target="edmain">���ݿ�ʽ����</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListFilePath.php" target="edmain">Ŀ¼ʽ����</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dogg']||$r['douserlist'])
    {
        ?>

        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="doggid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="ggimg"><a href="#edown" onMouseUp=turnit(dogg,"ggimg"); style="CURSOR: hand">��������</a></td>
            </tr>
            <tbody id="dogg"<?=$display?>>
            <?php
            if($r['dogg'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListGg.php" target="edmain">������</a></td>
                </tr>
                <?php
            }
            if($r['douserlist'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListUserlist.php" target="edmain">�Զ����б�</a></td>
                </tr>
                <?php
            }
            if($r['douserpage'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListPage.php" target="edmain">�Զ���ҳ��</a></td>
                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
        <br>
        <?php
    }
    ?>
    <?php
}
elseif($phome=='temp')
{
    if($r['dotemplate'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dochangedataid">
            <tr>

                <td height="25" class="header"><img src="../data/images/noadd.gif" width="20" height="9" border="0"><a href="TempGroup.php" target="edmain">����/����ģ��</a></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dotempvarid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="tempvarimg"><a href="#edown" onMouseUp=turnit(dotempvar,"tempvarimg"); style="CURSOR: hand">ģ���������</a></td>
            </tr>
            <tbody id="dotempvar"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddTempvar.php?phome=AddTempvar" target="edmain">����ģ�����</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListTempvar.php" target="edmain">����ģ�����</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dolisttempid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="listtempimg"><a href="#edown" onMouseUp=turnit(dolisttemp,"listtempimg"); style="CURSOR: hand">�б�ģ�����</a></td>
            </tr>
            <tbody id="dolisttemp"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=AddListtemp.php?phome=AddListtemp target=edmain>�����б�ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListListtemp.php target=edmain>�����б�ģ��</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dosofttempid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="softempimg"><a href="#edown" onMouseUp=turnit(dosofttemp,"softtempimg"); style="CURSOR: hand">����ģ�����</a></td>
            </tr>
            <tbody id="dosofttemp"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=AddSofttemp.php?phome=AddSofttemp target=edmain>��������ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListSofttemp.php target=edmain>��������ģ��</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dopubtempid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="pubtempimg"><a href="#edown" onMouseUp=turnit(dopubtemp,"pubtempimg"); style="CURSOR: hand">����ģ��</a></td>
            </tr>
            <tbody id="dopubtemp"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=indextemp target=edmain>�޸���ҳģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=softclasstemp target=edmain>�޸ķ��ർ��ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=searchtemp target=edmain>�޸�����ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=searchformtemp target=edmain>�޸�������ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=ggtemp target=edmain>�޸Ĺ����б�ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=cptemp target=edmain>�޸Ŀ������ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=classjstemp target=edmain>�޸�����JSģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=navtemp target=edmain>�޸ķ��ർ��JSģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=otherlinktemp target=edmain>�޸��������ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=ggjstemp target=edmain>�޸Ĺ���JSģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=searchjstemp1 target=edmain>�޸ĺ�������JSģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=searchjstemp2 target=edmain>�޸���������JSģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=votetemp target=edmain>�޸�ͶƱģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=downsofttemp target=edmain>�޸����ص�ַģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=onlinesofttemp target=edmain>�޸����ߵ�ַģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=listpagetemp target=edmain>�޸��б��ҳģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=loginiframe target=edmain>�޸Ŀ�ܵ�½״̬ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=loginjstemp target=edmain>�޸�JS��½״̬ģ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListTemplate.php?tname=downpagetemp target=edmain>�޸���������ҳģ��</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
}
elseif($phome=='user')
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="douserid">
        <tr>
            <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="userimg"><a href="#edown" onMouseUp=turnit(douser,"userimg"); style="CURSOR: hand">����Ա����</a></td>
        </tr>
        <tbody id="douser"<?=$display?>>
        <tr>
            <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="EditPassword.php" target="edmain">�޸�����</a></td>
        </tr>
        <?php
        if($r['douser'])
        {
            ?>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListUser.php target=edmain>�����û�</a></td>
            </tr>
            <?php
        }
        if($r['dogroup'])
        {
            ?>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListGroup.php target=edmain>�����û���</a></td>
            </tr>
            <?php
        }
        if($r['dolog'])
        {
            ?>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListLog.php target=edmain>�����½��־</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <br>
    <?php
    if($r['domember']||$r['docard'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="domemberid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="memberimg"><a href="#edown" onMouseUp=turnit(domember,"memberimg"); style="CURSOR: hand">��Ա����</a></td>
            </tr>
            <tbody id="domember"<?=$display?>>
            <?php
            if($r['domember'])
            {
                ?>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListMember.php target=edmain>�����Ա</a></td>
                </tr>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListMemberGroup.php target=edmain>�����Ա��</a></td>
                </tr>
                <?php
            }
            if($r['docard'])
            {
                ?>
                <tr>
                    <td height="24" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=GetDown.php target=edmain>�������͵���</a></td>
                </tr>
                <tr>
                    <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=DelDownRecord.php target=edmain>ɾ�����ر���</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['docard'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="docardid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="cardimg"><a href="#edown" onMouseUp=turnit(docard,"cardimg"); style="CURSOR: hand">�㿨����</a></td>
            </tr>
            <tbody id="docard"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=AddCard.php?phome=AddCard target=edmain>���ӵ㿨</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=AddMoreCard.php target=edmain>�������ӵ㿨</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListCard.php target=edmain>����㿨</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dopay']||$r['dobuygroup'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dopayid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="payimg"><a href="#edown" onMouseUp=turnit(dopay,"payimg"); style="CURSOR: hand">����֧��</a></td>
            </tr>
            <tbody id="dopay"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListBuyGroup.php" target=edmain>�����ֵ����</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="pay/PayApi.php" target=edmain>����֧���ӿ�</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="pay/ListPayRecord.php" target=edmain>����֧����¼</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
}
elseif($phome=='other')
{
    if($r['doad'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="doadid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="adimg"><a href="#edown" onMouseUp=turnit(doad,"adimg"); style="CURSOR: hand">������</a></td>
            </tr>
            <tbody id="doad"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AdClass.php" target="edmain">���������</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddAd.php?phome=AddAd" target="edmain">���ӹ��</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListAd.php" target="edmain">������</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListAd.php?time=1" target="edmain">������ڹ��</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dolink'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dolinkid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="linkimg"><a href="#edown" onMouseUp=turnit(dolink,"linkimg"); style="CURSOR: hand">�������ӹ���</a></td>
            </tr>
            <tbody id="dolink"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=AddLink.php?phome=AddLink target=edmain>������������</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=ListLink.php target=edmain>������������</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
    if($r['dovote'])
    {
        ?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="dovoteid">
            <tr>
                <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="listdownimg"><a href="#edown" onMouseUp=turnit(dovote,"voteimg"); style="CURSOR: hand">ͶƱ����</a></td>
            </tr>
            <tbody id="dovote"<?=$display?>>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddVote.php?phome=AddVote" target="edmain">����ͶƱ</a></td>
            </tr>
            <tr>
                <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListVote.php" target="edmain">����ͶƱ</a></td>
            </tr>
            </tbody>
        </table>
        <br>
        <?php
    }
}
elseif($phome=='uploadvideo')
{
    ?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder" id="douserid">
        <tr>
            <td height="25" class="header"><img src="<?=$addimg?>" width="20" height="9" name="userimg"><a href="#edown" onMouseUp=turnit(douser,"userimg"); style="CURSOR: hand">�ϴ�����</a></td>
        </tr>
        <tbody id="douser"<?=$display?>>
        <tr>
            <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="uploadvideo.php" target="edmain">�ϴ���Ƶ</a></td>

        <tr>
            <td height="25" bgcolor="#FFFFFF"<?=$movecolor?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="ListVideo.php" target="edmain">������Ƶ</a></td>
        </tr>
        </tbody>
    </table>
    <?php
}
?>
</body>
</html>