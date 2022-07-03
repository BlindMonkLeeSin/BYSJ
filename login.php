<?php
   include_once 'conn.php';

//flag = user 用户登录，为shop 商家登录

$type = $_GET['type'];

//shop注册状态，得到用户名
if($type == 'getUserName'){
	if($_SESSION['flag'] == "register"){
		$userName = $_SESSION['username'];
		echo $userName;
	}else{
		echo "error";
	}
}

//注销
if($type == "cancel"){
	unset($_SESSION['flag']);
    unset($_SESSION['username']);
    echo "注销成功";
}

//检查用户是否登录
if($type == "ifLogin"){
	$userName = $_SESSION['username'];
    $flag = $_SESSION['flag'];
	echo "$userName,$flag";
}

//用户登录
if($type == 'login'){
	$userName = $_GET['userName'];
    $userPwd = $_GET['userPwd'];
    $stmt = $mysqli->stmt_init();
    $sql2 = "select user_name from user where user_name='$userName' and user_pwd='$userPwd'";
    //创建准备语句
    if ($stmt->prepare($sql2)) {
        $stmt->execute();    //执行查询    
        $stmt->bind_result($user_name);//绑定结果
        if($stmt->fetch()) {  //获取准备语句的结果
      	    $_SESSION['username'] = $userName;
      	    $_SESSION['flag'] = "user";
      	    echo "登录成功";
	    }else{
	    	echo "请输入正确的用户名和密码";
	    }
	    $stmt->close();//关闭准备语句
    } 
    $mysqli->close();
}

//检查用户名是否存在
if($type == "check"){
	$userName = $_GET['userName'];
	$stmt = $mysqli->stmt_init();
    $sql2 = "select user_name from user where user_name='$userName'";
    //创建准备语句
    if ($stmt->prepare($sql2)) {
        $stmt->execute();    //执行查询    
        $stmt->bind_result($user_name);//绑定结果
        if($stmt->fetch()) {  //获取准备语句的结果
             echo "该用户名已存在";
        }
	    $stmt->close();//关闭准备语句
    } 
    $mysqli->close();
}

//用户注册
if( $type == 'register'){
	$userName = $_GET['userName'];
    $userPwd = $_GET['userPwd'];

	$stmt = $mysqli->stmt_init();
	$sql2 = "select user_name from user where user_name='$userName'";
	if($stmt->prepare($sql2)) {
        $stmt->execute();    //执行查询    
        $stmt->bind_result($user_name);//绑定结果
        if($stmt->fetch()) {  //获取准备语句的结果
            die("请勿重复注册");
	    }
	    $stmt->close();//关闭准备语句
    }
    $sql="insert into user values('','$userName','$userPwd','','')";
    $result=$mysqli->query($sql);
    if($result){
      	$_SESSION['username'] = $userName;
      	$_SESSION['flag'] = "user";
        echo "注册成功";
    }else{
    	echo "注册失败";
    }
    $mysqli->close();
}

//插入code
if($type == "insertCode" ){
	$userName = $_GET['userName'];
	$code = $_GET['code'];
    $sql="insert shop_code values('','$userName','$code')";
    $result=$mysqli->query($sql);
    if($result){
        echo "成功插入验证码";
    }else{
    	echo "插入验证码失败";
    }
    $mysqli->close();
	
}
//判断shop登录或注册
if( $type == 'shop_status'){
	$userName = $_GET['userName'];
	$code = $_GET['code'];
	
	//检查code
	$stmt = $mysqli->stmt_init();
    $sql2 = "select shop_name from shop_code where shop_name='$userName' and code='$code'";
    //创建准备语句
    if ($stmt->prepare($sql2)) {
        $stmt->execute();    //执行查询    
        $stmt->bind_result($user_name);//绑定结果
        if($stmt->fetch()){
            $sql2 = "select shop_name from shop where shop_name='$userName'";
            //创建准备语句
            if ($stmt->prepare($sql2)) {
                $stmt->execute();    //执行查询    
                $stmt->bind_result($user_name);//绑定结果
                if($stmt->fetch()){
        	        //判断为登录
        	        $_SESSION['username'] = $userName;
      	            $_SESSION['flag'] = "shop";
      	            echo "login";
                }else{
        	        //判断为注册
        	        $_SESSION['username'] = $userName;
        	        $_SESSION['flag'] = "register";
        	        echo "register";
                }
            }
        }else{
        	echo "code errar";
        }
    $stmt->close();//关闭准备语句
	   
    } 
	
	//删除code
	$sql="delete from shop_code where shop_name='$userName'";
	$result=$mysqli->query($sql);
	if($result){
//		echo "删除成功！";
		}
	$mysqli->close();
}
?>

