<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<title>基本信息</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/shopInfo.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
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
                		<li><a class="active" href="shopInfo.php">基本信息</a></li>
                		<li><a href="shopEidtInfo.php">修改信息</a></li>
                	</ul>
                </li>
                <li>
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a href="shopNewOrder.php">新的订单</a></li>
                		<li><a href="shopLssueOrder.php">发出的订单</a></li>
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
              <h1 class="f18">基本信息</h1>
              <div class="main-content ml30 mt10">
              	
              	<?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select shop_name,store_name,logo,shop_class,shop_addr,sdsj,tjzs,shop_money from shop where shop_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($shop_name,$store_name,$logo,$shop_class,$shop_addr,$sdsj,$tjzs,$money);
	                    while ($stmt->fetch()) {
	            ?>
                <h2><span class="dib w100">店铺名:</span><?php echo $store_name; ?></h2>
                <figure class="clearfix">
                	<figcaption class="fl w100">LOGO</figcaption>
                	<img class="fl w70 h70" src="../image/shop/<?php echo $logo; ?>">
                </figure>
                <p><span class="dib w100">联系人电话:</span><?php echo $shop_name; ?></p>
                <p><span class="dib w100">门店分类</span><?php echo $shop_class; ?></p>
                <p><span class="dib w100">地址:</span><?php echo $shop_addr; ?></p>
                <p><span class="dib w100">送达时间:</span>平均送达时间<?php echo $sdsj; ?>分</p>
                <p><span class="dib w100 vm">推荐指数:</span><meter class=" w70 h10 vm" min="0" low="0.6" high="0.9" max="1" value="<?php echo $tjzs; ?>" optimum="100"></meter></p>
                <p><span class="dib w100">余额:</span><?php echo $money;?>元</p>
                <?php	
                	    }
	                    $stmt->close();
                }
                $mysqli->close();
              	?>
              </div> 
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
		</script>
	</body>
</html>
