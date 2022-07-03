<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>商品分类信息</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/shopProductInfo.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
		<script type="text/javascript" src="JS/shopProductInfo.js" ></script>
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
                		<li><a href="shopLssueOrder.php">发出的订单</a></li>
                		<li><a href="shopHistoryOrder.php">历史订单</a></li>
                	</ul>
                </li>
                <li>
                	商品管理
                	<ul class="userInfoList-item">
                		<li><a class="active" href="shopProductInfo.php">商品信息</a></li>
                		<li><a href="addProduct.php">添加商品</a></li>
                	</ul>
                </li>
			</ul>
			<div class="main fr f14 fc6">
                <h1 class="f18">商品分类信息</h1>
                <div class="main-header mt30 clearfix pl150 pr150">
                	 <div class="main-header-left fl">
                	 	<span class="fl mr20">分类</span>
                	 	<div class="classIf fl w200 h40 bb pl15 pr15 f0 pr">
                	 	   <span class="classIf-box dib f14">全部商品</span>
                	 	   <span class="dib listIcon"></span>
                	 	   <span class="dib "></span>
                	 	   <ul class="classIf-content cb w200 f14 bb pa none">
                	 	   </ul>
                	 	</div>
                	 </div>
                	 <div class="main-header-right fr f0">
                	 	<label class="mr20 f14">添加分类</label>
                	 	<input class="w200 h40 bb pl15 fc6" id="insertClassText" type="text">
                	 	<button class="w60 h40 bb nb fcf" id="addClassBt">添加</button>
                	 </div>
                </div>
                <div class="main-content clearfix mt20">
                	<!--<div class="productInfo fl clearfix mb10 pr">
                		<figure class="fl pr">
                			<img class="w100 h100" src="../image/food.png">
                			<input class="imgSc w100 h100 bb pa" type="file">
                		</figure>
                		<div class="productInfo-details fl pl15 bb">
                			<input class="productName db h20 bb pl10 mt5 f12 fc9" type="text" value="大包子">
                			<p class="f0">
                			    <span class="dib w80 mt5 mb5 f12">月销售额1000</span>
                			    <select class="selectClass w100 h20 mt5 f12 bb">
                				    <option>新品上市</option>
                				    <option>好东西水水sadsad水</option>
                				    <option>最新特价</option>
                			    </select>
                			</p>
                			<input class="productMoney db h20 bb pl10 f12 fc9" type="text" value="16.00">
                			<div class="productControl f0 mt5">
                				<button class="control-edit nb w60 h20 fcf ml10">修改</button>
                				<button class="control-delete nb w60 h20 fcf ml10">删除</button>
                			</div>
                		</div>
                	</div>-->
                	
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
	</body>
</html>
