<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的订单</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/login.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/myOrder.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/seach.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
	</head>
	<body>
		<?php
			include_once '../conn.php';
			if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
				
			}else{
				header("location:index1.html");
			}
		?>
		<header class="headerBlue">
		  <div class="container bc clearfix ">
			<span class="logoBlue fl"></span>
			<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="../index1.html">首页</a></li>
               	<li><a href="myOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="strip fl f0 ml30 ">
				<div class="strip-addr1 dib vm f12 w200 h40 ">
					<span class="addrIcon dib vm ml10 mr10 vm"></span>
					<span class="strip-addr1-info dib vm">上帝之家</span>
				</div>
				<div class="strip-addr2 dib f0 vm w200 h40 none">
					<p class="strip-addr2-item1 dib w80 h40 pl10 bb vm">
					    <span class="strip-addr2-item1-info dib vm fc3 f12">温州市永嘉县</span>
					    <span class="strip-addr2-item1-listIcon listIcon dib vm"></span>
					</p>
					<input class="strip-addr2-item2 h40 nb pl10 bb f12 vm" type="text" placeholder="请输入送餐地址">
				</div>
				<div class="strip-search dib vm f0 w200 h40">
				    <span class="seachIcon dib vm ml10"></span>
				    <input class="strip-search-text h40 nb vm pl10 bb f12" type="text" placeholder="搜索产品和商家">
			    </div>
			</div>
			<div class="fr">
               <ul class="loginList f0">
               	<li id="userName" class="pr">
               		<a href="javascript:void(0);">
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
               			<li><a href="myOrder.php">我的订单</a></li>
               			<li><a href="personalData.php">我的资料</a></li>
               			<li><a href="myCt.php">我的收藏</a></li>
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
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a class="active" href="myOrder.php">近三个月的订单</a></li>
                	</ul>
                </li>
                <li>
                	我的资料
                	<ul class="userInfoList-item">
                		<li><a href="accountBalance.php">账户余额</a></li>
                		<li><a href="personalData.php">个人资料</a></li>
                		<li><a href="addrMm.php">地址管理</a></li>
                	</ul>
                </li>
                <li><a href="myCt.php">我的收藏</a></li>
			</ul>
			<div class="main fr">
                <h1 class="f18">近三个月的订单</h1>
                <table class="w mt30 f12">
                  <thead>
                	<tr class="order-title">
                		<th>下单时间</th>
                		<th class="order-title-content">订单内容</th>
                		<th></th>
                		<th>支付金额(元)</th>
                		<th>状态</th>
                		<th>操作</th>
                	</tr>
                  </thead>
                  <tbody>
                <?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql ="select myorder.time,myorder.bh,myorder.money,myorder.status,shop.logo,shop.shop_name from myorder inner join shop where myorder.shop_name=shop.shop_name and user_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($time,$bh,$money,$status,$logo,$shopName);
	                    while ($stmt->fetch()) {
	                       
                ?>
                	<tr class="order-content">
                		<td class="myorder-content-time pr10 pr">
                			<?php echo $time;?>
                			<span class="circular pa"></span>
                		</td>
                		<td class="order-content-img pl20 pr20">
                			<a href="../shop.php?shopname=<?php echo $shopName ;?>">
                				<figure>
                				    <img src="../image/shop/<?php echo $logo;?>">
                			    </figure>
                			</a>
                		</td>
                		<td class="myorder-content-details">
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
                			<h3>订单编号:<a href="orderDetails.php?bh=<?php echo $bh?>"><?php echo $bh;?></a></h3>
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
                			<a class="detailsButton pl10 pr10" href="orderDetails.php?bh=<?php echo $bh?>">订单详情</a>
                			<a class="db mt10 none" href="#">再来一份</a>
                			<a class="db mt10 none" href="#">评论</a>
                		</td>
                	</tr>
                <?php	
                	   }
	                   $stmt->close();
                    }
                    $mysqli->close();
              	?>
                	<!--<tr class="order-content">
                		<td class="myorder-content-time pr10 pr">
                			2018-01-22 18:38
                			<span class="circular pa"></span>
                		</td>
                		<td class="order-content-img pl20 pr20">
                			<a href="shop.html">
                				<figure>
                				    <img src="../image/cheshi.png">
                			    </figure>
                			</a>
                		</td>
                		<td class="myorder-content-details">
                			<span>宝岛招牌饭-列汤一份</span>
                			<span>菜品1份</span>
                			<h3>订单编号:<a href="#">0909808008</a></h3>
                		</td>
                		<td class="tc">0.01元</td>
                		<td class="tc">订单已完成</td>
                		<td class="tc">
                			<a class="detailsButton pl10 pr10" href="#">订单详情</a>
                			<a class="db mt10 none" href="#">再来一份</a>
                			<a class="db mt10" href="#">评论</a>
                		</td>
                	</tr>-->
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
        <script>
        	cancel();
        	seach();
        	$(".strip-addr1-info").text(sessionStorage.area);
            $(".strip-addr2-item1-info").text(sessionStorage.city);
        </script>
	</body>
</html>
