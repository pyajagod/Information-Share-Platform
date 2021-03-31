<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
include("../class/t_functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}

include('../class/classfun.php');
if($phome=="AddClass")//增加分类
{
	AddClass($_POST,$myuserid,$myusername);
}
elseif($phome=="EditClass")//修改分类
{
	EditClass($_POST,$myuserid,$myusername);
}
elseif($phome=="DelClass")//删除分类
{
	$classid=$_GET['classid'];
	DelClass($classid,$myuserid,$myusername);
}
elseif($phome=="EditClassOrder")//修改分类显示顺序
{
	$classid=$_POST['classid'];
	$myorder=$_POST['myorder'];
	EditClassOrder($classid,$myorder,$myuserid,$myusername);
}
elseif($phome=="ChangeSonclass")//更新分类关系
{
	$start=$_GET['start'];
	ChangeSonclass($start,$myuserid,$myusername);
}
elseif($phome=="AddZt")//增加专题
{
	AddZt($_POST,$myuserid,$myusername);
}
elseif($phome=="EditZt")//修改专题
{
	EditZt($_POST,$myuserid,$myusername);
}
elseif($phome=="DelZt")//删除专题
{
	DelZt($_GET['ztid'],$myuserid,$myusername);
}
elseif($phome=='ChangeClassIslast')//终极分类与非终极分类之间的转换
{
	$classid=$_GET['classid'];
	ChangeClassIslast($classid,$myuserid,$myusername);
}
else
{printerror("您来自的链接不存在","history.go(-1)");}
db_close();
$empire=null;
?>
