<?php
if(!defined('InEmpireDown'))
{
	exit();
}
?>
<form name="add" method="post" action="infophome.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�������� 
        <input type=hidden name=softid value="<?=$softid?>"> <input type=hidden name=phome value="<?=$phome?>"> 
        <input type=hidden name=bclassid value="<?=$bclassid?>"> <input type=hidden name=classid value="<?=$classid?>"> 
        <input type=hidden name=tranpic value="<?=$r[tranpic]?>"> <input type=hidden name=tranimg value="<?=$r[tranimg]?>">
        <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"> </td>
    </tr>
    <tr> 
      <td width="22%" height="25" bgcolor="#FFFFFF">������ƣ�(*)</td>
      <td width="78%" height="25" bgcolor="#FFFFFF"> <input name="softname" type="text" id="softname" value="<?=$r[softname]?>" size="40">
        �汾: 
        <input name="soft_version" type="text" id="soft_version" value="<?=$r[soft_version]?>" size="15"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ԣ�</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="isgood" type="checkbox" id="isgood" value="1"<?=$r[isgood]==1?' checked':''?>>
        �Ƽ� 
        <input name="checked" type="checkbox" id="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        ͨ����� ���ö����� 
        <select name="istop">
          <option value="0"<?=$r[istop]==0?' selected':''?>>0���ö�</option>
          <option value="1"<?=$r[istop]==1?' selected':''?>>1���ö�</option>
          <option value="2"<?=$r[istop]==2?' selected':''?>>2���ö�</option>
          <option value="3"<?=$r[istop]==3?' selected':''?>>3���ö�</option>
          <option value="4"<?=$r[istop]==4?' selected':''?>>4���ö�</option>
          <option value="5"<?=$r[istop]==5?' selected':''?>>5���ö�</option>
          <option value="6"<?=$r[istop]==6?' selected':''?>>6���ö�</option>
        </select>
        ����ĸ��
        <select name="zm" id="zm">
          <option value="">�Զ�ʶ��</option>
		  <?=$zms?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ؼ��֣�</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="keyboard" type="text" id="keyboard" value="<?=$r[keyboard]?>" size="45"> 
        <font color="#666666">(�������&quot;,&quot;��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">Ԥ��ͼ��</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="softpic" type="text" id="softpic" value="<?=$r[softpic]?>" size="45"> 
        <font color="#666666">(��û�У�������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF">�ϴ�ͼƬ�� 
        <input type="file" name="file"> <font color="#666666">(��ֱ�ӵ�ַ����)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ߣ�</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="writer" type="text" id="writer" value="<?=$r[writer]?>" size="45"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ٷ���վ��</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="homepage" type="text" id="homepage" value="<?=$r[homepage]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʾ��ַ��</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="demo" type="text" id="demo" value="<?=$r[demo]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���л�����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="soft_fj" type="text" id="soft_fj" value="<?=$r[soft_fj]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> 
        <?=$fj_check?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������ԣ�</td>
      <td height="25" bgcolor="#FFFFFF"> �������ԣ� 
        <select name="language" id="language">
          <?=$l_options?>
        </select>
        ������ͣ� 
        <select name="softtype" id="select5">
          <?=$t_options?>
        </select>
        ��Ȩ��ʽ�� 
        <select name="soft_sq" id="select6">
          <?=$s_options?>
        </select>
        ����ȼ��� 
        <select name="star" id="select7">
          <option value="1"<?=$r[star]==1?' selected':''?>>һ��</option>
          <option value="2"<?=$r[star]==2?' selected':''?>>����</option>
          <option value="3"<?=$r[star]==3?' selected':''?>>���� </option>
          <option value="4"<?=$r[star]==4?' selected':''?>>����</option>
          <option value="5"<?=$r[star]==5?' selected':''?>>����</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ļ���</td>
      <td height="25" bgcolor="#FFFFFF"> �ļ�����: 
        <input name="filetype" type="text" id="filetype" value="<?=$r[filetype]?>" size="6"> 
        <select name="select2" onchange="document.add.filetype.value=this.value">
          <option value="">����</option>
          <option value=".zip">.zip</option>
          <option value=".rar">.rar</option>
          <option value=".exe">.exe</option>
        </select>
        �ļ���С: 
        <input name="filesize" type="text" id="filesize2" value="<?=$r[filesize]?>" size="10"> 
        <select name="select" onchange="document.add.filesize.value+=this.value">
          <option value="">��λ</option>
          <option value=" MB">MB</option>
          <option value=" KB">KB</option>
          <option value=" GB">GB</option>
          <option value=" BYTES">BYTES</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����û�����</td>
      <td height="25" bgcolor="#FFFFFF"><select name="foruser" id="select4">
          <option value="0">�ο�</option>
          <?=$sgroup?>
        </select> <input name="doforuser" type="checkbox" id="doforuser" value="1">
        Ӧ����ÿ�����ص�ַ(������������)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�������������</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downfen" type="text" id="downfen" value="<?=$r[downfen]?>" size="6">
        �� 
        <input name="dodownfen" type="checkbox" id="dodownfen" value="1">
        Ӧ����ÿ�����ص�ַ(������������)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ص�ַǰ׺��</td>
      <td height="25" bgcolor="#FFFFFF"><select name="cdownurl" id="cdownurl" onchange="document.add.downurl.value=this.value">
          <option>--</option>
          <?=$durl?>
        </select> <input name="downurl" type="text" id="downurl" size="60"> </td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"> <p><strong>���ص�ַ��</strong></p></td>
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="5%"> <div align="center">���</div></td>
                  <td width="18%"><div align="left">��������</div></td>
                  <td width="50%">���ص�ַ 
                    <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>"> 
                  </td>
                  <td width="16%"> <div align="center">Ȩ��</div></td>
                  <td width="11%"> <div align="center">����</div></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td> 
              <?
			if($phome=="EditSoft")
			{
				echo"$allpath";
			}
			else
			{
				?>
              <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <?
				for($si=1;$si<=$showdnum;$si++)
				{
				?>
                <tr> 
                  <td width="5%"> <div align="center">
                      <?=$si?>
                    </div></td>
                  <td width="18%"> <div align="left"> 
                      <input name="downname[]" type="text" id="downname[]" value="���ص�ַ<?=$si?>" size="16">
                    </div></td>
                  <td width="50%"><select name=thedownqz[]><option value=''>--ǰ׺--</option><?=$newdurl?></select><input name="downpath[]" type="text" size="30" id=downpath<?=$si?>><a href='#edown' onclick=SpOpenChFile(0,'downpath<?=$si?>')>�ϴ�</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'downpath<?=$si?>')>ѡ��</a> 
                  </td>
                  <td width="16%"><div align="center"> 
                      <select name="downuser[]" id="select">
                        <option value="0">�ο�</option>
                        <?=$group?>
                      </select>
                    </div></td>
                  <td width="11%"> <div align="center"> 
                      <input name="fen[]" type="text" id="fen[]" value="0" size="6">
                    </div></td>
                </tr>
                <?
				}
				?>
              </table>
              <?
			}
			?>
            </td>
          </tr>
          <tr> 
            <td height="25">���ص�ַ��չ����: 
              <input name="downnum" type="text" id="downnum" value="1" size="6"> 
              <input type="button" name="Submit5" value="�����ַ" onclick="javascript:doadd();"></td>
          </tr>
          <tr> 
            <td id=adddown></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"><strong>������ܣ�</strong><br> 
        <br>
        UBB����˵����<br>
        ���ӣ�[url]���ӵ�ַ[/url]<br>
        ͼƬ��[img]ͼƬ��ַ[/img]<br>
        FLASH��[flash]flash��ַ[/flash]<br>
        ���ּӴ֣�[b]����[/b]</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="softsay" cols="67" rows="12" style="WIDTH:100%"><?=$softsay?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"> <input name="showother" type="checkbox" id="showother" value="1" onclick="if(this.checked){document.getElementById('showotherinfo').style.display='';}else{document.getElementById('showotherinfo').style.display='none';}">
        ������Ϣ</td>
    </tr>
    <tbody id="showotherinfo" style="display:none"> 
      <tr> 
        <td height="25" bgcolor="#FFFFFF">����ͳ��(��/��/��/��)��</td>
        <td height="25" bgcolor="#FFFFFF"><input name="count_all" type="text" id="count_all" value="<?=$r[count_all]?>" size="6">
          / 
          <input name="count_month" type="text" id="count_month" value="<?=$r[count_month]?>" size="6">
          / 
          <input name="count_week" type="text" id="count_week" value="<?=$r[count_week]?>" size="6">
          / 
          <input name="count_day" type="text" id="count_day" value="<?=$r[count_day]?>" size="6"></td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">�ⲿ���ӣ�</td>
        <td height="25" bgcolor="#FFFFFF"><input name="titleurl" type="text" id="titleurl" value="<?=$r[titleurl]?>" size="45">
          (��д�����ӵ�ַ���Ǵ�����)</td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">������ʽ��</td>
        <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td width="45%">���ԣ� 
                <input name="titlefont[b]" type="checkbox" id="titlefont[b]" value="b"<?=strstr($r[titlefont],'b|')?' checked':''?>>
                ���� 
                <input name="titlefont[i]" type="checkbox" id="titlefont[i]" value="i"<?=strstr($r[titlefont],'i|')?' checked':''?>>
                б�� 
                <input name="titlefont[s]" type="checkbox" id="titlefont[s]" value="s"<?=strstr($r[titlefont],'s|')?' checked':''?>>
                ɾ����</td>
              <td width="55%">��ɫ�� 
                <input name="titlecolor" type="text" id="titlecolor" value="<?=$r[titlecolor]?>" size="10"> 
                <a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">����ʱ�䣺</td>
        <td height="25" bgcolor="#FFFFFF"><input name="softtime" type="text" id="softtime" value="<?=$softtime?>"> 
        </td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">����ר�⣺</td>
        <td height="25" bgcolor="#FFFFFF"><select name="ztid" id="ztid">
		<option value="0">������ר��</option>
            <?=$zts?>
          </select></td>
      </tr>
      <tr>
        <td height="25" bgcolor="#FFFFFF">�Զ����ļ�����</td>
        <td height="25" bgcolor="#FFFFFF"><input name="filename" type="text" id="filename" value="<?=$r[filename]?>" size="45">
        </td>
      </tr>
    </tbody>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit2" value="�ύ"> 
        <input type="reset" name="Submit3" value="����"></td>
    </tr>
  </table>
</form>