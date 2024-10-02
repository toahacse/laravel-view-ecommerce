<?php

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
