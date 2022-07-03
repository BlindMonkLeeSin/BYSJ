<?php
	include_once '../conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
	}else{
		header("location:shopLogin.html");
	}
	$type = $_POST['type'];
	$bh = $_POST['bh'];
	if($type == "fh"){
		$sql="update myorder set status=1,time=now() where bh='$bh'";
	    $result=$mysqli->query($sql);
	    if($result){
            echo "发货成功";
		}
	    $mysqli->close();
	}
	if($type == "sd"){
		$sql="update myorder set status=2,time=now() where bh='$bh'";
	    $result=$mysqli->query($sql);
	    if($result){
            echo "确认收货";
		}
	    $mysqli->close();
	}
?>