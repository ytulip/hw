<?php

//phpinfo();
//exit;


function copyDir($dirSrc,$dirTo)
{
    if(is_file($dirTo))
    {
        echo $dirTo . '这不是一个目录';
        return;
    }
    if(!file_exists($dirTo))
    {
        mkdir($dirTo);
    }

    if($handle=opendir($dirSrc))
    {
        while($filename=readdir($handle))
        {
            if($filename!='.' && $filename!='..')
            {
                $subsrcfile=$dirSrc . '/' . $filename;
                $subtofile=$dirTo . '/' . $filename;
                if(is_dir($subsrcfile))
                {
                    copyDir($subsrcfile,$subtofile);//再次递归调用copydir
                }
                if(is_file($subsrcfile))
                {
                    copy($subsrcfile,$subtofile);
                }
            }
        }
        closedir($handle);
    }

}

function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ //将文件加入zip对象
                $zip->addFile($path."/".$filename);
            }
        }
    }
    @closedir($path);
}




echo '生成首页<br/>';
$serverPath =  'http://' . $_SERVER['HTTP_HOST'];
$home = file_get_contents( $serverPath . '/home');
//替换css和js路径
$home = str_replace('"/public','"public',$home);
//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist?type=1');
$worklist = str_replace('\/images\/','images\/',$worklist);
$home = str_replace('"staticHoldValue1"',$worklist,$home);
$home = str_replace('refreshWork();',"refreshWork_static();",$home);


/*替换模板链接*/
$home = str_replace('href="/works"','href="works.html"',$home);
$home = str_replace('href="/about"','href="about.html"',$home);
$home = str_replace('href="/contact"','href="contact.html"',$home);
$home = str_replace('href="/home"','href="home.html"',$home);

file_put_contents('temp/home.html',$home);
echo '生成首页完成<br/>';


echo '生成works<br/>';
$works = file_get_contents($serverPath . '/works');
$works = str_replace('"/public','"public',$works);

//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist');
$worklist = str_replace('\/images\/','images\/',$worklist);
$works = str_replace('"staticHoldValue1"',$worklist,$works);
$works = str_replace('refreshWork();',"refreshWork_static();",$works);


/*替换模板链接*/
$works = str_replace('href="/works"','href="works.html"',$works);
$works = str_replace('href="/about"','href="about.html"',$works);
$works = str_replace('href="/contact"','href="contact.html"',$works);
$works = str_replace('href="/home"','href="home.html"',$works);

$works = str_replace('href="works"','href="works.html"',$works);
$works = str_replace('href="/works?type=2"','href="works2.html"',$works);
$works = str_replace('href="/works?type=3"','href="works3.html"',$works);
$works = str_replace('href="/works?type=4"','href="works4.html"',$works);



file_put_contents('temp/works.html',$works);
echo '生成works完成<br/>';

$workIds = [];
$listObj = json_decode($worklist);
foreach ($listObj->data as $key=>$val)
{
    $workIds[] = $val->id;
}



echo '生成works2<br/>';
$works = file_get_contents($serverPath . '/works');
$works = str_replace('"/public','"public',$works);

//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist?type=2');
$worklist = str_replace('\/images\/','images\/',$worklist);
$works = str_replace('"staticHoldValue1"',$worklist,$works);
$works = str_replace('refreshWork();',"refreshWork_static();",$works);


/*替换模板链接*/
$works = str_replace('href="/works"','href="works.html"',$works);
$works = str_replace('href="/about"','href="about.html"',$works);
$works = str_replace('href="/contact"','href="contact.html"',$works);
$works = str_replace('href="/home"','href="home.html"',$works);

$works = str_replace('href="works"','href="works.html"',$works);
$works = str_replace('href="/works?type=2"','href="works2.html"',$works);
$works = str_replace('href="/works?type=3"','href="works3.html"',$works);
$works = str_replace('href="/works?type=4"','href="works4.html"',$works);



file_put_contents('temp/works2.html',$works);
echo '生成works2完成<br/>';




echo '生成works3<br/>';
$works = file_get_contents($serverPath . '/works');
$works = str_replace('"/public','"public',$works);

//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist?type=3');
$worklist = str_replace('\/images\/','images\/',$worklist);
$works = str_replace('"staticHoldValue1"',$worklist,$works);
$works = str_replace('refreshWork();',"refreshWork_static();",$works);


/*替换模板链接*/
$works = str_replace('href="/works"','href="works.html"',$works);
$works = str_replace('href="/about"','href="about.html"',$works);
$works = str_replace('href="/contact"','href="contact.html"',$works);
$works = str_replace('href="/home"','href="home.html"',$works);

