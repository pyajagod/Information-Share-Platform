<?php

//取得随机数
function make_password($pw_length){
    $low_ascii_bound=50;
    $upper_ascii_bound=122;
    $notuse=array(58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
    $i = 0;
    $password1 = "";
    while( $i < $pw_length)
    {
        mt_srand((double)microtime()*1000000);
        $randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
        if(!in_array($randnum,$notuse))
        {
            $password1 = $password1.chr($randnum);
            $i++;
        }
    }
    return $password1;
}
