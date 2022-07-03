<?php
   include_once '../conn.php';
    if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
        $type = $_POST['type'];
        //收藏店铺
        if($type == "ct"){
        	$userName = $_SESSION['username'];
        	$shopName = $_POST['shopName'];
            $sql="insert into user_ct values('','$userName','$shopName')";
            $result=$mysqli->query($sql);
            if($result){
	            echo "收藏成功";
            }
            $mysqli->close();		
        }
        //取消收藏
        if($type == "cancelCt"){
        	$userName = $_SESSION['username'];
        	$shopName = $_POST['shopName'];
        	$sql="delete from user_ct where user_name='$userName' and shop_name='$shopName'";
	        $result=$mysqli->query($sql);
	        if($result){
		        echo "取消收藏";
		    }
	        $mysqli->close();        			
        }
        //根据id删除收藏
        if($type == "deleteCt"){
        	$ctId = $_POST['ctId'];
        	$sql="delete from user_ct where id='$ctId'";
	        $result=$mysqli->query($sql);
	        if($result){
		        echo "成功删除收藏";
		    }
	        $mysqli->close();        			
        }    	
    }else{
    	header("location:index1.html");
    }
?>