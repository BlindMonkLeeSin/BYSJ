<?php
	include_once '../conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
				
	}else{
		header("location:index1.html");
	}
	
	$userName = $_SESSION['username'];
    $type = isset($_POST['type'])?$_POST['type'] : $_GET['type'];
//  $name = $_POST['name'];
//  $sex = $_POST['sex'];
//  $tel = $_POST['tel'];
//  $addr = $_POST['addr'];
//  $addrDetails = $_POST['addrDetails'];
//  $id = $_POST['id'];
//  $lng = $_POST['lng'];
//  $lat = $_POST['lat'];
//  $ = $_POST[''];
//  $ = $_POST[''];
//  $ = $_POST[''];
    //删除地址
    if($type =="deleteAddr"){
        $addrId = $_POST['addrId'];
        
    	$sql="delete from user_addr where Id='$addrId'";
	    $result=$mysqli->query($sql);
	    if($result){
		    echo "删除地址成功！";
		}
	    $mysqli->close();
    }
    //添加地址
    if($type == "addAddr"){
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $tel = $_POST['tel'];
        $addr = $_POST['addr'];
        $addrDetails = $_POST['addrDetails'];
        $lng = $_POST['lng'];
        $lat = $_POST['lat'];
        
        $sql="insert into user_addr values('','$userName','$name','$sex','$tel','$addr','$addrDetails','$lng','$lat')";
        $result=$mysqli->query($sql);        
        if($result){
        	echo "添加地址成功";
        }
        $mysqli->close();
    }
    //更新地址
    if($type == "updateAddr"){
    	$addrId = $_POST['addrId'];
    	
    	$name = $_POST['name'];
        $sex = $_POST['sex'];
        $tel = $_POST['tel'];
        $addr = $_POST['addr'];
        $addrDetails = $_POST['addrDetails'];
        $lng = $_POST['lng'];
        $lat = $_POST['lat'];
        
    	$sql="update user_addr set name ='$name',sex='$sex',tel='$tel',addr='$addr',addrDetails='$addrDetails',lng='$lng',lat='$lat' where Id='$addrId'";
	    $result=$mysqli->query($sql);
	    if($result){
//          header("location:shopProductInfo.html");
            echo "修改地址成功";
		}
	    $mysqli->close();
    }
    //获得内容
    if($type == "domeData"){
    	//将字符转化在服务器端转换为汉字的函数，不用也可以。
        function decodeUnicode($str){
            return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
            create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
            ),
            $str);
        }  
    	$resultArr = array();
	    $con = mysql_connect("localhost","root","root");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        $userName = $_SESSION['username'];
        mysql_select_db("BYSJ", $con);
        $sql="select id,name,sex,tel,addr,addrDetails,lng,lat from user_addr where user_name = '$userName'";
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo decodeUnicode($josn);
	    
    }
?>