$works = str_replace('href="works"','href="works.html"',$works);
$works = str_replace('href="/works?type=2"','href="works2.html"',$works);
$works = str_replace('href="/works?type=3"','href="works3.html"',$works);
$works = str_replace('href="/works?type=4"','href="works4.html"',$works);



file_put_contents('temp/works3.html',$works);
echo '生成works3完成<br/>';




echo '生成works4<br/>';
$works = file_get_contents($serverPath . '/works');
$works = str_replace('"/public','"public',$works);

//替换ajax请求
$worklist = file_get_contents($serverPath . '/worklist?type=4');
$worklist = str_replace('\/images\/','images\/',$worklist);
$works = str_replace('"staticHoldValue1"',$worklist,$works);
$works = str_replace('refreshWork();',"refreshWork_static();",$works);


/*替换模板链接*/
$works = str_replace('href="/works"','href="works.html"',$works);
$works = str_replace('href="/about"','href="about.html"',$works);
$works = str_replace('href="/contact"','href="contact.html"',$works);
$works = str_replace('href="/home"','href="home.html"',$works);

$works = str_replace('href="works"','href="works.html"',$works);
$works = str_replace('href="/works?type=2"','href="works2.html"',$works);
$works = str_replace('href="/works?type=3"','href="works3.html"',$works);
$works = str_replace('href="/works?type=4"','href="works4.html"',$works);



file_put_contents('temp/works4.html',$works);
echo '生成works4完成<br/>';


echo '生产work详情<br/>';
foreach ($workIds as $val)
{
    $work = file_get_contents($serverPath . '/work?id=' . $val);
    $work = str_replace('"/public','"public',$work);
    $work = str_replace('href="/works"','href="works.html"',$work);
    $work = str_replace('href="/about"','href="about.html"',$work);
    $work = str_replace('href="/contact"','href="contact.html"',$work);
    $work = str_replace('href="/home"','href="home.html"',$work);
    $work = str_replace('"/images/','"images/',$work);

    /*上一个项目，下一个项目替换,正则匹配*/
    $matches = [];
    preg_match_all('/"\/work\?id=([0-9]+)"/i', $work, $matches);
//    foreach ($matches as $key=>$value)
//    {
//
//    }
    if( isset($matches[0]) )
    {
        foreach ($matches[0] as $key=>$value)
        {
            $work = str_replace($value,'"work' . $matches[1][$key] . '.html"',$work);
        }
    }

    file_put_contents('temp/work'.$val.'.html',$work);
    echo '生产work'.$val.'<br/>';
}
echo '生产work详情完成<br/>';


echo '生成我们是谁<br/>';
$whoWeAre = file_get_contents($serverPath . '/about');
$whoWeAre = str_replace('"/public','"public',$whoWeAre);
$whoWeAre = str_replace('href="/works"','href="works.html"',$whoWeAre);
$whoWeAre = str_replace('href="/about"','href="about.html"',$whoWeAre);
$whoWeAre = str_replace('href="/contact"','href="contact.html"',$whoWeAre);
$whoWeAre = str_replace('href="/home"','href="home.html"',$whoWeAre);
$whoWeAre = str_replace('"/images/','"images/',$whoWeAre);
file_put_contents('temp/about.html',$whoWeAre);
echo '生产我们是谁完成<br/>';

echo '生成联系我们<br/>';
$contactUs = file_get_contents($serverPath . '/contact');
$contactUs = str_replace('"/public','"public',$contactUs);
$contactUs = str_replace('href="/works"','href="works.html"',$contactUs);
$contactUs = str_replace('href="/about"','href="about.html"',$contactUs);
$contactUs = str_replace('href="/contact"','href="contact.html"',$contactUs);
$contactUs = str_replace('href="/home"','href="home.html"',$contactUs);
$contactUs = str_replace('"/images/','"images/',$contactUs);
file_put_contents('temp/contact.html',$contactUs);
echo '生成联系我们完成<br/>';


//拷贝资源目录
echo '拷贝资源目录<br/>';
copyDir('public','temp/public');
//copyDir('images','temp/images');
echo '拷贝资源目录结束<br/>';

//生产压缩包并下载
$zipName = time() . '' . rand(10000, 99999) . '.zip';
$zip = new ZipArchive();
if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
    addFileToZip('temp/', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    $zip->close(); //关闭处理的zip文件
    echo 33;
}else{
    echo '文件打开失败';
}


//header("Location:" . $serverPath . '/demo.zip');
echo '<script>location.href="'.$serverPath . '/'. $zipName .'"</script>';
exit;

//echo '生产压缩包结束<br/>';
