<?php
if(!defined('InEmpireDown'))
{
	exit();
}
?>
<form name="add" method="post" action="infophome.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加下载 
        <input type=hidden name=softid value="<?=$softid?>"> <input type=hidden name=phome value="<?=$phome?>"> 
        <input type=hidden name=bclassid value="<?=$bclassid?>"> <input type=hidden name=classid value="<?=$classid?>"> 
        <input type=hidden name=tranpic value="<?=$r[tranpic]?>"> <input type=hidden name=tranimg value="<?=$r[tranimg]?>">
        <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"> </td>
    </tr>
    <tr> 
      <td width="22%" height="25" bgcolor="#FFFFFF">软件名称：(*)</td>
      <td width="78%" height="25" bgcolor="#FFFFFF"> <input name="softname" type="text" id="softname" value="<?=$r[softname]?>" size="40">
        版本: 
        <input name="soft_version" type="text" id="soft_version" value="<?=$r[soft_version]?>" size="15"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">属性：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="isgood" type="checkbox" id="isgood" value="1"<?=$r[isgood]==1?' checked':''?>>
        推荐 
        <input name="checked" type="checkbox" id="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        通过审核 ，置顶级别： 
        <select name="istop">
          <option value="0"<?=$r[istop]==0?' selected':''?>>0级置顶</option>
          <option value="1"<?=$r[istop]==1?' selected':''?>>1级置顶</option>
          <option value="2"<?=$r[istop]==2?' selected':''?>>2级置顶</option>
          <option value="3"<?=$r[istop]==3?' selected':''?>>3级置顶</option>
          <option value="4"<?=$r[istop]==4?' selected':''?>>4级置顶</option>
          <option value="5"<?=$r[istop]==5?' selected':''?>>5级置顶</option>
          <option value="6"<?=$r[istop]==6?' selected':''?>>6级置顶</option>
        </select>
        ，字母：
        <select name="zm" id="zm">
          <option value="">自动识别</option>
		  <?=$zms?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">关键字：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="keyboard" type="text" id="keyboard" value="<?=$r[keyboard]?>" size="45"> 
        <font color="#666666">(多个请用&quot;,&quot;格开)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">预览图：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="softpic" type="text" id="softpic" value="<?=$r[softpic]?>" size="45"> 
        <font color="#666666">(如没有，请留空)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF">上传图片： 
        <input type="file" name="file"> <font color="#666666">(比直接地址优先)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">作者：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="writer" type="text" id="writer" value="<?=$r[writer]?>" size="45"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">官方网站：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="homepage" type="text" id="homepage" value="<?=$r[homepage]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">演示地址：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="demo" type="text" id="demo" value="<?=$r[demo]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">运行环境：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="soft_fj" type="text" id="soft_fj" value="<?=$r[soft_fj]?>" size="45"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> 
        <?=$fj_check?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">软件属性：</td>
      <td height="25" bgcolor="#FFFFFF"> 界面语言： 
        <select name="language" id="language">
          <?=$l_options?>
        </select>
        软件类型： 
        <select name="softtype" id="select5">
          <?=$t_options?>
        </select>
        授权形式： 
        <select name="soft_sq" id="select6">
          <?=$s_options?>
        </select>
        软件等级： 
        <select name="star" id="select7">
          <option value="1"<?=$r[star]==1?' selected':''?>>一星</option>
          <option value="2"<?=$r[star]==2?' selected':''?>>二星</option>
          <option value="3"<?=$r[star]==3?' selected':''?>>三星 </option>
          <option value="4"<?=$r[star]==4?' selected':''?>>四星</option>
          <option value="5"<?=$r[star]==5?' selected':''?>>五星</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件：</td>
      <td height="25" bgcolor="#FFFFFF"> 文件类型: 
        <input name="filetype" type="text" id="filetype" value="<?=$r[filetype]?>" size="6"> 
        <select name="select2" onchange="document.add.filetype.value=this.value">
          <option value="">类型</option>
          <option value=".zip">.zip</option>
          <option value=".rar">.rar</option>
          <option value=".exe">.exe</option>
        </select>
        文件大小: 
        <input name="filesize" type="text" id="filesize2" value="<?=$r[filesize]?>" size="10"> 
        <select name="select" onchange="document.add.filesize.value+=this.value">
          <option value="">单位</option>
          <option value=" MB">MB</option>
          <option value=" KB">KB</option>
          <option value=" GB">GB</option>
          <option value=" BYTES">BYTES</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">面向用户级别：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="foruser" id="select4">
          <option value="0">游客</option>
          <?=$sgroup?>
        </select> <input name="doforuser" type="checkbox" id="doforuser" value="1">
        应用于每个下载地址(方便批量操作)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">下载所需点数：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="downfen" type="text" id="downfen" value="<?=$r[downfen]?>" size="6">
        点 
        <input name="dodownfen" type="checkbox" id="dodownfen" value="1">
        应用于每个下载地址(方便批量操作)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">下载地址前缀：</td>
      <td height="25" bgcolor="#FFFFFF"><select name="cdownurl" id="cdownurl" onchange="document.add.downurl.value=this.value">
          <option>--</option>
          <?=$durl?>
        </select> <input name="downurl" type="text" id="downurl" size="60"> </td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"> <p><strong>下载地址：</strong></p></td>
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
                <tr> 
                  <td width="5%"> <div align="center">编号</div></td>
                  <td width="18%"><div align="left">下载名称</div></td>
                  <td width="50%">下载地址 
                    <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>"> 
                  </td>
                  <td width="16%"> <div align="center">权限</div></td>
                  <td width="11%"> <div align="center">点数</div></td>
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
                      <input name="downname[]" type="text" id="downname[]" value="下载地址<?=$si?>" size="16">
                    </div></td>
                  <td width="50%"><select name=thedownqz[]><option value=''>--前缀--</option><?=$newdurl?></select><input name="downpath[]" type="text" size="30" id=downpath<?=$si?>><a href='#edown' onclick=SpOpenChFile(0,'downpath<?=$si?>')>上传</a> / <a href='#edown' onclick=SpOpenChFilePath(0,'downpath<?=$si?>')>选择</a> 
                  </td>
                  <td width="16%"><div align="center"> 
                      <select name="downuser[]" id="select">
                        <option value="0">游客</option>
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
            <td height="25">下载地址扩展数量: 
              <input name="downnum" type="text" id="downnum" value="1" size="6"> 
              <input type="button" name="Submit5" value="输出地址" onclick="javascript:doadd();"></td>
          </tr>
          <tr> 
            <td id=adddown></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"><strong>软件介绍：</strong><br> 
        <br>
        UBB代码说明：<br>
        链接：[url]链接地址[/url]<br>
        图片：[img]图片地址[/img]<br>
        FLASH：[flash]flash地址[/flash]<br>
        文字加粗：[b]文字[/b]</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="softsay" cols="67" rows="12" style="WIDTH:100%"><?=$softsay?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"> <input name="showother" type="checkbox" id="showother" value="1" onclick="if(this.checked){document.getElementById('showotherinfo').style.display='';}else{document.getElementById('showotherinfo').style.display='none';}">
        其他信息</td>
    </tr>
    <tbody id="showotherinfo" style="display:none"> 
      <tr> 
        <td height="25" bgcolor="#FFFFFF">下载统计(总/月/周/日)：</td>
        <td height="25" bgcolor="#FFFFFF"><input name="count_all" type="text" id="count_all" value="<?=$r[count_all]?>" size="6">
          / 
          <input name="count_month" type="text" id="count_month" value="<?=$r[count_month]?>" size="6">
          / 
          <input name="count_week" type="text" id="count_week" value="<?=$r[count_week]?>" size="6">
          / 
          <input name="count_day" type="text" id="count_day" value="<?=$r[count_day]?>" size="6"></td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">外部链接：</td>
        <td height="25" bgcolor="#FFFFFF"><input name="titleurl" type="text" id="titleurl" value="<?=$r[titleurl]?>" size="45">
          (填写后连接地址将是此链接)</td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">标题样式：</td>
        <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td width="45%">属性： 
                <input name="titlefont[b]" type="checkbox" id="titlefont[b]" value="b"<?=strstr($r[titlefont],'b|')?' checked':''?>>
                粗体 
                <input name="titlefont[i]" type="checkbox" id="titlefont[i]" value="i"<?=strstr($r[titlefont],'i|')?' checked':''?>>
                斜体 
                <input name="titlefont[s]" type="checkbox" id="titlefont[s]" value="s"<?=strstr($r[titlefont],'s|')?' checked':''?>>
                删除线</td>
              <td width="55%">颜色： 
                <input name="titlecolor" type="text" id="titlecolor" value="<?=$r[titlecolor]?>" size="10"> 
                <a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">发布时间：</td>
        <td height="25" bgcolor="#FFFFFF"><input name="softtime" type="text" id="softtime" value="<?=$softtime?>"> 
        </td>
      </tr>
      <tr> 
        <td height="25" bgcolor="#FFFFFF">所属专题：</td>
        <td height="25" bgcolor="#FFFFFF"><select name="ztid" id="ztid">
		<option value="0">不隶属专题</option>
            <?=$zts?>
          </select></td>
      </tr>
      <tr>
        <td height="25" bgcolor="#FFFFFF">自定义文件名：</td>
        <td height="25" bgcolor="#FFFFFF"><input name="filename" type="text" id="filename" value="<?=$r[filename]?>" size="45">
        </td>
      </tr>
    </tbody>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit2" value="提交"> 
        <input type="reset" name="Submit3" value="重置"></td>
    </tr>
  </table>
</form>