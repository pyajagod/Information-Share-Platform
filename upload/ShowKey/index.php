<?php
include("../class/connect.php");
include("../data/cache/public.php");

//ȡ�������
function domake_password($pw_length){
	$low_ascii_bound=48;
	$upper_ascii_bound=57;
	$notuse=array(58);
	while($i<$pw_length)
	{
		mt_srand((double)microtime()*1000000);
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}

//��ʾ��֤��
function ShowKey(){
	$key=strtolower(domake_password(4));
	$set=esetcookie("checkplkey",$key);
	//�Ƿ�֧��gd��
	if(function_exists("imagejpeg")) 
	{
		header ("Content-type: image/jpeg");
		$img=imagecreate(47,20);
		$blue=imagecolorallocate($img,102,102,102);
		$white=ImageColorAllocate($img,255,255,255);
		$black=ImageColorAllocate($img,71,71,71);
		imagefill($img,0,0,$blue);
		imagestring($img,5,6,3,$key,$white);
		for($i=0;$i<90;$i++) //�����������
		{
			imagesetpixel($img,rand()%70,rand()%30,$black);
		}
		imagejpeg($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagepng"))
	{
		header ("Content-type: image/png");
		$img=imagecreate(47,20);
		$blue=imagecolorallocate($img,102,102,102);
		$white=ImageColorAllocate($img,255,255,255);
		$black=ImageColorAllocate($img,71,71,71);
		imagefill($img,0,0,$blue);
		imagestring($img,5,6,3,$key,$white);
		for($i=0;$i<90;$i++) //�����������
		{
			imagesetpixel($img,rand()%70,rand()%30,$black);
		}
		imagepng($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagegif")) 
	{
		header("Content-type: image/gif");
		$img=imagecreate(47,20);
		$blue=imagecolorallocate($img,102,102,102);
		$white=ImageColorAllocate($img,255,255,255);
		$black=ImageColorAllocate($img,71,71,71);
		imagefill($img,0,0,$blue);
		imagestring($img,5,6,3,$key,$white);
		for($i=0;$i<90;$i++) //�����������
		{
			imagesetpixel($img,rand()%70,rand()%30,$black);
		}
		imagegif($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagewbmp")) 
	{
		header ("Content-type: image/vnd.wap.wbmp");
		$img=imagecreate(47,20);
		$blue=imagecolorallocate($img,102,102,102);
		$white=ImageColorAllocate($img,255,255,255);
		$black=ImageColorAllocate($img,71,71,71);
		imagefill($img,0,0,$blue);
		imagestring($img,5,6,3,$key,$white);
		for($i=0;$i<90;$i++) //�����������
		{
			imagesetpixel($img,rand()%70,rand()%30,$black);
		}
		imagewbmp($img);
		imagedestroy($img);
	}
	else
	{
		$set=esetcookie("checkplkey","edown");
		echo ReadFiletext("../data/images/edown.jpg");
	}
}
ShowKey();
?>