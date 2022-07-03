<?php
   include_once '../conn.php';
   if($_SESSION['flag'] == "register"){
   	    //图片上传设置
        $allowtype = array("gif", "png", "jpg");   //设置允许上传的类型为gif, png和jpg
        $size = 1000000;                           //设置允许大小为1M（1000000字节）以内的文件
        $path = "../image/shop";                       //设置上传后保存文件的路径
        //1. 判断文件是否可以成功上传到服务器，$_FILES['myfile']['error'] 为0表示上传成功
        if($_FILES['myfile']['error'] > 0) {    
            echo '上传错误: ';
            switch ($_FILES['myfile']['error']){
                case 1:  die('上传文件大小超出了PHP配置中的约定值：upload_max_filesize');  
                case 2:  die('上传文件大小超出了表单中的约定值：MAX_FILE_SIZE');  
                case 3:  die('文件只被部分上载'); 
                case 4:  die('没有上传任何文件'); 
                case 6:  die('找不到临时文件夹');
                case 7:  die('文件写入失败');
                default: die('末知错误');
            }
        } 
        //2. 判断上传的文件是否为允许的文件类型,通过文件的后缀名
        $tuming= explode(".", $_FILES['myfile']['name']);
        $hz = array_pop($tuming); //array_pop() 函数弹出数组中的最后一个元素

        //3. 通过判断文件的后缀方式，来决定文件是否是允许上传的文件类型
        if(!in_array($hz, $allowtype)) {
            die("这个后缀是<b>{$hz}</b>,不是允许的文件类型!");
        }
        //4. 判断上传的文件是否为允许大小
        if($_FILES['myfile']['size'] > $size ) {
            die("超过了允许的<b>{$size}</b>字节大小");
        }
        //5. 为了系统安全，也为了同名文件不会被覆盖，上传后将文件名使用系统定义
        $filename = date("YmdHis").rand(100,999).".".$hz;
        //6. 判断是否为上传文件
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) { 
            if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $path.'/'.$filename)) {  
                die('问题: 不能将文件移动到指定目录。');
            }
        }else{
            die("问题: 上传文件{$_FILES['myfile']['name']}不是一个合法文件: ");
        }
        //7. 如果文件上传成功则输出
        echo "文件{ $filename }上传成功,保存在{$path}中，大小为{$_FILES['myfile']['size']}字节";
        
        $storeName = $_POST['storeName'];
   	    $userName = $_SESSION['username'];
   	    echo $userName;
   	    $shopTel = $_POST['shopTel'];
   	    $shopClass = $_POST['shopClass'];
   	    $openTime = $_POST['openTime'];
   	    $startTime = $_POST['startTime'];
   	    $addrDetails =$_POST['addrDetails'];
   	    $lng = $_POST['lng'];
   	    $lat = $_POST['lat'];
        $logo=$filename;
        
        
        $mysqli->set_charset('utf8');
        $sql="insert into shop values('','$userName','$storeName','$logo','$shopTel','$shopClass','$openTime','$startTime','$addrDetails','$lng','$lat','','','','','','','')";
        $result=$mysqli->query($sql);
        
        if($result){
        	$_SESSION['username'] = $userName;
      	    $_SESSION['flag'] = "shop";
         header("location:shopInfo.php");	
        }
        $mysqli->close();
    }else{
   	    die("非法 操作");
    }
?>