<?php

use Carbon\Carbon;

function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

if (!function_exists('replaceStr')) {
    function replaceStr($str){
        return(preg_replace('/\s+/','_',$str));
    }
}

if (!function_exists('checkTokenExpiryInMinutes')) {
    function checkTokenExpiryInMinutes($time, $timeDiff){
        $data = Carbon::parse($time->format('Y-m-d h:i:s a'));
        $now = Carbon::now();
        $diff = $data->diffInMinutes($now);

        if($diff > $timeDiff){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length=20){
        $ch = '0123456789abcdefghijklmnopqrstwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $len = strlen($ch);
        $str='';
        for($i = 0; $i<$length; $i++){
            $str .=$ch[random_int(0, $len-1)];
        }
        return $str;
    }
}
