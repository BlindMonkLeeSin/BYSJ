<?php
	include_once '../conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
	}else{
		header("location:shopLogin.html");
	}
	
	//插入分类
   $type = $_POST['type'];
   if($type == "insertClass"){
   	    $userName = $_SESSION['username'];
   	    $productClass = $_POST['productClass'];
   	    $sql="insert into product_class values('','$userName','$productClass')";
        $result=$mysqli->query($sql);
        if($result){
                echo "插入类成功";
        }else{
    	        echo "失败";
        }
    $mysqli->close();
   }
   
   //显示分类
   if($type == "showClass"){
?>
	    	    <li>
                	<a class="fc9" href="javascript:void(0);">全部商品</a>
                	<span class="fr h40 none">x</span>
                </li> 
<?php              
   	    $userName = $_SESSION['username'];
   	    $stmt=$mysqli->stmt_init();
        $sql="select product_class from product_class where shop_name='$userName'";
        if($stmt->prepare($sql)){
	        $stmt->execute();
	        $stmt->bind_result($product_class);
	        while ($stmt->fetch()){
?>
	    	    <li>
                	<a class="fc9" href="javascript:void(0);"><?php echo $product_class ?></a>
                	<span class="fr h40 none">x</span>
                </li> 
<?php                  
	        }
	        $stmt->close();
	    }
    $mysqli->close();
    }
    
    if($type == "deleteClass"){
    	$userName = $_SESSION['username'];
    	$productClass = $_POST['productClass'];
    	$sql="delete from product_class where shop_name='$userName' and product_class='$productClass'";
	    $result=$mysqli->query($sql);
	    if($result){
	    	echo "删除类成功";
		}
	    $mysqli->close();
    }
?>