<?php
	include_once 'conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
				
	}else{
		header("location:index1.html");
	}
	$info = $_POST['data'];
	$result = json_decode($info);

	
	$bh = date("YmdHis").rand(100,999);//生成订单编号
	
	$userName = $_SESSION['username'];
	$shopName = $result->shopName;
	$addrId = $result->addrId; 
	$psf = $result->psf;
	$num = $result->num;
	$money = $psf+$num;
	$remarks = $result->remarks;
	$balance = $result->balance;
	
	$arr = $result->product;
	//插入产品
	foreach($arr as $val){
		$id = $val->id;
		$num = $val->num;
		$sql2="insert into order_dli values('','$bh','$id','$num')";
        $result=$mysqli->query($sql2);
        if($result){
        	echo "产品插入成功";
        }
	}
	
    //插入订单
	$sql="insert into myorder values('',now(),'$bh','$userName','$shopName','$addrId','$money','$remarks',0)";
    $result=$mysqli->query($sql);
    if($result){
        	echo "订单插入成功";
    }
    //扣费
    $sql2="update user set user_money='$balance' where user_name='$userName'";
	$result=$mysqli->query($sql2);
	if($result){
        echo "扣费成功";
	}
	//商家加钱
        $stmt=$mysqli->stmt_init();
        $sql="select shop_money from shop where shop_name = '$shopName'";
        if($stmt->prepare($sql)){
	        $stmt->execute();
	        $stmt->bind_result($shopMoney);
	        if($stmt->fetch()) {
	        	$countMoney = $shopMoney+$money;
	        	echo $countMoney;
	        	echo $shopName;
	        	$stmt->close();
	        	$sql2="update shop set shop_money='$countMoney' where shop_name = '$shopName'";
	            $result=$mysqli->query($sql2);
	            if($result){
                    echo "商家得到钱";
	            }
	        }
	    }
	    $mysqli->close();

?>