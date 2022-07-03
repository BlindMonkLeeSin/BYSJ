<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<title>修改信息</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/shopEidtInfo.css" />
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
                		<li><a href="shopInfo.php">基本信息</a></li>
                		<li><a class="active" href="shopEidtInfo.php">修改信息</a></li>
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
                <h1 class="f18">修改信息</h1>
                <div class="main-content ml30 mt20">            	
              	<?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select shop_tel,open_time,start_time,psf,qbj,introduce,notice from shop where shop_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($shop_tel,$open_time,$start_time,$psf,$qbj,$introduce,$notice);
	                    while ($stmt->fetch()) {
	            ?> 	
	              <form  action="updateShopInfo.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
                	<div class="mb10">
                		<label class="dib w100">外卖电话</label>
                		<input class="w200 h40 bb pl15 fc3" type="text" name="shopTel" value="<?php echo $shop_tel; ?>" >
                	</div>
                	<div class="mb10">
                		<label class="dib w100">营业时间</label>
                		<input class="w200 h40 bb pl10 mr10 fc3" type="time" name="openTime" value="<?php echo $open_time; ?>">
                		<input class="w200 h40 bb pl10 fc3" type="time" name="startTime" value="<?php echo $start_time; ?>">
                	</div>
                	<div class="mb10">
                		<label class="dib w100">配送费</label>
                		<input class="w200 h40 bb pl15 fc3" type="text" name="psf" value="<?php echo $psf; ?>">
                	</div>
                	<div class="mb10">
                		<label class="dib w100">起步价</label>
                		<input class="w200 h40 bb pl15 fc3" type="text" name="qbj" value="<?php echo $qbj; ?>">
                	</div>
                	<div class="main-content-notice mb20 fl">
                		<label class="notice-title db tc fcf mr100">简介</label>
                		<textarea class="notice-content h100 bb p5 f12 fc3" name="introduce"><?php echo $introduce; ?></textarea>                			
                	</div>
                	<div class="main-content-notice mb20 fl">
                		<label class="notice-title db tc fcf">公告</label>
                		<textarea class="notice-content h100 bb p5 f12 fc3" name="notice"><?php echo $notice; ?></textarea>                			
                	</div>
                	<div class="tc cb">
                		<button class="main-content-submit w100 h30 nb fcf tc" type="submit">修改</button>
                	</div>
                  </form>
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
