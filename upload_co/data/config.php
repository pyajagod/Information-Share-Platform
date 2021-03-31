<?php
//------- 数据库设置 -------

$phome_db_ver="5.0";	//数据库版本
$phome_db_server="114.115.175.207";	//数据库登陆地址
$phome_db_port="";	//端口，不填为按默认
$phome_db_username="root";	//数据库用户名
$phome_db_password="ccxm";	//数据库密码
$phome_db_dbname="empiredown";	//数据库名
$phome_db_char="gbk";	//数据库默认编码
$dbtbpre="e_";	//数据表前缀


//------- Cookie设置 -------
$phome_cookiedomain="";		//cookie作用域
$phome_cookiepath="/";		//cookie作用路径
$phome_cookievarpre="nhskx";		//cookie变量前缀


//其他设置
$do_ecookiernd='caP4T7P7gZ7SNGg288pWCd4XJn8CPd';	//COOKIE认证码(填写10~50个任意字符，最好多种字符组合)
$do_loginauth='';	//登录认证码,如果设置登录需要输入此认证码才能通过
$phome_edown_charver="gb2312";	//页面编码
$phome_headercharset=1;	//页面默认字符集,0=关闭 1=开启


//文件类型
$tranpicturetype=',.jpg,.gif,.png,.bmp,.jpeg,';	//图片
$tranflashtype=',.swf,.flv,';	//FLASH
$mediaplayertype=',.wmv,.asf,.wma,mp3,.asx,.mid,.midi,';	//mediaplayer
$realplayertype=',.rm,.ra,.rmvb,.mp4,.mov,.avi,.wav,.ram,.mpg,.mpeg,';	//realplayer
?>