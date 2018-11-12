<?php

function unicode_decode($name)
{
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}

echo '生成首页<br/>';
$serverPath =  'http://' . $_SERVER['HTTP_HOST'];
$home = file_get_contents( $serverPath . '/home');
//替换css和js路径
$home = str_replace('"/public','"public',$home);
//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist?type=1');
$worklist = str_replace('\/images\/','images\/',$worklist);
echo $worklist;
//echo unicode_decode($worklist);
//exit;
//echo $worklist;
$home = str_replace('"staticHoldValue1"',$worklist,$home);
$home = str_replace('refreshWork();',"refreshWork_static();",$home);
file_put_contents('temp/home.html',$home);
echo '生成首页完成<br/>';