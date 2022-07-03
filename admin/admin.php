<?php
    include_once '../conn.php';
    $type = isset($_POST['type'])?$_POST['type'] : $_GET['type'];
if($_SESSION['flag']=="admin"){
     //得到历史操作
    if($type =="getHistory" && isset($_SESSION['flag']) && $_SESSION['flag'] =="admin"){
    	$resultArr = array();
    	$con = mysql_connect("localhost","root","root");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("BYSJ", $con);
        $sql2="select * from history";
        $result = mysql_query($sql2);      			  		
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo $josn;	
    }
    //得到用户信息
    if($type =="getUserInfo" && isset($_SESSION['flag']) && $_SESSION['flag'] =="admin"){
    	$resultArr = array();
	    $con = mysql_connect("localhost","root","root");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("BYSJ", $con);
        $sql2="select * from user";
        $result = mysql_query($sql2);      			  		
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo $josn;	
    }
    //得到商家信息
    if($type =="getShopInfo" && isset($_SESSION['flag']) && $_SESSION['flag'] =="admin"){
    	$resultArr = array();
	    $con = mysql_connect("localhost","root","root");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("BYSJ", $con);
        $sql2="select id,shop_name,store_name,shop_class,shop_addr,shop_money from shop";
        $result = mysql_query($sql2);      			  		
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo $josn;	
    }
    //删除用户信息
    if($type == "delUser" && isset($_SESSION['flag']) && $_SESSION['flag'] =="admin"){
    	$flag = 0;
    	$userName = $_POST['userName'];
    	$sql="delete from user where user_name='$userName'";
	    $result=$mysqli->query($sql);
	    if($result){
		    echo "删除成功！";
		    $flag = 1;
		}
        $name = "用户".$userName;
        $content = "被删除了"; 
	    if($flag == 1){
	    	$sql="insert into history values('',now(),'$name','$content')";
            $result=$mysqli->query($sql);
        
           if($result){
        	    echo "历史更新";
           }
	    }
	    $mysqli->close();
    }
    //充值
    if($type == "addr"){
    	$flag = 1;
    	$userName = $_POST['userName'];
    	$sumMoney = $_POST['sumMoney'];
    	$addMoney = $_POST['addMoney'];
	    $sql="update user set user_money='$sumMoney' where user_name='$userName'";
	    $result=$mysqli->query($sql);
	    if($result){
            echo "充值成功";
            $flag = 1;
		}
		$name = "用户".$userName;
        $content = "充值了".$addMoney."元"; 
		if($flag == 1){
	    	$sql="insert into history values('',now(),'$name','$content')";
            $result=$mysqli->query($sql);
        
           if($result){
        	    echo "历史更新";
           }
	    }
	    $mysqli->close();
    }
    //删除商家信息
    if($type == "delShop" && isset($_SESSION['flag']) && $_SESSION['flag'] =="admin"){
    	$flag = 1;
    	$shopName = $_POST['shopName'];
    	$sql="delete from shop where shop_name='$shopName'";
	    $result=$mysqli->query($sql);
	    if($result){
		    echo "删除成功！";
		}

	    $name = "商家".$shopName;
        $content = "被删除了";  
		if($flag == 1){
	    	$sql="insert into history values('',now(),'$name','$content')";
            $result=$mysqli->query($sql);
        
           if($result){
        	    echo "历史更新";
           }
	    }
	    $mysqli->close();
    }	  	
}
    if($type == "login"){
    	$adminUser = $_POST['adminUser'];
    	$adminPwd = $_POST['adminPwd'];
    	
    	$stmt = $mysqli->stmt_init();
        $sql = "select admin_name from admin where admin_name='$adminUser' and admin_pwd='$adminPwd'";
    	if($adminPwd && $adminUser){
    		if ($stmt->prepare($sql)) {
                $stmt->execute();    //执行查询    
                $stmt->bind_result($user_name);//绑定结果
                if($stmt->fetch()) {  //获取准备语句的结果
      	            $_SESSION['username'] = $adminUser;
      	            $_SESSION['flag'] = "admin";
//    	            echo "登录成功";
      	            header("location:adminMain.html");
	            }else{
	    	        die("请输入正确的用户名和密码");
	            }
	            $stmt->close();//关闭准备语句
    } 
    $mysqli->close();
    		
    	}else{
    		die("账号或密码不能为空");
    	}
    }
   

?>