<?php
   include_once '../conn.php';
   if($_SESSION['flag']=="admin"){
   	    $resultArr = array();
    	$con = mysql_connect("localhost","root","root");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("BYSJ", $con);
        $sql="select product_id,sum(num) as num from order_dli group by product_id";
        $result = mysql_query($sql);      			  		
        while($row = mysql_fetch_array($result))
        {   
        	$resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo $josn."<br>";	
        
        foreach($resultArr as $val){
        	$productId = $val["product_id"];
        	$num = $val['num'];
//      	echo $productId;
//      	echo $num;
            $sql2="update product set product_sv ='$num' where Id='$productId'";
	        $result=$mysqli->query($sql2);
	        if($result){
                echo "修改成功<br>";
		    }
	    }
        $mysqli->close();
//      $stmt=$mysqli->stmt_init();
//      $sql="select product_id,sum(num) from order_dli group by product_id";
//          if($stmt->prepare($sql)){
//	            $stmt->execute();
//	            $stmt->bind_result($productId,$num);
//	            while ($stmt->fetch()){
//	            	$sql2="update product set product_sv ='$num' where Id='$productId'";
//	                $result=$mysqli->query($sql2);
//	                if($result){
//                      echo "修改成功";
//		            }
//              }
//              $stmt->close();
//          }
//          $mysqli->close();
   }else{
   	  die("没有权限操作");
   }
?>