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
echo $worklist;
//echo unicode_decode($worklist);
//exit;
//echo $worklist;
$home = str_replace('"staticHoldValue1"',$worklist,$home);
$home = str_replace('refreshWork();',"refreshWork_static();",$home);
file_put_contents('temp/home.html',$home);
echo '生成首页完成<br/>';

//拷贝资源目录
echo '拷贝资源目录<br/>';
copyDir('public','temp/public');
//copyDir('images','temp/images');
echo '拷贝资源目录结束<br/>';

//生产压缩包并下载
$zip = new ZipArchive();
if ($zip->open('demo.zip', ZipArchive::CREATE) === TRUE) {
    addFileToZip('temp/', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    $zip->close(); //关闭处理的zip文件
    echo 33;
}else{
    echo '文件打开失败';
}


//header("Location:" . $serverPath . '/demo.zip');
echo '<script>location.href="'.$serverPath . '/demo.zip'.'"</script>';
exit;

//echo '生产压缩包结束<br/>';
