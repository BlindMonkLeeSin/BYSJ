<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>发出的订单</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="../css/common/shopOrder.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
		<script type="text/javascript" src="JS/orderBt.js" ></script>
	</head>
	<body>
		<?php
	        include_once '../conn.php';
		    if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
		    }else{
			    header("location:shopLogin.html");
	        }
	    ?>
		<header class="headerBlue">
		  <div class="container bc clearfix ">
			<span class="logoBlue fl"></span>
						<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="../index1.html">首页</a></li>
               	<li><a href="shopNewOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="fr">
               <ul class="loginList f0">
                  <li id="shopName" class="pr">
               		<a href="shopInfo/shopLogin.html">
               			<?php 
               				if(isset($_SESSION['username'])){
               				    echo $_SESSION['username'];
               			    }else{
               			    	echo "";
               			    } 
               		    ?>
               		</a>
               		<span class="dib listIcon w15 h15"></span>
               		<ul class="loginListDetalist f14 pa tc none">
               			<li><a href="shopInfo.php">店铺信息</a></li>
               			<li><a href="shopNewOrder.php">我的订单</a></li>
               			<li><a href="shopProductInfo.php">商品管理</a></li>
               			<li class="cancel"><a href="javascript: void(0);">退出</a></li>
               		</ul>
               	  </li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="container bc clearfix mt50 mb20">
            <ul class="userInfoList fl mt20 ml50">
                <li>
                	店铺信息
                	<ul class="userInfoList-item">
                		<li><a href="shopInfo.php">基本信息</a></li>
                		<li><a href="shopEidtInfo.php">修改信息</a></li>
                	</ul>
                </li>
                <li>
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a href="shopNewOrder.php">新的订单</a></li>
                		<li><a class="active" href="shopLssueOrder.php">发出的订单</a></li>
                		<li><a href="shopHistoryOrder.php">历史订单</a></li>
                	</ul>
                </li>
                <li>
                	商品管理
                	<ul class="userInfoList-item">
                		<li><a href="shopProductInfo.php">商品信息</a></li>
                		<li><a href="addProduct.php">添加商品</a></li>
                	</ul>
                </li>
			</ul>
			<div class="main fr f14 fc6">
                <h1 class="f18">发出的订单</h1>
                <table class="w mt30 f12">
                  <thead>
                	<tr class="order-title tc">
                		<th class="">发货时间</th>
                		<th>订单人信息</th>
                		<th class="tl pl20">内容</th>
                		<th>支付金额(元)</th>
                		<th>状态</th>
                		<th>操作</th>
                	</tr>
                  </thead>
                  <tbody>
                <?php
                	$shopName=$_SESSION['username'];
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql ="select myorder.time,myorder.bh,myorder.money,myorder.status,user_addr.name,user_addr.sex,user_addr.tel,user_addr.addr,user_addr.addrDetails from myorder inner join user_addr where myorder.addr_id=user_addr.id and shop_name = '$userName' and status='1'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($time,$bh,$money,$status,$name,$sex,$tel,$addr,$addrDetails);
	                    while ($stmt->fetch()) {
	                       
                ?>
                	<tr class="order-content tc">
                		<td class="w40">
                			<?php echo $time;?>
                		</td>
                		<td>
                            <span><?php echo $name;?>(<?php echo $sex;?>)</span>
                            <span><?php echo $tel;?></span>
                            <p><?php echo $addr;?><?php echo $addrDetails;?></p>
                		</td>
                		<td class="tl pl20 w300">
                			        <?php
                			    		$con = mysql_connect("localhost","root","root");
                			    		if (!$con)
                                        {
                                            die('Could not connect: ' . mysql_error());
                                        }
                                        $num=0;
                                        mysql_select_db("BYSJ", $con);
                                        $sql2="select product.product_name from order_dli inner join product where order_dli.product_id=product.id and bh='$bh'";
                                        $result = mysql_query($sql2);
                                        while($row = mysql_fetch_array($result))
                                        {   $num+=1;
                                    ?>
                                            <span><?php echo $row['product_name'];?></span>
                                    <?php

                                       }
                                    ?>
                			<span>菜品<?php echo $num;?>份</span>
                			<h3>订单编号:<a href="orderDetails.php?bh=<?php echo $bh;?>"><?php echo $bh;?></a></h3>
                		</td>
                		<td class="tc"><?php echo $money;?></td>
                		<td class="tc">
						<?php 
							switch($status){
								case 0: 
								echo "已支付";
								break;
								case 1:
								echo "已发货";
								break;
								case 2:
								echo "已完成";
								break;
							}
						?>
                		</td>
                		<td class="tc">
                			<a class="detailsButton mt10 mb10 dib" href="orderDetails.php?bh=<?php echo $bh;?>">订单详情</a>
                			<a class="arrivalButton mt10 mb10 dib" href="javascript:void(0);" data-bh="<?php echo $bh;?>">到货</a>
                		</td>
          
                	</tr>
                <?php	
                	   }
	                   $stmt->close();
                    }
                    $mysqli->close();
              	?>
                  </tbody>
                </table>
			</div>
		</div>
        <footer class="footer h150 tc">
 	        <address class="addr pt20 pb10">
 		        <span>name</span>
 		        <span>40214157</span>
 		        <span>班级14101</span>
 		        <span>phone</span>
 	        </address>
 	        <span class="fca">copyright&copy2017-2018</span>
        </footer>
	</body>
</html>
