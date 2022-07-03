<?php
	include_once '../conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
	}else{
		header("location:shopLogin.html");
	}
	
	$userName = $_SESSION['username'];
	$shopTel = $_POST['shopTel'];
	$openTime = $_POST['openTime'];
	$startTime = $_POST['startTime'];
	$psf = $_POST['psf'];
	$qbj = $_POST['qbj'];
	$notice = $_POST['notice'];
	$introduce = $_POST['introduce'];

	$sql="update shop set shop_tel ='$shopTel',open_time='$openTime',start_time='$startTime',psf='$psf',qbj='$qbj',notice='$notice',introduce='$introduce' where shop_name='$userName'";
	$result=$mysqli->query($sql);
	if($result){
        header("location:shopEidtInfo.php");
		}
	$mysqli->close();
?>