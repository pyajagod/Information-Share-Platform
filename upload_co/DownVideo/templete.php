<?php
if(!defined('InEmpireDown'))
{
    exit();
}
?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>视频下载</title>
    <link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<br>
<br>
<br>
<div style="margin-left: 18%; margin-right: 18%">
    <?php
        echo $r[path_intro]
    ?>
</div>
<table align="center" width="100%">
    <tr>
        <td height="32" align=center><a title="<?=$r[path_id]?>"><img onclick="tiao()" src="../data/images/download1.png" border=0></a></td>
    </tr>
    <tr>
        <td align=center>(点击购买)</td>
    </tr>
</table>
<br>
</body>
<script>
    function tiao() {
        var is = confirm("您是否确认下载此视频？");
        if (is){
            window.location.href = "<?=$url?>";
        }else {
            window.history.go(-1);
        }
    }
</script>
</html>