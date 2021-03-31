<?php
if(!defined('InEmpireDown'))
{
    exit();
}
?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>下载结果</title>
    <link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
    <script>
    var width = window.screen.width;
    if(width < 500){
      document.writeln('<link href="../../staticPoj/assets/cssm/layui.css" rel="stylesheet" type="text/css">');
    }else{
      document.writeln('<link href="../../staticPoj/layui/css/layui.css" rel="stylesheet" type="text/css">');
    }
    </script>
</head>
<body>
<br>
<br>
<br>
<br>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>路径详情</legend>
</fieldset>
<input type="hidden" id="pathId" value="<?php echo $r[path_address]?>">
<div class="layui-form">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="150">
            <col width="150">
        </colgroup>
        <thead>
        <tr>
            <th>下载地址</th>
            <th>提取码</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><button class="layui-btn layui-btn-warm" onclick="tiao2()">链接地址</button></td>
            <td><strong><?=$r[path_password]?></strong></td>
            <td><button type="button" class="layui-btn layui-btn-warm" onclick="tiao()">返回首页</button></td>
        </tr>
        </tbody>
    </table>
</div>
<br>
</body>

<script src="../../staticPoj/layui/layui.js"></script>
<script>
    function tiao() {
        window.history.go(-4);
    }

    function tiao2() {
        setTimeout('var path = document.getElementById("pathId").value;window.open(path, "_bank");', 500);
    }
</script>
</html>